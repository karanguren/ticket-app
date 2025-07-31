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

    // --- NUEVA PROPIEDAD PARA RECIBIR LA CANTIDAD DE TICKETS ---
    public $numberOfTicketsForConfirmation = 0; // Inicializamos a 0

    // Modificamos el listener 'updatePaymentTotalAmount' para que también reciba la cantidad de tickets
    // El nombre del listener será el mismo para no romper la comunicación con BuyTickets.
    // BuyTickets despacha 'updatePaymentTotalAmount' con $this->totalAmount y $this->ticketQuantity
    protected $listeners = ['updatePaymentTotalAmount' => 'setTotalAmount'];

    // El mount ahora acepta un parámetro adicional para la cantidad de tickets
    public function mount($totalAmount, $numberOfTickets = 0) // Añadimos $numberOfTickets con un default
    {
        $this->totalAmount = $totalAmount;
        $this->numberOfTicketsForConfirmation = $numberOfTickets; // Asignamos la cantidad de tickets
    }

    // Modificamos setTotalAmount para que acepte y guarde la cantidad de tickets
    public function setTotalAmount($newTotal, $newNumberOfTickets = 0) // Acepta la cantidad de tickets
    {
        $this->totalAmount = $newTotal;
        $this->numberOfTicketsForConfirmation = $newNumberOfTickets; // Guardamos la nueva cantidad de tickets

        // Mantenemos tu lógica existente para actualizar el contenido del pago
        if ($this->showPaymentInfo && $this->activeButton) {
            $this->paymentContent = $this->generatePaymentHtml($this->activeButton);
        }
    }

    private function generatePaymentHtml($method)
    {
        $bsToUsdRate = 110;
        $html = '';

        switch ($method) {
            case 'pagoMovil':
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-lg"><strong>🏦 Banco:</strong> <span class="text-grey-600 font-medium">Venezuela / Banesco</span></p>
                        <p class="mb-2 text-lg"><strong>📱 Teléfono:</strong> <span class="text-grey-600 font-medium">0426-3068466</span></p>
                        <p class="mb-2 text-lg"><strong>🪪 C.I:</strong> <span class="text-grey-600 font-medium">V-17.718.709</span></p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-700">Bs. ' . $this->totalAmount . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Pago Móvil';
                break;
            case 'zelle':
                $totalUsd = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-green-700 break-words">correo@ejemplo.com</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . $totalUsd . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Zelle';
                break;
            case 'binance':
                $totalUsdt = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">Pay Id: 1234567890</p>
                        <p class="mb-2 text-xl font-semibold text-yellow-600 break-words">correo: 1234567890</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">USDT ' . $totalUsdt . '</span>
                        </p>
                    </div>
                ';
                $this->paymentTitle = 'Binance Pay';
                break;
            case 'zinli':
                $totalUsdZinli = number_format(floatval($this->totalAmount) / $bsToUsdRate, 2, '.', '');
                $html = '
                    <div class="text-center">
                        <p class="mb-2 text-xl font-semibold text-purple-600 break-words">@rifasloshermanos</p>
                        <p class="text-slate-600 leading-normal font-light mt-4">
                            Total a pagar: <span class="font-bold text-green-600">$ ' . $totalUsdZinli . '</span>
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

    // --- NUEVO MÉTODO PARA ABRIR EL MODAL DE CONFIRMACIÓN DE PAGO ---
    // Este método es llamado por el botón que quieres agregar.
    public function openConfirmPaymentModalButton()
    {
        // Despachamos el evento al ConfirmPaymentModal con los datos que hemos recibido
        // Asegúrate de que ConfirmPaymentModal.php tenga un método openModal($amount, $ticketsCount)
        $this->dispatch('open-confirm-payment-modal', (float) $this->totalAmount, $this->numberOfTicketsForConfirmation);
        // Usamos (float) para asegurar que el totalAmount se pase como número.
    }

    public function render()
    {
        return view('livewire.payment-methods');
    }
}