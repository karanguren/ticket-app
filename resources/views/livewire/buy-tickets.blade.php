    
<div class="w-full md:w-1/2 p-4 flex flex-col items-center h-full">
    <p class="text-2xl text-[#ef4848] font-bold text-center mb-8">Compra aquí tus tickets 🎟️</p>
    <flux:badge color="red" size="lg" class="text-white mb-5">Valor Ticket: {{ $ticketPrice }}Bs</flux:badge>

    <div class="md:flex md:items-center mb-2">
        <div class="md:w-1/3">
            <label class="block text-white font-bold md:text-right mb-1 md:mb-0 pr-4" for="tickets">
                Tickets
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                max="100"
                wire:model.live="ticketQuantity"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-500"
                id="tickets"
                type="number"
            >
        </div>
    </div>
    <p class="text-white mt-2 mb-2 text-[13px] w-full text-center px-10">
        Seleccione la cantidad de números a comprar. Utiliza los botones para seleccionar de forma más rápida una
        cantidad mayor de tickets a comprar. <strong>Mínimo 2 Tickets por compra</strong>
    </p>

    <div class="flex flex-wrap justify-center w-full gap-4 mb-4">
        <button wire:click="setTicketQuantity(2)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-lg">
            2
        </button>
        <button wire:click="setTicketQuantity(5)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-lg">
            5
        </button>
        <button wire:click="setTicketQuantity(10)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-lg">
            10
        </button>
        <button wire:click="setTicketQuantity(20)" class="cursor-pointer w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-lg">
            20
        </button>
    </div>

    <span class="text-white text-xl mt-4 mb-4">Tickets seleccionados: <span class="font-bold text-[#ef4848]">{{ $ticketQuantity }} </span> </span>

    @livewire('payment-methods', ['totalAmount' => $totalAmount])
</div>

   