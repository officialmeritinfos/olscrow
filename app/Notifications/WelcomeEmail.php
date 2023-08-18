<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
{
    use Queueable;
    public $name;

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
        $url = route('login');
        return (new MailMessage)
                ->subject('Welcome to '.env('APP_NAME'))
                ->greeting('Welcome '.$this->name)
                ->line('Welcome to '.env('APP_NAME').', your secured meetup app. I am John,the CEO of '.env('APP_NAME').'.')
                ->line('While building '.env('APP_NAME').', we envisioned an all inclusive solution for people
                of legal ages to safely and securely hook and get to know each other without either party being
                scared of being duped. So we created this app<br/>
                We want you to have the best experience while using our platform, and if you should ever meet any challenge,
                please contact our 24/7 support channel right away.')
                ->action('Go to Dashboard', $url)
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
