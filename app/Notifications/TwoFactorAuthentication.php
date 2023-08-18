<?php

namespace App\Notifications;

use App\Models\GeneralSetting;
use App\Models\TwoFactor;
use App\Traits\Regular;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorAuthentication extends Notification
{
    use Queueable,Regular;
    public mixed $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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

        TwoFactor::create([
            'user'          =>$user->id,
            'email'         =>$user->email,
            'token'         =>bcrypt($token),
            'codeExpire'    =>strtotime($web->codeExpire,time())
        ]);
        return (new MailMessage)
                ->subject('Two-factor Authentication')
                ->greeting('Welcome '.$user->name)
                ->line('There is a Login request on your '.env('APP_NAME').' account.
                 However, there is a Two factor authentication on your account. Use the code below to
                 authenticate this request. ')
                ->line('<p style="text-align: center;"><b>'.$token.'</b></p>')
                ->line('<p style="text-align: center;">Token is valid for '.$web->codeExpire.'</p>
                            <p>Do not share this code with anybody via mail, sms, or phone call.
                                None of our staff will ever ask for it either. Be vigilant!
                            </p>')
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
