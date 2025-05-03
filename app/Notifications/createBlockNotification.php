<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class createBlockNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    
    private $user_create;
    private $blocked;
    public function __construct($user_create,$blocked)
    {
   
    $this->user_create=$user_create;
    $this->blocked=$blocked;
   
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
             
            'blocked'=> $this->blocked,
            'user_create'=>auth()->user()->name  ,

        ];
    }
}
