<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href=" {{ asset('bootstrap/bootstrap.css') }} ">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('bootstrap/bootstrap.js') }} " defer>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <title>Code de deblocage virement sur votre comote {{ config('app.name') }}</title>
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
            background-color: #673ab7;
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
            <h1>Code de deblocage du Virement sur votre compte {{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $compte->nom.' '.$compte->prenom }},</p>
            <p> Votre code de déblocage du Virement de la somme de <strong>{{$compte->account_balance2. ' '. $compte->devise }} </strong> est </p>
            <p href="#" class="btn btn-primary text-center" style="font-size: 2rem; padding:1rem; background-color:#333; color:#f4f4f4">{{ $compte->code_virement }}</p>
            <p style="color: red;">Ne partagez pas votre code de deblocage !!</p>
        </div>
        <div class="footer">
            <p>Merci d'utiliser {{ config('app.name') }} !</p>
        </div>
    </div>
</body>

</html>