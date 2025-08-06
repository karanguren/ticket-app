<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PaymentNotification;
use App\Models\GeneratedTicket; 
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketsEmail;
use App\Models\ExchangeRate;

class TicketsList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterConfirmed = 'all'; 
    public $notificationId; 
    public $showConfirmModal = false;
    public $showTicketsModal = false;

    public $selectedNotification = null;

    public $modalNotificationName;
    public $modalNotificationAmount;
    public $modalNotificationTicketsCount; 

    public $showExchangeRateModal = false;
    public $exchangeRate = 0;

    public $winningNumbers = ['1234', '5555', '2313', '7890', '3333'];

    public function mount()
    {
        
        $rate = ExchangeRate::latest()->first();
        $this->exchangeRate = $rate ? $rate->rate : 38.00; 
    }

    public function openConfirmModal($id)
    {
        $this->notificationId = $id;
        $notification = PaymentNotification::find($id);
        if ($notification) {
            $this->modalNotificationName = $notification->name;
            $this->modalNotificationAmount = $notification->amount;
            $this->modalNotificationTicketsCount = $notification->number_of_tickets;
            $this->showConfirmModal = true;
        } else {
            session()->flash('error', 'Notificación no encontrada.');
        }
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->reset(['notificationId', 'modalNotificationName', 'modalNotificationAmount', 'modalNotificationTicketsCount']);
    }

    public function openTicketsModal($id)
    {
        $this->selectedNotification = PaymentNotification::find($id);
        if ($this->selectedNotification) {
            $this->showTicketsModal = true;
        } else {
            session()->flash('error', 'Notificación no encontrada.');
        }
    }

    public function closeTicketsModal()
    {
        $this->showTicketsModal = false;
        $this->selectedNotification = null;
    }

    public function openExchangeRateModal()
    {
        $this->showExchangeRateModal = true;
    }

    public function closeExchangeRateModal()
    {
        $this->showExchangeRateModal = false;
    }

    public function saveExchangeRate()
    {
        $this->validate([
            'exchangeRate' => 'required|numeric|gt:0',
        ]);

        $rate = ExchangeRate::latest()->first();
        if ($rate) {
            $rate->update(['rate' => $this->exchangeRate]);
        } else {
            ExchangeRate::create(['rate' => $this->exchangeRate]);
        }

        session()->flash('message', 'Tasa de cambio actualizada con éxito.');
        $this->closeExchangeRateModal();
        $this->dispatch('exchangeRateUpdated', $this->exchangeRate); 
    }

    public function confirmPayment()
    {
        if (!$this->notificationId) {
            session()->flash('error', 'No se ha seleccionado ninguna notificación para confirmar.');
            return;
        }

        $notification = PaymentNotification::find($this->notificationId);

        if (!$notification) {
            session()->flash('error', 'Notificación no encontrada.');
            return;
        }

        if ($notification->is_confirmed) {
            session()->flash('warning', 'Esta notificación ya ha sido confirmada.');
            $this->closeConfirmModal();
            return;
        }

        $hasWinner = false;

        try {
            $numberOfTicketsToGenerate = $notification->number_of_tickets;
            $generatedTicketsArray = $this->generateUniqueTicketNumbers($numberOfTicketsToGenerate);

            foreach ($generatedTicketsArray as $ticketNumber) {
                GeneratedTicket::create([
                    'payment_notification_id' => $notification->id,
                    'cedula' => $notification->cedula, 
                    'ticket_number' => $ticketNumber,
                ]);
            }

            $notification->is_confirmed = true;
            $notification->confirmed_at = now();
            $notification->tickets = json_encode($generatedTicketsArray);
            $notification->has_winning_ticket = $hasWinner;
            $notification->save();

            session()->flash('message', 'Pago confirmado y tickets generados con éxito!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al confirmar el pago o generar tickets: ' . $e->getMessage());
        }

        $this->closeConfirmModal();
        $this->resetPage(); 
        $this->dispatch('refresh-tickets');
    }

    public function sendTicketsEmail($notificationId)
    {
        $notification = PaymentNotification::find($notificationId);

        if (!$notification || !$notification->is_confirmed) {
            session()->flash('error', 'Notificación no encontrada o no confirmada.');
            return;
        }

        if (!$notification->tickets) {
            session()->flash('warning', 'No hay tickets asignados a esta notificación para enviar por correo.');
            return;
        }

        try {
            $decodedTickets = json_decode($notification->tickets, true);
            
            Mail::to($notification->email)->send(new TicketsEmail(
                $notification->name, 
                $decodedTickets
            ));

            session()->flash('message', '¡Correo de tickets enviado con éxito!');
        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un error al enviar el correo: ' . $e->getMessage());
        }
    }

    private function generateUniqueTicketNumbers($count)
    {
        $tickets = [];
        $maxAttempts = $count * 5;
        $attempts = 0;

        while (count($tickets) < $count && $attempts < $maxAttempts) {
            $randomNumber = rand(0, 9999); 
            $ticket = str_pad($randomNumber, 4, '0', STR_PAD_LEFT); 

            if (in_array($ticket, $this->winningNumbers)) {
                
                $hasWinner = true;
            }

           
            if (!GeneratedTicket::where('ticket_number', $ticket)->exists()) {
                $tickets[] = $ticket; 
            }
            $attempts++;
        }

        
        if (count($tickets) < $count) {
            session()->flash('warning', 'No se pudieron generar todos los tickets únicos solicitados. Se generaron ' . count($tickets) . ' de ' . $count . '.');
        }

        return array_unique($tickets); 
    }

    public function sendWhatsApp($notificationId)
    {
        $notification = PaymentNotification::find($notificationId);

        if (!$notification || !$notification->is_confirmed) {
            session()->flash('error', 'Notificación no encontrada o no confirmada.');
            return;
        }

        if (!$notification->tickets) {
            session()->flash('warning', 'No hay tickets asignados a esta notificación para enviar por WhatsApp.');
            return;
        }

        $decodedTickets = json_decode($notification->tickets, true);
        $ticketsString = implode(', ', $decodedTickets);
        $userName = $notification->name;

        $whatsappUrl = "https://api.whatsapp.com/send?phone=584164162492&text=%C2%A1Hola%20%F0%9F%91%8B%20*{$userName}*!%20%F0%9F%8E%89%0A%0ATu%20pago%20ha%20sido%20confirmado%2C%20estos%20son%20tus%20tickets%3A%0A%0A{$ticketsString}.%20%0A%0A%C2%A1Mucha%20suerte!%20%F0%9F%A4%9E%F0%9F%8D%80";
        $this->js("window.open('{$whatsappUrl}', '_blank')");
    }

    public function render()
    {
        $notifications = PaymentNotification::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('cedula', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('reference_number', 'like', '%' . $this->search . '%')
                    ->orWhere('tickets', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterConfirmed !== 'all', function ($query) {
                $query->where('is_confirmed', $this->filterConfirmed === 'true');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.tickets-list', [
            'notifications' => $notifications,
        ]);
    }
}