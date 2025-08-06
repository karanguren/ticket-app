<!DOCTYPE html>
<html>
<head>
    <title>Tickets de Rifas los Hermanos</title>
</head>
<body>
    <img style="display: block; margin-left: auto; margin-right: auto; width: 200px; height: auto;" src="{{asset('images/logo.png')}}">
    <div style="margin: auto; width: 600px; padding: 10px;">
        <p style="text-align: justify; margin-left: 20px;">
            <p class="text-3xl text-[#ef4848] font-bold mt-5">Hola!</p>
            <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $clientName }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Gracias por participar y comprar con <br>Rifas los Hermanos!
            <br>
            Los detalles a continuacion:
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            <h3 style="text-align: justify; margin-left: 20px;">
                Aqui estan tus numeros:
            </h3>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Tickets adquiridos:
            <br>
            Números:
            <br>
            @foreach ($tickets as $ticket)
                <span style="display: inline-block; padding: 5px; margin-right: 5px; background-color: #f3f4f6; border-radius: 5px;">{{ $ticket }}</span>
            @endforeach
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Para cualquier consulta o asistencia adicional que necesite, puede comunicarse las 24
            horas del dia con nuestro equipo a traves de rifas@gmail.com
        </p>
    </div>
</body>
</html>