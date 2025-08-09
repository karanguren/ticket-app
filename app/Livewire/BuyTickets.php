<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExchangeRate;

class BuyTickets extends Component
{
    public $ticketQuantity = null;
    public $ticketPrice = 75.00;
    public $totalAmount = '0.00';
    public $totalAmountInDollars = '0.00';
    public $exchangeRate;
    
    protected $rules = [
        'ticketQuantity' => 'required|integer|min:2',
    ];

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
        if (!is_null($this->ticketQuantity)) {
            $this->validateOnly('ticketQuantity');
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
        $this->ticketQuantity = null; 
        $this->updateTotalAmount();
    }

    public function render()
    {
        return view('livewire.buy-tickets');
    }
}