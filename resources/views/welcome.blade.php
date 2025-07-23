<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- flickity -->
         <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
         <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])

            <style>

                .diagonal {
                    writing-mode: vertical-rl;
                    text-orientation: mixed;
                }

                @media (max-width: 991px) {
                    .fixed-footer {
                        display: none;
                    }

                    .img-about {
                        display: none;
                    }

                    .contact-mb {
                        padding: 0 !important;
                    }
                }

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

    <body class="bg-[url('../../public/images/fondoDark.png')] dark:bg-[url('../../public/images/fondoLight.png')] bg-cover bg-no-repeat bg-center md:bg-left text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            <nav class="flex items-center justify-end gap-4">
                <!-- <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                >
                    Log in
                </a> -->

                <!-- <a
                    href="{{ route('faq') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#ef4848] border-[#ef4848] hover:border-[#ef4848] border text-[#ef4848] dark:border-[#ef4848] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    Preguntas y Respuestas
                </a> -->

                <button id="openTicketVerifierModalBtn" 
                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105
                           flex items-center justify-center space-x-2 mt-8">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Verificar Tickets</span>
            </button>
            </nav>
        </header>
        <div class="flex flex-col md:flex-row items-center md:px-[76px] px-[50px] gap-8  w-full">
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center">
                <p class="text-4xl text-[#ef4848] font-bold text-center"> Bienvenidos<br> Rifas los Hermanos</p>
                <img class="max-w-lg" src="{{asset('images/logo.png')}}" alt="Background"/>
            </div>
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center">
                <p class="text-3xl text-[#ef4848] font-bold mt-5">🥇 Primer Premio</p>
                <p class="text-white text-xl mt-5">1 iPhone 14promax 📱</p>
                <p class="text-3xl text-[#ef4848] font-bold mt-5">🥈 Segundo Premio</p>
                <p class="text-white text-xl mt-5">Mercado de Comida valorado en 150$ 🛒</p>
                <p class="text-3xl text-[#ef4848] font-bold mt-5">🥉 Tercer Premio</p>
                <p class="text-white text-xl mt-5 mb-10">100$ en Efectivo 💵</p>

                <div class="carousel w-full md:w-3/4 h-96" data-flickity='{"wrapAround": true, "autoPlay": 5000, "prevNextButtons": false, "pageDots": false}'>
                    <div class="carousel-cell-1 w-full h-96">
                        <img class="bg-cover w-full" src="{{asset('images/r1.jpg')}}" alt="1"/>
                    </div>
                    <div class="carousel-cell-2 w-full h-96">
                        <img class="bg-cover w-full" src="{{asset('images/r2.jpg')}}" alt="2"/>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-2xl text-[#ef4848] font-bold text-center mb-5 mt-10  md:px-[76px] px-[50px]">¿Cómo puedes participar en un sorteo?</p>
        <div class="flex flex-col md:flex-row gap-4 w-full max-w-6xl mx-auto  md:px-[76px] px-[50px]">
            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <!-- <h2 class="text-xl font-semibold text-gray-800 mb-2">Escoge la cantidad </h2> -->
                <p class="text-gray-600 font-medium">Escoge la cantidad de tickets que deseas comprar. Puedes escoger los que quieras 😱</p>
            </div>

            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <!-- <h2 class="text-xl font-semibold text-gray-800 mb-2">Columna 2</h2> -->
                <p class="text-gray-600 font-medium">Una vez que selecciones los tickets a comprar, termina tu proceso de compra y realiza el pago 🫡</p>
            </div>

            <div class="w-full md:w-1/3 p-6 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-center">
                <!-- <h2 class="text-xl font-semibold text-gray-800 mb-2">Columna 3</h2> -->
                <p class="text-gray-600 font-medium">Una vez realices el pago y lo notifiques, te llegará un email con el detalle de los tickets comprados. ¡Listo, a ganar! 🤑​</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center md:px-[76px] px-[50px] gap-8 md:h-screen w-full p-[40px]">
            <div class="w-full md:w-1/2 p-4 flex flex-col items-center h-full">
                <p class="text-2xl text-[#ef4848] font-bold text-center mb-8">Compra aquí tus tickets 🎟️</p>
                <flux:badge color="red" size="lg" class="text-white mb-8">Valor Ticket: 30bs</flux:badge>
                <div class="w-5/6 bg-gray-200 rounded-full dark:bg-gray-700 mx-8">
                    <div class="bg-red-600 text-xs font-medium text-red-100 text-center p-0.5 leading-none rounded-full" style="width: 45%"> 45%</div>
                </div>
                <strong class="text-white text-[12px] mt-3 mb-3">0.00% del objetivo alcanzado</strong>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-white font-bold md:text-right mb-1 md:mb-0 pr-4" for="tickets">
                            Ticket
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input min="2" max="100" onkeyup="updateText()" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-500" id="tickets" type="number">
                    </div>
                </div>
                <p class="text-white text-[12px] mb-5">Mínimo 2 y Máximo 100 Tickets por compra</p>
        
                <p class="text-white mt-2 mb-4 text-[13px] w-full text-center px-10">
                    Seleccione la cantidad de números a comprar. Utiliza los botones para seleccionar de forma más rápida una
                    cantidad mayor de tickets a comprar. Cantidad mínima permitida: <strong>2</strong>
                </p>
                <div class="flex flex-wrap justify-center w-full gap-4 mb-4">
                    <button class="w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                        2
                    </button>
                    <button class="w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                        5
                    </button>
                    <button class="w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                        10
                    </button>
                    <button class="w-24 bg-red-500 hover:bg-red-600 text-white font-bold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full">
                        20
                    </button>
                </div>
                
                <p class="text-2xl text-white font-bold mt-07 mb-5">Metodos de pago</p>
                <div class="flex flex-wrap gap-4 justify-center mb-6">
                    <div id="pagoMovilBtn" class="cursor-pointer">
                        <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/d.png')}}" alt="Pago Movil"/>
                    </div>
                    <!-- <div id="zelleBtn" class="cursor-pointer">
                        <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/b.jpg')}}" alt="Zelle"/>
                    </div>
                    <div id="binanceBtn" class="cursor-pointer">
                        <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/e.png')}}" alt="Binance"/>
                    </div>
                    <div id="zinliBtn" class="cursor-pointer">
                        <img class="w-20 h-20 rounded-full object-cover shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105" src="{{asset('images/a.png')}}" alt="Zinli"/>
                    </div> -->
                </div>
                <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96 hidden" id="miDiv">
                    <div class="p-4 h-64"> 
                        <h5 class="mb-2 text-[#ef4848] text-xl font-semibold text-center" id="dynamicTitle">
                        </h5>
                        <div id="dynamicText" class="text-slate-600 leading-normal font-light">
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-4 flex flex-col items-center">
                <p class="text-2xl text-white font-bold">Confirma tu pago</p>
                <div class="w-90 mb-24">
                    <flux:label class="text-white">Nombre</flux:label>
                    <flux:input 
                        placeholder="Nombre"
                        type="text"
                        required
                        class="mb-4"
                    />
                    <flux:label class="text-white">Cédula</flux:label>
                    <flux:input 
                        placeholder="Cédula"
                        type="text"
                        required
                        class="mb-4"
                    />
                    <flux:label class="text-white">Teléfono</flux:label>
                    <flux:input 
                        type="phone"
                        mask="(999)999-9999"
                        placeholder="Teléfono"
                        required
                        class="mb-4"
                    />
                    <flux:label class="text-white">Correo</flux:label>
                    <flux:input
                        wire:model="email"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="mb-4"
                    />
                    <flux:label class="text-white">Nro. de Referencia (ultimos 4)</flux:label>
                    <flux:input
                        wire:model="ref"
                        type="text"
                        required
                        placeholder="Nro. de Referencia"
                        class="mb-4"
                        
                    />
                    <flux:label class="text-white">Capture de pago</flux:label>
                    <flux:input 
                        type="file" 
                        wire:model="logo" 
                        placeholder="Captura de pago"
                        required
                    />
                    <flux:button class="mt-5" variant="danger" icon="arrow-down-tray"> CONFIRMAR PAGO </flux:button>
                </div>
                <flux:callout class="w-3/4" icon="exclamation-triangle" color="red" inline>
                    <flux:callout.heading>IMPORTANTE</flux:callout.heading>
                    <flux:callout.text>Si en 24 horas no te llegan tus Números al correo, por favor escribe a Soporte no antes.</flux:callout.text>
                    <x-slot name="actions" class="@md:h-full m-0!">
                        <flux:button target="_blank" href="https://api.whatsapp.com/send?phone=+584143669987&text=Hola!"><img src="{{asset('images/whatsappN.png')}}" class="w-[20px] mr-4"> CONTACTANOS -></flux:button>
                    </x-slot>
                </flux:callout>
            </div>
        </div>

        <!-- <div>
            <a
                href="{{ route('faq') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
            >
                Log in
            </a>
        </div> -->
        

        <div id="Modal" class="fixed inset-0 bg-[#1b1b18ad] overflow-y-auto h-full w-full flex items-center justify-center hidden top-0">
            <div class="relative p-5 border max-w-3xl w-full shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-red-900">¡Bienvenido!</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500 text-justify">
                            1. Los números disponibles a comprar de cada una de nuestras rifas serán descritos en la página de detalles de las mismas.
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
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="closeModalBtn" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-36 shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="ticketVerifierModal" class="fixed inset-0 bg-[#1b1b18ad] overflow-y-auto h-full w-full flex items-center justify-center hidden top-0 z-50">
        <div class="relative p-5 border max-w-md w-full shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Verificar Tickets</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 mb-4">
                        Ingresa el número de tu ticket o tu cédula para verificar si eres ganador.
                    </p>
                    <input type="text" placeholder="Número de Ticket o Cédula" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
                    <button class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Verificar
                    </button>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeTicketVerifierModalBtn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-36 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
        <script>
            window.totalFromLaravel = "{{ $totalAPagar ?? '0.00' }}"; 
        </script>
        @vite('resources/js/app.js') 
    </body>

    <footer>
        <div class="diagonal right-[20px] fixed bottom-[20px] px-[15px] py-[10px] bg-transparent z-9999">
            <span class="text-[10px] text-white">© 2025 Copyright: All rights reserved.</span>
        </div>
        <div class="left-[20px] fixed bottom-[20px] px-[15px] py-[10px] text-sm bg-transparent z-9999">
            <div class="text-center flex flex-col justify-center">
                    <a href="https://api.whatsapp.com/send?phone=+584143669987&text=Hola!" target="_blank" class="mb-[20px] ml-[0px]">
                    <img src="{{asset('images/whatsapp.png')}}" style="width: 4%">
                    </a>
                    <!-- <a href="#" target="_blank" class="mb-[20px] ml-[0px]">
                    <img src="{{asset('images/facebook.png')}}" style="width: 4%"> -->
                    </a>
                    <a href="https://www.instagram.com/rifasloshermanos333" target="_blank" class="mb-[20px] ml-[0px]">
                    <img src="{{asset('images/instagram.png')}}" style="width: 4%">
                    </a>
                    <a href="#" target="_blank" class="ml-[0px]">
                    <img src="{{asset('images/tik-tok.png')}}" style="width: 4%">
                    </a>
            </div>
        </div>
    </footer>
</html>

<script>

</script>
