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
                <nav class="flex items-center justify-start gap-4">
                    <a
                        href="{{ url('/') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#ef4848] border-[#ef4848] hover:border-[#ef4848] border text-[#ef4848] dark:border-[#ef4848] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                    >
                        Inicio
                    </a>
                </nav>
        </header>
        <p class="text-2xl text-[#ef4848] font-bold text-center mb-5 mt-10  md:px-[76px] px-[50px]">¿Cómo puedes participar en un sorteo?</p>
        <div class="flex flex-col md:flex-row gap-4 w-full max-w-6xl mx-auto  md:px-[76px] px-[50px]">
            <flux:accordion exclusive>
                <flux:accordion.item>
                    <flux:accordion.heading>What's your refund policy?</flux:accordion.heading>
                    <flux:accordion.content>
                        If you are not satisfied with your purchase, we offer a 30-day money-back guarantee. Please contact our support team for assistance.
                    </flux:accordion.content>
                </flux:accordion.item>
                <flux:accordion.item>
                    <flux:accordion.heading>Do you offer any discounts for bulk purchases?</flux:accordion.heading>
                    <flux:accordion.content>
                        Yes, we offer special discounts for bulk orders. Please reach out to our sales team with your requirements.
                    </flux:accordion.content>
                </flux:accordion.item>
                <flux:accordion.item>
                    <flux:accordion.heading>How do I track my order?</flux:accordion.heading>
                    <flux:accordion.content>
                        Once your order is shipped, you will receive an email with a tracking number. Use this number to track your order on our website.
                    </flux:accordion.content>
                </flux:accordion.item>
            </flux:accordion>
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
    </body>

    <footer>
        <div class="diagonal right-[20px] fixed bottom-[20px] px-[15px] py-[10px] bg-transparent z-9999">
            <span class="text-[10px] text-white">© 2025 Copyright: All rights reserved.</span>
        </div>
        <div class="left-[20px] fixed bottom-[20px] px-[15px] py-[10px] text-sm bg-transparent z-9999">
            <div class="text-center flex flex-col justify-center">
                    <a href="#" target="_blank" class="mb-[20px] ml-[0px]">
                    <img src="{{asset('images/whatsapp.png')}}" style="width: 4%">
                    </a>
                    <a href="#" target="_blank" class="mb-[20px] ml-[0px]">
                    <img src="{{asset('images/facebook.png')}}" style="width: 4%">
                    </a>
                    <a href="#" target="_blank" class="mb-[20px] ml-[0px]">
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
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('Modal');
        var closeButton = document.getElementById('closeModalBtn');

        // Muestra el modal
        modal.classList.remove('hidden');

        // Cierra el modal al hacer clic en el botón de cerrar
        closeButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Cierra el modal al hacer clic fuera de él
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    let lastClickedButtonId = null;

    // Función para mostrar/ocultar el texto dinámico y actualizar su contenido
    function togglePaymentInfo(title, text, buttonId) {
      const miDiv = document.getElementById('miDiv');
      const dynamicTitle = document.getElementById('dynamicTitle');
      const dynamicText = document.getElementById('dynamicText');

      // Si el div está visible y se hace clic en el mismo botón, ocultarlo
      if (!miDiv.classList.contains('hidden') && lastClickedButtonId === buttonId) {
        miDiv.classList.add('hidden');
        miDiv.classList.remove('flex');
        lastClickedButtonId = null; // Reiniciar el último botón clickeado
      } else {
        // Si el div está oculto o se hace clic en un botón diferente, mostrarlo y actualizar el contenido
        dynamicTitle.innerText = title;
        dynamicText.innerText = text;

        if (miDiv.classList.contains('hidden')) {
          miDiv.classList.remove('hidden');
          miDiv.classList.add('flex'); // Asegura que el flexbox se aplique para el centrado
        }
        lastClickedButtonId = buttonId; // Actualizar el último botón clickeado
      }
    }

    // Obtener referencias a los divs de los botones
    const pagoMovilBtn = document.getElementById('pagoMovilBtn');
    const zelleBtn = document.getElementById('zelleBtn');
    const binanceBtn = document.getElementById('binanceBtn');
    const zinliBtn = document.getElementById('zinliBtn');

    // Asignar eventos click a cada botón
    if (pagoMovilBtn) {
      pagoMovilBtn.addEventListener('click', () => {
        togglePaymentInfo(
          'Información de Pago Móvil',
          'Para Pago Móvil, por favor, realiza la transferencia al número XXXXXXXX con la cédula V-XXXXXXXX. Envía el capture de tu pago al soporte.',
          'pagoMovilBtn'
        );
      });
    }

    if (zelleBtn) {
      zelleBtn.addEventListener('click', () => {
        togglePaymentInfo(
          'Información de Zelle',
          'Envía tu pago a la cuenta de Zelle: correo@ejemplo.com. No olvides incluir tu nombre en la referencia y enviar el comprobante.',
          'zelleBtn'
        );
      });
    }

    if (binanceBtn) {
      binanceBtn.addEventListener('click', () => {
        togglePaymentInfo(
          'Información de Binance Pay',
          'Realiza tu pago a nuestro ID de Binance Pay: XXXXXXXXXX. Confirma la transacción en la aplicación y envíanos el ID de la operación.',
          'binanceBtn'
        );
      });
    }

    if (zinliBtn) {
      zinliBtn.addEventListener('click', () => {
        togglePaymentInfo(
          'Información de Zinli',
          'Para Zinli, transfiere a nuestro usuario: @usuario_zinli. Asegúrate de que la cantidad sea exacta y envía el capture.',
          'zinliBtn'
        );
      });
    }

    // Función para copiar el texto al portapapeles
    function copyToClipboard() {
      const dynamicText = document.getElementById('dynamicText');
      const textToCopy = dynamicText.innerText;

      // Crea un elemento de texto temporal para la copia
      const tempInput = document.createElement('textarea');
      tempInput.value = textToCopy;
      document.body.appendChild(tempInput);
      tempInput.select();
      
      try {
        document.execCommand('copy');
        showCopyMessage(); // Muestra el mensaje de éxito
      } catch (err) {
        console.error('Error al copiar el texto: ', err);
        // Podrías mostrar un mensaje de error si lo deseas
      } finally {
        document.body.removeChild(tempInput); // Elimina el elemento temporal
      }
    }

    // Función para mostrar el mensaje de "¡Texto copiado!"
    function showCopyMessage() {
        const copyMessage = document.getElementById('copyMessage');
        copyMessage.classList.add('show');
        setTimeout(() => {
            copyMessage.classList.remove('show');
        }, 2000); // El mensaje desaparece después de 2 segundos
    }

    // Asignar evento click al botón de copiar texto
    if (copyTextBtn) {
      copyTextBtn.addEventListener('click', copyToClipboard);
    }
</script>
