<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rifas Los Hermanos</title>
        @livewireStyles
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
    <body>
        @livewire('welcome-page')

    </body>
    <footer>
        <div class="diagonal right-[20px] fixed bottom-[20px] px-[15px] py-[10px] bg-transparent z-9999">
            <span class="text-[10px] text-white">© 2025 Copyright: All rights reserved.</span>
        </div>
        <div class="left-[20px] fixed bottom-[20px] px-[15px] py-[10px] text-sm bg-transparent">
            <div class="text-center flex flex-col justify-center">
                <a href="https://api.whatsapp.com/send?phone=584143669987&text=%C2%A1Hola!%20%F0%9F%91%8B%0A%0ATengo%20una%20consulta..." target="_blank" class="mb-[20px] ml-[0px] w-[23px]">
                    <img src="{{asset('images/whatsapp.png')}}" style="width: 100%">
                </a>
                </a>
                <a href="https://www.instagram.com/rifasloshermanos333" target="_blank" class="mb-[20px] ml-[0px] w-[23px]">
                    <img src="{{asset('images/instagram.png')}}" style="width: 100%">
                </a>
                <a href="#" target="_blank" class="ml-[0px] w-[23px]">
                    <img src="{{asset('images/tik-tok.png')}}" style="width: 100%">
                </a>
            </div>
        </div>
    </footer>
</html>