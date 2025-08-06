<?php

namespace App\Livewire;

use Livewire\Component;

class BuyTickets extends Component
{
    public $ticketQuantity = 0;
    public $ticketPrice = 60.00;
    public $totalAmount = '0.00'; 

    public function mount()
    {
        $this->updateTotalAmount();
        $this->dispatch('updateConfirmPaymentDetails', $this->totalAmount, $this->ticketQuantity)->to('payment-methods');
    }

    public function updatedTicketQuantity($value)
    {
        $cleanValue = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        $cleanValue = (int) $cleanValue;

        if ($cleanValue < 2 && $cleanValue !== 0) {
            $this->ticketQuantity = 2;
        } else {
            $this->ticketQuantity = $cleanValue;
        }

        $this->updateTotalAmount();
    }

    public function setTicketQuantity($quantity)
    {
        $this->ticketQuantity = max(2, $quantity);
        $this->updateTotalAmount();
    }

    public function updateTotalAmount()
{
    $subtotal = ($this->ticketQuantity >= 2) ? ($this->ticketQuantity * $this->ticketPrice) : 0;
    $this->totalAmount = number_format($subtotal, 2, '.', '');

    $this->dispatch('updatePaymentTotalAmount', (float) $this->totalAmount, $this->ticketQuantity)->to('payment-methods');
}


    public function render()
    {
        return view('livewire.buy-tickets');
    }
}