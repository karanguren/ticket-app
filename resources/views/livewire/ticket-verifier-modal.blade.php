<div>
    <div id="ticketVerifierModal" class="fixed inset-0 z-50 {{ $showModal ? 'flex' : 'hidden' }} items-center justify-center p-4">
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>
        <div class="relative p-5 border max-w-md w-full shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4 px-7"> 
                    <h3 class="text-2xl text-[#ef4848] font-bold leading-6">Verificar Tickets</h3>
                    <button wire:click="closeModal" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 mb-4">
                        Ingresa tu número de cédula.
                    </p>
                    <form wire:submit.prevent="searchTickets">
                        <input
                            wire:model.live="cedula"
                            type="text"
                            placeholder="Número de Cédula"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4"
                        >
                        @error('cedula') <span class="text-red-500 text-sm block mb-4">{{ $message }}</span> @enderror
                        <div class="flex justify-end">
                            <button type="submit" class="cursor-pointer px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Verificar
                            </button>
                        </div>
                    </form>

                    @if ($searchPerformed)
                        @if (!empty($foundTickets))
                            <div class="mt-6 text-left">
                                <p class="font-semibold text-gray-700 mb-2">Tus números comprados:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($foundTickets as $ticket)
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                            {{ $ticket }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-6 text-center text-red-600">
                                <p>No se encontraron tickets para la cédula ingresada.</p>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- <div class="items-center px-4 py-3 mt-4"> 
                    <button wire:click="closeModal" type="button" class="cursor-pointer px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-36 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Cerrar
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</div>
