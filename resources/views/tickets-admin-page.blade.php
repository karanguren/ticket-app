<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Tickets</title>
    @vite('resources/css/app.css') 
    @livewireStyles 
</head>
<body>
    @livewire('tickets-list')

    @vite('resources/js/app.js') 
    @livewireScripts 

    <script>
        Livewire.on('open-whatsapp-tab', (event) => { 
            const whatsappUrl = event.url; 
            window.open(whatsappUrl, '_blank'); 
        });
    </script>
</body>
</html>