<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentOptions()
    {
        $precioProducto = 130.00;
        $cantidad = 5;
        $impuesto = 0.16;
        $totalAPagar = ($precioProducto * $cantidad) * (1 + $impuesto);

        return view('welcome', [
            'totalAPagar' => number_format($totalAPagar, 2, '.', '')
        ]);
    }
}