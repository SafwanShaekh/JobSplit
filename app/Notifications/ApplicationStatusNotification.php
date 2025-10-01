<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    protected $application;
    protected $status;

    public function __construct(Application $application, $status)
    {
        $this->application = $application;
        $this->status = $status; // 'Approved' ya 'Rejected'
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $jobTitle = $this->application->job->title;
        $message = "Your application for the job \"{$jobTitle}\" has been {$this->status}.";

        return [
            'message' => $message,
            'url' => route('applications.index'), // User ko 'Applied Jobs' page par le jayega
        ];
    }
}
