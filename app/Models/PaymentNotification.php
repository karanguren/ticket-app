<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cedula',
        'phone',
        'email',
        'reference_number',
        'capture_path',
        'amount',
        'number_of_tickets',
        'tickets',
        'is_confirmed', // Aunque tenga un valor por defecto, lo incluyo si se quisiera setear
        'confirmed_at', // También se incluye si se quisiera setear
    ];
}