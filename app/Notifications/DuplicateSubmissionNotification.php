<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DuplicateSubmissionNotification extends Notification
{
    use Queueable;

    protected $studentName;
    protected $orNo;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @param string $studentName
     * @param string $orNo
     * @param string $type
     * @return void
     */
    public function __construct($studentName, $orNo, $type)
    {
        $this->studentName = $studentName;
        $this->orNo = $orNo;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Duplicate submission attempt by {$this->studentName} ({$this->type}) with OR No. {$this->orNo} on " . now()->format('F d, Y H:i'),
            'student_name' => $this->studentName,
            'or_no' => $this->orNo,
            'type' => $this->type,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}