<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendDepartmentNotification extends Notification
{
    use Queueable;
    private mixed $department,$message,$subject,$file;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($department,$subject,$message,$file=null)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->department = $department;
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
            ->greeting('Hello '.$this->department->name)
            ->subject($this->subject)
            ->line($this->message)
            ->attach(empty($this->file)?public_path('nextropay.png'):$this->file)
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
