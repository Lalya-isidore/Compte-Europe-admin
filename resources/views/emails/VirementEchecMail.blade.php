<!DOCTYPE html>
<html>
<head>
    <title>Echec de virement </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #c01818;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Echec de virement </h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $compte->nom }} {{ $compte->prenom }},</p>
            <p>Nous vous informons que votre virement de {{ $transfer->solidvire }} {{ $transfer->devise }} a echoué!!</p>
            <p>Les détails du virement sont les suivants :</p>
            <ul>
                <li>Montant : {{ $transfer->solidvire }} {{ $compte->devise }}</li>
                <li>Date : {{ $transfer->created_at->format('d/m/Y H:i') }}</li>
                <li>Bénéficiaire : {{ $transfer->beneficiary_name }}</li>
                <li>Référence : {{ $transfer->numerocompte }}</li>
            </ul>
            <p>Merci d'utiliser nos services.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
