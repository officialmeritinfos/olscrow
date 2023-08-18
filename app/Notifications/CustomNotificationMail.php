<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomNotificationMail extends Notification
{
    use Queueable;
    public mixed $user,$title,$message,$file;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$title,$message,$file=null)
    {
        $this->user = $user;
        $this->title = $title;
        $this->message = $message;
        $this->file = $file;
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
        return (new MailMessage)
                    ->greeting('Hello '.$this->user)
                    ->subject($this->title)
                    ->line($this->message)
                    //->attach(empty($this->file)?public_path('nextropay.png'):$this->file)
                    ->action('Go to account', route('login'))
                    ->line('Thank you for using '.env('APP_NAME'));
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
