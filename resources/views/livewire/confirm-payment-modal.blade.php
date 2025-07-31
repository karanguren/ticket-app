<div>
    <div id="confirmPaymentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 {{ $showModal ? 'flex' : 'hidden' }}">
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>
        <div class="relative p-5 border max-w-lg w-full shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4"> 
                    <h3 class="text-2xl text-[#ef4848] font-bold leading-6">Notifica tu pago</h3>
                    
                    <button wire:click="closeModal" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                @if ($totalAmount && $numberOfTickets)
                    <p class="text-xl font-bold text-green-600 text-center my-4">
                        Monto a confirmar: Bs. {{ number_format($totalAmount, 2, ',', '.') }}
                    </p>
                    <p class="text-lg font-semibold text-gray-800 text-center mb-4">
                        Cantidad de Tickets: {{ $numberOfTickets }}
                    </p>
                @elseif ($totalAmount)
                    {{-- Si solo el monto está disponible (como antes) --}}
                    <p class="text-xl font-bold text-green-600 text-center my-4">
                        Monto a confirmar: Bs. {{ number_format($totalAmount, 2, ',', '.') }}
                    </p>
                @endif

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif
                @error('image') <span class="text-red-500 text-sm block mb-2">{{ $message }}</span> @enderror

                <form wire:submit.prevent="confirmPayment">
                    <div class="mt-2 px-7 py-3">
                        <div class="w-full">
                            <flux:label class="text-gray-700">Nombre</flux:label>
                            <flux:input
                                wire:model="name"
                                placeholder="Nombre"
                                type="text"
                                required
                                class="mb-4"
                            />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <flux:label class="text-gray-700">Cédula</flux:label>
                            <flux:input
                                wire:model="cedula"
                                placeholder="Cédula"
                                type="text"
                                required
                                class="mb-4"
                            />
                            @error('cedula') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <flux:label class="text-gray-700">Teléfono</flux:label>
                            <flux:input
                                wire:model="phone"
                                type="tel"
                                mask="(999)999-9999"
                                placeholder="Teléfono"
                                required
                                class="mb-4"
                            />
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <flux:label class="text-gray-700">Correo</flux:label>
                            <flux:input
                                wire:model="email"
                                type="email"
                                required
                                autocomplete="email"
                                placeholder="email@example.com"
                                class="mb-4"
                            />
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <flux:label class="text-gray-700">Nro. de Referencia (ultimos 4)</flux:label>
                            <flux:input
                                wire:model="ref"
                                type="text"
                                required
                                placeholder="Nro. de Referencia"
                                class="mb-4"
                            />
                            @error('ref') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <flux:label class="text-gray-700">Capture de pago</flux:label>
                            <flux:input
                                wire:model="image"
                                type="file"
                                placeholder="Captura de pago"
                                required
                            />
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="mt-2 max-h-48 rounded" alt="Previsualización del capture">
                            @endif
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            <div class="flex justify-end">
                                <flux:button type="submit" class="cursor-pointer px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" variant="danger" icon="arrow-up-right">
                                    CONFIRMAR PAGO
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
