<?php

namespace App\Notifications;

use App\Models\Email;
use App\Models\GeneralSetting;
use App\Traits\Regular;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification
{
    use Queueable,Regular;
    public mixed $user,$partner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$partner=2)
    {
        $this->user = $user;
        $this->partner = $partner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->user;
        $web = GeneralSetting::find(1);
        $token = $this->generateToken('emails','token');

        Email::create([
            'user'          =>$user->id,
            'email'         =>$user->email,
            'token'         =>bcrypt($token),
            'codeExpire'    =>strtotime($web->codeExpire,time()),
            'isPartner'     =>$this->partner
        ]);
        //generate token
        return (new MailMessage)
                    ->subject('Email Verification')
                    ->greeting('Welcome '.$user->name)
                    ->line('Your account is almost created. Use the code below to verify your email
                        address on '.env('APP_NAME').' and enjoy unlimited features.')
                    ->line('<p style="text-align: center;"><b>'.$token.'</b></p>')
                    ->line('<p>Token is valid for '.$web->codeExpire.'</p>')
                    ->line('Thank you for using our choosing '.env('APP_NAME'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
