<div>
    <p class="text-2xl text-white font-bold mt-07 mb-5 text-center">Métodos de pago</p>
    <div class="flex flex-wrap gap-4 justify-center mb-6">
        <div wire:click="showPaymentMethod('pagoMovil')" class="cursor-pointer">
            <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/d.png')}}" alt="Pago Movil"/>
        </div>
        <!-- <div wire:click="showPaymentMethod('zelle')" class="cursor-pointer">
            <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/b.jpg')}}" alt="Zelle"/>
        </div>
        <div wire:click="showPaymentMethod('binance')" class="cursor-pointer">
            <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/e.png')}}" alt="Binance"/>
        </div>
        <div wire:click="showPaymentMethod('zinli')" class="cursor-pointer">
            <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/a.png')}}" alt="Zinli"/>
        </div> -->
    </div>
    <div id="miDiv" class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96 {{ $showPaymentInfo ? '' : 'hidden' }}">
        <div class="p-4 h-64 flex justify-center items-center flex-col">
            <h5 class="mb-2 text-[#ef4848] text-xl font-semibold text-center">{{ $paymentTitle }}</h5>
            <div class="text-slate-600 leading-normal font-light">
                {!! $paymentContent !!}
            </div>
        </div>
    </div>
    @if ($showPaymentInfo && (float)$totalAmount > 0 && $numberOfTicketsForConfirmation > 0)
        <div class="flex justify-center">
            <button
                wire:click="openConfirmPaymentModalButton"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105 flex items-center justify-center space-x-2"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Confirmar Pago
            </button>
        </div>
    @endif
</div>

