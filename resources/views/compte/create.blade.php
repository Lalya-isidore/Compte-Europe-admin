@extends('layouts.app')
@section('page-content')

{{--  MARGE GAUCHE / DROITE  --}}
<div class="container-fluid px-lg-4 px-md-3 px-2 py-4">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $fieldErrorMessages = collect($errors->getMessages())
            ->except('error')
            ->flatMap(function ($messages) {
                return $messages;
            })
            ->filter()
            ->values();
    @endphp

    @if ($fieldErrorMessages->isNotEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Veuillez corriger les champs suivants :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($fieldErrorMessages as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ===== RECHARGER MON COMPTE ===== -->
    <div class="container mt-4 text-center">
        <div class="row mb-3 justify-content-center">
            <button id="paieFormsBtn" class="btn btn-primary col-md-6">Recharger mon compte</button>
        </div>

    <div id="rechargeOptions" class="mt-4 d-none text-center">
            <h6 class="mb-3">Choisissez un montant à recharger</h6>
            <img src="/téléchargement (33).png" alt="Image 2" class="img-fluid" style="max-width: 80px;">
            <img src="/MTN.jpeg" alt="Image 3" class="img-fluid" style="max-width: 68px;">

            <div class="row justify-content-center">
                {{-- 5000 F CFA --}}
                <div class="col-md-6 mb-3">
                    <form action="{{ url('payement5000/' . auth()->user()->id) }}" method="POST">
                        @csrf
                        <div class="btn-amount">
                            <div class="amount">5000 F CFA</div>
                            <div class="credits">+ 6000 Crédits</div>
                        </div>
                        <input type="hidden" name="field" value="test">
                        <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                            data-public-key="pk_live_efQKwcgS1RbiISIOEMt1PjLi"
                            data-button-text="Payer 5000"
                            data-button-class="btn btn-primary"
                            data-customer-firstname="{{ auth()->user()->name }}"
                            data-customer-email="{{ auth()->user()->email }}"
                            data-customer-lastname="{{ auth()->user()->name }}"
                            data-customer-name="{{ auth()->user()->name }}"
                            data-transaction-amount="5000"
                            data-transaction-description="Description de la transaction"
                            data-currency-iso="XOF"></script>
                    </form>
                </div>

                {{-- 10000 F CFA --}}
                <div class="col-md-6 mb-3">
                    <form action="{{ url('payement10000/' . auth()->user()->id) }}" method="POST">
                        @csrf
                        <div class="btn-amount">
                            <div class="amount">10000 F CFA</div>
                            <div class="credits">+ 17000 Crédits</div>
                        </div>
                        <input type="hidden" name="field" value="test">
                        <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                            data-public-key="pk_live_efQKwcgS1RbiISIOEMt1PjLi"
                            data-button-text="Payer 10000"
                            data-button-class="btn btn-primary"
                            data-customer-firstname="{{ auth()->user()->name }}"
                            data-customer-email="{{ auth()->user()->email }}"
                            data-customer-lastname="{{ auth()->user()->name }}"
                            data-customer-name="{{ auth()->user()->name }}"
                            data-transaction-amount="10000"
                            data-transaction-description="Description de la transaction"
                            data-currency-iso="XOF"></script>
                    </form>
                </div>
            </div>

            <div class="row justify-content-center">
                {{-- 25000 F CFA --}}
                <div class="col-md-6 mb-3">
                    <form action="{{ url('payement25000/' . auth()->user()->id) }}" method="POST">
                        @csrf
                        <div class="btn-amount">
                            <div class="amount">25000 F CFA</div>
                            <div class="credits">+ 40000 Crédits</div>
                        </div>
                        <input type="hidden" name="field" value="test">
                        <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                            data-public-key="pk_live_efQKwcgS1RbiISIOEMt1PjLi"
                            data-button-text="Payer 25000"
                            data-button-class="btn btn-primary"
                            data-customer-firstname="{{ auth()->user()->name }}"
                            data-customer-email="{{ auth()->user()->email }}"
                            data-customer-lastname="{{ auth()->user()->name }}"
                            data-customer-name="{{ auth()->user()->name }}"
                            data-transaction-amount="25000"
                            data-transaction-description="Description de la transaction"
                            data-currency-iso="XOF"></script>
                    </form>
                </div>

                {{-- 50000 F CFA --}}
                <div class="col-md-6 mb-3">
                    <form action="{{ url('payement50000/' . auth()->user()->id) }}" method="POST">
                        @csrf
                        <div class="btn-amount">
                            <div class="amount">50000 F CFA</div>
                            <div class="credits">+ 100000 Crédits</div>
                        </div>
                        <input type="hidden" name="field" value="test">
                        <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                            data-public-key="pk_live_efQKwcgS1RbiISIOEMt1PjLi"
                            data-button-text="Payer 50000"
                            data-button-class="btn btn-primary"
                            data-customer-firstname="{{ auth()->user()->name }}"
                            data-customer-email="{{ auth()->user()->email }}"
                            data-customer-lastname="{{ auth()->user()->name }}"
                            data-customer-name="{{ auth()->user()->name }}"
                            data-transaction-amount="50000"
                            data-transaction-description="Description de la transaction"
                            data-currency-iso="XOF"></script>
                    </form>
                </div>
            </div>

            <div class="alert alert-danger d-flex align-items-center mt-3" style="max-width: 500px; margin: auto;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <span>Ne quittez pas la page de paiement Fedapay, les crédits peuvent mettre du temps à apparaître.</span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-12 text-center">
                <h6>Crédit(s) disponible : <span class="available-credits">{{ auth()->user()->credit_user }}</span></h6>
            </div>
        </div>

        <div class="alert alert-info text-center fw-bold">
            <i class="fas fa-info-circle"></i> La création d'un Flash compte coûte 3000 crédit(s).
        </div>
    </div>
    <!-- FIN RECHARGER MON COMPTE -->

    <!-- ===== CRÉER UN COMPTE ===== -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Créer un Flash Compte</h4>

                    <form action="{{ route('compte.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Nom <i style="color:red">*</i></label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label>Prénom <i style="color:red">*</i></label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email <i style="color:red">*</i></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Téléphone <i style="color:red">*</i></label>
                                <input type="text" name="phone_number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Pays <i style="color:red">*</i></label>
                                <select class="form-select" name="country" required="" id="country">
                                <option disabled="" selected="">
                                    Sélectionnez un pays
                                </option>
                                <option value="Afghanistan (+93)" data-tel="+93" data-code="AF">
                                    🇦🇫 Afghanistan (+93)
                                </option>
                                <option value="Afrique du Sud (+27)" data-tel="+27" data-code="ZA">
                                    🇿🇦 Afrique du Sud (+27)
                                </option>
                                <option value="Albanie (+355)" data-tel="+355" data-code="AL">
                                    🇦🇱 Albanie (+355)
                                </option>
                                <option value="Algérie (+213)" data-tel="+213" data-code="DZ">
                                    🇩🇿 Algérie (+213)
                                </option>
                                <option value="Allemagne (+49)" data-tel="+49" data-code="DE">
                                    🇩🇪 Allemagne (+49)
                                </option>
                                <option value="Andorre (+376)" data-tel="+376" data-code="AD">
                                    🇦🇩 Andorre (+376)
                                </option>
                                <option value="Angola (+244)" data-tel="+244" data-code="AO">
                                    🇦🇴 Angola (+244)
                                </option>
                                <option value="Anguilla (+1264)" data-tel="+1264" data-code="AI">
                                    🇦🇮 Anguilla (+1264)
                                </option>
                                <option value="Antarctique (+672)" data-tel="+672" data-code="AQ">
                                    🇦🇶 Antarctique (+672)
                                </option>
                                <option value="Antigua-et-Barbuda (+1268)" data-tel="+1268" data-code="AG">
                                    🇦🇬 Antigua-et-Barbuda (+1268)
                                </option>
                                <option value="Arabie saoudite (+966)" data-tel="+966" data-code="SA">
                                    🇸🇦 Arabie saoudite (+966)
                                </option>
                                <option value="Argentine (+54)" data-tel="+54" data-code="AR">
                                    🇦🇷 Argentine (+54)
                                </option>
                                <option value="Arménie (+374)" data-tel="+374" data-code="AM">
                                    🇦🇲 Arménie (+374)
                                </option>
                                <option value="Aruba (+297)" data-tel="+297" data-code="AW">
                                    🇦🇼 Aruba (+297)
                                </option>
                                <option value="Australie (+61)" data-tel="+61" data-code="AU">
                                    🇦🇺 Australie (+61)
                                </option>
                                <option value="Autriche (+43)" data-tel="+43" data-code="AT">
                                    🇦🇹 Autriche (+43)
                                </option>
                                <option value="Azerbaïdjan (+994)" data-tel="+994" data-code="AZ">
                                    🇦🇿 Azerbaïdjan (+994)
                                </option>
                                <option value="Bahamas (+1242)" data-tel="+1242" data-code="BS">
                                    🇧🇸 Bahamas (+1242)
                                </option>
                                <option value="Bahreïn (+973)" data-tel="+973" data-code="BH">
                                    🇧🇭 Bahreïn (+973)
                                </option>
                                <option value="Bangladesh (+880)" data-tel="+880" data-code="BD">
                                    🇧🇩 Bangladesh (+880)
                                </option>
                                <option value="Barbade (+1246)" data-tel="+1246" data-code="BB">
                                    🇧🇧 Barbade (+1246)
                                </option>
                                <option value="Belgique (+32)" data-tel="+32" data-code="BE">
                                    🇧🇪 Belgique (+32)
                                </option>
                                <option value="Belize (+501)" data-tel="+501" data-code="BZ">
                                    🇧🇿 Belize (+501)
                                </option>
                                <option value="Bermudes (+1441)" data-tel="+1441" data-code="BM">
                                    🇧🇲 Bermudes (+1441)
                                </option>
                                <option value="Bhoutan (+975)" data-tel="+975" data-code="BT">
                                    🇧🇹 Bhoutan (+975)
                                </option>
                                <option value="Bolivie (+591)" data-tel="+591" data-code="BO">
                                    🇧🇴 Bolivie (+591)
                                </option>
                                <option value="Bonaire, Saint Eustache et Saba (+599)" data-tel="+599" data-code="BQ">
                                    🇧🇶 Bonaire, Saint Eustache et Saba (+599)
                                </option>
                                <option value="Bosnie-Herzégovine (+387)" data-tel="+387" data-code="BA">
                                    🇧🇦 Bosnie-Herzégovine (+387)
                                </option>
                                <option value="Botswana (+267)" data-tel="+267" data-code="BW">
                                    🇧🇼 Botswana (+267)
                                </option>
                                <option value="Brunéi Darussalam (+673)" data-tel="+673" data-code="BN">
                                    🇧🇳 Brunéi Darussalam (+673)
                                </option>
                                <option value="Brésil (+55)" data-tel="+55" data-code="BR">
                                    🇧🇷 Brésil (+55)
                                </option>
                                <option value="Bulgarie (+359)" data-tel="+359" data-code="BG">
                                    🇧🇬 Bulgarie (+359)
                                </option>
                                <option value="Burkina Faso (+226)" data-tel="+226" data-code="BF">
                                    🇧🇫 Burkina Faso (+226)
                                </option>
                                <option value="Burundi (+257)" data-tel="+257" data-code="BI">
                                    🇧🇮 Burundi (+257)
                                </option>
                                <option value="Bélarus (+375)" data-tel="+375" data-code="BY">
                                    🇧🇾 Bélarus (+375)
                                </option>
                                <option value="Bénin (+229)" data-tel="+229" data-code="BJ">
                                    🇧🇯 Bénin (+229)
                                </option>
                                <option value="Cambodge (+855)" data-tel="+855" data-code="KH">
                                    🇰🇭 Cambodge (+855)
                                </option>
                                <option value="Cameroun (+237)" data-tel="+237" data-code="CM">
                                    🇨🇲 Cameroun (+237)
                                </option>
                                <option value="Canada (+1)" data-tel="+1" data-code="CA">
                                    🇨🇦 Canada (+1)
                                </option>
                                <option value="Cap-Vert (+238)" data-tel="+238" data-code="CV">
                                    🇨🇻 Cap-Vert (+238)
                                </option>
                                <option value="Chili (+56)" data-tel="+56" data-code="CL">
                                    🇨🇱 Chili (+56)
                                </option>
                                <option value="Chine (+86)" data-tel="+86" data-code="CN">
                                    🇨🇳 Chine (+86)
                                </option>
                                <option value="Chypre (+357)" data-tel="+357" data-code="CY">
                                    🇨🇾 Chypre (+357)
                                </option>
                                <option value="Colombie (+57)" data-tel="+57" data-code="CO">
                                    🇨🇴 Colombie (+57)
                                </option>
                                <option value="Comores (+269)" data-tel="+269" data-code="KM">
                                    🇰🇲 Comores (+269)
                                </option>
                                <option value="Congo-Brazzaville (+242)" data-tel="+242" data-code="CG">
                                    🇨🇬 Congo-Brazzaville (+242)
                                </option>
                                <option value="Corée du Nord (+850)" data-tel="+850" data-code="KP">
                                    🇰🇵 Corée du Nord (+850)
                                </option>
                                <option value="Corée du Sud (+82)" data-tel="+82" data-code="KR">
                                    🇰🇷 Corée du Sud (+82)
                                </option>
                                <option value="Costa Rica (+506)" data-tel="+506" data-code="CR">
                                    🇨🇷 Costa Rica (+506)
                                </option>
                                <option value="Croatie (+385)" data-tel="+385" data-code="HR">
                                    🇭🇷 Croatie (+385)
                                </option>
                                <option value="Cuba (+53)" data-tel="+53" data-code="CU">
                                    🇨🇺 Cuba (+53)
                                </option>
                                <option value="Curacao (+599)" data-tel="+599" data-code="CW">
                                    🇨🇼 Curacao (+599)
                                </option>
                                <option value="Côte d’Ivoire (+225)" data-tel="+225" data-code="CI">
                                    🇨🇮 Côte d’Ivoire (+225)
                                </option>
                                <option value="Danemark (+45)" data-tel="+45" data-code="DK">
                                    🇩🇰 Danemark (+45)
                                </option>
                                <option value="Djibouti (+253)" data-tel="+253" data-code="DJ">
                                    🇩🇯 Djibouti (+253)
                                </option>
                                <option value="Dominique (+1767)" data-tel="+1767" data-code="DM">
                                    🇩🇲 Dominique (+1767)
                                </option>
                                <option value="Égypte (+20)" data-tel="+20" data-code="EG">
                                    🇪🇬 Égypte (+20)
                                </option>
                                <option value="El Salvador (+503)" data-tel="+503" data-code="SV">
                                    🇸🇻 El Salvador (+503)
                                </option>
                                <option value="Émirats arabes unis (+971)" data-tel="+971" data-code="AE">
                                    🇦🇪 Émirats arabes unis (+971)
                                </option>
                                <option value="Équateur (+593)" data-tel="+593" data-code="EC">
                                    🇪🇨 Équateur (+593)
                                </option>
                                <option value="Érythrée (+291)" data-tel="+291" data-code="ER">
                                    🇪🇷 Érythrée (+291)
                                </option>
                                <option value="Espagne (+34)" data-tel="+34" data-code="ES">
                                    🇪🇸 Espagne (+34)
                                </option>
                                <option value="Estonie (+372)" data-tel="+372" data-code="EE">
                                    🇪🇪 Estonie (+372)
                                </option>
                                <option value="État de la Cité du Vatican (+379)" data-tel="+379" data-code="VA">
                                    🇻🇦 État de la Cité du Vatican (+379)
                                </option>
                                <option value="États fédérés de Micronésie (+691)" data-tel="+691" data-code="FM">
                                    🇫🇲 États fédérés de Micronésie (+691)
                                </option>
                                <option value="États-Unis (+1)" data-tel="+1" data-code="US">
                                    🇺🇸 États-Unis (+1)
                                </option>
                                <option value="Éthiopie (+251)" data-tel="+251" data-code="ET">
                                    🇪🇹 Éthiopie (+251)
                                </option>
                                <option value="Fidji (+679)" data-tel="+679" data-code="FJ">
                                    🇫🇯 Fidji (+679)
                                </option>
                                <option value="Finlande (+358)" data-tel="+358" data-code="FI">
                                    🇫🇮 Finlande (+358)
                                </option>
                                <option value="France (+33)" data-tel="+33" data-code="FR" selected="">
                                    🇫🇷 France (+33)
                                </option>
                                <option value="Gabon (+241)" data-tel="+241" data-code="GA">
                                    🇬🇦 Gabon (+241)
                                </option>
                                <option value="Gambie (+220)" data-tel="+220" data-code="GM">
                                    🇬🇲 Gambie (+220)
                                </option>
                                <option value="Ghana (+233)" data-tel="+233" data-code="GH">
                                    🇬🇭 Ghana (+233)
                                </option>
                                <option value="Gibraltar (+350)" data-tel="+350" data-code="GI">
                                    🇬🇮 Gibraltar (+350)
                                </option>
                                <option value="Grenade (+1473)" data-tel="+1473" data-code="GD">
                                    🇬🇩 Grenade (+1473)
                                </option>
                                <option value="Groenland (+299)" data-tel="+299" data-code="GL">
                                    🇬🇱 Groenland (+299)
                                </option>
                                <option value="Grèce (+30)" data-tel="+30" data-code="GR">
                                    🇬🇷 Grèce (+30)
                                </option>
                                <option value="Guadeloupe (+590)" data-tel="+590" data-code="GP">
                                    🇬🇵 Guadeloupe (+590)
                                </option>
                                <option value="Guam (+1671)" data-tel="+1671" data-code="GU">
                                    🇬🇺 Guam (+1671)
                                </option>
                                <option value="Guatemala (+502)" data-tel="+502" data-code="GT">
                                    🇬🇹 Guatemala (+502)
                                </option>
                                <option value="Guernesey (+44)" data-tel="+44" data-code="GG">
                                    🇬🇬 Guernesey (+44)
                                </option>
                                <option value="Guinée (+224)" data-tel="+224" data-code="GN">
                                    🇬🇳 Guinée (+224)
                                </option>
                                <option value="Guinée équatoriale (+240)" data-tel="+240" data-code="GQ">
                                    🇬🇶 Guinée équatoriale (+240)
                                </option>
                                <option value="Guinée-Bissau (+245)" data-tel="+245" data-code="GW">
                                    🇬🇼 Guinée-Bissau (+245)
                                </option>
                                <option value="Guyana (+592)" data-tel="+592" data-code="GY">
                                    🇬🇾 Guyana (+592)
                                </option>
                                <option value="Guyane française (+594)" data-tel="+594" data-code="GF">
                                    🇬🇫 Guyane française (+594)
                                </option>
                                <option value="Géorgie (+995)" data-tel="+995" data-code="GE">
                                    🇬🇪 Géorgie (+995)
                                </option>
                                <option value="Géorgie du Sud et les îles Sandwich du Sud (+500)" data-tel="+500"
                                    data-code="GS">
                                    🇬🇸 Géorgie du Sud et les îles Sandwich du Sud (+500)
                                </option>
                                <option value="Haïti (+509)" data-tel="+509" data-code="HT">
                                    🇭🇹 Haïti (+509)
                                </option>
                                <option value="Honduras (+504)" data-tel="+504" data-code="HN">
                                    🇭🇳 Honduras (+504)
                                </option>
                                <option value="Hongrie (+36)" data-tel="+36" data-code="HU">
                                    🇭🇺 Hongrie (+36)
                                </option>
                                <option value="Île Bouvet (+47)" data-tel="+47" data-code="BV">
                                    🇧🇻 Île Bouvet (+47)
                                </option>
                                <option value="Île Christmas (+61)" data-tel="+61" data-code="CX">
                                    🇨🇽 Île Christmas (+61)
                                </option>
                                <option value="Île Norfolk (+672)" data-tel="+672" data-code="NF">
                                    🇳🇫 Île Norfolk (+672)
                                </option>
                                <option value="Île de Man (+44)" data-tel="+44" data-code="IM">
                                    🇮🇲 Île de Man (+44)
                                </option>
                                <option value="Îles Caïmans (+1345)" data-tel="+1345" data-code="KY">
                                    🇰🇾 Îles Caïmans (+1345)
                                </option>
                                <option value="Îles Cocos - Keeling (+61)" data-tel="+61" data-code="CC">
                                    🇨🇨 Îles Cocos - Keeling (+61)
                                </option>
                                <option value="Îles Cook (+682)" data-tel="+682" data-code="CK">
                                    🇨🇰 Îles Cook (+682)
                                </option>
                                <option value="Îles Féroé (+298)" data-tel="+298" data-code="FO">
                                    🇫🇴 Îles Féroé (+298)
                                </option>
                                <option value="Îles Heard et MacDonald (+577)" data-tel="+577" data-code="HM">
                                    🇭🇲 Îles Heard et MacDonald (+577)
                                </option>
                                <option value="Îles Malouines (+500)" data-tel="+500" data-code="FK">
                                    🇫🇰 Îles Malouines (+500)
                                </option>
                                <option value="Îles Mariannes du Nord (+1670)" data-tel="+1670" data-code="MP">
                                    🇲🇵 Îles Mariannes du Nord (+1670)
                                </option>
                                <option value="Îles Marshall (+692)" data-tel="+692" data-code="MH">
                                    🇲🇭 Îles Marshall (+692)
                                </option>
                                <option value="Îles Mineures Éloignées des États-Unis (+1)" data-tel="+1"
                                    data-code="UM">
                                    🇺🇲 Îles Mineures Éloignées des États-Unis (+1)
                                </option>
                                <option value="Îles Salomon (+677)" data-tel="+677" data-code="SB">
                                    🇸🇧 Îles Salomon (+677)
                                </option>
                                <option value="Îles Turks et Caïques (+1649)" data-tel="+1649" data-code="TC">
                                    🇹🇨 Îles Turks et Caïques (+1649)
                                </option>
                                <option value="Îles Vierges britanniques (+1284)" data-tel="+1284" data-code="VG">
                                    🇻🇬 Îles Vierges britanniques (+1284)
                                </option>
                                <option value="Îles Vierges des États-Unis (+1340)" data-tel="+1340" data-code="VI">
                                    🇻🇮 Îles Vierges des États-Unis (+1340)
                                </option>
                                <option value="Îles Åland (+358)" data-tel="+358" data-code="AX">
                                    🇦🇽 Îles Åland (+358)
                                </option>
                                <option value="Inde (+91)" data-tel="+91" data-code="IN">
                                    🇮🇳 Inde (+91)
                                </option>
                                <option value="Indonésie (+62)" data-tel="+62" data-code="ID">
                                    🇮🇩 Indonésie (+62)
                                </option>
                                <option value="Irak (+964)" data-tel="+964" data-code="IQ">
                                    🇮🇶 Irak (+964)
                                </option>
                                <option value="Iran (+98)" data-tel="+98" data-code="IR">
                                    🇮🇷 Iran (+98)
                                </option>
                                <option value="Irlande (+353)" data-tel="+353" data-code="IE">
                                    🇮🇪 Irlande (+353)
                                </option>
                                <option value="Islande (+354)" data-tel="+354" data-code="IS">
                                    🇮🇸 Islande (+354)
                                </option>
                                <option value="Israël (+972)" data-tel="+972" data-code="IL">
                                    🇮🇱 Israël (+972)
                                </option>
                                <option value="Italie (+39)" data-tel="+39" data-code="IT">
                                    🇮🇹 Italie (+39)
                                </option>
                                <option value="Jamaïque (+1876)" data-tel="+1876" data-code="JM">
                                    🇯🇲 Jamaïque (+1876)
                                </option>
                                <option value="Japon (+81)" data-tel="+81" data-code="JP">
                                    🇯🇵 Japon (+81)
                                </option>
                                <option value="Jersey (+44)" data-tel="+44" data-code="JE">
                                    🇯🇪 Jersey (+44)
                                </option>
                                <option value="Jordanie (+962)" data-tel="+962" data-code="JO">
                                    🇯🇴 Jordanie (+962)
                                </option>
                                <option value="Kazakhstan (+7)" data-tel="+7" data-code="KZ">
                                    🇰🇿 Kazakhstan (+7)
                                </option>
                                <option value="Kenya (+254)" data-tel="+254" data-code="KE">
                                    🇰🇪 Kenya (+254)
                                </option>
                                <option value="Kirghizistan (+996)" data-tel="+996" data-code="KG">
                                    🇰🇬 Kirghizistan (+996)
                                </option>
                                <option value="Kiribati (+686)" data-tel="+686" data-code="KI">
                                    🇰🇮 Kiribati (+686)
                                </option>
                                <option value="Kosovo (+383)" data-tel="+383" data-code="XK">
                                    🇽🇰 Kosovo (+383)
                                </option>
                                <option value="Koweït (+965)" data-tel="+965" data-code="KW">
                                    🇰🇼 Koweït (+965)
                                </option>
                                <option value="Laos (+856)" data-tel="+856" data-code="LA">
                                    🇱🇦 Laos (+856)
                                </option>
                                <option value="Lesotho (+266)" data-tel="+266" data-code="LS">
                                    🇱🇸 Lesotho (+266)
                                </option>
                                <option value="Lettonie (+371)" data-tel="+371" data-code="LV">
                                    🇱🇻 Lettonie (+371)
                                </option>
                                <option value="Liban (+961)" data-tel="+961" data-code="LB">
                                    🇱🇧 Liban (+961)
                                </option>
                                <option value="Libye (+218)" data-tel="+218" data-code="LY">
                                    🇱🇾 Libye (+218)
                                </option>
                                <option value="Libéria (+231)" data-tel="+231" data-code="LR">
                                    🇱🇷 Libéria (+231)
                                </option>
                                <option value="Liechtenstein (+423)" data-tel="+423" data-code="LI">
                                    🇱🇮 Liechtenstein (+423)
                                </option>
                                <option value="Lituanie (+370)" data-tel="+370" data-code="LT">
                                    🇱🇹 Lituanie (+370)
                                </option>
                                <option value="Luxembourg (+352)" data-tel="+352" data-code="LU">
                                    🇱🇺 Luxembourg (+352)
                                </option>
                                <option value="Macédoine (+389)" data-tel="+389" data-code="MK">
                                    🇲🇰 Macédoine (+389)
                                </option>
                                <option value="Madagascar (+261)" data-tel="+261" data-code="MG">
                                    🇲🇬 Madagascar (+261)
                                </option>
                                <option value="Malaisie (+60)" data-tel="+60" data-code="MY">
                                    🇲🇾 Malaisie (+60)
                                </option>
                                <option value="Malawi (+265)" data-tel="+265" data-code="MW">
                                    🇲🇼 Malawi (+265)
                                </option>
                                <option value="Maldives (+960)" data-tel="+960" data-code="MV">
                                    🇲🇻 Maldives (+960)
                                </option>
                                <option value="Mali (+223)" data-tel="+223" data-code="ML">
                                    🇲🇱 Mali (+223)
                                </option>
                                <option value="Malte (+356)" data-tel="+356" data-code="MT">
                                    🇲🇹 Malte (+356)
                                </option>
                                <option value="Maroc (+212)" data-tel="+212" data-code="MA">
                                    🇲🇦 Maroc (+212)
                                </option>
                                <option value="Martinique (+596)" data-tel="+596" data-code="MQ">
                                    🇲🇶 Martinique (+596)
                                </option>
                                <option value="Maurice (+230)" data-tel="+230" data-code="MU">
                                    🇲🇺 Maurice (+230)
                                </option>
                                <option value="Mauritanie (+222)" data-tel="+222" data-code="MR">
                                    🇲🇷 Mauritanie (+222)
                                </option>
                                <option value="Mayotte (+262)" data-tel="+262" data-code="YT">
                                    🇾🇹 Mayotte (+262)
                                </option>
                                <option value="Mexique (+52)" data-tel="+52" data-code="MX">
                                    🇲🇽 Mexique (+52)
                                </option>
                                <option value="Moldavie (+373)" data-tel="+373" data-code="MD">
                                    🇲🇩 Moldavie (+373)
                                </option>
                                <option value="Monaco (+377)" data-tel="+377" data-code="MC">
                                    🇲🇨 Monaco (+377)
                                </option>
                                <option value="Mongolie (+976)" data-tel="+976" data-code="MN">
                                    🇲🇳 Mongolie (+976)
                                </option>
                                <option value="Montserrat (+354)" data-tel="+354" data-code="MS">
                                    🇲🇸 Montserrat (+354)
                                </option>
                                <option value="Monténégro (+382)" data-tel="+382" data-code="ME">
                                    🇲🇪 Monténégro (+382)
                                </option>
                                <option value="Mozambique (+258)" data-tel="+258" data-code="MZ">
                                    🇲🇿 Mozambique (+258)
                                </option>
                                <option value="Myanmar (+95)" data-tel="+95" data-code="MM">
                                    🇲🇲 Myanmar (+95)
                                </option>
                                <option value="Namibie (+264)" data-tel="+264" data-code="NA">
                                    🇳🇦 Namibie (+264)
                                </option>
                                <option value="Nauru (+674)" data-tel="+674" data-code="NR">
                                    🇳🇷 Nauru (+674)
                                </option>
                                <option value="Nicaragua (+505)" data-tel="+505" data-code="NI">
                                    🇳🇮 Nicaragua (+505)
                                </option>
                                <option value="Niger (+227)" data-tel="+227" data-code="NE">
                                    🇳🇪 Niger (+227)
                                </option>
                                <option value="Nigéria (+234)" data-tel="+234" data-code="NG">
                                    🇳🇬 Nigéria (+234)
                                </option>
                                <option value="Niue (+683)" data-tel="+683" data-code="NU">
                                    🇳🇺 Niue (+683)
                                </option>
                                <option value="Norvège (+47)" data-tel="+47" data-code="NO">
                                    🇳🇴 Norvège (+47)
                                </option>
                                <option value="Nouvelle-Calédonie (+687)" data-tel="+687" data-code="NC">
                                    🇳🇨 Nouvelle-Calédonie (+687)
                                </option>
                                <option value="Nouvelle-Zélande (+64)" data-tel="+64" data-code="NZ">
                                    🇳🇿 Nouvelle-Zélande (+64)
                                </option>
                                <option value="Népal (+977)" data-tel="+977" data-code="NP">
                                    🇳🇵 Népal (+977)
                                </option>
                                <option value="Oman (+968)" data-tel="+968" data-code="OM">
                                    🇴🇲 Oman (+968)
                                </option>
                                <option value="Ouganda (+256)" data-tel="+256" data-code="UG">
                                    🇺🇬 Ouganda (+256)
                                </option>
                                <option value="Ouzbékistan (+998)" data-tel="+998" data-code="UZ">
                                    🇺🇿 Ouzbékistan (+998)
                                </option>
                                <option value="Pakistan (+92)" data-tel="+92" data-code="PK">
                                    🇵🇰 Pakistan (+92)
                                </option>
                                <option value="Palaos (+680)" data-tel="+680" data-code="PW">
                                    🇵🇼 Palaos (+680)
                                </option>
                                <option value="Panama (+507)" data-tel="+507" data-code="PA">
                                    🇵🇦 Panama (+507)
                                </option>
                                <option value="Papouasie-Nouvelle-Guinée (+675)" data-tel="+675" data-code="PG">
                                    🇵🇬 Papouasie-Nouvelle-Guinée (+675)
                                </option>
                                <option value="Paraguay (+595)" data-tel="+595" data-code="PY">
                                    🇵🇾 Paraguay (+595)
                                </option>
                                <option value="Pays-Bas (+31)" data-tel="+31" data-code="NL">
                                    🇳🇱 Pays-Bas (+31)
                                </option>
                                <option value="Philippines (+63)" data-tel="+63" data-code="PH">
                                    🇵🇭 Philippines (+63)
                                </option>
                                <option value="Pitcairn (+672)" data-tel="+672" data-code="PN">
                                    🇵🇳 Pitcairn (+672)
                                </option>
                                <option value="Pologne (+48)" data-tel="+48" data-code="PL">
                                    🇵🇱 Pologne (+48)
                                </option>
                                <option value="Polynésie française (+689)" data-tel="+689" data-code="PF">
                                    🇵🇫 Polynésie française (+689)
                                </option>
                                <option value="Porto Rico (+1)" data-tel="+1" data-code="PR">
                                    🇵🇷 Porto Rico (+1)
                                </option>
                                <option value="Portugal (+351)" data-tel="+351" data-code="PT">
                                    🇵🇹 Portugal (+351)
                                </option>
                                <option value="Pérou (+51)" data-tel="+51" data-code="PE">
                                    🇵🇪 Pérou (+51)
                                </option>
                                <option value="Qatar (+974)" data-tel="+974" data-code="QA">
                                    🇶🇦 Qatar (+974)
                                </option>
                                <option value="R.A.S. chinoise de Hong Kong (+852)" data-tel="+852" data-code="HK">
                                    🇭🇰 R.A.S. chinoise de Hong Kong (+852)
                                </option>
                                <option value="R.A.S. chinoise de Macao (+853)" data-tel="+853" data-code="MO">
                                    🇲🇴 R.A.S. chinoise de Macao (+853)
                                </option>
                                <option value="Roumanie (+40)" data-tel="+40" data-code="RO">
                                    🇷🇴 Roumanie (+40)
                                </option>
                                <option value="Royaume-Uni (+44)" data-tel="+44" data-code="GB">
                                    🇬🇧 Royaume-Uni (+44)
                                </option>
                                <option value="Russie (+7)" data-tel="+7" data-code="RU">
                                    🇷🇺 Russie (+7)
                                </option>
                                <option value="Rwanda (+250)" data-tel="+250" data-code="RW">
                                    🇷🇼 Rwanda (+250)
                                </option>
                                <option value="République centrafricaine (+236)" data-tel="+236" data-code="CF">
                                    🇨🇫 République centrafricaine (+236)
                                </option>
                                <option value="République dominicaine (+1)" data-tel="+1" data-code="DO">
                                    🇩🇴 République dominicaine (+1)
                                </option>
                                <option value="République démocratique du Congo (+243)" data-tel="+243" data-code="CD">
                                    🇨🇩 République démocratique du Congo (+243)
                                </option>
                                <option value="République tchèque (+420)" data-tel="+420" data-code="CZ">
                                    🇨🇿 République tchèque (+420)
                                </option>
                                <option value="Réunion (+262)" data-tel="+262" data-code="RE">
                                    🇷🇪 Réunion (+262)
                                </option>
                                <option value="Sahara occidental (+212)" data-tel="+212" data-code="EH">
                                    🇪🇭 Sahara occidental (+212)
                                </option>
                                <option value="Saint-Barthélémy (+590)" data-tel="+590" data-code="BL">
                                    🇧🇱 Saint-Barthélémy (+590)
                                </option>
                                <option value="Saint-Kitts-et-Nevis (+1869)" data-tel="+1869" data-code="KN">
                                    🇰🇳 Saint-Kitts-et-Nevis (+1869)
                                </option>
                                <option value="Saint-Marin (+378)" data-tel="+378" data-code="SM">
                                    🇸🇲 Saint-Marin (+378)
                                </option>
                                <option value="Saint-Martin (+590)" data-tel="+590" data-code="MF">
                                    🇲🇫 Saint-Martin (+590)
                                </option>
                                <option value="Saint-Martin (+1721)" data-tel="+1721" data-code="SX">
                                    🇸🇽 Saint-Martin (+1721)
                                </option>
                                <option value="Saint-Pierre-et-Miquelon (+508)" data-tel="+508" data-code="PM">
                                    🇵🇲 Saint-Pierre-et-Miquelon (+508)
                                </option>
                                <option value="Saint-Vincent-et-les Grenadines (+1784)" data-tel="+1784" data-code="VC">
                                    🇻🇨 Saint-Vincent-et-les Grenadines (+1784)
                                </option>
                                <option value="Sainte-Hélène (+290)" data-tel="+290" data-code="SH">
                                    🇸🇭 Sainte-Hélène (+290)
                                </option>
                                <option value="Sainte-Lucie (+358)" data-tel="+358" data-code="LC">
                                    🇱🇨 Sainte-Lucie (+358)
                                </option>
                                <option value="Samoa (+685)" data-tel="+685" data-code="WS">
                                    🇼🇸 Samoa (+685)
                                </option>
                                <option value="Samoa américaines (+1684)" data-tel="+1684" data-code="AS">
                                    🇦🇸 Samoa américaines (+1684)
                                </option>
                                <option value="Sao Tomé-et-Principe (+239)" data-tel="+239" data-code="ST">
                                    🇸🇹 Sao Tomé-et-Principe (+239)
                                </option>
                                <option value="Serbie (+381)" data-tel="+381" data-code="RS">
                                    🇷🇸 Serbie (+381)
                                </option>
                                <option value="Seychelles (+248)" data-tel="+248" data-code="SC">
                                    🇸🇨 Seychelles (+248)
                                </option>
                                <option value="Sierra Leone (+232)" data-tel="+232" data-code="SL">
                                    🇸🇱 Sierra Leone (+232)
                                </option>
                                <option value="Singapour (+65)" data-tel="+65" data-code="SG">
                                    🇸🇬 Singapour (+65)
                                </option>
                                <option value="Slovaquie (+421)" data-tel="+421" data-code="SK">
                                    🇸🇰 Slovaquie (+421)
                                </option>
                                <option value="Slovénie (+386)" data-tel="+386" data-code="SI">
                                    🇸🇮 Slovénie (+386)
                                </option>
                                <option value="Somalie (+252)" data-tel="+252" data-code="SO">
                                    🇸🇴 Somalie (+252)
                                </option>
                                <option value="Soudan (+249)" data-tel="+249" data-code="SD">
                                    🇸🇩 Soudan (+249)
                                </option>
                                <option value="Soudan du sud (+211)" data-tel="+211" data-code="SS">
                                    🇸🇸 Soudan du sud (+211)
                                </option>
                                <option value="Sri Lanka (+94)" data-tel="+94" data-code="LK">
                                    🇱🇰 Sri Lanka (+94)
                                </option>
                                <option value="Suisse (+41)" data-tel="+41" data-code="CH">
                                    🇨🇭 Suisse (+41)
                                </option>
                                <option value="Suriname (+597)" data-tel="+597" data-code="SR">
                                    🇸🇷 Suriname (+597)
                                </option>
                                <option value="Suède (+46)" data-tel="+46" data-code="SE">
                                    🇸🇪 Suède (+46)
                                </option>
                                <option value="Svalbard et Île Jan Mayen (+47)" data-tel="+47" data-code="SJ">
                                    🇸🇯 Svalbard et Île Jan Mayen (+47)
                                </option>
                                <option value="Swaziland (+268)" data-tel="+268" data-code="SZ">
                                    🇸🇿 Swaziland (+268)
                                </option>
                                <option value="Syrie (+963)" data-tel="+963" data-code="SY">
                                    🇸🇾 Syrie (+963)
                                </option>
                                <option value="Sénégal (+221)" data-tel="+221" data-code="SN">
                                    🇸🇳 Sénégal (+221)
                                </option>
                                <option value="Tadjikistan (+992)" data-tel="+992" data-code="TJ">
                                    🇹🇯 Tadjikistan (+992)
                                </option>
                                <option value="Tanzanie (+255)" data-tel="+255" data-code="TZ">
                                    🇹🇿 Tanzanie (+255)
                                </option>
                                <option value="Taïwan (+886)" data-tel="+886" data-code="TW">
                                    🇹🇼 Taïwan (+886)
                                </option>
                                <option value="Tchad (+235)" data-tel="+235" data-code="TD">
                                    🇹🇩 Tchad (+235)
                                </option>
                                <option value="Terres australes françaises (+262)" data-tel="+262" data-code="TF">
                                    🇹🇫 Terres australes françaises (+262)
                                </option>
                                <option value="Territoire britannique de l'océan Indien (+246)" data-tel="+246"
                                    data-code="IO">
                                    🇮🇴 Territoire britannique de l'océan Indien (+246)
                                </option>
                                <option value="Territoire palestinien (+970)" data-tel="+970" data-code="PS">
                                    🇵🇸 Territoire palestinien (+970)
                                </option>
                                <option value="Thaïlande (+66)" data-tel="+66" data-code="TH">
                                    🇹🇭 Thaïlande (+66)
                                </option>
                                <option value="Timor oriental (+670)" data-tel="+670" data-code="TL">
                                    🇹🇱 Timor oriental (+670)
                                </option>
                                <option value="Togo (+228)" data-tel="+228" data-code="TG">
                                    🇹🇬 Togo (+228)
                                </option>
                                <option value="Tokelau (+690)" data-tel="+690" data-code="TK">
                                    🇹🇰 Tokelau (+690)
                                </option>
                                <option value="Tonga (+676)" data-tel="+676" data-code="TO">
                                    🇹🇴 Tonga (+676)
                                </option>
                                <option value="Trinité-et-Tobago (+1868)" data-tel="+1868" data-code="TT">
                                    🇹🇹 Trinité-et-Tobago (+1868)
                                </option>
                                <option value="Tunisie (+216)" data-tel="+216" data-code="TN">
                                    🇹🇳 Tunisie (+216)
                                </option>
                                <option value="Turkménistan (+993)" data-tel="+993" data-code="TM">
                                    🇹🇲 Turkménistan (+993)
                                </option>
                                <option value="Turquie (+90)" data-tel="+90" data-code="TR">
                                    🇹🇷 Turquie (+90)
                                </option>
                                <option value="Tuvalu (+688)" data-tel="+688" data-code="TV">
                                    🇹🇻 Tuvalu (+688)
                                </option>
                                <option value="Ukraine (+380)" data-tel="+380" data-code="UA">
                                    🇺🇦 Ukraine (+380)
                                </option>
                                <option value="Uruguay (+598)" data-tel="+598" data-code="UY">
                                    🇺🇾 Uruguay (+598)
                                </option>
                                <option value="Vanuatu (+678)" data-tel="+678" data-code="VU">
                                    🇻🇺 Vanuatu (+678)
                                </option>
                                <option value="Venezuela (+58)" data-tel="+58" data-code="VE">
                                    🇻🇪 Venezuela (+58)
                                </option>
                                <option value="Viêt Nam (+84)" data-tel="+84" data-code="VN">
                                    🇻🇳 Viêt Nam (+84)
                                </option>
                                <option value="Wallis-et-Futuna (+681)" data-tel="+681" data-code="WF">
                                    🇼🇫 Wallis-et-Futuna (+681)
                                </option>
                                <option value="Yémen (+967)" data-tel="+967" data-code="YE">
                                    🇾🇪 Yémen (+967)
                                </option>
                                <option value="Zambie (+260)" data-tel="+260" data-code="ZM">
                                    🇿🇲 Zambie (+260)
                                </option>
                                <option value="Zimbabwe (+263)" data-tel="+263" data-code="ZW">
                                    🇿🇼 Zimbabwe (+263)
                                </option>
                            </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Adresse <i style="color:red">*</i></label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Devise <i style="color:red">*</i></label>
                                <select name="devise" id="devise" class="form-select" required="">
                                <option value="" disabled="" selected="">Devise disponible...</option>
                                <optgroup label="Europe">
                                    <option value="€">Euro (EUR)</option>
                                    <option value="£">Livre sterling (GBP)</option>
                                    <option value="CHF">Franc suisse (CHF)</option>
                                    <option value="NIO">Cordaba (NIO)</option>
                                    <option value="kr">Couronne norvégienne (NOK)</option>
                                    <option value="kr">Couronne suédoise (SEK)</option>
                                    <option value="krD">Couronne danoise (DKK)</option>
                                    <option value="zł">Złoty polonais (PLN)</option>
                                    <option value="Kč">Couronne tchèque (CZK)</option>
                                    <option value="Ft">Forint hongrois (HUF)</option>
                                    <option value="XPF">Franc Pacifique (XPF)</option>
                                    <option value="RON">Leu roumain (RON)</option>
                                    <option value="лв">Lev bulgare (BGN)</option>
                                    <option value="kn">Kuna croate (HRK)</option>
                                    <option value="дин">Dinar serbe (RSD)</option>
                                    <option value="£">Livre sterling de Jersey (JEP)</option>
                                    <option value="MDL">Leu moldave (MDL)</option>
                                    <option value="ден">Denier macédonien (MKD)</option>
                                    <option value="MK">Mark convertible de Bosnie-Herzégovine (MK)</option>
                                </optgroup>
                                <optgroup label="Asie">
                                    <option value="¥">Yen japonais (JPY)</option>
                                    <option value="￥">Yuan chinois (CNY)</option>
                                    <option value="₩">Won sud-coréen (KRW)</option>
                                    <option value="₹">Roupie indienne (INR)</option>
                                    <option value="Rp">Rupiah indonésienne (IDR)</option>
                                    <option value="RM">Ringgit malaisien (MYR)</option>
                                    <option value="₮">Tugrik Mongol (MNT)</option>
                                    <option value="₱">Peso philippin (PHP)</option>
                                    <option value="S$">Dollar de Singapour (SGD)</option>
                                    <option value="HKD">Dollar de Hong Kong (HKD)</option>
                                    <option value="AED">Dirham arabes (AED)</option>
                                    <option value="฿">Baht thaïlandais (THB)</option>
                                    <option value="₪">Shekel israélien (ILS)</option>
                                    <option value="JOD">Dinar jordanien (JOD)</option>
                                    <option value="KGS">Som (KGS)</option>
                                    <option value="KHR">Riel cambodgien (KHR)</option>
                                    <option value="KWD">Dinar koweïtien (KWD)</option>
                                    <option value="Ks">Kyat (MMK)</option>
                                    <option value="P">Pataca de Macao (MOP)</option>
                                    <option value="MVR">Rufiyaa maldivien (MVR)</option>
                                    <option value="Rs">Roupie népalais (NPR)</option>
                                    <option value="OMR">Rial omani (OMR)</option>
                                    <option value="QAR">Rial qatarien (QAR)</option>
                                    <option value="₽">Rouble russe (RUB)</option>
                                    <option value="SAR">Rial saoudien (SAR)</option>
                                    <option value="£S">Livre syrien (SYP)</option>
                                    <option value="ЅМ">Somoni (TJS)</option>
                                    <option value="₺">Livre turque (TRY)</option>
                                    <option value="YER">Rial yéménite (YER)</option>
                                </optgroup>
                                <optgroup label="Amérique du Nord">
                                    <option value="₡">Colón costaricien (CRC)</option>
                                    <option value="$">Dollar américain (USD)</option>
                                    <option value="$ CA">Dollar canadien (CAD)</option>
                                    <option value="RD$"> Peso dominicain (DOP)</option>
                                    <option value="$MXN">Peso mexicain (MXN)</option>
                                    <option value="C$">Oro de cordoue (NIO)</option>
                                    <option value="฿">Balboa panaméen (PAB)</option>
                                    <option value="Qtz">Quetzal (Qtz)</option>
                                </optgroup>
                                <optgroup label="Amérique du Sud">
                                    <option value="R$">Réai brésilien (BRL)</option>
                                    <option value="$">Peso argentin (ARS)</option>
                                    <option value="Bs">Peso boliviano (BOB)</option>
                                    <option value="$">Peso chilien (CLP)</option>
                                    <option value="COL$">Peso colombien (COP)</option>
                                    <option value="S/">Sol péruvien (PEN)</option>
                                    <option value="$U">Peso uruguayen (UYU)</option>
                                    <option value="₲">Guaraní (PYG)</option>
                                </optgroup>
                                <optgroup label="Afrique">
                                    <option value="R">Rand sud-africain (ZAR)</option>
                                    <option value="E£">Livre égyptienne (EGP)</option>
                                    <option value="DA">Dinar algérien (DZD)</option>
                                    <option value="DT">Dinar tunisien (TND)</option>
                                    <option value="DH">Dirham marocain (MAD)</option>
                                    <option value="₦">Nigerian naira (NGN)</option>
                                    <option value="Rs">Roupie mauricienne (MUR)</option>
                                    <option value="KSh">Shilling kényan (KES)</option>
                                    <option value="₵">Cedi ghanéen (GHS)</option>
                                    <option value="XOF">Franc CFA (XOF)</option>
                                    <option value="XAF">Franc CFA (XAF)</option>
                                    <option value="FC">Franc comorien (KMF)</option>
                                    <option value="Ar">Ariary malgache (MGA)</option>
                                    <option value="UM">Ouguiya mauritanien (MRO)</option>
                                    <option value="MK">Kwacha malawite (MWK)</option>
                                    <option value="FRw">Franc rwandais (RWF)</option>
                                </optgroup>
                                <optgroup label="Océanie">
                                    <option value="AU$">Dollar australien (AUD)</option>
                                    <option value="FJ$">Dollar fidjien (FJD)</option>
                                    <option value="$NZ">Dollar néo-zélandais (NZD)</option>
                                    <option value="K">Kina (PGK)</option>
                                </optgroup>
                            </select>
                            </div>
                            <div class="col-md-6">
                                <label>Langue <i style="color:red">*</i></label>
                                <select name="lang" class="form-select" required>
                                    <option disabled selected>Langue</option>
                                    <option value="af">Afrikaans</option>
                            <option value="sq">Albanais</option>
                            <option value="de">Allemand</option>
                            <option value="am">Amharique</option>
                            <option value="en">Anglais</option>
                            <option value="ar">Arabe</option>
                            <option value="hy">Arménien</option>
                            <option value="az">Azéri</option>
                            <option value="eu">Basque</option>
                            <option value="bn">Bengali</option>
                            <option value="be">Biélorusse</option>
                            <option value="my">Birman</option>
                            <option value="bs">Bosniaque</option>
                            <option value="bg">Bulgare</option>
                            <option value="ca">Catalan</option>
                            <option value="ceb">Cebuano</option>
                            <option value="ny">Chichewa</option>
                            <option value="zh-CN">Chinois (simplifié)</option>
                            <option value="zh-TW">Chinois (traditionnel)</option>
                            <option value="si">Cingalais</option>
                            <option value="ko">Coréen</option>
                            <option value="co">Corse</option>
                            <option value="ht">Créole haïtien</option>
                            <option value="hr">Croate</option>
                            <option value="da">Danois</option>
                            <option value="es">Espagnol</option>
                            <option value="eo">Espéranto</option>
                            <option value="et">Estonien</option>
                            <option value="fr">Français</option>
                            <option value="fi">Finnois</option>
                            <option value="fy">Frison</option>
                            <option value="gd">Gaélique (Écosse)</option>
                            <option value="gl">Galicien</option>
                            <option value="cy">Gallois</option>
                            <option value="ka">Géorgien</option>
                            <option value="el">Grec</option>
                            <option value="gu">Gujarati</option>
                            <option value="ha">Haoussa</option>
                            <option value="haw">Hawaïen</option>
                            <option value="iw">Hébreu</option>
                            <option value="hi">Hindi</option>
                            <option value="hmn">Hmong</option>
                            <option value="hu">Hongrois</option>
                            <option value="ig">Igbo</option>
                            <option value="id">Indonésien</option>
                            <option value="ga">Irlandais</option>
                            <option value="is">Islandais</option>
                            <option value="it">Italien</option>
                            <option value="ja">Japonais</option>
                            <option value="jw">Javanais</option>
                            <option value="kn">Kannada</option>
                            <option value="kk">Kazakh</option>
                            <option value="km">Khmer</option>
                            <option value="rw">Kinyarwanda</option>
                            <option value="ky">Kirghiz</option>
                            <option value="ku">Kurde</option>
                            <option value="lo">Laotien</option>
                            <option value="la">Latin</option>
                            <option value="lv">Letton</option>
                            <option value="lt">Lituanien</option>
                            <option value="lb">Luxembourgeois</option>
                            <option value="mk">Macédonien</option>
                            <option value="ms">Malaisien</option>
                            <option value="ml">Malayalam</option>
                            <option value="mg">Malgache</option>
                            <option value="mt">Maltais</option>
                            <option value="mi">Maori</option>
                            <option value="mr">Marathi</option>
                            <option value="mn">Mongol</option>
                            <option value="nl">Néerlandais</option>
                            <option value="ne">Népalais</option>
                            <option value="no">Norvégien</option>
                            <option value="or">Odia (oriya)</option>
                            <option value="ug">Ouïgour</option>
                            <option value="uz">Ouzbek</option>
                            <option value="ps">Pachtô</option>
                            <option value="pa">Panjabi</option>
                            <option value="fa">Persan</option>
                            <option value="tl">Philippin</option>
                            <option value="pl">Polonais</option>
                            <option value="pt">Portugais</option>
                            <option value="ro">Roumain</option>
                            <option value="ru">Russe</option>
                            <option value="sm">Samoan</option>
                            <option value="sr">Serbe</option>
                            <option value="st">Sesotho</option>
                            <option value="sn">Shona</option>
                            <option value="sd">Sindhî</option>
                            <option value="sk">Slovaque</option>
                            <option value="sl">Slovène</option>
                            <option value="so">Somali</option>
                            <option value="su">Soundanais</option>
                            <option value="sv">Suédois</option>
                            <option value="sw">Swahili</option>
                            <option value="tg">Tadjik</option>
                            <option value="ta">Tamoul</option>
                            <option value="tt">Tatar</option>
                            <option value="cs">Tchèque</option>
                            <option value="te">Telugu</option>
                            <option value="th">Thaï</option>
                            <option value="tr">Turc</option>
                            <option value="tk">Turkmène</option>
                            <option value="uk">Ukrainien</option>
                            <option value="ur">Urdu</option>
                            <option value="vi">Vietnamien</option>
                            <option value="xh">Xhosa</option>
                            <option value="yi">Yiddish</option>
                            <option value="yo">Yorouba</option>
                            <option value="zu">Zoulou</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Type <i style="color:red">*</i></label>
                                <select name="account_type" class="form-select" required>
                                    <option disabled selected>Type</option>
                                    <option>Professionnel</option>
                                    <option>Standard</option>
                                    <option>Prépayé</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Statut <i style="color:red">*</i></label>
                                <select name="account_status" class="form-select" required>
                                    <option disabled selected>Statut</option>
                                    <option>Activé</option>
                                    <option>Examen</option>
                                    <option>Suspendu</option>
                                    <option>Bloqué</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Solde à créditer <i style="color:red">*</i></label>
                            <input type="number" step="0.01" name="account_balance" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Transferts supportés <i style="color:red">*</i></label>
                            <input type="text" name="transfer_supported" class="form-control" required>
                            <small>Nom de la banque utilisée pour vos virements.</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label>% début <i style="color:red">*</i></label>
                                <input type="number" min="1" max="100" name="start_percentage" class="form-control" required>
                                <small>Mettre 1</small>
                            </div>
                            <div class="col-6">
                                <label>% fin <i style="color:red">*</i></label>
                                <input type="number" min="1" max="100" name="end_percentage" class="form-control" required>
                                <small>2-99 = échec, 100 = succès</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message à afficher <span class="text-danger">· requis</span></label>
                            <textarea name="failure_message" rows="2" class="form-control" placeholder="Message à affiché à la fin du virement..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alerte par e-mail (Obligatoire) :</label>
                            <div class="alert alert-info mb-0">
                                Les alertes par e-mail sont envoyées à l'adresse e-mail du client.<br>
                                <strong>NB :</strong> Les messages d'alerte par e-mail sont gratuits et sont intégrés par défaut.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Alerte par SMS (Facultatif) :</label>
                            <div class="form-check form-switch d-flex align-items-center gap-2 mb-2">
                                <input class="form-check-input" type="checkbox" id="alertSmsToggle" name="alert_sms" value="1" @checked(old('alert_sms'))>
                                <label class="form-check-label" for="alertSmsToggle">Activer les alertes par SMS</label>
                            </div>
                            <div class="alert alert-info mb-0">
                                Les alertes par SMS sont envoyées vers le numéro de téléphone du client.<br>
                                <strong>NB :</strong> 1 000 Crédits pour les alertes par SMS.
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="createCompteBtn" class="btn btn-success fw-semibold">
                                Créer l'accès client (3 000 Crédits)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE : COMPTES EXISTANTS --}}
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Mes comptes créés</h5>
                </div>
                <div class="card-body">
                    @forelse($comptes as $compte)
                        <div class="border rounded p-2 mb-2">
                            <strong>{{ $compte->nom }} {{ $compte->prenom }}</strong> –
                            {{ number_format($compte->account_balance, 2, ',', ' ') }} {{ $compte->devise }}
                            <span class="badge
                                @if($compte->account_status === 'Activé') bg-success
                                @elseif($compte->account_status === 'Examen') bg-primary
                                @elseif($compte->account_status === 'Suspendu') bg-warning
                                @else bg-danger @endif">
                                {{ $compte->account_status }}
                            </span>
                <button class="btn btn-sm btn-outline-primary float-end"
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
                                    data-numerocompte="{{ $compte->numerocompte }}"
                                    data-start-percentage="{{ $compte->start_percentage }}"
                                    data-end-percentage="{{ $compte->end_percentage }}"
                                    data-compte-id="{{ $compte->id }}"
                                    data-delete-url="{{ $compte->is_default ? '' : route('account.destroy', $compte->id) }}"
                                    data-is-default="{{ $compte->is_default ? '1' : '0' }}"
                                    data-password="{{ $compte->password }}"
                                    data-code-virement="{{ $compte->code_virement }}"
                                    data-failure-message="{{ $compte->failure_message }}"
                                    data-alert-email="{{ $compte->alert_email ? '1' : '0' }}"
                                    data-alert-sms="{{ $compte->alert_sms ? '1' : '0' }}"
                                    data-code-used="{{ !empty($compte->has_completed_transfer) ? '1' : '0' }}"
                                    data-creation-cost="{{ 3000 + ($compte->alert_sms ? 1000 : 0) }}"
                                    data-created-at="{{ optional($compte->created_at)->toIso8601String() }}"
                                    data-has-completed-transfer="0">
                                Détails
                            </button>
                        </div>
                    @empty
                        <div class="text-center text-muted">Aucun compte pour l’instant.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- FIN CRÉER UN COMPTE -->
<style>
                .copy-icon {
                    margin-left: 10px;
                    cursor: pointer;
                    color: #007BFF;
                    transition: color 0.3s ease;
                }

                .copy-icon.copied {
                    color: #28A745;
                }

                .modaldetail p {
                    font-size: 1rem;
                }

                .carddetail {
                    background-color: #d8dcdd;
                    padding: 15px 15px 0 15px;
                    max-width: 90%;
                    margin: auto;
                    margin-top: -10px;
                    text-transform: lowercase
                }

                .client-access-summary {
                    background-color: #f6f9fc;
                    border-radius: 0.75rem;
                    padding: 1rem 1.25rem;
                    margin-top: 1.5rem;
                    box-shadow: inset 0 0 0 1px rgba(13, 110, 253, 0.1);
                }

                .client-summary-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 0.65rem;
                    font-weight: 600;
                    color: #1d3557;
                    gap: 1rem;
                }

                .client-summary-row:last-child {
                    margin-bottom: 0;
                }

                .client-summary-label {
                    flex: 1;
                    font-size: 0.9rem;
                }

                .client-summary-value {
                    font-size: 0.9rem;
                    font-weight: 500;
                    color: #12263a;
                }

                .detail-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    border-radius: 999px;
                    font-size: 0.8rem;
                    font-weight: 600;
                    padding: 0.2rem 0.85rem;
                    text-transform: uppercase;
                    letter-spacing: 0.02em;
                }

                .detail-badge--usage {
                    background-color: #e6f4ff;
                    color: #0b5394;
                }

                .detail-badge--usage-yes {
                    background-color: #d1f5e0;
                    color: #0a7b34;
                }

                .detail-badge--usage-no {
                    background-color: #ffe5e5;
                    color: #b7322c;
                }

                .status-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    border-radius: 999px;
                    font-size: 0.8rem;
                    font-weight: 600;
                    padding: 0.2rem 0.85rem;
                    text-transform: uppercase;
                }

                .status-badge--active {
                    background-color: #d1f5e0;
                    color: #0a7b34;
                }

                .status-badge--inactive {
                    background-color: #ffe5e5;
                    color: #b7322c;
                }

                .state-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.35rem;
                    border-radius: 999px;
                    padding: 0.25rem 0.9rem;
                    font-size: 0.82rem;
                    font-weight: 600;
                }

                .state-badge--active {
                    background-color: #d1f5e0;
                    color: #0a7b34;
                }

                .state-badge--warning {
                    background-color: #fff4d6;
                    color: #ad7a00;
                }

                .state-badge--danger {
                    background-color: #ffe5e5;
                    color: #b7322c;
                }

                .state-badge--info {
                    background-color: #e6f4ff;
                    color: #0b5394;
                }
            </style>
            <style>
                .header2 {
                    background-color: cadetblue;
                    color: #f3f3f3;
                }

                .succes {
                    /* background-color: #4caf50; */
                    color: #f3f3f3;
                }

                .close2 {
                    background-color: #0d6efd;
                    color: #f3f3f3;
                    font-size: 1.5rem;
                    border: 0;
                    /*border-radius: 50%;*/
                    /*width: 2rem;*/
                    /*height: 2rem;*/
                    /*display: flex;*/
                    /*align-items: center;*/
                    /*justify-content: center;*/
                }
            </style>
            

            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title " id="infoModalLabel" style=" color:white">Détail de l'accès client
                            </h5>
                            <button type="button" class="close close2" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modaldetail">
                            <div class="info-section">
                                <h6 class="text-info fw-bold fs-4"><i class="fas fa-user"></i> Informations Personnelles
                                </h6>
                                <p><strong>Titulaire du compte:</strong> <span id="modal-nom"></span></p>
                                <div class="card carddetail">
                                    <p><i><strong>Adresse e-mail:</strong> <span id="modal-email"></span></i><i
                                            class="fas fa-copy copy-icon" data-clipboard-target="#modal-email"
                                            title="Copier"></i></p>
                                    <p><i><strong>Mot de passe:</strong> <span id="modal-password"></span></i> <i
                                            class="fas fa-copy copy-icon" data-clipboard-target="#modal-password"
                                            title="Copier"></i></p>
<a href="https://transfermoneyy.com" target="_blank" class="visit-link fw-bold">Visitez le compte</a>

                                </div>
                                
                                <div class="modal-footer">

                </div>
                                
                                
                                @isset($compte)
                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <form id="envoyer-email-form" method="POST" action="#" data-action-template="{{ route('comptes.envoyerEmail', ['id' => '__ID__']) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Envoyer les coordonnées par email</button>
                    </form>
                                        </div>
                                        
                                        <div class="col-sm-6 ">
                                              <form id="envoyer-code-form" method="POST" action="#" data-action-template="{{ route('comptes.envoyerCodeDeblocage', ['id' => '__ID__']) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Envoyer le Code de déblocage</button>
                    </form>
                                        </div>
                                    </div>
                                @endisset

                                <p class="mt-3 "><strong>Numéro de téléphone:</strong> <span id="modal-phone"></span></p>
                                <p><strong>Pays de résidence:</strong> <span id="modal-country"></span></p>
                                <p><strong>Adresse de résidence:</strong> <span id="modal-address"></span></p>
                            </div>
                            <div class="info-section">
                                <h6 class="text-info fw-bold fs-4"><i class="fas fa-university"></i> Compte et Virement
                                </h6>
                                <p><strong>Solde du compte:</strong> <span id="modal-balance"></span><span
                                        id="modal-devise-display"></span></p>
                                <p><strong>Type de compte:</strong> <span id="modal-account-type"></span></p>
                                <p><strong>Statut du compte:</strong> <span id="modal-account-status"></span></p>
                                <p><strong>Virement supporté:</strong> <span id="modal-transfer-supported"></span></p>
                                <p><strong>Numéro du compte:</strong> <span id="modal-numerocompte"></span></p>
                <p><strong>Pourcentage de début:</strong> <span id="modal-start-percentage"></span>%</p>
                <p><strong>Pourcentage de fin:</strong> <span id="modal-end-percentage"></span>%</p>
                 <p><strong>Message a affiché:</strong> <span id="modal-failure-message"
                                        style="color: #007BFF"></span></p>
                                <p><strong>Code de déblocage:</strong> <span
                                        style="background-color: black; border-radius:10%; color:white; font-size:1rem; padding:.4rem;"
                                        id="modal-code-virement"></span><i class="fas fa-copy copy-icon"
                                        data-clipboard-target="#modal-code-virement" title="Copier"></i></p>
                                <input type="hidden" id="compte-id">

                                <div class="client-access-summary mt-4">
                                    <p class="client-summary-row">
                                        <span class="client-summary-label">Code déjà utilisé :</span>
                                        <span id="modal-code-used" class="detail-badge detail-badge--usage">—</span>
                                    </p>
                                    <p class="client-summary-row">
                                        <span class="client-summary-label">Alert Mail Pro :</span>
                                        <span id="modal-alert-email" class="status-badge status-badge--inactive">—</span>
                                    </p>
                                    <p class="client-summary-row">
                                        <span class="client-summary-label">Alert SMS Pro :</span>
                                        <span id="modal-alert-sms" class="status-badge status-badge--inactive">—</span>
                                    </p>
                                    <p class="client-summary-row">
                                        <span class="client-summary-label">Coût de création :</span>
                                        <span id="modal-creation-cost" class="client-summary-value">—</span>
                                    </p>
                                    <p class="client-summary-row">
                                        <span class="client-summary-label">Date de création :</span>
                                        <span id="modal-created-at" class="client-summary-value">—</span>
                                    </p>
                                    <p class="client-summary-row mb-0">
                                        <span class="client-summary-label">État :</span>
                                        <span id="modal-state-pill" class="state-badge state-badge--info">—</span>
                                    </p>
                                </div>
                            </div>

                            @isset($compte)
<small class="small-text">Recréditer le compte après un transfert</small>
                                @isset($compte)
    <form id="remboursement-form" method="POST" action="#" data-action-template="{{ route('comptes.rembourserCompte', ['id' => '__ID__']) }}" >
        @csrf
        <button type="submit" class="btn btn-success" id="remboursement-btn">Rembourser le Solde</button>
    </form>
@endisset

                            @endisset
                        </div>


 <hr>
                        <div class="row">
                            <div class="col-md-3"></div>
                                <button id="toggleFormsBtn" class="btn btn-primary mb-3 col-md-6">Modifier les
                                    informations
                                Client</button>
                            <div class="col-md-3"></div>
                        </div>


                        <div id="formsContainer" style="display: none;">
                            <form id="changeStatusForm" method="POST" action="#" data-action-template="{{ route('update.status', ['id' => '__ID__']) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="compte_id" id="statusCompteId">
                                <div class="mx-3 mb-1">
                                    <label for="account_status" class="fw-bold">Statut de Compte</label>
                                    <div class="d-flex justify-content-center">
                                        <select name="account_status" id="account_status" class="form-select">
                                            <option value="" disabled selected>Choisissez le statut du compte
                                            </option>
                                            <option value="Activé">Activé</option>
                                            <option value="Examen">En examen</option>
                                            <option value="Suspendu">Suspendu</option>
                                            <option value="Bloqué">Bloqué</option>
                                        </select>
                                        <div class="mx-2">
                                            <button type="submit" class="btn btn-success fw-bold"
                                                style="font-size: .8rem">Changer le statut du compte</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <form id="plusSolde" method="POST" action="#" data-action-template="{{ route('update.solde', ['id' => '__ID__']) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="compte_id" id="plusSoldeCompteId">
                                <div class="mx-3 mb-1">
                                    <label for="montant" class="fw-bold">Compléter le solde de <i
                                            style="color: green">+</i></label>
                                    <div class="d-flex justify-content-center">
                                        <input type="number" class="form-control" name="montant"
                                            placeholder="Entrer le montant à ajouter au compte">
                                        <div class="mx-2">
                                            <button type="submit" class="btn btn-success fw-bold"
                                                style="font-size: .8rem">Compléter le solde du compte</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <form id="moinsSolde" method="POST" action="#" data-action-template="{{ route('diminuer.solde', ['id' => '__ID__']) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="compte_id" id="moinsSoldeCompteId">
                                <div class="mx-3 mb-1">
                                    <label for="montant" class="fw-bold">Diminuer le solde de <i
                                            style="color: red">-</i></label>
                                    <div class="d-flex justify-content-center">
                                        <input type="number" class="form-control" name="montant"
                                            placeholder="Entrer le montant à soustraire du compte" required>
                                        <div class="mx-2">
                                            <button type="submit" class="btn btn-danger fw-bold"
                                                style="font-size: .8rem">Diminuer le solde du compte</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                                <form id="failuremessage" method="POST" action="#" data-action-template="{{ route('modifier.failuremessage', ['id' => '__ID__']) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="compte_id" id="failuremessageCompteId">
                                    <div class="mx-3 mb-1">
                                        <label for="message" class="fw-bold">Message</label>
                                        <div class="d-flex justify-content-center">
                                            <input type="text" class="form-control" name="failuremessage"
                                                placeholder="Entrer le Message" required>
                                            <div class="mx-2">
                                                <button type="submit" class="btn btn-success fw-bold"
                                                    style="font-size: .8rem">Modifier le message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <form id="percentageForm" method="POST"
                                    action="#" data-action-template="{{ route('modifier.pourcentages', ['id' => '__ID__']) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mx-3 mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="start_percentage">Pourcentage de Début</label>
                                        <input type="number" class="form-control" id="start_percentage"
                                            name="start_percentage" min="1" max="100" placeholder="min:1" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end_percentage">Pourcentage de Fin</label>
                                        <input type="number" class="form-control" id="end_percentage"
                                            name="end_percentage" min="1" max="100" placeholder="max:100" required>
                                    </div>
                                </div>
                                <div class="text-center mb-1">
                                        <button type="submit" class="btn btn-primary">Modifier le pourcentages</button>
                                    </div>
                            </form>
                            
                            <hr>
                            <div id="deleteAccountSection">
                                <form id="deleteAccountForm" method="POST" action="" data-delete-base="{{ url('/delete-account') }}" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" id="deleteCompteId" name="compte_id">
                                    <div class="mx-3 mb-1 text-center">
                                        <p class="fw-bold text-danger mb-2">Supprimer définitivement ce compte</p>
                                        <button type="submit" class="btn btn-danger fw-bold">
                                            Supprimer le compte
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="deleteAccountDisabledMessage" class="alert alert-info mx-3 mb-1 d-none text-center" role="alert">
                                Ce compte principal a été créé automatiquement et ne peut pas être supprimé.
                            </div>
                        </div>


<script>
                function confirmDelete() {
                    return confirm('Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.');
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var infoModal = document.getElementById('infoModal');
                    var deleteForm = document.getElementById('deleteAccountForm');
                    var hiddenField = document.getElementById('deleteCompteId');
                    var detailButtons = document.querySelectorAll('[data-bs-target="#infoModal"]');
                    var deleteSection = document.getElementById('deleteAccountSection');
                    var deleteDisabledMessage = document.getElementById('deleteAccountDisabledMessage');

                    function buildDeleteUrl(id) {
                        var base = deleteForm ? deleteForm.getAttribute('data-delete-base') : '';
                        if (!base || !id) {
                            return '';
                        }
                        return base.replace(/\/$/, '') + '/' + id;
                    }

                    function applyDeleteContext(trigger) {
                        if (!trigger || !deleteForm) {
                            return;
                        }
                        var dataset = trigger.dataset || {};
                        var compteId = trigger.getAttribute('data-compte-id') || dataset.compteId || '';
                        var rawDefaultFlag = trigger.getAttribute('data-is-default');
                        if (rawDefaultFlag === null && typeof dataset.isDefault !== 'undefined') {
                            rawDefaultFlag = dataset.isDefault;
                        }
                        var isDefault = rawDefaultFlag === '1' || rawDefaultFlag === 'true';
                        if (deleteSection) {
                            deleteSection.classList.toggle('d-none', isDefault);
                        }
                        if (deleteDisabledMessage) {
                            deleteDisabledMessage.classList.toggle('d-none', !isDefault);
                        }
                        if (hiddenField) {
                            hiddenField.value = compteId;
                        }
                        if (isDefault) {
                            deleteForm.removeAttribute('action');
                            return;
                        }
                        var deleteUrl = trigger.getAttribute('data-delete-url') || dataset.deleteUrl;
                        if (!deleteUrl) {
                            deleteUrl = buildDeleteUrl(compteId);
                        }
                        if (deleteUrl) {
                            deleteForm.setAttribute('action', deleteUrl);
                        }
                    }

                    if (detailButtons.length && deleteForm) {
                        detailButtons.forEach(function(button) {
                            button.addEventListener('click', function() {
                                applyDeleteContext(button);
                            });
                        });
                    }

                    if (infoModal && deleteForm) {
                        infoModal.addEventListener('show.bs.modal', function(event) {
                            applyDeleteContext(event.relatedTarget);
                        });
                    }

                    if (deleteForm) {
                        deleteForm.addEventListener('submit', function() {
                            var currentAction = deleteForm.getAttribute('action');
                            if (deleteSection && deleteSection.classList.contains('d-none')) {
                                return;
                            }
                            if (!currentAction) {
                                var fallbackId = hiddenField ? hiddenField.value : '';
                                var fallbackUrl = buildDeleteUrl(fallbackId);
                                if (fallbackUrl) {
                                    deleteForm.setAttribute('action', fallbackUrl);
                                }
                            }
                        });
                    }
                });
            </script>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary succes" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

<style>
  .small-text {
    font-size: 0.875rem; /* Taille du texte légèrement plus petite */
    color: #6c757d; /* Couleur gris moyen */
    font-weight: 600; /* Poids du texte semi-gras */
    margin-top: 10px; /* Marge supérieure */
    display: block; /* Affichage en bloc pour contrôler les marges */
    font-style: italic; /* Texte en italique */

  }
</style>



        </div>


    </div>
    <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var rechargeButton = document.getElementById('paieFormsBtn');
                    var rechargeOptions = document.getElementById('rechargeOptions');
                    var alertSmsToggle = document.getElementById('alertSmsToggle');
                    var createCompteBtn = document.getElementById('createCompteBtn');
                    var baseCost = 3000;
                    var smsCost = 1000;

                    function updateSubmitLabel() {
                        if (!createCompteBtn) {
                            return;
                        }
                        var total = alertSmsToggle && alertSmsToggle.checked ? baseCost + smsCost : baseCost;
                        createCompteBtn.textContent = 'Créer l\'accès client (' + total.toLocaleString('fr-FR') + ' Crédits)';
                    }

                    if (alertSmsToggle) {
                        alertSmsToggle.addEventListener('change', updateSubmitLabel);
                    }

                    if (rechargeButton && rechargeOptions) {
                        rechargeButton.addEventListener('click', function() {
                            var isHidden = rechargeOptions.classList.contains('d-none');
                            rechargeOptions.classList.toggle('d-none', !isHidden);
                            rechargeButton.textContent = isHidden ? 'Masquer les options de recharge' : 'Recharger mon compte';
                        });
                    }

                    updateSubmitLabel();

                    var toggleFormsBtn = document.getElementById('toggleFormsBtn');
                    var formsContainer = document.getElementById('formsContainer');
                    if (toggleFormsBtn && formsContainer) {
                        toggleFormsBtn.addEventListener('click', function() {
                            var shouldShow = formsContainer.style.display === 'none' || formsContainer.style.display === '';
                            formsContainer.style.display = shouldShow ? 'block' : 'none';
                        });
                    }
                });
            </script>
    <script>
        var currentCompteId = '';

        function populateModal(data) {
            var modal = $('#infoModal');
            modal.find('#modal-nom').text(data.nom || '');
            modal.find('#modal-email').text(data.email || '');
            modal.find('#modal-phone').text(data.phone || data.phone_number || '');
            modal.find('#modal-country').text(data.country || '');
            modal.find('#modal-password').text(data.password || '');
            modal.find('#modal-code-virement').text(data.codeVirement || '');
            modal.find('#modal-address').text(data.address || '');
            modal.find('#modal-devise').text(data.devise || '');
            modal.find('#modal-balance').text(data.balance || '');
            modal.find('#modal-account-type').text(data.accountType || '');
            modal.find('#modal-account-status').text(data.accountStatus || '');
            modal.find('#modal-failure-message').text(data.failureMessage || '');
            modal.find('#modal-transfer-supported').text(data.transferSupported || '');
            modal.find('#modal-numerocompte').text(data.numerocompte || '');
            modal.find('#modal-start-percentage').text(data.startPercentage || '');
            modal.find('#modal-end-percentage').text(data.endPercentage || '');

            var deviseDisplay = modal.find('#modal-devise-display');
            if (deviseDisplay.length) {
                deviseDisplay.text(data.devise ? ' ' + data.devise : '');
            }

            if (data.compteId) {
                setFormAction('#envoyer-email-form', data.compteId);
                setFormAction('#envoyer-code-form', data.compteId);
                setFormAction('#remboursement-form', data.compteId);
                setFormAction('#changeStatusForm', data.compteId);
                setFormAction('#plusSolde', data.compteId);
                setFormAction('#moinsSolde', data.compteId);
                setFormAction('#percentageForm', data.compteId);
                setFormAction('#failuremessage', data.compteId);
                $('#compte-id').val(data.compteId);
                $('#statusCompteId').val(data.compteId);
                $('#plusSoldeCompteId').val(data.compteId);
                $('#moinsSoldeCompteId').val(data.compteId);
                $('#failuremessageCompteId').val(data.compteId);
                $('#deleteCompteId').val(data.compteId);
                currentCompteId = data.compteId;
            }

            if (typeof data.accountStatus !== 'undefined' && data.accountStatus !== null) {
                $('#account_status').val(data.accountStatus);
            }
            if (typeof data.startPercentage !== 'undefined' && data.startPercentage !== null) {
                $('#start_percentage').val(data.startPercentage);
            }
            if (typeof data.endPercentage !== 'undefined' && data.endPercentage !== null) {
                $('#end_percentage').val(data.endPercentage);
            }
            if (typeof data.failureMessage !== 'undefined' && data.failureMessage !== null) {
                $('#failuremessage input[name="failuremessage"]').val(data.failureMessage);
            }

            updateAlertBadges(data.alertEmail, data.alertSms);
            updateCodeUsageBadge(data.codeUsed);
            updateCreationCost(data.creationCost);
            updateCreationDate(data.createdAt);
            updateStateBadge(data.accountStatus);
            toggleRemboursementForm(data.hasCompletedTransfer);
        }

        function updateAlertBadges(alertEmail, alertSms) {
            var emailBadge = $('#modal-alert-email');
            var smsBadge = $('#modal-alert-sms');

            emailBadge.removeClass('status-badge--active status-badge--inactive');
            smsBadge.removeClass('status-badge--active status-badge--inactive');

            emailBadge.text('—');
            smsBadge.text('—');

            if (emailBadge.length) {
                var hasExplicitEmailValue = alertEmail !== undefined && alertEmail !== null && alertEmail !== '';
                var normalizedEmail = String(alertEmail).toLowerCase();
                var isActiveEmail = hasExplicitEmailValue
                    ? (normalizedEmail === '1' || normalizedEmail === 'true' || alertEmail === true)
                    : true;
                var emailIcon = isActiveEmail ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>';
                emailBadge.html(emailIcon + ' ' + (isActiveEmail ? 'Activé' : 'Désactivé'));
                emailBadge.toggleClass('status-badge--active', isActiveEmail);
                emailBadge.toggleClass('status-badge--inactive', !isActiveEmail);
            }

            if (smsBadge.length) {
                var normalizedSms = String(alertSms).toLowerCase();
                var isActiveSms = normalizedSms === '1' || normalizedSms === 'true' || alertSms === true;
                var smsIcon = isActiveSms ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>';
                smsBadge.html(smsIcon + ' ' + (isActiveSms ? 'Activé' : 'Désactivé'));
                smsBadge.toggleClass('status-badge--active', isActiveSms);
                smsBadge.toggleClass('status-badge--inactive', !isActiveSms);
            }
        }

        function updateCodeUsageBadge(codeUsed) {
            var badge = $('#modal-code-used');
            if (!badge.length) {
                return;
            }
            badge.removeClass('detail-badge--usage-yes detail-badge--usage-no');
            var normalized = String(codeUsed).toLowerCase();
            var isUsed = normalized === '1' || normalized === 'true' || codeUsed === true;
            badge.text(isUsed ? 'OUI' : 'NON');
            badge.toggleClass('detail-badge--usage-yes', isUsed);
            badge.toggleClass('detail-badge--usage-no', !isUsed);
        }

        function updateCreationCost(creationCost) {
            var target = $('#modal-creation-cost');
            if (!target.length) {
                return;
            }
            if (creationCost === undefined || creationCost === null || creationCost === '') {
                target.text('—');
                return;
            }
            var costNumber = Number(creationCost);
            if (Number.isNaN(costNumber)) {
                target.text(creationCost);
                return;
            }
            target.text(costNumber.toLocaleString('fr-FR') + ' Crédits');
        }

        function updateCreationDate(createdAt) {
            var target = $('#modal-created-at');
            if (!target.length) {
                return;
            }
            if (!createdAt) {
                target.text('—');
                return;
            }
            var date = new Date(createdAt);
            if (Number.isNaN(date.getTime())) {
                target.text(createdAt);
                return;
            }
            var formatter = new Intl.DateTimeFormat('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                timeZone: 'UTC'
            });
            var parts = formatter.formatToParts(date);
            var segments = { day: '—', month: '—', year: '—', hour: '00', minute: '00' };
            parts.forEach(function(part) {
                if (Object.prototype.hasOwnProperty.call(segments, part.type)) {
                    segments[part.type] = part.value;
                }
            });
            var dateString = [segments.day, segments.month, segments.year].join('/');
            var timeString = segments.hour + ':' + segments.minute;
            target.text(dateString + ' à ' + timeString + ' UTC+0');
        }

        function updateStateBadge(accountStatus) {
            var badge = $('#modal-state-pill');
            if (!badge.length) {
                return;
            }
            badge.removeClass('state-badge--active state-badge--warning state-badge--danger state-badge--info');
            var label = '—';
            var cls = 'state-badge--info';
            var icon = '';

            switch ((accountStatus || '').toLowerCase()) {
                case 'activé':
                    label = 'Flash Compte actif';
                    icon = '<i class="fas fa-check-circle"></i>';
                    cls = 'state-badge--active';
                    break;
                case 'examen':
                    label = 'En examen';
                    icon = '<i class="fas fa-hourglass-half"></i>';
                    cls = 'state-badge--warning';
                    break;
                case 'suspendu':
                    label = 'Compte suspendu';
                    icon = '<i class="fas fa-exclamation-triangle"></i>';
                    cls = 'state-badge--danger';
                    break;
                case 'bloqué':
                    label = 'Compte bloqué';
                    icon = '<i class="fas fa-ban"></i>';
                    cls = 'state-badge--danger';
                    break;
                default:
                    label = accountStatus || '—';
                    icon = label !== '—' ? '<i class="fas fa-info-circle"></i>' : '';
                    cls = 'state-badge--info';
                    break;
            }

            badge.addClass(cls);
            badge.html((icon ? icon + ' ' : '') + label);
        }

        function toggleRemboursementForm(hasCompletedTransfer) {
            var form = $('#remboursement-form');
            if (!form.length) {
                return;
            }
            var helperHint = form.prev('.small-text');
            var submitButton = form.find('button[type="submit"]');
            var isAllowed = hasCompletedTransfer === true || hasCompletedTransfer === 1 || hasCompletedTransfer === '1';

            if (helperHint && helperHint.length) {
                helperHint.toggle(isAllowed);
            }
            if (submitButton && submitButton.length) {
                submitButton.prop('disabled', !isAllowed);
                submitButton.toggleClass('disabled', !isAllowed);
                if (!isAllowed) {
                    submitButton.attr('title', 'Disponible après un transfert complété');
                } else {
                    submitButton.removeAttr('title');
                }
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleRemboursementForm(false);

            $('#infoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                if (!button || !button.length) {
                    return;
                }

                var compteId = button.data('compte-id');
                var modalData = {
                    nom: getButtonData(button, 'nom'),
                    email: getButtonData(button, 'email'),
                    phone: getButtonData(button, 'phone'),
                    country: getButtonData(button, 'country'),
                    password: getButtonData(button, 'password'),
                    codeVirement: getButtonData(button, 'code-virement'),
                    address: getButtonData(button, 'address'),
                    balance: getButtonData(button, 'balance'),
                    accountType: getButtonData(button, 'account-type'),
                    accountStatus: getButtonData(button, 'account-status'),
                    failureMessage: getButtonData(button, 'failure-message'),
                    transferSupported: getButtonData(button, 'transfer-supported'),
                    numerocompte: getButtonData(button, 'numerocompte'),
                    startPercentage: getButtonData(button, 'start-percentage'),
                    endPercentage: getButtonData(button, 'end-percentage'),
                    compteId: compteId,
                    alertEmail: getButtonData(button, 'alert-email'),
                    alertSms: getButtonData(button, 'alert-sms'),
                    codeUsed: getButtonData(button, 'code-used'),
                    creationCost: getButtonData(button, 'creation-cost'),
                    createdAt: getButtonData(button, 'created-at'),
                    hasCompletedTransfer: getButtonData(button, 'has-completed-transfer')
                };

                populateModal(modalData);

                if (compteId) {
                    fetch(`/compte/${compteId}/details`)
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {
                            populateModal(data);
                            syncTriggerDataset(button, data);
                        })
                        .catch(function(error) {
                            console.error('Error fetching compte details:', error);
                        });
                }
            });

            var clipboard = new ClipboardJS('.copy-icon');

            clipboard.on('success', function(e) {
                var icon = e.trigger;
                icon.classList.remove('fa-copy');
                icon.classList.add('fa-check');
                icon.title = 'Copié';

                setTimeout(function() {
                    icon.classList.remove('fa-check');
                    icon.classList.add('fa-copy');
                    icon.title = 'Copier';
                }, 2000);

                e.clearSelection();
            });

            clipboard.on('error', function(e) {
                console.error('Échec de la copie : ', e);
            });
        });

        function syncTriggerDataset(button, data) {
            if (!button || !button.length || !data) {
                return;
            }

            var mapping = {
                'nom': data.nom,
                'email': data.email,
                'phone': data.phone || data.phone_number,
                'country': data.country,
                'password': data.password,
                'code-virement': data.codeVirement,
                'address': data.address,
                'balance': data.balance,
                'account-type': data.accountType,
                'account-status': data.accountStatus,
                'failure-message': data.failureMessage,
                'transfer-supported': data.transferSupported,
                'numerocompte': data.numerocompte,
                'start-percentage': data.startPercentage,
                'end-percentage': data.endPercentage,
                'alert-email': data.alertEmail ? '1' : '0',
                'alert-sms': data.alertSms ? '1' : '0',
                'code-used': data.codeUsed ? '1' : '0',
                'creation-cost': data.creationCost,
                'created-at': data.createdAt,
                'has-completed-transfer': data.hasCompletedTransfer ? '1' : '0'
            };

            Object.keys(mapping).forEach(function(key) {       
                var attributeName = 'data-' + key;
                if (typeof mapping[key] === 'undefined') {     
                    return;
                }
                button.attr(attributeName, mapping[key]);      
            });
        }

        function setFormAction(selector, compteId) {
            if (!selector || !compteId) {
                return;
            }
            var form = $(selector);
            if (!form.length) {
                return;
            }
            var template = form.attr('data-action-template');  
            if (!template) {
                return;
            }
            var updated = template.replace('__ID__', compteId);
            form.attr('action', updated);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var templatedForms = document.querySelectorAll('form[data-action-template]');
            templatedForms.forEach(function(form) {
                form.addEventListener('submit', function() {
                    var currentAction = form.getAttribute('action');
                    if (!currentAction || currentAction === '#') {
                        var template = form.getAttribute('data-action-template');
                        var compteId = document.getElementById('compte-id') ? document.getElementById('compte-id').value : '';
                        if ((!compteId || !compteId.length) && currentCompteId) {
                            compteId = currentCompteId;
                        }
                        if (template && compteId) {
                            form.setAttribute('action', template.replace('__ID__', compteId));
                        }
                    }
                });
            });
        });

        function getButtonData(button, key) {
            if (!button || !button.length) {
                return undefined;
            }
            var attrValue = button.attr('data-' + key);
            if (typeof attrValue !== 'undefined') {
                return attrValue;
            }
            var dataset = button[0] && button[0].dataset ? button[0].dataset : null;
            if (!dataset) {
                return undefined;
            }
            var camelKey = key.replace(/-([a-z])/g, function(_, char) {
                return char.toUpperCase();
            });
            return dataset[camelKey];
        }
    </script>
</div>
<!-- FIN MARGE GAUCHE / DROITE -->

@endsection