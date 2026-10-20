<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réception</title>
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
        .success-icon {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
        }
        .message {
            background-color: #f0fdf4;
            border-left: 4px solid #22c55e;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box {
            background-color: #f9fafb;
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
            <h1>Merci pour votre message !</h1>
        </div>
        
        <div class="content">
            <div class="success-icon">✓</div>
            
            <p>Bonjour {{ $data['name'] }},</p>
            
            <div class="message">
                <p><strong>Votre message a bien été reçu !</strong></p>
                <p>Nous avons bien reçu votre demande et nous vous répondrons dans les plus brefs délais.</p>
            </div>
            
            <div class="info-box">
                <p><strong>Récapitulatif de votre demande :</strong></p>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin: 10px 0;">📋 <strong>Profil :</strong> {{ $data['type'] }}</li>
                    <li style="margin: 10px 0;">🎯 <strong>Besoins :</strong> {{ implode(', ', $data['needs']) }}</li>
                    @if($data['budget'] !== 'Non spécifié')
                    <li style="margin: 10px 0;">💰 <strong>Budget :</strong> {{ $data['budget'] }}</li>
                    @endif
                </ul>
            </div>
            
            <p>En attendant notre réponse, n'hésitez pas à consulter nos <a href="{{ url('/services') }}" style="color: #DC2626;">services</a> et nos <a href="{{ url('/programs') }}" style="color: #DC2626;">programmes de formation</a>.</p>
            
            <p>Cordialement,<br>
            <strong>L'équipe Khara Consulting</strong></p>
        </div>
        
        <div class="footer">
            <p>Khara Consulting - Beyond and Further</p>
            <p>Cet email est un accusé de réception automatique. Merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
