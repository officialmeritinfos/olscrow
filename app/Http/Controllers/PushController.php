<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PushController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //store
    public function store(Request $request){
        try{
            UserDevice::updateOrCreate([
                'user'=>$request->user()->id,
                'token'=>$request->token
            ]);
            //$request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }

    public function push(){
        $user=Auth::user();
        $user->notify(new SendPushNotification($user,'Welcome to Oloscrow','We are glad you joined us',route('login')));
    }
}
