<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\BookingReport;
use App\Models\BookingReportAppeal;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Package;
use App\Models\ReportType;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBooking;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Regular;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Bookings extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $booking = UserBooking::where('escortId',$user->id)->paginate();

        if ($user->accountType!=1){
            $booking=UserBooking::where('user',$user->id)->paginate();
        }
        return view('dashboard.pages.booking.index')->with([
            'user'=>$user,
            'pageName'=>'Your Bookings',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'bookings'=>$booking
        ]);
    }
    //start a booking process
    public function startBookingProcess($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $package = Order::where('reference',$id)->first();
        if (empty($package)){
            return back()->with('error','We could not find this order.');
        }

        $escort = User::where('id',$package->user)->first();

        return view('dashboard.pages.hall.pages.booking_start')->with([
            'user'=>$user,
            'pageName'=>'Book an Escort - '.ucfirst($escort->username),
            'siteName'=>$web->name,
            'web'=>$web,
            'escort'=>$escort,
            'package'=>$package,
            'countries'=>Country::where('status',1)->get()
        ]);
    }
    //place booking
    public function processBooking(Request $request)
    {
        try {

            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'orderType' => ['required', 'numeric','integer','in:1,2,3'],
                'country' => ['required', 'string','exists:countries,iso3'],
                'state' => ['required', 'string'],
                'location' => ['required', 'string'],
                'package' => ['required', 'string','exists:orders,reference'],
                'escort' => ['required', 'numeric',Rule::exists('users','id')->where('accountType',1)],
                'dateToMeet'=>['required','date','after_or_equal:today'],
                'password'=>['required','current_password:web'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            $input = $validator->validated();

            $package = Order::where([
                'reference'=>$input['package'],
                'user'=>$input['escort'],
                'status'=>1
            ])->first();
            if (empty($package)){
                return $this->sendError('package.error',['error'=>'We cannot find this package you selected.']);
            }
            //check if the user has sufficient balance
            switch ($input['orderType']){
                case 1:
                    $amountDebit = $package->amount;
                    break;
                case 2:
                    $amountDebit = $package->overnight;
                    break;
                default:
                    $amountDebit = $package->weekend;
                    break;
            }
            //check for sufficient fund
            if ($amountDebit >$user->accountBalance){
                return $this->sendError('balance.error',['error'=>'Insufficient fund for balance']);
            }
            //escort profile
            $escort = User::where('id',$input['escort'])->first();
            $escortPackage = Package::where('id',$escort->package)->first();
            //check that escort is not booked the same day and not delivered
            $hasBooking = UserBooking::where([
                'escortId'=>$input['escort'],
                'bookDate'=>strtotime($input['dateToMeet']),
            ])->where(function ($query) {
                $query->where('status',1)->orWhere('status',4);
            })->get();

            if ($hasBooking->count()>0){
                return $this->sendError('booking.error',['error'=>'Escort is booked on the selected date. Please choose another time ']);
            }
            //stop user from booking an escort when he has a pending problem
            $userHasPendingEscort = UserBooking::where([
                'user'=>$user->id,
                'reported'=>1
            ])->first();
            if (!empty($userHasPendingEscort)){
                return $this->sendError('booking.error',['error'=>'You have a booking under appeal. Please resolve before you can proceed to booking another escort.']);
            }
            $user->accountBalance = $user->accountBalance - $amountDebit;
            //create booking
            $reference = $this->generateUniqueReference('user_bookings','reference');
            $transReference = $this->generateUniqueReference('transactions','reference');
            $charge = $escortPackage->fee/100*$amountDebit;
            $amountCredit = $amountDebit - $charge;
            $booking = UserBooking::create([
                'user'=>$user->id,'escortId'=>$escort->id,
                'reference'=>$reference,'currency'=>$package->currency,
                'amount'=>$amountDebit,'orderId'=>$package->id,
                'orderType'=>$input['orderType'],
                'paymentStatus'=>1,'country'=>$input['country'],
                'state'=>$input['state'],'location'=>$input['location'],
                'bookDate'=>strtotime($input['dateToMeet']),
                'amountCredit'=>$amountCredit,'charge'=>$charge,
                'status'=>2,'timeAcceptBooking'=>strtotime($web->bookingAcceptanceTime,time())
            ]);
            if (!empty($booking)){
                //create a transaction record for this transaction
                $transaction = Transaction::create([
                    'user'=>$user->id,'reference'=>$transReference,
                    'currency'=>$booking->currency,'amount'=>$booking->amount,
                    'purpose'=>'Escort Booking','orderId'=>$booking->id,'status'=>1,'type'=>2
                ]);
                $booking->transactionId=$transaction->id;
                $booking->save();


                $user->save();//update balance
                //send escort a notification
                $message = "A new booking has been placed on your escort profile on ".$web->name.". The reference ID is ".$reference.", and you have ".$web->bookingAcceptanceTime." to accept this booking";
                $escort->notify(new SendPushNotification($escort,'New Escort booking',$message));

                return $this->sendResponse([
                    'redirectTo'=>route('user.bookings')
                ],'Escort booking successfully placed.');
            }
            return $this->sendError('booking.error',['error'=>'Something went wrong while making your booking']);
        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //booking detail
    public function bookingDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        if ($user->accountType!=1){
            $booking=UserBooking::where('user',$user->id)->where('reference',$id)->firstOrFail();
            $party = User::where('id',$booking->escortId)->first();
        }else{

            $booking = UserBooking::where('escortId',$user->id)->where('reference',$id)->firstOrFail();
            $party = User::where('id',$booking->user)->first();
        }
        return view('dashboard.pages.booking.detail')->with([
            'user'=>$user,
            'pageName'=>'Booking Detail',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'booking'=>$booking,
            'package'=>Order::where('id',$booking->orderId)->first(),
            'party'=>$party,
            'reportTypes'=>ReportType::where('status',1)->get(),
            'report'=>BookingReport::where('bookingId',$booking->id)->first()
        ]);
    }
    //accept booking
    public function acceptBooking(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('escortId',$user->id)]
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'escortId'=>$user->id
            ])->first();

            if ($booking->status!=2){
                return $this->sendError('booking.error',['error'=>'Booking is either cancelled or has been accepted or even completed.']);
            }
            //since this is time bound, bounce back if it has elapsed
            if (time() > $booking->timeAcceptBooking){
                return $this->sendError('booking.error',['error'=>'Time to accept booking has elapsed']);
            }


            $booker = User::where('id',$booking->user)->first();
            $booking->status=4;
            $booking->save();
            //notify booker
            $message = "Your booking with $user->displayName has been accepted. Please endeavour to meet up with your escort as agreed.";
            $booker->notify(new SendPushNotification($booker,'Booking accepted by Escort',$message));
            $booker->notify(new CustomNotification($booker,$message,'Booking accepted by Escort'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking accepted, and client notified');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //request transport fee
    public function requestTransportFee(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('escortId',$user->id)],
                'amount'=>['required','numeric']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'escortId'=>$user->id
            ])->first();


            //check that order is active
            if ($booking->status !=4){
                return $this->sendError('booking.error',['error'=>'Booking is either completed or not active.']);
            }
            //check if request has been made before
            if ($booking->requestForTransport==1){
                return $this->sendError('booking.error',['error'=>'You have already requested for transport fee. Allow for client to respond.']);
            }



            $booker = User::where('id',$booking->user)->first();
            $booking->requestForTransport=1;
            $booking->transportStatus=4;
            $booking->transportFee=$input['amount'];
            $booking->save();
            //notify booker
            $message = "Your escort $user->displayName has requested for a transport fee of ".$booking->currency.number_format($input['amount'],2).". Login to approve request or decline the same.";
            $booker->notify(new SendPushNotification($booker,'Escort Request for Transport',$message));
            $booker->notify(new CustomNotification($booker,$message,'Escort Request for Transport.'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Transport Request sent.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //escort mark booking delivered
    public function escortMarkBookingDelivered(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('escortId',$user->id)],
                'password'=>['required','current_password:web']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'escortId'=>$user->id
            ])->first();

            if ($booking->status==2){
                return $this->sendError('booking.error',['error'=>'Booking is pending acceptance']);
            }

            if ($booking->status==3){
                return $this->sendError('booking.error',['error'=>'Booking has been cancelled']);
            }

            if ($booking->status==1){
                return $this->sendError('booking.error',['error'=>'Booking has been concluded already']);
            }

            if ($booking->reported==1){
                return $this->sendError('booking.error',['error'=>'Booking has been reported already. Please appeal instead']);
            }

            $booker = User::where('id',$booking->user)->first();
            $booking->approvedByEscort=1;
            $booking->timeToApproveByClient=strtotime($web->clientTimeToApproveBooking,time());
            $booking->save();
            //notify booker
            $message = "Your booking with $user->displayName has been marked as delivered. If this is not true, please appeal now. You have ".$web->clientTimeToApproveBooking." to appeal this approval";
            $booker->notify(new SendPushNotification($booker,'Escort Booking delivery',$message));
            $booker->notify(new CustomNotification($booker,$message,'Escort Booking delivery'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking marking as delivered and pending clients response.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //escort cancel booking
    public function escortCancelBooking(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('escortId',$user->id)],
                'password'=>['required','current_password:web'],
                'reason'=>['required','string']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'escortId'=>$user->id
            ])->first();

            if ($booking->status==2){
                return $this->sendError('booking.error',['error'=>'Booking is pending acceptance']);
            }

            if ($booking->status==3){
                return $this->sendError('booking.error',['error'=>'Booking has been cancelled']);
            }

            if ($booking->status==1){
                return $this->sendError('booking.error',['error'=>'Booking has been concluded already']);
            }
            $booker = User::where('id',$booking->user)->first();

            $amountRefund = 0;
            if ($booking->requestForTransport==1 && $booking->transportStatus==1){
                $amountRefund=$amountRefund+$booking->transportFee;
                $user->transportBalance = $user->transportBalance-$booking->transportFee;
                $user->save();
            }
            $amountRefund=$amountRefund+$booking->amount;

            $booking->status=3;
            $booking->paymentStatus=5;
            $booking->cancellationReason=$input['reason'];

            $booker->accountBalance=$booker->accountBalance+$amountRefund;
            $booker->save();
            $booking->save();

            //create transaction records for this transaction
            $transReference = $this->generateUniqueReference('transactions','reference');
            Transaction::create([
                'user'=>$booker->id,'reference'=>$transReference,
                'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                'purpose'=>'Refund for escort booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
            ]);
            //if transport was paid for, refund it
            if ($booking->requestForTransport==1 && $booking->transportStatus==1) {
                $tranReference = $this->generateUniqueReference('transactions', 'reference');
                Transaction::create([
                    'user' => $booker->id, 'reference' => $tranReference,
                    'currency' => $booking->currency, 'amount' => $booking->transportFee,
                    'purpose' => 'Refund for escort transport for booking '.$booking->reference, 'orderId' => $booking->id, 'status' => 1, 'type' => 1
                ]);
            }
            //notify booker
            $message = "Your booking with $user->displayName has been cancelled by the escort, and every pending appeals resolved, and full amount paid refunded to your balance. We are sorry for the inconveniences";
            $booker->notify(new SendPushNotification($booker,'Escort Booking Cancelled',$message));
            $booker->notify(new CustomNotification($booker,$message,'Escort Booking Cancelled'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking cancelled.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //approve transport request
    public function approveEscortTransport(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('user',$user->id)],
                'password'=>['required','current_password:web']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'user'=>$user->id
            ])->first();

            //check that order is active
            if ($booking->status !=4){
                return $this->sendError('booking.error',['error'=>'Booking is either completed or not active.']);
            }
            //check if request has been made before
            if ($booking->transportStatus!=4){
                return $this->sendError('booking.error',['error'=>'You have either responded to this request or the request was never made.']);
            }
            //check for sufficient balance
            if ($user->accountBalance <$booking->transportFee){
                return $this->sendError('booking.error',['error'=>'Insufficient balance to cover this bill. Please topup account.']);
            }

            $user->accountBalance = $user->accountBalance-$booking->transportFee;
            $escort = User::where('id',$booking->escortId)->first();
            $escort->transportBalance = $escort->transportBalance+$booking->transportFee;

            $transReference = $this->generateUniqueReference('transactions','reference');

            $transaction = Transaction::create([
                'user'=>$user->id,'reference'=>$transReference,
                'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                'purpose'=>'Escort Transport Fare for Booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>2
            ]);

            $booking->transportStatus=1;
            $booking->transportTranId=$transaction->reference;
            $booking->save();
            $escort->save();
            $escort->save();
            //notify booker
            $message = "Your request for transport for the booking with ID $booking->reference has approved and your transport account funded. Note that this will be released only at the completion of service.";
            $escort->notify(new SendPushNotification($escort,'Booking Transport Request Approval',$message));
            $escort->notify(new CustomNotification($escort,$message,'Booking Transport Request Approval'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Transport Request approved.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //reject transport request
    public function rejectEscortTransport(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('user',$user->id)],
                'password'=>['required','current_password:web'],
                'reason'=>['required','string']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'user'=>$user->id
            ])->first();

            //check that order is active
            if ($booking->status !=4){
                return $this->sendError('booking.error',['error'=>'Booking is either completed or not active.']);
            }
            //check if request has been made before
            if ($booking->transportStatus!=4){
                return $this->sendError('booking.error',['error'=>'You have either responded to this request or the request was never made.']);
            }
            //check for sufficient balance
            if ($user->accountBalance <$booking->transportFee){
                return $this->sendError('booking.error',['error'=>'Insufficient balance to cover this bill. Please topup account.']);
            }

            $escort = User::where('id',$booking->escortId)->first();

            $booking->transportStatus=3;
            $booking->save();
            $escort->save();
            $escort->save();
            //notify booker
            $message = "Your request for transport for the booking with ID $booking->reference has rejected.";
            $escort->notify(new SendPushNotification($escort,'Booking Transport Request Rejected',$message));
            $escort->notify(new CustomNotification($escort,$message,'Booking Transport Request Rejected'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Transport Request rejected.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //user cancel booking
    public function userCancelBooking(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('user',$user->id)],
                'password'=>['required','current_password:web'],
                'reason'=>['required','string']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'user'=>$user->id
            ])->first();

            if ($booking->status!=2){
                return $this->sendError('booking.error',['error'=>'Booking is has been accepted already.']);
            }

            if ($booking->status==3){
                return $this->sendError('booking.error',['error'=>'Booking has been cancelled']);
            }

            if ($booking->status==1){
                return $this->sendError('booking.error',['error'=>'Booking has been concluded already']);
            }

            $amountRefund=$booking->amount;

            $transReference = $this->generateUniqueReference('transactions','reference');

            Transaction::create([
                'user'=>$user->id,'reference'=>$transReference,
                'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                'purpose'=>'Refund for escort booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
            ]);

            $escort = User::where('id',$booking->escortId)->first();
            $booking->status=3;
            $booking->paymentStatus=5;
            $booking->cancellationReason=$input['reason'];

            $user->accountBalance=$user->accountBalance+$amountRefund;
            $user->save();
            $booking->save();
            //notify booker
            $message = "Your booking with $user->username has been cancelled by the user, and every pending appeals resolved, and full amount paid refunded to their balance. We are sorry for the inconveniences";
            $escort->notify(new SendPushNotification($escort,'Escort Booking Cancelled',$message));
            $escort->notify(new CustomNotification($escort,$message,'Escort Booking Cancelled'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking cancelled.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //user mark booking delivered
    public function userMarkBookingDelivered(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'booking'=>['required','numeric',Rule::exists('user_bookings','id')->where('user',$user->id)],
                'password'=>['required','current_password:web']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id'=>$input['booking'],'user'=>$user->id
            ])->first();

            if ($booking->status==2){
                return $this->sendError('booking.error',['error'=>'Booking is pending acceptance']);
            }

            if ($booking->status==3){
                return $this->sendError('booking.error',['error'=>'Booking has been cancelled']);
            }

            if ($booking->status==1){
                return $this->sendError('booking.error',['error'=>'Booking has been concluded already']);
            }

            if ($booking->approvedByEscort!=1){
                return $this->sendError('booking.error',['error'=>'Please wait for escort to confirm this first.']);
            }

            $escort = User::where('id',$booking->escortId)->first();

            $amountCredit = 0;
            if ($booking->requestForTransport==1 && $booking->transportStatus==1){
                $amountCredit = $amountCredit+$booking->transportFee;
                $escort->transportBalance = $escort->transportBalance-$booking->transportFee;
            }
            $amountCredit = $amountCredit+$booking->amountCredit;
            $escort->accountBalance = $escort->accountBalance+$amountCredit;//credit escort

            $transReference = $this->generateUniqueReference('transactions','reference');
            Transaction::create([
                'user'=>$escort->id,'reference'=>$transReference,
                'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                'purpose'=>'Payment for booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
            ]);
            $tranReference = $this->generateUniqueReference('transactions','reference');
            Transaction::create([
                'user'=>$escort->id,'reference'=>$tranReference,
                'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                'purpose'=>'Payment for Tfare for booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
            ]);

            //handle referral
            $referral = $this->handleReferralCrediting($escort,$booking->charge,$booking);

            $escort->save();
            $booking->approvedByUser=1;
            $booking->status=1;
            $booking->referralAmount=$referral;
            $booking->save();

            //notify booker
            $message = "Your booking with $user->username has been marked as delivered. Your funds have been released into your account.";
            $escort->notify(new SendPushNotification($escort,'Escort Booking delivery',$message));
            $escort->notify(new CustomNotification($escort,$message,'Escort Booking delivery'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking marked as delivered and completed');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //user reports booking
    public function userReportBooking(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'booking' => ['required', 'numeric', Rule::exists('user_bookings', 'id')->where('user', $user->id)],
                'password' => ['required', 'current_password:web'],
                'reportType'=>['required','numeric','exists:report_types,id'],
                'reportDetail'=>['required','string']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id' => $input['booking'], 'user' => $user->id
            ])->first();

            if ($booking->status == 2) {
                return $this->sendError('booking.error', ['error' => 'Booking is pending acceptance']);
            }


            if ($booking->status == 3) {
                return $this->sendError('booking.error', ['error' => 'Booking has been cancelled']);
            }

            if ($booking->status == 1) {
                return $this->sendError('booking.error', ['error' => 'Booking has been concluded already']);
            }

            if ($booking->reported==1){
                return $this->sendError('booking.error', ['error' => 'Booking has been reported already']);
            }

            $escort = User::where('id',$booking->escortId)->first();

            $reference = $this->generateUniqueReference('booking_reports','reference',15);

            $report = BookingReport::create([
                'bookingId'=>$booking->id,'reference'=>$reference,'escortId'=>$escort->id,
                'user'=>$user->id,'reportType'=>$input['reportType'],'reportDetail'=>$input['reportDetail'],
                'lastResponder'=>$user->id,'status'=>2
            ]);

            $booking->reported=1;
            $booking->report=$input['reportType'];
            $booking->reportMessage = $input['reportDetail'];
            $booking->reportedBy=1;
            $booking->reportId = $report->id;
            $booking->timeToAppeal = strtotime($web->clientTimeToApproveBooking,time());
            $booking->save();

            //send escort notification
            $message = "Your booking with id $booking->reference has been reported by your client. You have ".$web->clientTimeToApproveBooking." to appeal this report or we will cancel this transaction and refund the client.";
            $escort->notify(new SendPushNotification($escort,'Escort Booking Reported',$message));
            $escort->notify(new CustomNotification($escort,$message,'Escort Booking Reported'));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking reported. We will intervene once escort appeals or you receive a refund if escort fails to appeal.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //booking report detail
    public function bookingReportDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        if ($user->accountType!=1){
            $booking=UserBooking::where('user',$user->id)->where('reference',$id)->firstOrFail();
        }else{

            $booking = UserBooking::where('escortId',$user->id)->where('reference',$id)->firstOrFail();
        }
        $report = BookingReport::where('bookingId',$booking->id)->first();

        return view('dashboard.pages.booking.report_detail')->with([
            'user'=>$user,
            'pageName'=>'Booking Report Detail',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'booking'=>$booking,
            'package'=>Order::where('id',$booking->orderId)->first(),
            'reportType'=>ReportType::where('id',$report->reportType)->first(),
            'report'=>$report,
            'escort'=>User::where('id',$booking->escortId)->first(),
            'client'=>User::where('id',$booking->user)->first(),
        ]);
    }
    //escort appeal report
    public function escortAppealReport(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'booking' => ['required', 'numeric', Rule::exists('user_bookings', 'id')->where('escortId', $user->id)],
                'password' => ['required', 'current_password:web'],
                'appealDetail'=>['required','string']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $booking = UserBooking::where([
                'id' => $input['booking'], 'escortId' => $user->id
            ])->first();

            if ($booking->status == 2) {
                return $this->sendError('booking.error', ['error' => 'Booking is pending acceptance']);
            }

            if ($booking->status == 3) {
                return $this->sendError('booking.error', ['error' => 'Booking has been cancelled']);
            }

            if ($booking->status == 1) {
                return $this->sendError('booking.error', ['error' => 'Booking has been concluded already']);
            }

            if ($booking->reported!=1){
                return $this->sendError('booking.error', ['error' => 'Booking has not been reported.']);
            }

            if ($booking->timeToAppeal <time()){
                return $this->sendError('booking.error', ['error' => 'Time to appeal has elapsed. Please await judgement by support.']);
            }

            $report = BookingReport::where('bookingId',$booking->id)->first();
            $booker = User::where('id',$booking->user)->first();

            BookingReportAppeal::create([
                'reportId'=>$report->id,'escortId'=>$user->id,'user'=>$booking->user,
                'appealMessage'=>$input['appealDetail'],'type'=>2
            ]);

            $booking->appealed=1;
            $report->status=4;
            $report->timeSupportIntervene=strtotime($web->supportInterveneTime,time());
            $report->appealed=1;
            $report->appealMessage = $input['appealDetail'];
            $booking->save();
            $report->save();

            //send notification to support and booker
            $bookerMessage = "Your report with ID $report->reference has been appealed by the Escort. We are allowing a window of ".$web->supportInterveneTime." for resolution by both parties before support intervenes";
            $booker->notify(new SendPushNotification($booker,'Escort booking report Appealed',$bookerMessage));
            $booker->notify(new CustomNotification($booker,$bookerMessage,'Escort booking report Appealed'));

            //send mail to admin
            $message = "The Escort Booking reported by ".$booker->name." against the escort ".$user->name." for the booking with ID ".$booking->reference." has been appealed by the escort";
            $this->sendMailToAdmin('Escort Booking Report Appealed',$message);

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Report Appealed. A customer support agent will wade into the situation in the next '.$web->supportInterveneTime.' if both parties fails to reach a compromise.');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
}
