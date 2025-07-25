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
        <div class="p-4 h-64">
            <h5 class="mb-2 text-[#ef4848] text-xl font-semibold text-center">{{ $paymentTitle }}</h5>
            <div class="text-slate-600 leading-normal font-light">
                {!! $paymentContent !!}
            </div>
        </div>
    </div>
</div>
