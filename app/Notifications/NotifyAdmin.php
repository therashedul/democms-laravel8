<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NotifyAdmin extends Notification implements ShouldQueue
{
    use Queueable;
    private $user;

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
        return ['database'];
    }

 

    /**
     * Get the array representation of the notification.
     *  // 'comment' => $this->user,
      *      // 'user' => User::find($this->comment->user_id),
       *     // 'post' => Post::find($this->comment->post_id),
        *    // 'profile' => Profile::find($this->comment->user_id)
     
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }
}
