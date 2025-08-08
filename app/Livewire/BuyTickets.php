<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExchangeRate;

class BuyTickets extends Component
{
    public $ticketQuantity = 0;
    public $ticketPrice = 75.00;
    public $totalAmount = '0.00';
    public $totalAmountInDollars = '0.00';
    public $exchangeRate;
    
    protected $listeners = ['exchangeRateUpdated', 'paymentConfirmationSuccess' => 'resetTicketSelection'];
    
    public function mount()
    {
        $rate = ExchangeRate::latest()->first();
        $this->exchangeRate = $rate ? $rate->rate : 38.00;
        
        $this->updateTotalAmount();
        $this->dispatch('updatePaymentTotalAmount', (float) $this->totalAmount, (float) $this->totalAmountInDollars, $this->ticketQuantity)->to('payment-methods');
        
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
        $subtotalBs = ($this->ticketQuantity >= 2) ? ($this->ticketQuantity * $this->ticketPrice) : 0;
        $this->totalAmount = number_format($subtotalBs, 2, '.', '');
        
        if ($this->exchangeRate > 0) {
            $subtotalDollars = $subtotalBs / $this->exchangeRate;
            $this->totalAmountInDollars = number_format($subtotalDollars, 2, '.', '');
        } else {
            $this->totalAmountInDollars = '0.00';
        }

        $this->dispatch('updatePaymentTotalAmount', (float) $this->totalAmount, (float) $this->totalAmountInDollars, $this->ticketQuantity)->to('payment-methods');
    }

    public function exchangeRateUpdated($newRate)
    {
        $this->exchangeRate = $newRate;
        $this->updateTotalAmount();
    }

    public function resetTicketSelection()
    {
        $this->ticketQuantity = 0; 
        $this->updateTotalAmount();
    }

    public function render()
    {
        return view('livewire.buy-tickets');
    }
}