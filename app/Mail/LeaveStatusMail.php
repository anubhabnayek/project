<?php

namespace App\Mail;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $leave;
    public $messageText;

    /**
     * Create a new message instance.
     */
    public function __construct(LeaveRequest $leave, string $messageText)
    {
        $this->leave = $leave;
        $this->messageText = match (strtolower(trim((string) $leave->status))) {
            'approved' => 'Your leave application has been approved.',
            'rejected' => 'Your leave application has been rejected.',
            default    => 'Your leave application is pending review.',
        };
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Leave Status Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Leave Application ' . ucfirst(strtolower($this->leave->status)))
            ->view('emails.leave-status'); // your view name
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
