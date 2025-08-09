<div>
    <div id="confirmPaymentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 {{ $showModal ? 'flex' : 'hidden' }}">
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>
        <div class="relative p-5 border max-w-lg w-full shadow-lg rounded-md bg-white max-h-[80vh] sm:max-h-full overflow-y-auto">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-2"> 
                    <div class="flex-grow text-center mr-[-24px]">
                        <h3 class="text-2xl text-[#ef4848] font-bold leading-6">Notifica tu pago</h3>
                    </div>
                    
                    <button wire:click="closeModal" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                @if (!$paymentSubmitted)
                    @if ($totalAmount && $numberOfTickets)
                        <p class="text-xl font-bold text-green-600 text-center mt-2">
                            Monto a confirmar: Bs. {{ number_format($totalAmount, 2, ',', '.') }}
                        </p>
                        <p class="text-lg font-semibold text-gray-800 text-center mb-2">
                            Cantidad de Tickets: {{ $numberOfTickets }}
                        </p>
                    @endif
                    
                    @if (session()->has('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @error('image') <span class="text-red-500 text-sm block mb-2">{{ $message }}</span> @enderror
                    <form wire:submit.prevent="confirmPayment">
                        <div class="mt-2 px-7 py-3">
                            <div class="w-full">
                                <flux:label class="text-gray-700">Nombre</flux:label>
                                <flux:input
                                    wire:model="name"
                                    placeholder="Nombre y Apellido"
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
                                    mask="(9999)999-9999"
                                    placeholder="(9999)999-9999"
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

                                <flux:label class="text-gray-700">Nro. de Referencia (último 4)</flux:label>
                                <flux:input
                                    wire:model="ref"
                                    type="text"
                                    required
                                    placeholder="Solo los últimos 4 digitos"
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
                                    <img src="{{ $image->temporaryUrl() }}" class="mt-2 max-h-32 rounded" alt="Previsualización del capture">
                                @endif
                                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                <div class="flex justify-end mt-4">
                                    <flux:button type="submit"  class="cursor-pointer px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50" variant="danger" icon="arrow-up-right">
                                        <span wire:loading.remove wire:target="confirmPayment">CONFIRMAR PAGO</span>
                                        <span wire:loading wire:target="confirmPayment">CONFIRMANDO...</span>
                                    </flux:button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="text-center py-8">
                        <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-gray-900">¡Notificación Enviada!</h3>
                        <p class="mt-2 text-base text-gray-600">Tu confirmación de pago ha sido recibida con éxito.</p>
                        <p class="text-sm text-gray-500">Pronto verificaremos tu pago y te enviaremos tus tickets.</p>
                        <div class="mt-8">
                            <button
                                wire:click="closeModal"
                                type="button"
                                class="px-6 py-3 bg-red-600 border border-transparent rounded-md shadow-sm text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Entendido
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
