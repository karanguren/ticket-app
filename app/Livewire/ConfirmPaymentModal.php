<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; 

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

    protected $listeners = [
        'open-confirm-payment-modal' => 'openModal',
        'updateConfirmPaymentTotal' => 'updateTotalAmount', 
    ];

    public function openConfirmPaymentModal()
{
    $this->dispatch('open-confirm-payment-modal');
    $this->dispatch('updateConfirmPaymentTotal', $this->totalAmount);
}

    public function openModal()
    {
        $this->showModal = true;
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
            'ref' => 'required|string|max:4', 
            'image' => 'required|image|max:10240', 
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('payment-captures', 'public'); 
        }

        
        // PaymentNotification::create([
        //     'name' => $this->name,
        //     'cedula' => $this->cedula,
        //     'phone' => $this->phone,
        //     'email' => $this->email,
        //     'reference_number' => $this->ref,
        //     'capture_path' => $imagePath,
        //     'amount' => $this->totalAmount, 
        // ]);

        session()->flash('message', 'Tu notificación de pago ha sido enviada con éxito!');

        $this->closeModal();
    }

    private function resetForm()
    {
        $this->reset(['name', 'cedula', 'phone', 'email', 'ref', 'image']);
    }

    public function render()
    {
        return view('livewire.confirm-payment-modal');
    }
}
