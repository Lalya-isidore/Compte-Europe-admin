
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h2>Réinitialisation de mot de passe</h2>
    <p>Bonjour {{ $user->name }},</p>
    <p>Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de votre mot de passe.</p>
    <p>Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
    <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.</p>
    <p>Merci,</p>
    <p>Votre équipe {{ config('app.name') }}</p>
</body>
</html>
