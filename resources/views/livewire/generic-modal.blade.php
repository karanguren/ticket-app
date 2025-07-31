<div>
    <div id="Modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 {{ $showModal ? 'flex' : 'hidden' }}">
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>
        <div class="bg-white rounded-lg shadow-xl p-6 md:p-8 z-10 w-full max-w-lg mx-auto relative transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg leading-6 font-medium text-red-900">¡Bienvenido!</h3>
                <button wire:click="closeModal" type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="text-sm text-gray-500 text-justify">
                <p class="text-sm text-gray-500 text-justify">
                    1. El sorteo es con números aleatorios, al momento de nosotros verificar tu pago y que completemos la solicitud de compra, el sistema de forma automática te enviará al correo electrónico que colocaste en el proceso de compra, los números de boletos para participar en el sorteo.
                    <br>
                    <br>
                    2. Solo pueden participar personas naturales mayores de 18 años.
                    <br>
                    <br>
                    3. Los premios deben ser retirados personalmente en el lugar indicado en cada rifa, entregaremos personalmente solamente en la dirección indicada por el ganador del primer premio o premio mayor.
                    <br>
                    <br>
                    4. Los ganadores deberán aceptar que Rifas Los Hermanos difunda en todas sus redes sociales fotografías y videos con la presencia de los ganadores luego de haber sido entregados los premios.
                </p>
                <p class="mt-4">¡Te deseamos mucha suerte en el sorteo!</p>
            </div>
            <div class="flex justify-end">
                <button wire:click="closeModal" type="button" class="cursor-pointer px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

