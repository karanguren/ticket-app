<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketsEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $clientName;
    public $tickets;

    /**
     * Create a new message instance.
     */
    public function __construct($clientName, $tickets)
    {
        $this->clientName = $clientName;
        $this->tickets = $tickets;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Tickets de Rifas los Hermanos',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tickets',
            with: [
                'clientName' => $this->clientName,
                'tickets' => $this->tickets,
            ],
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