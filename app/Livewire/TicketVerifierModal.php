<?php

namespace App\Livewire;

use Livewire\Component;

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

        
        // $this->foundTickets = Ticket::whereHas('user', function ($query) {
        //     $query->where('cedula', $this->cedula);
        // })->pluck('ticket_number')->toArray();
        //
        // $this->foundTickets = Ticket::where('cedula_of_buyer', $this->cedula)->pluck('ticket_number')->toArray();

        
        $dummyTickets = [
            '12345678' => ['101', '102', '105', '200'],
            '98765432' => ['300', '301'],
            '17718709' => ['123', '456', '789'], 
        ];

        $this->foundTickets = $dummyTickets[$this->cedula] ?? [];
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