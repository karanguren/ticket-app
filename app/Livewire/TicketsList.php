<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class TicketsList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterConfirmed = 'false'; 
    public $dummyNotifications; 

    public $showConfirmModal = false;
    public $notificationToConfirmId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterConfirmed' => ['except' => 'false']
    ];

    
    public function mount()
    {
        $this->generateDummyData();
    }

   
    private function generateDummyData()
    {
        $data = [];
        for ($i = 1; $i <= 25; $i++) { 
            $isConfirmed = (bool) (rand(0, 1)); 
            $amount = rand(20, 200) * 5; 

            $tickets = $isConfirmed ? $this->generateTickets($amount) : null;
            $confirmedAt = $isConfirmed ? now()->subDays(rand(0, 10))->toDateTimeString() : null;

            $data[] = [
                'id' => $i,
                'name' => 'Usuario ' . $i,
                'cedula' => 'V-' . str_pad(rand(1000000, 9999999), 7, '0', STR_PAD_LEFT),
                'email' => 'usuario' . $i . '@example.com',
                'phone' => '0414' . str_pad(rand(1000000, 9999999), 7, '0', STR_PAD_LEFT),
                'reference_number' => str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'capture_path' => null, 
                'amount' => $amount,
                'payment_method' => ['Pago Móvil', 'Zelle', 'Transferencia'][array_rand(['Pago Móvil', 'Zelle', 'Transferencia'])],
                'tickets' => $tickets,
                'is_confirmed' => $isConfirmed,
                'confirmed_at' => $confirmedAt,
                'created_at' => now()->subDays(rand(0, 30))->toDateTimeString(),
            ];
        }
        $this->dummyNotifications = new Collection($data);
    }

    public function openConfirmModal($notificationId)
    {
        $this->notificationToConfirmId = $notificationId;
        $this->showConfirmModal = true;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->notificationToConfirmId = null;
    }

    public function confirmPayment()
    {
        
        $notificationId = $this->notificationToConfirmId;

        if (is_null($notificationId)) {
            session()->flash('error', 'Error: No se ha especificado una notificación para confirmar.');
            $this->closeConfirmModal();
            return;
        }

        $notificationIndex = $this->dummyNotifications->search(function ($item) use ($notificationId) {
            return $item['id'] === $notificationId;
        });

        if ($notificationIndex !== false) {
            $notification = $this->dummyNotifications->get($notificationIndex);

            if (!$notification['is_confirmed']) {
                $tickets = $this->generateTickets($notification['amount']);
                $notification['tickets'] = $tickets;
                $notification['is_confirmed'] = true;
                $notification['confirmed_at'] = now()->toDateTimeString();

                $this->dummyNotifications->put($notificationIndex, $notification);

                session()->flash('message', 'Pago confirmado y tickets generados (simulado) para ' . $notification['email'] . '. Ahora puedes enviar el WhatsApp.');

            } else {
                session()->flash('warning', 'Este pago ya ha sido confirmado.');
            }
        } else {
            session()->flash('error', 'Notificación no encontrada.');
        }

        $this->closeConfirmModal(); 
        $this->resetPage(); 
    }

    private function generateTickets($amount)
    {
        $costPerTicket = 50; 
        $numberOfTickets = floor($amount / $costPerTicket);
        $numberOfTickets = max(1, $numberOfTickets); 

        $generatedTickets = [];
        for ($i = 0; $i < $numberOfTickets; $i++) {
            $generatedTickets[] = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        }
        return array_unique($generatedTickets);
    }

    public function sendWhatsApp($notificationId)
    {
        $notification = $this->dummyNotifications->firstWhere('id', $notificationId);

        if ($notification && $notification['is_confirmed'] && !empty($notification['tickets'])) {
            $phone = preg_replace('/[^0-9]/', '', $notification['phone']);
            $ticketsString = implode(', ', $notification['tickets']);
            $userName = $notification['name'];

            $whatsappUrl = "https://api.whatsapp.com/send?phone=58{$phone}&text=%C2%A1Hola%20%F0%9F%91%8B%20*{$userName}*!%20%F0%9F%8E%89%0A%0ATu%20pago%20ha%20sido%20confirmado%20y%20tus%20tickets%20est%C3%A1n%20listos%3A%0A%0A{$ticketsString}.%20%0A%0A%C2%A1Mucha%20suerte!%20%F0%9F%A4%9E%F0%9F%8D%80";

            $this->dispatch('open-whatsapp-tab', url: $whatsappUrl);

            session()->flash('message', 'Abriendo WhatsApp para ' . $userName . ' con los tickets.');

        } elseif ($notification && !$notification['is_confirmed']) {
            session()->flash('warning', 'No se pueden enviar tickets por WhatsApp hasta que el pago sea confirmado.');
        } else {
            session()->flash('error', 'Notificación o tickets no encontrados para enviar por WhatsApp.');
        }
    }

    public function render()
    {
        $filteredNotifications = $this->dummyNotifications->filter(function ($notification) {
            $matchesSearch = empty($this->search) ||
                             stripos($notification['name'], $this->search) !== false ||
                             stripos($notification['cedula'], $this->search) !== false ||
                             stripos($notification['email'], $this->search) !== false ||
                             stripos($notification['reference_number'], $this->search) !== false;

            $matchesConfirmedFilter = ($this->filterConfirmed === 'all') ||
                                      ($this->filterConfirmed === 'true' && $notification['is_confirmed']) ||
                                      ($this->filterConfirmed === 'false' && !$notification['is_confirmed']);

            return $matchesSearch && $matchesConfirmedFilter;
        })->sortByDesc('created_at'); 

        $perPage = 10;
        $currentPage = $this->getPage();
        $pagedData = $filteredNotifications->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $notifications = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $filteredNotifications->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('livewire.tickets-list', [
            'notifications' => $notifications,
        ]);
    }
}
