    
    <div class="w-full md:w-1/2 p-4 flex flex-col items-center h-full">
        <p class="text-2xl text-[#ef4848] font-bold text-center mb-8">Compra aquí tus tickets 🎟️</p>
        <flux:badge color="red" size="lg" class="text-white mb-8">Valor Ticket: {{ $ticketPrice }}Bs</flux:badge>
        <div class="w-3/5 bg-gray-200 rounded-full dark:bg-gray-700 mx-8">
            <div class="bg-red-600 text-xs font-medium text-red-100 text-center p-0.5 leading-none rounded-full" style="width: 45%"> 45%</div>
        </div>
        <strong class="text-white text-[12px] mt-3 mb-3">0.00% del objetivo alcanzado</strong>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-white font-bold md:text-right mb-1 md:mb-0 pr-4" for="tickets">
                    Tickets
                </label>
            </div>
            <div class="md:w-2/3">
                <input min="2" max="100" wire:model.live="ticketQuantity" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-500" id="tickets" type="number">
            </div>
        </div>
        <p class="text-white text-[12px] mb-5">Mínimo 2 y Máximo 100 Tickets por compra</p>

        <p class="text-white mt-2 mb-4 text-[13px] w-full text-center px-10">
            Seleccione la cantidad de números a comprar. Utiliza los botones para seleccionar de forma más rápida una
            cantidad mayor de tickets a comprar. Cantidad mínima permitida: <strong>2</strong>
        </p>
        <div class="flex flex-wrap justify-center w-full gap-4 mb-4">
            <button wire:click="setTicketQuantity(2)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                2
            </button>
            <button wire:click="setTicketQuantity(5)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                5
            </button>
            <button wire:click="setTicketQuantity(10)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                10
            </button>
            <button wire:click="setTicketQuantity(20)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                20
            </button>
        </div>

        @livewire('payment-methods', ['totalAmount' => $totalAmount])
    </div>