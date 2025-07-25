<?php

namespace App\Livewire;

use Livewire\Component;

class BuyTickets extends Component
{
    public $ticketQuantity = 2;
    public $ticketPrice = 30.00;
    public $totalAmount = '0.00';

    public function mount()
    {
        $this->ticketQuantity = max(2, $this->ticketQuantity);
        $this->updateTotalAmount();
    }

    public function updatedTicketQuantity($value)
    {
        $value = (int) $value;

        if ($value < 2) {
            $this->ticketQuantity = 2;
        } elseif ($value > 100) {
            $this->ticketQuantity = 100;
        } else {
            $this->ticketQuantity = $value;
        }
        $this->updateTotalAmount();
    }

    public function setTicketQuantity($quantity)
    {
        $this->ticketQuantity = max(2, min(100, $quantity));
        $this->updateTotalAmount();
    }

    public function updateTotalAmount()
    {
        $subtotal = $this->ticketQuantity * $this->ticketPrice;
        $total = $subtotal;
        $this->totalAmount = number_format($total, 2, '.', '');

    }

    public function render()
    {
        return view('livewire.buy-tickets');
    }
}