<?php

namespace App\Notifications;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailForPartner extends Notification
{
    use Queueable;
    public string $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
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
        $web = GeneralSetting::find(1);
        return (new MailMessage)
            ->subject('Welcome to '.env('APP_NAME').' Partnership programme.')
            ->greeting('Welcome '.$this->name)
            ->line('Welcome to the '.env('APP_NAME').' partnership programme,
                your one stop Blockchain Infrastructure and cryptocurrency payment processing solution.')
            ->line('We are delighted that you declared to join the '.env('APP_NAME').' Partnership Programme,
                and help us build a formidable Payment processing platform while earning from our numerous commissions.
                <br/>
                <b>NOTE</b>:This is a pre-launch registration and no other activity is needed to be done by you.
                    You will be notified as soon as we launch to proceed with account completion.
                    <br/> Please join our Community of Partners on Telegram where we will keep you updated using the link
                    below.')
            ->action('Join Community', $web->telegramCommunity)
            ->line('Thank you for choosing '.env('APP_NAME'));
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
