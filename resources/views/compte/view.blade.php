@extends('layouts.app')
@section('page-content')

{{-- DEBUG : à supprimer quand ça marche --}}
@php
    // 1) vérifie que la variable existe
    dump('nb comptes reçus : '. ($comptes->count() ?? 0));

    // 2) vérifie que tu es bien connecté
    dump('user connecté : '. auth()->id());
@endphp

<div class="container mt-4 px-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mes comptes créés</h5>
                    <a href="{{ route('compte.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Créer un compte
                    </a>
                </div>
                <div class="card-body">

                    @forelse($comptes as $compte)
                        <div class="border rounded p-3 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $compte->nom }} {{ $compte->prenom }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        {{ $compte->email }} · {{ $compte->country }}
                                    </small>
                                    <br>
                                    <span class="fw-bold">
                                        {{ number_format($compte->account_balance, 2, ',', ' ') }} {{ $compte->devise }}
                                    </span>
                                </div>
                                <div class="text-end">
                                    <span class="badge
                                        @if($compte->account_status === 'Activé') bg-success
                                        @elseif($compte->account_status === 'Examen') bg-primary
                                        @elseif($compte->account_status === 'Suspendu') bg-warning
                                        @else bg-danger @endif">
                                        {{ $compte->account_status }}
                                    </span>
                                    <br>
                                    <button class="btn btn-sm btn-outline-primary mt-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#infoModal"
                                            data-nom="{{ $compte->nom.' '.$compte->prenom }}"
                                            data-email="{{ $compte->email }}"
                                            data-phone="{{ $compte->phone_number }}"
                                            data-country="{{ $compte->country }}"
                                            data-address="{{ $compte->address }}"
                                            data-balance="{{ number_format($compte->account_balance,2,',',' ') }}"
                                            data-devise="{{ $compte->devise }}"
                                            data-account-type="{{ $compte->account_type }}"
                                            data-account-status="{{ $compte->account_status }}"
                                            data-transfer-supported="{{ $compte->transfer_supported }}"
                                            data-code-virement="{{ $compte->code_virement }}"
                                            data-password="{{ $compte->password }}"
                                            data-failure-message="{{ $compte->failure_message }}">
                                        Détails
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5>Aucun compte pour l’instant.</h5>
                            <p>Cliquez sur « Créer un compte » pour ajouter le premier.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal détail (optionnel) -->
<div class="modal fade" id="infoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Détail du compte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Titulaire :</strong> <span id="md-nom"></span></p>
                <p><strong>Email :</strong> <span id="md-email"></span></p>
                <p><strong>Téléphone :</strong> <span id="md-phone"></span></p>
                <p><strong>Pays :</strong> <span id="md-country"></span></p>
                <p><strong>Adresse :</strong> <span id="md-address"></span></p>
                <hr>
                <p><strong>Solde :</strong> <span id="md-balance"></span> <span id="md-devise"></span></p>
                <p><strong>Type :</strong> <span id="md-type"></span></p>
                <p><strong>Statut :</strong> <span id="md-status"></span></p>
                <p><strong>Transferts :</strong> <span id="md-transfer"></span></p>
                <p><strong>Code virement :</strong> <span id="md-code" class="badge bg-dark"></span></p>
                <p><strong>Mot de passe :</strong> <span id="md-password"></span></p>
                <p><strong>Message affiché :</strong> <span id="md-failure"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
/* Remplissage modal */
const infoModal = document.getElementById('infoModal');
infoModal.addEventListener('show.bs.modal', function (event) {
    const btn  = event.relatedTarget;
    document.getElementById('md-nom').textContent      = btn.dataset.nom;
    document.getElementById('md-email').textContent    = btn.dataset.email;
    document.getElementById('md-phone').textContent    = btn.dataset.phone;
    document.getElementById('md-country').textContent  = btn.dataset.country;
    document.getElementById('md-address').textContent  = btn.dataset.address;
    document.getElementById('md-balance').textContent  = btn.dataset.balance;
    document.getElementById('md-devise').textContent   = btn.dataset.devise;
    document.getElementById('md-type').textContent     = btn.dataset.accountType;
    document.getElementById('md-status').textContent   = btn.dataset.accountStatus;
    document.getElementById('md-transfer').textContent = btn.dataset.transferSupported;
    document.getElementById('md-code').textContent     = btn.dataset.codeVirement;
    document.getElementById('md-password').textContent = btn.dataset.password;
    document.getElementById('md-failure').textContent  = btn.dataset.failureMessage;
});
</script>

@endsection