<?php

namespace App\Notifications;

use App\Models\Fiat;
use App\Models\GeneralSetting;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class SendSimpleInvoice extends Notification
{
    use Queueable;
    public $business;
    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($business, $invoice)
    {
        $this->business = $business;
        $this->invoice = $invoice;
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
        $invoice = $this->invoice;
        $business = $this->business;

        $urlToView=route('viewInvoice',['ref'=>$invoice->reference]);

        return (new MailMessage)
                    ->subject('Payment Request from '.$business->name)
                    ->greeting('Hi '.$invoice->name)
                    ->line($business->name.' sent you a payment invoice of
                    <b style="font-size:15px;color: #0b0b0b;">
                    '.$invoice->fiat.number_format($invoice->amount,2).'</b> for
                    <b style="font-size:15px;color: #0b0b0b;">'.$invoice->title.'</b><br><hr/>')
//                    ->line('Find details below<br>')
//                    ->line("<b>Title</b>: ".$invoice->title."<br>
//                                <b>Reference</b>: ".$invoice->reference."<br>
//                                <b>Amount</b>: ".$invoice->fiat.number_format($invoice->amount,2)."<br>
//                                <b>Note To Customer</b>: ".empty($invoice->note)?'N/A':$invoice->note."<br>
//                                <b>Due Date</b>: N/A<br>
//                                <b>Date Issued</b>: ".date('d-m-Y h:i:s',strtotime($invoice->created_at))."<br>
//                    ")
                    ->line("<p>Click the button below to view full invoice and make payment.</p>")
                    ->action('Proceed To Invoice', $urlToView)
                    ->line('Thank you for trusting '.$business->name);
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
