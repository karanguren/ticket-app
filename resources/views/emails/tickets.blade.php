<!DOCTYPE html>
<html>
<head>
    <title>Tickets de Rifas los Hermanos</title>
</head>
<body>
    <img style="display: block; margin-left: auto; margin-right: auto; width: 200px; height: auto;" src="{{asset('images/logo.png')}}">
    <div style="margin: auto; width: 600px; padding: 10px;">
        <p style="text-align: justify; margin-left: 20px;">
            <h2 style="text-align: justify; margin-left: 20px;">Hola! {{ $clientName }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Gracias por participar y comprar con <br>Rifas los Hermanos!
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            <h3 style="text-align: justify; margin-left: 20px;">
                Aqui estan tus numeros:
            </h3>
        </p>
        <br>
        <br>
        <p style="text-align: justify; margin-left: 20px;">
            @foreach ($tickets as $ticket)
                <span style="display: inline-flex; padding: 5px; margin: 5px; background-color: #dbeafe; border-radius: 8px; color: #193cb8;"> {{ $ticket }} </span>
            @endforeach
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Para cualquier consulta o asistencia adicional que necesite, puede comunicarse con nuestro equipo a traves de <a target="_blank" href="https://api.whatsapp.com/send?phone=584143669987&text=%C2%A1Hola!%20%F0%9F%91%8B%0A%0ATengo%20una%20consulta...">WhatsApp</a>
        </p>
    </div>
</body>
</html>