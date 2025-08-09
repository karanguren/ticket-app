<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets de Rifas Los Hermanos</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; background-color: #f7fafc; padding: 20px 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
        <div style="text-align: center; padding: 20px;">
            <img src="{{ $logoUrl }}" alt="Rifas Los Hermanos" style="max-width: 350px; height: auto;">
        </div>

        <div style="padding: 20px 40px; text-align: center;">
            <h1 style="font-size: 24px; color: #333333; margin-top: 0;">¡Hola, {{ $clientName }}! 👋</h1>
            <p style="font-size: 16px; color: #555555; line-height: 1.5;">
                Gracias por participar y comprar con **Rifas Los Hermanos**. ¡Tu pago ha sido confirmado!
            </p>

            <div style="background-color: #f0f4f8; border-radius: 8px; padding: 20px; margin-top: 20px;">
                <h3 style="font-size: 18px; color: #333333; margin-top: 0; margin-bottom: 15px;">Aquí están tus números:</h3>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                    @foreach ($tickets as $ticket)
                        <span style="font-size: 18px; font-weight: bold; padding: 10px 15px; background-color: #ef4848; color: #ffffff; border-radius: 8px; margin-right: 10px;">
                            {{ $ticket }}
                        </span>
                    @endforeach
                </div>
            </div>

            <p style="font-size: 16px; color: #555555; line-height: 1.5; margin-top: 20px;">
                ¡Mucha suerte en el próximo sorteo! Puedes comprar más y aumentar tus posibilidades de ganar.
            </p>
            
            <p style="font-size: 16px; color: #555555; line-height: 1.5; margin-top: 20px;">
                Para cualquier consulta o asistencia adicional que necesite, puede comunicarse con nuestro equipo a traves de
            </p>

            <div style="margin: 30px 0;">
                <a href="https://api.whatsapp.com/send?phone=584143669987&text=%C2%A1Hola!%20%F0%9F%91%8B%0A%0ATengo%20una%20consulta..." target="_blank" style="display: inline-block; padding: 12px 24px; font-size: 16px; font-weight: bold; color: #ffffff; background-color: #25d366; text-decoration: none; border-radius: 6px;">
                    WhatsApp
                </a>
            </div>
        </div>

        <div style="text-align: center; padding: 20px 40px; border-top: 1px solid #e2e8f0; margin-top: 20px;">
            <p style="font-size: 14px; color: #777777; margin-bottom: 10px;">Atentamente, <a href="https://hermanosrifas.com" target="_blank">hermanosrifas.com</a></p>
            <p style="font-size: 14px; color: #777777; margin-bottom: 10px;">¡Gracias por confiar en nosotros!</p>

            <div style="margin-top: 20px;">
                <h4 style="font-size: 16px; color: #555555; margin-bottom: 10px;">Síguenos en nuestras redes:</h4>
                <a href="https://www.instagram.com/rifasloshermanos333" target="_blank" style="margin: 0 8px;">
                    <img src="{{ $instagramUrl }}" alt="Instagram" width="32" height="32" style="display:inline-block; border-radius: 50%;">
                </a>
            </div>
        </div>
    </div>
</body>
</html>