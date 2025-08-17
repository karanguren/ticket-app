<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PaymentNotification;

use App\Mail\PaymentConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
    public $paymentMethod; 
    public $totalAmount;
    public $numberOfTickets;

    public $paymentSubmitted = false;


    protected $listeners = [
        'open-confirm-payment-modal' => 'openModal',
        'updateConfirmPaymentTotal' => 'updateTotalAmount',
    ];

    public function openModal($amount = null, $ticketsCount = null, $paymentTitle = null)
    {
        $this->showModal = true;
        $this->resetForm();
        $this->paymentSubmitted = false;

        if ($amount !== null) {
            $this->totalAmount = $amount;
        }
        if ($ticketsCount !== null) {
            $this->numberOfTickets = $ticketsCount;
        }
        if ($paymentTitle !== null) {
            $this->paymentMethod = $paymentTitle;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->paymentSubmitted = false;
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
                'payment_method' => $this->paymentMethod,
            ]);

            $this->dispatch('paymentConfirmationSuccess');

            $this->paymentSubmitted = true;
            session()->flash('message', '¡Tu notificación de pago ha sido enviada con éxito!');
        
            try {
                $data = [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'reference' => $this->ref,
                    'numberOfTickets' => $this->numberOfTickets,
                    'totalAmount' => (float) $this->totalAmount,
                    'purchaseDate' => now()->format('d-m-Y'),
                    'purchaseTime' => now()->format('H:i:s A'),
                    'receiptImageUrl' => asset('storage/' . $imagePath),
                    'paymentMethod' => $this->paymentMethod,
                ];

                Mail::to($data['email'])->send(new PaymentConfirmationEmail($data));
            
            } catch (\Exception $e) {
                
            }

        } catch (\Exception $e) {

            Storage::disk('public')->delete($imagePath);
            
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
