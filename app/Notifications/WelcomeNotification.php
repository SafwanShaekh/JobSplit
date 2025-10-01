<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database']; // Notification ko database mein save karega
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Welcome to the platform, ' . $this->user->name . '! We are excited to have you with us.',
            'url' => route('dashboard'), // User ko dashboard par le jayega
        ];
    }
}
