<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeneratedTicket;

class TicketVerifierModal extends Component
{
    public $showModal = false;

    public $cedula; 
    public $foundTickets = []; 
    public $searchPerformed = false; 

    protected $listeners = ['open-ticket-verifier-modal' => 'openModal'];

    public function openModal()
    {
        $this->showModal = true;
        $this->resetForm(); 
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm(); 
    }

    public function searchTickets()
    {
        $this->validate([
            'cedula' => 'required|string|max:20', 
        ]);

        $this->foundTickets = GeneratedTicket::where('cedula', $this->cedula)
                                            ->pluck('ticket_number')
                                            ->toArray();

        $this->searchPerformed = true; 
    }

    
    private function resetForm()
    {
        $this->reset(['cedula', 'foundTickets', 'searchPerformed']);
    }

    public function render()
    {
        return view('livewire.ticket-verifier-modal');
    }
}