<?php

namespace App\Notifications;

use App\Models\UserDevice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class SendPushNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $user;
    protected $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($user,$title,$message,$url='')
    {
        $this->title = $title;
        $this->message = $message;
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['firebase'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toFirebase($notifiable)
    {
        $tokens = UserDevice::where('user',$this->user->id)->get();
        if ($tokens->count()>0){
            $deviceTokens=[];
            foreach ($tokens as $token) {
                $tok[]=$token->token;

                $deviceTokens=$tok;
            }

            return (new FirebaseMessage())
                ->withTitle($this->title)
                ->withIcon(asset('icon.png'))
                ->withClickAction($this->url)
                ->withBody($this->message)
                ->withPriority('high')->asMessage($deviceTokens);
        }

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
