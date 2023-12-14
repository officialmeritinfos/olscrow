<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Package;
use App\Models\Service;
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
            $party = User::where('id',$booking->user)->first();
        }else{

            $booking = UserBooking::where('escortId',$user->id)->where('reference',$id)->firstOrFail();
            $party = User::where('id',$booking->escortId)->first();
        }
        return view('dashboard.pages.booking.detail')->with([
            'user'=>$user,
            'pageName'=>'Booking Detail',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'booking'=>$booking,
            'package'=>Order::where('id',$booking->orderId)->first(),
            'party'=>$party
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

            //since this is time bound, bounce back if it has elapsed
            if (time() > $booking->timeAcceptBooking){
                return $this->sendError('booking.error',['error'=>'Time to accept booking has elapsed']);
            }

            $booker = User::where('id',$booking->user)->first();
            $booking->status=4;
            $booking->save();
            //notify booker
            $message = "Your booking with '.$user->displayName.' has been accepted. Please endeavour to meet up with your escort as agreed.";
            $booker->notify(new SendPushNotification($booker,'Booking accepted by Escort',$message));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Booking accepted, and client notified');

        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('booking.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
}
