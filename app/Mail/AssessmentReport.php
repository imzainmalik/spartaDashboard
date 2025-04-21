<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssessmentReport extends Mailable
{
    use Queueable, SerializesModels;

    public $types;
    public $assement_notes;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($types,$assement_notes, $pdfPath)
    {
        // dd($assessmentData);
        $this->types = $types;
        $this->assement_notes = $assement_notes;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Security Assessment Report',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.emailTemplate',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];

        // Add the PDF file from public folder
        // if ($this->pdfPath) {
        //     // dd($this->pdfPath);
        //     $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath($this->pdfPath)
        //         ->as('Security_Assessment_Report.pdf')
        //         ->withMime('application/pdf');
        // }

        return $attachments;
    }
}
