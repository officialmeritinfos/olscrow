<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EscortProfile;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Service;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Orders extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('dashboard.pages.orders.index')->with([
            'user'=>$user,
            'pageName'=>'Your Orders',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'orders'=>Order::where('user',$user->id)->paginate(10)
        ]);
    }
    //process new order creation
    public function processOrderCreation(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'description' => ['required', 'string'],
                'title' => ['required', 'string'],
                'amount' => ['required', 'numeric'],
                'overnight' => ['required', 'numeric'],
                'weekend' => ['required', 'numeric'],
                'personalized' => ['nullable', 'numeric','integer'],
                'service'=>['required'],
                'service.*'=>['required','numeric','exists:services,id']
            ],[],[
                'amount'=>'Short-time fee',
                'overnight'=>'Overnight fee',
                'weekend'=>'Weekend fee',
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();

            //check that user has updated profile
            $hasUpdatedProfile = EscortProfile::where('user',$user->id)->first();

            if ($user->accountType==1 && empty($hasUpdatedProfile)){
                return $this->sendError('profile.error',['error'=>'Please update your public profile first']);
            }
            //check for location
            if ($user->accountType==1 && empty($user->city)){
                return $this->sendError('profile.error',['error'=>'Please update your public location first']);
            }

            $services = implode(',',$input['service']);

            $reference = $this->generateUniqueReference('orders', 'reference', 20);
            //collate the data to generate account
            $dataCollate = [
                'title' => $input['title'],
                'reference' => $reference,
                'amount' => $input['amount'],
                'overnight' => $input['overnight'],
                'weekend' => $input['weekend'],
                'personalized'=>$request->has('personalized')?1:2,
                'description'=>$input['description'],'status'=>1,
                'user'=>$user->id,'currency'=>$user->mainCurrency,
                'services'=>$services
            ];

            $order = Order::create($dataCollate);
            if (!empty($order)){
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Order successfully created');
            }
            return $this->sendError('order.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('order.error',['error'=>'Internal Server error']);
        }
    }
    //edit order
    public function editOrder($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $order = Order::where([
            'user'=>$user->id,'reference'=>$id
        ])->firstOrFail();

        return view('dashboard.pages.orders.edit')->with([
            'user'=>$user,
            'pageName'=>'Edit order',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'order'=>$order
        ]);
    }
    //delete order
    public function deleteOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'id' => ['required', 'string',Rule::exists('orders','reference')->where('user',$user->id)],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();

            Order::where('reference',$input['id'])->delete();

            return $this->sendResponse(['redirectTo'=>url()->previous()],'Order successfully removed');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('order.error',['error'=>'Internal Server error']);
        }

    }
    //update order
    public function updateOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'description' => ['required', 'string'],
                'title' => ['required', 'string'],
                'amount' => ['required', 'numeric'],
                'overnight' => ['required', 'numeric'],
                'weekend' => ['required', 'numeric'],
                'personalized' => ['nullable', 'numeric','integer'],
                'status' => ['required', 'numeric','integer'],
                'service'=>['required'],
                'service.*'=>['required','numeric','exists:services,id'],
                'id' => ['required', 'string',Rule::exists('orders','reference')->where('user',$user->id)],
            ],[],[
                'amount'=>'Short-time fee',
                'overnight'=>'Overnight fee',
                'weekend'=>'Weekend fee'
            ])->stopOnFirstFailure();

            if ($validator->fails()){
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            $input = $validator->validated();

            $services = implode(',',$input['service']);

            //collate the data to generate account
            $dataCollate = [
                'title' => $input['title'],
                'amount' => $input['amount'],
                'overnight' => $input['overnight'],
                'weekend' => $input['weekend'],
                'personalized'=>$request->has('personalized')?1:2,
                'description'=>$input['description'],'status'=>$input['status'],
                'currency'=>$user->mainCurrency,
                'services'=>$services
            ];

            $update = Order::where('reference',$input['id'])->update($dataCollate);
            if ($update){
                return $this->sendResponse([
                    'redirectTo'=>route('user.orders')
                ],'Order successfully updated');
            }
            return $this->sendError('order.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('order.error',['error'=>'Internal Server error']);
        }
    }
}
