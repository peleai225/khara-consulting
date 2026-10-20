<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            line-height: 1.6;
            color: #1E293B;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
        }
        .header {
            background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .info-block {
            background-color: #f9fafb;
            border-left: 4px solid #DC2626;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .info-label {
            font-weight: 600;
            color: #DC2626;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #1E293B;
        }
        .message-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nouveau message de contact</h1>
        </div>
        
        <div class="content">
            <p>Vous avez reçu un nouveau message via le formulaire de contact du site Khara Consulting.</p>
            
            <div class="info-block">
                <div class="info-label">Nom et prénom</div>
                <div class="info-value">{{ $data['name'] }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $data['email'] }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Téléphone</div>
                <div class="info-value">{{ $data['phone'] }}</div>
            </div>
            
            @if(!empty($data['whatsapp']))
            <div class="info-block">
                <div class="info-label">WhatsApp</div>
                <div class="info-value">{{ $data['whatsapp'] }}</div>
            </div>
            @endif
            
            <div class="info-block">
                <div class="info-label">Profil</div>
                <div class="info-value">{{ $data['type'] }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Besoins</div>
                <div class="info-value">{{ implode(', ', $data['needs']) }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Budget estimé</div>
                <div class="info-value">{{ $data['budget'] }}</div>
            </div>
            
            <div class="message-box">
                <div class="info-label">Message</div>
                <div class="info-value" style="white-space: pre-wrap; margin-top: 10px;">{{ $data['message'] }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Ce message a été envoyé depuis le formulaire de contact du site Khara Consulting.</p>
            <p>Répondez directement à cet email pour contacter le client.</p>
        </div>
    </div>
</body>
</html>
