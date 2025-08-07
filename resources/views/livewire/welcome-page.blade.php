<div>
   <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rifas Los Hermanos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- flickity -->
         <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
         <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @livewireStyles
            <style>

                /* Carrousel */

                .carousel {
                    background: transparent;
                }

                

                .carousel-cell-1 {
                    background-position: center;
                    margin-right: 30px;
                    border-radius: 10px;
                }

                .carousel-cell-2 {
                    margin-right: 30px;
                    background-position: center;
                    border-radius: 10px;
                }   
            </style>

    </head>

    <body class="bg-[url('../../public/images/fondoDark.png')] dark:bg-[url('../../public/images/fondoLight.png')] bg-cover bg-no-repeat bg-center md:bg-left text-[#1b1b18] flex p-2 lg:p-8 lg:justify-center min-h-screen flex-col overflow-x-hidden ">
        
        <div class="flex flex-col md:flex-row items-center sm:px-[100px] md:px-[76px] px-[50px] gap-8 w-full">
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center ">
                <p class="text-4xl text-[#ef4848] font-bold text-center"> Bienvenidos<br> Rifas los Hermanos</p>
                <img class="md:max-w-lg" src="{{asset('images/logo.png')}}" alt="Background"/>
            </div>
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center text-center">
                <p class="text-2xl text-[#ef4848] font-bold mt-5">🥇 Primer Premio</p>
                <p class="text-white text-xl mt-5">Moto Rk 200 (2025) 🏍️</p>
                <p class="text-2xl text-[#ef4848] font-bold mt-5">🥈 Segundo Premio</p>
                <p class="text-white text-xl mt-5">Mercado de Comida de 150$ 🛒</p>
                <p class="text-2xl text-[#ef4848] font-bold mt-5">🥉 Tercer Premio</p>
                <p class="text-white text-xl mt-5 mb-5">100$ en Efectivo 💵</p>
                <img class="bg-cover md:max-w-md" src="{{asset('images/r1.png')}}" alt="1"/>
                <!-- <div class="carousel w-full md:w-3/4 h-96" data-flickity='{"wrapAround": true, "autoPlay": 5000, "prevNextButtons": false, "pageDots": false}'>
                    <div class="carousel-cell-1 w-full h-96">
                        <img class="bg-cover w-full" src="{{asset('images/r1.png')}}" alt="1"/>
                    </div>
                     <div class="carousel-cell-2 w-full h-96">
                        <img class="bg-cover w-full" src="{{asset('images/r2.jpg')}}" alt="2"/>
                    </div> 
                </div> -->
            </div>
        </div>
        <div class="flex items-center mb-5 md:px-[76px] px-[50px] justify-center">
            <div class="w-full p-4 flex flex-col items-center ">
                <p class="text-2xl text-[#ef4848] font-bold text-center">¿Cómo puedes participar en un sorteo?</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4 w-full max-w-6xl mx-auto sm:px-[100px] md:px-[76px] px-[50px]">
            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <p class="text-gray-600 font-medium">Escoge la cantidad de tickets que deseas comprar. Puedes escoger los que quieras 😱</p>
            </div>

            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <p class="text-gray-600 font-medium">Una vez que selecciones los tickets a comprar, termina tu proceso de compra y realiza el pago 🫡</p>
            </div>

            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <p class="text-gray-600 font-medium">Una vez realices el pago y lo notifiques, te llegará un email con el detalle de los tickets comprados. ¡Listo, a ganar! 🤑​</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center md:px-[76px] px-[50px] gap-8 md:h-screen w-full p-[40px]">
            @livewire('buy-tickets')
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center">
                @livewire('tickets-sold-count')
                
                <div class="flex flex-wrap justify-center w-full gap-4 mb-4">
                    <button wire:click="$dispatch('open-ticket-verifier-modal')" class="bg-white hover:bg-white text-[#ef4848] font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105 flex items-center justify-center space-x-2 mb-8">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ver Tickets Comprados
                    </button>
                </div>
                <flux:callout class="md:w-3/4 w-full mb-2" variant="warning" icon="exclamation-circle" heading="Asegúrate de que la cantidad sea exacta y envía el capture." />
                <flux:callout class="md:w-3/4 w-full mb-2" variant="warning" icon="exclamation-circle" heading="Recuerde que debe esperar un lapso de 24 a 36 Horas aproximadamente mientras nuestro equipo trabaja para verificar y validar su compra y proceder a enviarles sus números de manera aleatoria a su correo electrónico suministrado previamente" />
                <flux:callout class="md:w-3/4 w-full" icon="exclamation-triangle" color="red" inline>
                    <flux:callout.heading>IMPORTANTE</flux:callout.heading>
                    <flux:callout.text>Si en 24 horas no te llegan tus Números al correo, por favor escribe a Soporte no antes.</flux:callout.text>
                    <x-slot name="actions" class="@md:h-full m-0!">
                        <flux:button class="bg-red-600 hover:bg-red-700 text-white" target="_blank" href="https://api.whatsapp.com/send?phone=584143669987&text=%C2%A1Hola!%20%F0%9F%91%8B%0A%0ATengo%20una%20consulta..."><img src="{{asset('images/whatsappN.png')}}" class="w-[20px] mr-4"> CONTACTANOS -></flux:button>
                    </x-slot>
                </flux:callout>
            </div>
        </div>
        
        <!-- terminos y condiciones -->
        @livewire('generic-modal')
        <!-- Verificacion de tickets -->
        @livewire('ticket-verifier-modal')
        <!-- Confirmacion de pago -->
        @livewire('confirm-payment-modal')

        @vite('resources/js/app.js') 
        @livewireScripts
    </body>
</html>
</div>
