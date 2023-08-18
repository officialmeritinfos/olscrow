<?php

namespace App\Notifications;

use App\Models\GeneralSetting;
use App\Models\PasswordReset;
use App\Traits\Regular;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PasswordRecovery extends Notification
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

        PasswordReset::create([
            'user'          =>$user->id,
            'email'         =>$user->email,
            'token'         =>bcrypt($token),
            'codeExpire'    =>strtotime($web->codeExpire,time())
        ]);
        //authenticate user
        Auth::login($user);

        //generate token
        return (new MailMessage)
            ->subject('Account Recovery Verification')
            ->greeting('Hello '.$user->name)
            ->line('We have received a password reset on your account at '.env('APP_NAME').'. Use the code
            below to verify this request.')
            ->line('<p style="text-align: center;"><b>'.$token.'</b></p>')
            ->line('<p style="text-align: center;">Token is valid for '.$web->codeExpire.'</p>.
                <p>Ignore if this request not made by you, and do not share this code with anyone.</p>')
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
