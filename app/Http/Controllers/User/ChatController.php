<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserChat;
use App\Models\UserChatMessage;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $messages = UserChatMessage::where('chatId',$chat->reference)->orderBy('created_at', 'asc')->get();

        if ($user->id!=$chat->sender){
            $userPlace = User::find($chat->sender);
            $title =$userPlace->name;
            $image = empty($userPlace->photo)?"https://ui-avatars.com/api/?name=$userPlace->name&background=random&round=true":$userPlace->photo;
        }elseif ($user->id!=$chat->receiver){
            $userPlace = User::find($chat->receiver);
            $title =$userPlace->name;
            $image = empty($userPlace->photo)?"https://ui-avatars.com/api/?name=$userPlace->name&background=random&round=true":$userPlace->photo;
        }
        $dataCo=[];

        foreach ($messages as $message) {
            $sender = User::find($message->sender);
            $data=[
                'message'=>$message->message,
                'created_at'=>$message->created_at,
                'sender'=>$message->sender,
                'seen'=> $message->seen==1,
                'name'=>$sender->name,
                'photo'=>empty($sender->photo)?"https://ui-avatars.com/api/?name=$sender->name&background=random&round=true":$sender->photo,
                'hour'=>date('h:i A',strtotime($message->created_at))
            ];

            $dataCo[]=$data;
        }

        return $this->sendResponse([
            'data'=>$dataCo,
            'receiver'=>$title,
            'photo'=>$image,
            'reference'=>$chat->reference,
            'link'=>route('user.chat.content',['id'=>$chat->reference])
        ],'fetched');
    }
    //send message
    public function sendMessage(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'chatId' => ['required', 'string','exists:user_chats,reference'],
                'message' => ['required', 'string'],
            ],[
                'required'=>'You cannot send empty message'
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();

            $chat = UserChat::where('reference',$input['chatId'])->where(function ($query) use($user){
                $query->where('sender',$user->id)->orWhere('receiver',$user->id);
            })->first();
            if (empty($chat)){
                return $this->sendError('chat.error',['error'=>'Attempting to respond to a chat you do not have the privilege']);
            }

            $message = UserChatMessage::create([
                'chatId'=>$chat->reference,
                'message'=>$input['message'],
                'sender'=>$user->id
            ]);
            if (!empty($message)){
                //send push notification
                if ($chat->sender!=$user->id){
                    $receiver = User::find($chat->sender);
                    $receiver->notify(new SendPushNotification($receiver,'New Message from '.$receiver->name,$input['message']));
                }elseif ($chat->receiver!=$user->id){
                    $receiver = User::find($chat->receiver);
                    $receiver->notify(new SendPushNotification($receiver,'New Message from '.$receiver->name,$input['message']));
                }

                return $this->sendResponse([
                    'redirectTo'=>url()->previous(),
                    'reference'=>$chat->reference,
                    'link'=>route('user.chat.content',['id'=>$chat->reference])
                ],'Sent');

            }
            return  $this->sendError('chat.error',['error'=>'Unable to deliver message']);
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('order.error',['error'=>'Internal Server error']);
        }
    }
}
