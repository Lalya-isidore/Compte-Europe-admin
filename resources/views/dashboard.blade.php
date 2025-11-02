@extends('layouts.app')

@section('page-content')
<div class="container mt-4">
    <h1 class="mb-4">Tableau de bord</h1>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Bienvenue sur votre espace
                </div>
                <div class="card-body">
                    <h5 class="card-title">Vous êtes connecté!</h5>
                    <p class="card-text">Que souhaitez-vous faire?</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('compte.create') }}" class="btn btn-primary me-2">
                            <i class="fas fa-plus-circle"></i> Créer un compte
                        </a>
                        <a href="{{ route('compte.view') }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Voir mes comptes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection