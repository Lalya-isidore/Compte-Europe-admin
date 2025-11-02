<!DOCTYPE html>
<html>

<head>
    <title>Échec de Virement. Remboursement du Solde sur {{ config('app.name') }}</title>
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
            background-color: #ff0000;
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

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #673ab7;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
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
            <h1>Échec de Virement. Remboursement du Solde</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $compte->nom . ' ' . $compte->prenom }},</p>
            <p>Nous regrettons de vous informer que votre tentative de Virement a échoué.</p>
            <p>Voici les détails du Virement :</p>
            <ul>
                <li><strong>Montant du Virement :</strong>  {{ number_format($compte->account_balance2, 2, ',', ' ') . ' ' . $compte->devise }}</li>
                <li><strong>Date du Virement :</strong> {{ $transfer->created_at }}</li> 
                <li><strong>Destinataire :</strong> {{ $transfer->beneficiary_name }}</li>
                <li><strong>Motif du Virement:</strong> {{ $transfer->reason }} </li>
            </ul>
            <p>Le montant de {{ $compte->account_balance2 . ' ' . $compte->devise }} a été remboursé sur votre compte.</p>
            <p>Nous nous excusons pour la gêne occasionnée. Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter.</p>
        </div>
        <div class="footer">
            <p>Merci d'utiliser {{ config('app.name') }} !</p>
        </div>
    </div>
</body>

</html>
