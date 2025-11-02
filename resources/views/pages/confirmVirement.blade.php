<!-- resources/views/transfers/confirm.blade.php -->
@extends('./../layouts.app')

@section('page-content')
<div class="container">
    <h2>Confirmation du Virement</h2>


    <!-- <form action="{{ route('storeVirement') }}" method="post"> -->
    <form action="{{ route('virementDetailRoute2') }}" method="post">
        @csrf
        @method('post')
        <input type="hidden" name="numerocompte" value="{{ $transfer['numerocompte'] }}">
        <input type="hidden" name="name_servieur" value="{{ $transfer['name_servieur'] }}">
        <input type="hidden" name="beneficiary_name" value="{{ $transfer['beneficiary_name'] }}">
        <input type="hidden" name="reason" value="{{ $transfer['reason'] }}">

        <div class="card mt-4">
            <div class="card-body">
                <p><strong>Numéro de Compte :</strong> {{ $transfer['numerocompte'] }}</p>
                <p><strong>Nom du serveur :</strong> {{ $transfer['name_servieur'] }}</p>
                <p><strong>Nom du bénéficiaire :</strong> {{ $transfer['beneficiary_name'] }}</p>
                <p><strong>Motif :</strong> {{ $transfer['reason'] }}</p>
            </div>
        </div>
        <label for="">Code de sécurité </label>
        <input type="text" class="form-control" name="codeVirement" required>

        <button type="submit" class="btn btn-primary mt-4">Confirmer le Virement</button>
    </form>


</div>
@endsection