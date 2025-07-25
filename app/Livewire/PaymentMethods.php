<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentMethods extends Component
{
    public $totalAmount;
    public $showPaymentInfo = false;
    public $paymentTitle = '';
    public $paymentContent = '';
    public $activeButton = null;

    public function mount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    public function updatedTotalAmount($value)
    {
        $this->totalAmount = $value; 

        if ($this->showPaymentInfo && $this->activeButton) {
            $this->showPaymentMethod($this->activeButton, true);
        }
    }

    private function generatePaymentHtml($method)
    {
        $bsToUsdRate = 36.5; 
        $html = '';

        switch ($method) {
            case 'pagoMovil':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg"><strong>🏦 Banco:</strong> Venezuela / Banesco</p>
                        <p class="mb-2 text-lg"><strong>📱 Teléfono:</strong> <span class="text-blue-600 font-medium">0426-3068466</span></p>
                        <p class="mb-2 text-lg"><strong>🪪 C.I:</strong> <span class="text-blue-600 font-medium">V-17.718.709</span></p>
                        <p class="mt-4 text-sm text-gray-500">Por favor, adjunta tu comprobante.</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">Bs. ' . $this->totalAmount . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Información de Pago Móvil';
                break;
            case 'zelle':
                $totalUsd = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg">Envía tu pago a la cuenta de Zelle:</p>
                        <p class="mb-2 text-xl font-semibold text-green-700 break-words">correo@ejemplo.com</p>
                        <p class="mt-4 text-sm text-gray-500">Asegúrate de incluir tu nombre en la referencia y enviar el comprobante.</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . $totalUsd . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Información de Zelle';
                break;
            case 'binance':
                $totalUsdt = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg">Realiza tu pago a nuestro ID de Binance Pay:</p>
                        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">1234567890</p>
                        <p class="mt-4 text-sm text-gray-500">Confirma la transacción en la aplicación y envíanos el ID de la operación.</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">USDT ' . $totalUsdt . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Información de Binance Pay';
                break;
            case 'zinli':
                $totalUsdZinli = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg">Para Zinli, transfiere a nuestro usuario:</p>
                        <p class="mb-2 text-xl font-semibold text-purple-600 break-words">@rifasloshermanos</p>
                        <p class="mt-4 text-sm text-gray-500">Asegúrate de que la cantidad sea exacta y envía el capture.</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . $totalUsdZinli . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Información de Zinli';
                break;
        }
        return $html;
    }

    public function showPaymentMethod($method, $isUpdate = false)
    {
        if (!$isUpdate && $this->activeButton === $method && $this->showPaymentInfo) {
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

    public function render()
    {
        return view('livewire.payment-methods');
    }
}