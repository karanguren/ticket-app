<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Payments Livewire</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="p-8 bg-gray-800 min-h-screen flex items-center justify-center">
        @livewire('payment-methods', ['totalAmount' => $totalAmount])
    </div>
    @vite('resources/js/app.js')
    @livewireScripts
</body>
</html>