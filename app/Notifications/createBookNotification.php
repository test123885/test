<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class createBookNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $book_id;
    private $user_create;
    private $tiltle;
    public function __construct($book_id,$user_create,$tiltle)
    {
    $this->book_id=$book_id;
    $this->user_create=$user_create;
    $this->tiltle=$tiltle;
   
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'book_id'=> $this->book_id,
            'user_create'=>auth()->user()->name  ,
            'tiltle'=> $this->tiltle,

        ];
    }
}
