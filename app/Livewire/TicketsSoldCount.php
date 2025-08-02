<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeneratedTicket;

class TicketsSoldCount extends Component
{
    // Propiedad pública para almacenar el conteo de tickets
    public $soldTicketsCount = 0;
    public $totalTickets = 10000;

    // Método que se ejecuta al iniciar el componente
    public function mount()
    {
        $this->updateTicketsCount();
    }

    // Método para consultar y actualizar el conteo desde la base de datos
    public function updateTicketsCount()
    {
        // Contamos el número de tickets en la tabla 'generated_tickets'
        $this->soldTicketsCount = GeneratedTicket::count();
    }

    public function render()
    {
        return view('livewire.tickets-sold-count');
    }
}
