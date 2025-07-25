<div>
    {{-- Contenedor para la barra de búsqueda y el selector de paginación --}}
    <div class="mb-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0 md:space-x-4">
            {{-- Campo de Búsqueda --}}
            <div class="w-full md:w-1/3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por nombre..."
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
            </div>

            {{-- Selector de Elementos por Página --}}
            <div class="w-full md:w-auto flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Mostrar:</label>
                <select wire:model.live="perPage" id="perPage"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Tabla de Ítems --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    {{-- Encabezado para ID con ordenación --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <button wire:click="sortBy('id')" class="flex items-center space-x-1 focus:outline-none">
                            <span>ID</span>
                            @if ($sortField === 'id') {{-- Muestra el icono de ordenación si es el campo actual --}}
                                <svg class="w-3 h-3 @if($sortDirection === 'desc') rotate-180 @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            @endif
                        </button>
                    </th>
                    {{-- Encabezado para Nombre con ordenación --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <button wire:click="sortBy('name')" class="flex items-center space-x-1 focus:outline-none">
                            <span>Nombre</span>
                            @if ($sortField === 'name')
                                <svg class="w-3 h-3 @if($sortDirection === 'desc') rotate-180 @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            @endif
                        </button>
                    </th>
                    {{-- Encabezado para Fecha de Creación con ordenación --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <button wire:click="sortBy('created_at')" class="flex items-center space-x-1 focus:outline-none">
                            <span>Fecha de Creación</span>
                            @if ($sortField === 'created_at')
                                <svg class="w-3 h-3 @if($sortDirection === 'desc') rotate-180 @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            @endif
                        </button>
                    </th>
                    {{-- Puedes añadir más encabezados de columna aquí --}}
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                {{-- Bucle para mostrar cada ítem --}}
                @forelse ($items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $item->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $item->created_at->format('d/m/Y H:i') }} {{-- Formateamos la fecha --}}
                        </td>
                        {{-- Puedes añadir más celdas para otros datos del ítem aquí --}}
                    </tr>
                @empty
                    {{-- Mensaje si no se encuentran resultados --}}
                    <tr>
                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">
                            No se encontraron resultados para tu búsqueda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Enlaces de Paginación --}}
    <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        {{ $items->links() }} {{-- Livewire renderiza los enlaces de paginación automáticamente --}}
    </div>
</div>