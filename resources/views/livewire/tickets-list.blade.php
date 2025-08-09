 <div>
    
    <div class="container mx-auto p-4 sm:p-6 lg:p-8 bg-gray-100 min-h-screen">
        <!-- <div class="flex items-center mb-2 mt-2 md:px-[76px] px-[50px] justify-center">
            <div class="w-full p-4 flex flex-col items-center ">
                <button 
                    wire:click="openExchangeRateModal"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                >
                    Cambiar Tasa de Cambio
                </button>
            </div>
        </div> -->

        <div class="flex items-center mb-5 mt-8 md:px-[76px] px-[50px] justify-center">
            <div class="w-full p-4 flex flex-col items-center ">
                <p class="text-3xl text-[#ef4848] font-bold text-center">Gestión de Notificaciones de Pago</p>
            </div>
        </div>
    
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="mb-6 flex flex-col items-start gap-4">
            <button
                wire:click="findUserWithMostTickets"
                class="px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200"
            >
                Ver usuario con más tickets
            </button>
            @if ($mostTicketsUser)
                <div class="p-4 bg-purple-100 border-l-4 border-purple-500 text-purple-700 rounded-r-lg shadow-md w-full relative">
                    <button wire:click="closeMostTicketsUser" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <p class="font-bold">El usuario con más tickets es:</p>
                    <p>
                        Cédula: <span class="font-semibold">{{ $mostTicketsUser['cedula'] }}</span>
                        | Total de Tickets: <span class="font-semibold">{{ $mostTicketsUser['total_tickets'] }}</span>
                    </p>
                </div>
            @endif
        </div>
    
        {{-- Controles de Filtro y Búsqueda --}}
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Buscar por nombre, cédula, correo, tickets o referencia..."
                class="w-full sm:w-2/3 md:w-1/2 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
    
            <select
                wire:model.live="filterConfirmed"
                class="w-full sm:w-1/3 md:w-1/4 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
                <option value="all">Mostrar Todos</option>
                <option value="false">Solo Pendientes</option>
                <option value="true">Solo Confirmados</option>
            </select>
        </div>

        
    
        {{-- Tabla de Notificaciones --}}
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref. Pago</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tickets</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cant. de Tickets</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tickets Ganador</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen del Pago</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($notifications as $notification)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->cedula }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->reference_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @php
                                    $currencySymbol = 'Bs.';
                                    if (in_array($notification->payment_method, ['Zelle', 'Binance', 'Zinli'])) {
                                         $currencySymbol = '$';
                                    }
                                @endphp
                                {{ $currencySymbol }} {{ number_format($notification->amount, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->payment_method ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($notification->is_confirmed && !empty($notification->tickets))
                                    <button
                                        wire:click="openTicketsModal({{ $notification->id }})"
                                        class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    >
                                        Ver Tickets
                                    </button>
                                @else
                                    <span class="text-gray-500">Pendiente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification->number_of_tickets }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($notification->has_winning_ticket)
                                    <span class="text-red-600 font-bold">Tiene un número ganador</span>
                                @else
                                    <span class="text-gray-500">No</span>
                                @endif
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($notification->capture_path)
                                    <a href="{{ Storage::url($notification->capture_path) }}" target="_blank">
                                        <img 
                                            src="{{ Storage::url($notification->capture_path) }}" 
                                            alt="Comprobante de Pago" 
                                            class="w-16 h-16 object-cover rounded-md"
                                        >
                                    </a>
                                @else
                                    <span class="text-gray-500">No hay imagen</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($notification->is_confirmed)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmado</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if (!$notification['is_confirmed'])
                                    <button
                                        wire:click="openConfirmModal({{ $notification['id'] }})"
                                        wire:loading.attr="disabled"
                                        class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 mr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
                                    >
                                        Confirmar Pago
                                    </button>
                                @else
                                    {{-- Muestra el botón de enviar correo si está confirmado --}}
                                    <button
                                        wire:click="sendTicketsEmail({{ $notification->id }})"
                                        wire:loading.attr="disabled"
                                        class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 mr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
                                    >
                                        Enviar Correo
                                    </button>
                                @endif

                                @if ($notification['is_confirmed'] && !empty($notification['tickets']))
                                    <button
                                        wire:click="sendWhatsApp({{ $notification->id }})"
                                        wire:loading.attr="disabled"
                                        class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 mr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
                                    >
                                        Enviar WhatsApp
                                    </button>
                                
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No hay notificaciones de pago encontradas con los filtros actuales.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        {{-- Paginación --}}
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
        <!-- Modal de confirmacion -->
        @if ($showConfirmModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000b5] bg-opacity-50 p-4" x-cloak>
                <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-auto p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">Confirmar Pago</h3>
                    <p class="text-gray-700 mb-6 text-center">¿Estás seguro de que deseas confirmar este pago? Esta acción generará los tickets.</p>

                    <div class="flex justify-center gap-4">
                        <button
                            wire:click="closeConfirmModal"
                            type="button"
                            class="px-5 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                            Cancelar
                        </button>
                        <button
                            wire:click="confirmPayment" {{-- Llama al método confirmPayment del componente --}}
                            wire:loading.attr="disabled"
                            type="button"
                            class="px-5 py-2 bg-red-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Sí, Confirmar
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- modal de tickets -->
        @if ($showTicketsModal && $selectedNotification)
            @php
                $decodedTickets = json_decode($selectedNotification->tickets, true);
            @endphp
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000b5] bg-opacity-50 p-4" x-cloak>
                <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Tickets de {{ $selectedNotification->name }}</h3>
                        <button wire:click="closeTicketsModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <p class="text-gray-700 mb-4">A continuación se muestran todos los tickets asignados a esta notificación.</p>

                    <div class="grid grid-cols-5 sm:grid-cols-6 lg:grid-cols-6 gap-2 mb-6 max-h-60 overflow-y-auto p-2 border rounded-md flex-wrap">
                        @if ($decodedTickets)
                            @foreach ($decodedTickets as $ticket)
                                <span class="inline-flex items-center justify-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                                    <!-- {{ $loop->iteration }} - {{ $ticket }} -->
                                    {{ $ticket }}
                                </span>
                            @endforeach
                        @else
                            <p class="text-gray-500 col-span-full">No se encontraron tickets para esta notificación.</p>
                        @endif
                    </div>

                    <div class="text-right">
                        <button
                            wire:click="closeTicketsModal"
                            type="button"
                            class="px-5 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- Modal de tasa de cambio -->
        @if ($showExchangeRateModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000b5] bg-opacity-50 p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Actualizar Tasa de Cambio</h3>
                        <button wire:click="closeExchangeRateModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <p class="text-gray-700 mb-4">Ingrese la nueva tasa de cambio del dólar a bolívares.</p>

                    <form wire:submit.prevent="saveExchangeRate">
                        <div class="mb-4">
                            <label for="exchangeRate" class="block text-sm font-medium text-gray-700">Tasa de Cambio (Bs./$)</label>
                            <input 
                                type="text" 
                                id="exchangeRate" 
                                wire:model="exchangeRate" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="ej. 100.50"
                            >
                            @error('exchangeRate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="text-right mt-6">
                            <button 
                                wire:click="closeExchangeRateModal" 
                                type="button" 
                                class="px-4 py-2 mr-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Cancelar
                            </button>
                            <button 
                                type="submit" 
                                class="px-6 py-2 ml-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 mr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
                            >
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div> 



