<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_notification_id',
        'cedula',
        'ticket_number',
    ];

    /**
     * Get the payment notification that owns the generated ticket.
     */
    public function paymentNotification()
    {
        return $this->belongsTo(PaymentNotification::class);
    }
}
