<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeneratedTicket;

class TicketsSoldCount extends Component
{
    public $soldTicketsCount = 0;
    public $totalTickets = 10000;

    public function mount()
    {
        $this->updateTicketsCount();
    }

    public function updateTicketsCount()
    {
        $this->soldTicketsCount = GeneratedTicket::count();
    }

    public function render()
    {
        return view('livewire.tickets-sold-count');
    }
}
