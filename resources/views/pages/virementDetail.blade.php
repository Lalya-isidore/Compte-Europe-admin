@extends('./../layouts.app')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-4">
                <a href="{{ route('showroute') }}" class="  d-flex justify-content-end mb-5 btn btn-primary fw-bold"
                    style="text-decoration: none; color:black; width:5rem ; color:white; ">Acceuil</a>
                <div class="alert alert-info">
                    <p><strong>Numéro de Compte :</strong> {{ $transfer['numerocompte'] }}</p>
                    <p><strong>Nom du serveur :</strong> {{ $transfer['name_servieur'] }}</p>
                    <p><strong>Nom du bénéficiaire :</strong> {{ $transfer['beneficiary_name'] }}</p>
                    <p><strong>Motif :</strong> {{ $transfer['reason'] }}</p>
                </div>

                <h1>Virement en cours, veuillez patienter...</h1>
                <div class="progress" data-start-percentage="{{ $compte->start_percentage }}"
                    data-end-percentage="{{ $compte->end_percentage }}" data-compte-id="{{ $compte->id }}">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <!-- Modal de succès -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header header2">
                    <h5 class="modal-title" id="successModalLabel">Virement Terminé</h5>
                    <button type="button" class="close close2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Le virement a été effectué avec succès.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary succes" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'échec -->
    <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failureModalLabel">Échec du Virement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $compte->failure_message }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <form id="transferForm" action="{{ route('storeVirement') }}" method="post">
        @csrf
        @method('post')
        <input type="hidden" name="numerocompte" value="{{ $transfer['numerocompte'] }}">
        <input type="hidden" name="name_servieur" value="{{ $transfer['name_servieur'] }}">
        <input type="hidden" name="beneficiary_name" value="{{ $transfer['beneficiary_name'] }}">
        <input type="hidden" name="reason" value="{{ $transfer['reason'] }}">
        <input type="hidden" id="account-balance" value="{{ $compte->account_balance }}">

        <button type="submit" class="btn btn-primary mt-4" style="display: none;">Confirmer le Virement</button>
    </form>


    <style>
        .progress {
            height: 45px;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }

        .modal-header {
            background-color: #d60a0a;
            color: #f3f3f3;
        }

        .btn-danger {
            background-color: #d60a0a;
            color: #f3f3f3;
        }

        .close {
            background-color: #f3f3f3;
            color: #d60a0a;
            font-size: 1rem;
            border: 0;
            border-radius: 100%;
        }

        .header2 {
            background-color: #4caf50;
            color: #f3f3f3;
        }

        .succes {
            background-color: #4caf50;
            color: #f3f3f3;
        }

        .close2 {
            background-color: #f3f3f3;
            color: #4caf50;
            font-size: 1rem;
            border: 0;
            border-radius: 100%;
        }

        .progress-bar {
            height: 100%;
            background-color: #4caf50;
            text-align: center;
            line-height: 45px;
            color: white;
            transition: width 0.4s;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var progressElement = document.querySelector('.progress');
            var progressBar = document.getElementById('progress-bar');
            var transferForm = document.getElementById('transferForm');
            var accountBalance = parseFloat(document.getElementById('account-balance').value);

            // Récupérer les valeurs des attributs de données
            var startPercentage = parseInt(progressElement.getAttribute('data-start-percentage'));
            var endPercentage = parseInt(progressElement.getAttribute('data-end-percentage'));
            var compteId = progressElement.getAttribute('data-compte-id');
            var comptetoken = progressElement.getAttribute('data-compte-token');

            var width = startPercentage;
            var interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                    // Afficher le modal de succès
                    $('#successModal').modal('show');

                    // Vérifier si le solde du compte est supérieur à zéro
                    if (accountBalance > 0) {
                        // Soumettre le formulaire de virement automatiquement via AJAX
                        var formData = new FormData(transferForm);
                        fetch(transferForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Transfer completed successfully');
                                    // Afficher un message de succès ou actualiser une partie de la page

                                    // Envoyer une requête AJAX pour mettre à jour le solde du compte à zéro
                                    fetch("{{ url('/compte/update-balance-to-zero') }}/" + compteId, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                console.log('Balance updated to zero');
                                            }
                                        });
                                } else {
                                    console.error('Error in transfer:', data);
                                    // Afficher un message d'erreur
                                }
                            });
                    } else {
                        console.error('Cannot complete transfer: Account balance is zero.');
                        // Afficher un message d'erreur ou une notification
                        alert('Le solde du compte est insuffisant pour effectuer le virement.');
                    }

                } else if (width >= endPercentage) {
                    clearInterval(interval);
                    // Afficher le modal d'échec
                    $('#failureModal').modal('show');

                    // Envoyer l'email d'échec de virement via AJAX
                    fetch("{{ url('/send-failure-email') }}/" + compteId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                compteId: compteId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Failure email sent successfully');
                            } else {
                                console.error('Error in sending failure email:', data.message);
                            }
                        });
                } else {
                    width += 1;
                    progressBar.style.width = width + '%';
                    progressBar.innerHTML = width + '%';
                }
            }, 10); // Ajustez la vitesse de progression en millisecondes

        });
    </script>
@endsection
