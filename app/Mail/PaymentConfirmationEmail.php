<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $email;
    public $phone;
    public $reference;
    public $numberOfTickets;
    public $paymentMethod;
    public $totalAmount;
    public $purchaseDate;
    public $purchaseTime;
    public $receiptImageUrl;
    public $logoUrl;
    public $instagramUrl;

    public function __construct(array $data)
    {
        $this->clientName = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->reference = $data['reference'];
        $this->numberOfTickets = $data['numberOfTickets'];
        $this->totalAmount = $data['totalAmount']; 
        $this->paymentMethod = $data['paymentMethod']; 
        $this->purchaseDate = $data['purchaseDate']; 
        $this->purchaseTime = $data['purchaseTime']; 
        $this->receiptImageUrl = $data['receiptImageUrl'];

        $this->logoUrl = asset('images/logo.png');
        $this->instagramUrl = asset('images/instagramN.png');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Pago',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmacion',
        );
    }
}
