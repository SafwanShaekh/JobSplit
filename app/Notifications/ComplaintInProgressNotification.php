<?php

namespace App\Notifications;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ComplaintInProgressNotification extends Notification
{
    use Queueable;

    protected $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'complaint_id' => $this->complaint->id,
            'subject' => $this->complaint->subject,
            'message' => 'An update on your complaint "' . $this->complaint->subject . '": It is now in progress.',
        ];
    }
}