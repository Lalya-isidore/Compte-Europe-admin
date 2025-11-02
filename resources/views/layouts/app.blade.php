<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSFERCASH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <!--<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/image/1.jpg') }} ">-->
    <!--<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/image/1.jpg') }} ">-->
    <!--<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/image/1.jpg') }} ">-->
    <link rel="manifest" href="/path/to/site.webmanifest">
</head>
<style>
    * {
        font-family: 'Roboto', sans-serif;
    }
    .logonom{
    color:  #0099ff;
    font-size: 1.5rem;
    font-weight: bolder;
    }
</style>



<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light container shadow">
        <div class="container-fluid" style="display: flex; justify-content: space-between;">
            <a class="navbar-brand logonom" href="#">FlashCompte</a>

            <ul class="navbar-nav  mb-2 mb-lg-0">
                @auth
                    <div class="d-flex lesli" >
                        <li class="nav-item mx-3">
                            <a class="nav-link" aria-current="page" href="{{ route('compte.create') }}">Compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('logout') }}">Me déconnecter</a>
                        </li>
                    </div>
                @else
                @endauth
            </ul>

        </div>
    </nav>
    <div class="container">
        @yield('page-content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>

    <script>
        // Écoute l'événement du clic sur le bouton de remboursement
        document.querySelector('.remboursement').addEventListener('click', function() {
            // Récupère l'ID du compte à rembourser depuis les données attribuées au bouton
            var compteId = this.getAttribute('data-compte-id');

            // Envoie une requête AJAX pour déclencher le remboursement
            fetch(`/compte/rembourse`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Assure-toi d'avoir le token CSRF correct ici
                    },
                    body: JSON.stringify({
                        compte_id: compteId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Vérifie si le remboursement a été effectué avec succès ou non
                    if (data.success) {
                        alert('Le remboursement a été effectué avec succès.');
                        location.reload(); // Recharge la page pour mettre à jour le solde du compte
                    } else {
                        alert('Le remboursement a échoué. Veuillez réessayer.');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Récupère l'élément du bouton de remboursement
            var remboursementBtn = document.querySelector('.remboursement');

            // Récupère la valeur de l'attribut data-virement-effectue
            var virementEffectue = remboursementBtn.getAttribute('data-virement-effectue');

            // Vérifie si un virement a été effectué
            if (virementEffectue === 'true') {
                // Affiche le bouton de remboursement
                remboursementBtn.style.display = 'block';
            } else {
                // Cache le bouton de remboursement
                remboursementBtn.style.display = 'none';
            }
        });
    </script>

</body>

</html>
