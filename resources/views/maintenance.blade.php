<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rifas Los Hermanos</title>
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[url('../../public/images/fondoDark.png')] dark:bg-[url('../../public/images/fondoLight.png')] bg-cover bg-no-repeat bg-center md:bg-left text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        @livewire('maintenance')
    </body>
</html>
