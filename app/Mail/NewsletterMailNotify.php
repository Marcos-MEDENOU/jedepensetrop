<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct( $data)
    {
        //
        $this->data = $data;
    }
    /**
     * Create a new message instance.
     */
    // public function build()
    // {
    //     return $this->from('marcosmedenou@gmail.com', 'Marcos MEDENOU')
    //     ->subject($this->data['subject'])->view('emails.index')->with('data', $this->data);
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Souscription a la Newsletter Jedepensetrop.com',
            // from : new Address('mailtrap@gmail.com', 'John')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.index',
            with:['name'=>$this->data]
        );
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
