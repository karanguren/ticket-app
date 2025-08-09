<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketsEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    
    public $clientName;
    public $tickets;
    public $logoUrl;
    public $instagramUrl;
    

    /**
     * Create a new message instance.
     */
    public function __construct($clientName, $tickets)
    {
        $this->clientName = $clientName;
        $this->tickets = $tickets;
        $this->logoUrl = asset('images/logo.png');
        $this->instagramUrl = asset('images/instagramN.png');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Tus Tickets de Rifas Los Hermanos!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tickets',
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