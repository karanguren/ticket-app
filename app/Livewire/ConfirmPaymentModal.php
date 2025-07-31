<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PaymentNotification;

class ConfirmPaymentModal extends Component
{
    use WithFileUploads;

    public $showModal = false;

    public $name;
    public $cedula;
    public $phone;
    public $email;
    public $ref;
    public $image;

    public $totalAmount;
    public $numberOfTickets;


    protected $listeners = [
        'open-confirm-payment-modal' => 'openModal',
        'updateConfirmPaymentTotal' => 'updateTotalAmount',
    ];

    public function openModal($amount = null, $ticketsCount = null)
    {
        $this->showModal = true;
        $this->resetForm();

        if ($amount !== null) {
            $this->totalAmount = $amount;
        }
        if ($ticketsCount !== null) {
            $this->numberOfTickets = $ticketsCount;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function updateTotalAmount($amount)
    {
        $this->totalAmount = $amount;
    }

    public function confirmPayment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'ref' => 'required|string|max:4', // Asumiendo que 'ref' son los últimos 4 dígitos
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('payment-captures', 'public');
        }

        try {
            PaymentNotification::create([
                'name' => $this->name,
                'cedula' => $this->cedula,
                'phone' => $this->phone,
                'email' => $this->email,
                'reference_number' => $this->ref,
                'capture_path' => $imagePath,
                'amount' => (float) $this->totalAmount,
                'is_confirmed' => false, 
                'number_of_tickets' => $this->numberOfTickets,
            ]);

            session()->flash('message', '¡Tu notificación de pago ha sido enviada con éxito!');
            // $this->closeModal(); 

        } catch (\Exception $e) {
            
            session()->flash('error', 'Hubo un error al enviar tu notificación de pago: ' . $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->reset(['name', 'cedula', 'phone', 'email', 'ref', 'image']);
        $this->totalAmount = null;
        $this->numberOfTickets = null;
    }

    public function render()
    {
        return view('livewire.confirm-payment-modal');
    }
}
