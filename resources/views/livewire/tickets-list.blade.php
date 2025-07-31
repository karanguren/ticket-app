<div>
    <div class="container mx-auto p-4 sm:p-6 lg:p-8 bg-gray-100 min-h-screen">
        <span class="flex items-center mb-8">
            <span class="h-px flex-1 bg-gray-300"></span>

            <span class="shrink-0 px-4 text-3xl font-bold text-gray-800 text-center">Gestión de Notificaciones de Pago</span>

            <span class="h-px flex-1 bg-gray-300"></span>
        </span>

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

        {{-- Controles de Filtro y Búsqueda --}}
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Buscar por nombre, cédula, correo o referencia..."
                class="w-full sm:w-2/3 md:w-1/2 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >

            <select
                wire:model.live="filterConfirmed"
                class="w-full sm:w-1/3 md:w-1/4 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
                <option value="false">Pendientes</option>
                <option value="true">Confirmados</option>
                <option value="all">Todos</option>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($notifications as $notification)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['cedula'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['phone'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['reference_number'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @php
                                $currencySymbol = 'Bs.';
                                if (in_array($notification['payment_method'], ['Zelle', 'Binance', 'Zinli'])) {
                                    $currencySymbol = '$';
                                }
                            @endphp
                            {{ $currencySymbol }} {{ number_format($notification['amount'], 2, ',', '.') }}
                        </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $notification['payment_method'] ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($notification['is_confirmed'] && !empty($notification['tickets']))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($notification['tickets'] as $ticket)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $ticket }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-500">Pendiente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($notification['is_confirmed'])
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmado</span>
                                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($notification['confirmed_at'])?->diffForHumans() }}</p>
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
                                    <button class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg mr-2 cursor-not-allowed" disabled>
                                        Confirmado
                                    </button>
                                @endif

                                @if ($notification['is_confirmed'] && !empty($notification['tickets']))
                                    <button
                                        wire:click="sendWhatsApp({{ $notification['id'] }})"
                                        wire:loading.attr="disabled"
                                        class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 mr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
                                    >
                                        Enviar WhatsApp
                                    </button>
                                @else
                                    <button class=" px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg mr-2 cursor-not-allowed" disabled >
                                        WhatsApp
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
    </div>
</div>
