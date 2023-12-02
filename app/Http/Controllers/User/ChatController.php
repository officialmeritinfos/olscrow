<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserChat;
use App\Models\UserChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    //landing page
    public function landingPage()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.chats.index')->with([
            'web'=>$web,
            'pageName'=>'Chat Room',
            'siteName'=>$web->name,
            'user'=>$user,
            'chats'=>UserChat::where(function ($query) use ($user) {
                $query->where('sender', $user->id)
                    ->where('deletedForSender', '!=',1);
            })
                ->orWhere(function ($query) use ($user) {
                    $query->where('receiver', $user->id)
                        ->where('deletedForReceiver', '!=',1);
                })
                ->get()
        ]);
    }
    //fetch the conversations in a particular chat
    public function fetchChat($chatId)
    {
        $user = Auth::user();
        $chat = UserChat::where('reference',$chatId)->first();
        $messages = UserChatMessage::where('chatId',$chat->reference)->get();

        if ($user->id!=$chat->sender){
            $userPlace = User::find($chat->sender);
            $title =$userPlace->name;
        }elseif ($user->id!=$chat->receiver){
            $userPlace = User::find($chat->receiver);
            $title =$userPlace->name;
        }
        $dataCo=[];

        foreach ($messages as $message) {
            $data=[
                'message'=>$message->message,
                'created_at'=>$message->created_at,
                'sender'=>$message->sender,
                'seen'=> $message->seen==1,
            ];

            $dataCo[]=$data;
        }

        return $this->sendResponse([
            'data'=>$dataCo,
            'receiver'=>$title
        ],'fetched');
    }
}
