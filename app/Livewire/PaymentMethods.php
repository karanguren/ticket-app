<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethods extends Component
{
    public $totalAmount;
    public $totalAmountInDollars;
    public $showPaymentInfo = false;
    public $paymentTitle = '';
    public $paymentContent = '';
    public $activeButton = null;

    public $numberOfTicketsForConfirmation = 0; 

    protected $listeners = [
        'updatePaymentTotalAmount' => 'setTotalAmount',
        'paymentConfirmationSuccess' => 'resetPaymentMethods' 
    ];

    
    public function mount($totalAmount, $numberOfTickets = 0) 
    {
        $this->totalAmount = $totalAmount;
        $this->numberOfTicketsForConfirmation = $numberOfTickets;
    }

    public function setTotalAmount($newTotalBs, $newTotalDollars, $newNumberOfTickets = 0)
    {
        $this->totalAmount = $newTotalBs;
        $this->totalAmountInDollars = $newTotalDollars;
        $this->numberOfTicketsForConfirmation = $newNumberOfTickets; 

        if ($this->showPaymentInfo && $this->activeButton) {
            $this->paymentContent = $this->generatePaymentHtml($this->activeButton);
        }
    }

    private function generatePaymentHtml($method)
    {
        $html = '';

        switch ($method) {
            case 'pagoMovil':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg"><strong>🏦 Banco:</strong> <span class="text-grey-600 font-medium">Venezuela / Banesco</span></p>
                        <p class="mb-2 text-lg"><strong>📱 Teléfono:</strong> <span class="text-grey-600 font-medium">0426-3068466</span></p>
                        <p class="mb-2 text-lg"><strong>🪪 C.I:</strong> <span class="text-grey-600 font-medium">V-17.718.709</span></p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-700">Bs. ' . number_format($this->totalAmount, 2, '.', '') . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Pago Móvil';
                break;
            case 'zelle':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-green-700 break-words">correo@ejemplo.com</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . number_format($this->totalAmountInDollars, 2, '.', '') . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Zelle';
                break;
            case 'binance':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">Pay Id: 1234567890</p>
                        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">correo: 1234567890</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">USDT ' . number_format($this->totalAmountInDollars, 2, '.', '') . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Binance Pay';
                break;
            case 'zinli':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-purple-600 break-words">@rifasloshermanos</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . number_format($this->totalAmountInDollars, 2, '.', '') . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Zinli';
                break;
        }
        return $html;
    }

    public function showPaymentMethod($method)
    {
        if ($this->activeButton === $method && $this->showPaymentInfo) {
            $this->showPaymentInfo = false;
            $this->activeButton = null;
            $this->paymentTitle = '';
            $this->paymentContent = '';
        } else {
            $this->activeButton = $method;
            $this->showPaymentInfo = true;
            $this->paymentContent = $this->generatePaymentHtml($method);
        }
    }

    public function resetPaymentMethods()
    {
        $this->totalAmount = null;
        $this->totalAmountInDollars = null;
        $this->showPaymentInfo = false;
        $this->paymentTitle = '';
        $this->paymentContent = '';
        $this->activeButton = null;
        $this->numberOfTicketsForConfirmation = 0;
        
        $this->dispatch('resetBuyTicketsComponent');
    }

    
    public function openConfirmPaymentModalButton()
    {
        $this->dispatch('open-confirm-payment-modal', (float) $this->totalAmount, $this->numberOfTicketsForConfirmation);
    }

    public function render()
    {
        return view('livewire.payment-methods');
    }
}