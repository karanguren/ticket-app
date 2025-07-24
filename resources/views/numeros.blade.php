<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Números para la Rifa</title>
    @vite('resources/css/app.css')
    {{-- Incluye Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[url('../../public/images/fondoDark.png')] dark:bg-[url('../../public/images/fondoLight.png')] bg-cover bg-no-repeat bg-center min-h-screen p-8 flex flex-col items-center">

    <h1 class="text-4xl text-[#ef4848] font-bold text-center mb-10">Selecciona tus Números de Rifa 🎟️</h1>

    <div
        x-data="{
            selectedNumbers: {}, // Objeto para almacenar números seleccionados { '0001': true, '0005': true }
            toggleNumber(number) {
                if (this.selectedNumbers[number]) {
                    delete this.selectedNumbers[number];
                } else {
                    this.selectedNumbers[number] = true;
                }
                // Opcional: emitir evento Livewire o actualizar un campo oculto si necesitas enviar esto a Laravel
                // console.log('Números seleccionados:', Object.keys(this.selectedNumbers));
            },
            isSelected(number) {
                return this.selectedNumbers[number];
            },
            get selectedCount() {
                return Object.keys(this.selectedNumbers).length;
            },
            clearSelection() {
                this.selectedNumbers = {};
            }
        }"
        class="w-full max-w-6xl bg-white bg-opacity-90 rounded-lg shadow-xl p-6"
    >
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Números Disponibles:</h2>
            <div class="flex items-center space-x-4">
                <span class="text-xl font-bold text-gray-700">Seleccionados: <span x-text="selectedCount" class="text-blue-600"></span></span>
                <button @click="clearSelection()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                    Limpiar Selección
                </button>
            </div>
        </div>

        <div class="grid grid-cols-10 sm:grid-cols-15 md:grid-cols-20 lg:grid-cols-25 gap-2 max-h-[70vh] overflow-y-auto pr-2">
            @for ($i = 0; $i <= 9999; $i++)
                @php
                    $number = str_pad($i, 4, '0', STR_PAD_LEFT);
                @endphp
                <button
                    @click="toggleNumber('{{ $number }}')"
                    :class="{
                        'bg-blue-600 text-white': isSelected('{{ $number }}'),
                        'bg-gray-200 text-gray-800 hover:bg-gray-300': !isSelected('{{ $number }}')
                    }"
                    class="p-1 sm:p-2 rounded-md font-semibold text-xs sm:text-sm transition duration-150 ease-in-out cursor-pointer flex items-center justify-center aspect-square"
                >
                    {{ $number }}
                </button>
            @endfor
        </div>

        <div class="mt-8 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Números Seleccionados:</h3>
            <div x-show="selectedCount > 0" class="flex flex-wrap justify-center gap-2 mb-6 p-4 border border-gray-300 rounded-lg bg-gray-50">
                <template x-for="(value, number) in selectedNumbers" :key="number">
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full font-medium">
                        <span x-text="number"></span>
                        <button @click="toggleNumber(number)" class="ml-1 text-blue-600 hover:text-blue-900">&times;</button>
                    </span>
                </template>
            </div>
            <p x-show="selectedCount === 0" class="text-gray-500 italic">No has seleccionado ningún número aún.</p>

            <button
                @click="alert('Comprar números: ' + Object.keys(selectedNumbers).join(', '))"
                :disabled="selectedCount === 0"
                :class="{
                    'bg-green-600 hover:bg-green-700': selectedCount > 0,
                    'bg-green-300 cursor-not-allowed': selectedCount === 0
                }"
                class="mt-6 px-8 py-3 text-white font-bold rounded-lg shadow-lg transition duration-200"
            >
                Comprar Números Seleccionados (<span x-text="selectedCount"></span>)
            </button>
        </div>
    </div>

</body>
</html>