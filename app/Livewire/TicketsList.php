<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PaymentNotification;
use App\Models\GeneratedTicket; // <--- Importamos el nuevo modelo
use Livewire\WithPagination;
use Carbon\Carbon; // Para diffForHumans

class TicketsList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterConfirmed = 'false'; // 'true', 'false', 'all'
    public $notificationId; // Para almacenar el ID de la notificación a confirmar
    public $showConfirmModal = false;

    // Propiedades para los datos de la notificación en el modal (si los necesitas allí)
    public $modalNotificationName;
    public $modalNotificationAmount;
    public $modalNotificationTicketsCount; // Asegúrate de que esta propiedad esté aquí

    // Método para abrir el modal de confirmación
    public function openConfirmModal($id)
    {
        $this->notificationId = $id;
        $notification = PaymentNotification::find($id);
        if ($notification) {
            $this->modalNotificationName = $notification->name;
            $this->modalNotificationAmount = $notification->amount;
            $this->modalNotificationTicketsCount = $notification->number_of_tickets; // Asigna la cantidad de tickets

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

        // --- LÓGICA DE GENERACIÓN Y ALMACENAMIENTO DE TICKETS ---
        try {
            // Obtenemos la cantidad de tickets a generar de la BD
            $numberOfTicketsToGenerate = $notification->number_of_tickets;

            // dd($numberOfTicketsToGenerate); // Para depuración: verificar cuántos tickets se deben generar

            $generatedTicketsArray = $this->generateUniqueTicketNumbers($numberOfTicketsToGenerate);

            // dd($generatedTicketsArray); // Para depuración: verificar los tickets generados

            // Guardar cada ticket en la nueva tabla `generated_tickets`
            foreach ($generatedTicketsArray as $ticketNumber) {
                GeneratedTicket::create([
                    'payment_notification_id' => $notification->id,
                    'cedula' => $notification->cedula, // Usamos la cédula de la notificación de pago
                    'ticket_number' => $ticketNumber,
                ]);
            }

            // Actualizar la notificación de pago
            $notification->is_confirmed = true;
            $notification->confirmed_at = now();
            // Almacenar el array de tickets generados como JSON en la columna 'tickets'
            $notification->tickets = json_encode($generatedTicketsArray);
            $notification->save();

            session()->flash('message', 'Pago confirmado y tickets generados con éxito!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al confirmar el pago o generar tickets: ' . $e->getMessage());
            // Opcional: Loguear el error para depuración
            // \Log::error('Error generating tickets: ' . $e->getMessage() . ' for notification ID: ' . $this->notificationId);
        }

        $this->closeConfirmModal();
        $this->resetPage(); // Resetear paginación si es necesario
    }

    /**
     * Genera un array de números de tickets únicos.
     * Basado en la cantidad confirmada.
     */
    private function generateUniqueTicketNumbers($count)
    {
        $tickets = [];
        $maxAttempts = $count * 5; // Limita los intentos para evitar bucles infinitos en caso de números insuficientes
        $attempts = 0;

        while (count($tickets) < $count && $attempts < $maxAttempts) {
            $randomNumber = rand(1, 10000); // Genera un número del 1 al 10.000
            $ticket = str_pad($randomNumber, 5, '0', STR_PAD_LEFT); // Rellena con ceros a la izquierda hasta 5 dígitos (ej: 00042)

            // Verifica si el ticket ya existe en la base de datos para evitar duplicados globales
            if (!GeneratedTicket::where('ticket_number', $ticket)->exists()) {
                $tickets[] = $ticket; // Añade a nuestro array temporal
            }
            $attempts++;
        }

        // Si después de muchos intentos no se pudo generar la cantidad deseada (poco probable con 10k números)
        if (count($tickets) < $count) {
            session()->flash('warning', 'No se pudieron generar todos los tickets únicos solicitados. Se generaron ' . count($tickets) . ' de ' . $count . '.');
        }

        return array_unique($tickets); // Asegura unicidad en el array devuelto, aunque ya lo chequeamos con `exists()`
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
                    ->orWhere('reference_number', 'like', '%' . $this->search . '%');
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