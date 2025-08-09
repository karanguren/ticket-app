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
            <h1 class="title">¡Gracias por realizar tu compra, {{ $clientName }}!</h1>
            <p class="text">
                Hemos recibido tu notificación de pago. Nuestro equipo validará la información y te enviaremos los tickets de tu compra a este mismo correo.
            </p>

            <div style="background-color: #f0f4f8; border-radius: 8px; padding: 20px; margin-top: 20px;">
                <h3>Aquí están tus datos:</h3>
                    <div class="detail-item"><strong>Nombre:</strong> {{ $clientName }}</div>
                    <div class="detail-item"><strong>Email:</strong> {{ $email }}</div>
                    <div class="detail-item"><strong>Teléfono:</strong> {{ $phone }}</div>
                    <div class="detail-item"><strong>Referencia:</strong> {{ $reference }}</div>
                    <div class="detail-item"><strong>Número de tickets:</strong> {{ $numberOfTickets }}</div>
                    <div class="detail-item"><strong>Método de pago:</strong> {{ $paymentMethod }}</div>
                    <div class="detail-item"><strong>Monto Pagado:</strong> Bs. {{ number_format($totalAmount, 2, ',', '.') }}</div>
                    <div class="detail-item"><strong>Fecha de la compra:</strong> {{ $purchaseDate }}</div>
                    <div class="detail-item"><strong>Hora de la compra:</strong> {{ $purchaseTime }}</div>
                    <div class="image-container">
                        <strong>Comprobante de Pago:</strong><br>
                        <img src="{{ $receiptImageUrl }}" alt="Comprobante de Pago" style="margin-top: 10px;">
                    </div>
            </div>

            <p style="font-size: 16px; color: #555555; line-height: 1.5; margin-top: 20px;">
                Por favor, espera un lapso de **24 a 36 horas** mientras nuestro equipo valida tu compra. Recibirás actualizaciones en tu correo electrónico.
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