<?php

namespace App\Livewire;

use Livewire\Component;

class BuyTickets extends Component
{
    public $ticketQuantity = 0;
    public $ticketPrice = 60.00;
    public $totalAmount = '0.00'; // Se mantendrá como string formateado

    public function mount()
    {
        $this->updateTotalAmount();
        // Al montar, también despachamos los valores iniciales a PaymentMethods
        $this->dispatch('updateConfirmPaymentDetails', $this->totalAmount, $this->ticketQuantity)->to('payment-methods');
    }

    public function updatedTicketQuantity($value)
    {
        $cleanValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        $cleanValue = (int) $cleanValue;

        // Lógica para el mínimo de 2 tickets y máximo de 100
        if ($cleanValue < 2 && $cleanValue !== 0) {
            $this->ticketQuantity = 2;
        } elseif ($cleanValue > 100) {
            $this->ticketQuantity = 100;
        } else {
            $this->ticketQuantity = $cleanValue;
        }

        $this->updateTotalAmount();
    }

    public function setTicketQuantity($quantity)
    {
        // Lógica para el mínimo de 2 tickets y máximo de 100
        $this->ticketQuantity = max(2, min(100, $quantity));
        $this->updateTotalAmount();
    }

    public function updateTotalAmount()
{
    $subtotal = ($this->ticketQuantity >= 2) ? ($this->ticketQuantity * $this->ticketPrice) : 0;
    $this->totalAmount = number_format($subtotal, 2, '.', '');

    // Importante: Despachamos AMBOS valores al listener del PaymentMethods
    $this->dispatch('updatePaymentTotalAmount', (float) $this->totalAmount, $this->ticketQuantity)->to('payment-methods');
}

    // El método openConfirmPaymentModal ya no será llamado desde este componente,
    // sino desde un botón en payment-methods.blade.php que llama a un método en PaymentMethods.php
    // Por lo tanto, puedes eliminar o dejar este método comentado si no se usa.
    // Si tienes un botón en BuyTickets.blade.php que abre el modal, entonces SÍ lo necesitarías.
    /*
    public function openConfirmPaymentModal()
    {
        // Aquí no necesitas calculateTotal() porque updateTotalAmount ya lo hace
        // Y las propiedades son $totalAmount y $ticketQuantity
        $this->dispatch('open-confirm-payment-modal', (float) $this->totalAmount, $this->ticketQuantity);
    }
    */

    public function render()
    {
        return view('livewire.buy-tickets');
    }
}