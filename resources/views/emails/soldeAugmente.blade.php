<!DOCTYPE html>
<html>

<head>
    <title>Augmentation de Solde sur {{ config('app.name') }}</title>
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
            background-color: #4caf50;
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
            <h1>Augmentation de Solde</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $compte->nom . ' ' . $compte->prenom }},</p>
            <p>Nous souhaitons vous informer que votre solde a été augmenté de {{ number_format($montant, 2, ',', ' ') . ' ' . $compte->devise }}.</p>
            <p>Voici les détails de l'opération :</p>
            <ul>
                <li><strong>Montant ajouté :</strong> {{ number_format($montant, 2, ',', ' ') . ' ' . $compte->devise }}</li>
                <li><strong>Nouveau solde :</strong> {{ number_format($compte->account_balance, 2, ',', ' ') . ' ' . $compte->devise }}</li>
            </ul>
            <p>Merci de votre confiance et d'utiliser {{ config('app.name') }} !</p>
        </div>
        <div class="footer">
            <p>Merci d'utiliser {{ config('app.name') }} !</p>
        </div>
    </div>
</body>

</html>
