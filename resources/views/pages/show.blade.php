<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfère Prêt</title>
    <link rel="stylesheet" href=" {{ asset('bootstrap/bootstrap.css') }} ">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('bootstrap/bootstrap.js') }} " defer>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Jaro:opsz@6..72&family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaro:opsz@6..72&family=Lobster&display=swap" rel="stylesheet">
</head>

<body>


    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        .account-balance {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: start;
        }

        .account-balance h2 {
            font-size: 2em;
            margin: 0;
        }

        .btn-custom {

            display: inline-block;
            width: 48%;
            margin: 10px 1%;
        }

        .transaction-history {
            margin-top: 20px;

        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-outline: none;
            outline: none;
        }

        .dashboard {
            position: relative;
            background-color: white;
            max-width: 800px;
            min-height: 100vh;
            margin: auto;

            box-shadow: 0 0 12px 0 rgba(0, 0, 0, .2);
            overflow: auto;
            padding: 10px 30px 150px 30px;
            transition: all 200ms linear;
        }

        footer {
            position: fixed;

            display: -webkit-box-flex;
            display: -ms-flex;
            display: flex;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            width: 700px;
            height: 67px;
            border-radius: 30px;
            box-shadow: 0 0 12px 0 rgba(0, 0, 0, .2);
            border: 1px solid #cfe2ff;
            bottom: 20px;
            overflow: hidden;
            background-color: white;
            z-index: 1000;
        }

        @media screen and (max-width: 800px) {
            footer {
                width: 80%;
                left: 10%;
            }
        }


        footer a i {
            display: flex;
            justify-content: center;
            color: white;
            padding-bottom: .5rem;
            position: relative;
            top: 4px;
            color: var(--bs-link-color);
        }

        /* footer a i:hover {
            display: flex;
            justify-content: center;
            color: white;
            padding-bottom: .5rem;
            position: relative;
            top: 4px;
            color: white;
        } */

        footer a * {
            display: block;
        }

        footer a:hover {
            background-color: #ccebf5;

        }


        footer a {
            text-decoration: none;
            width: 25%;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 6px;
            transition: all 100ms ease;
            color: var(--bs-link-color);
        }

        i {
            font-style: italic;
        }

        .menu-icon {
            font-size: 24px;
            /* Adjust icon size as needed */
            color: #000;
            /* Adjust icon color as needed */
            cursor: pointer;
        }

        .icon-circle {
            display: inline-block;
            width: 50px;
            /* Adjust size as needed */
            height: 50px;
            /* Adjust size as needed */
            border-radius: 50%;
            background-color: #f0f0f0;
            /* Adjust background color as needed */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-circle i {
            font-size: 24px;
            /* Adjust icon size as needed */
            color: var(--bs-link-color);
        }

        .dashboard nav {
            display: flex;
            justify-content: space-between;
        }

        .iconHist {
            padding: 13px 15px 13px 15px;
            background-color: #ccebf5;
            border-radius: 50%;
            font-size: 1.3rem;
            margin-right: 5px;
        }

        .iconHist2 {
            padding: 13px 15px 13px 15px;
            background-color: red;
            border-radius: 50%;
            font-size: 1.3rem;
            margin-right: 5px;
            color: #f0f0f0;
        }

        .iconHist3 {
            padding: 13px 15px 13px 15px;
            background-color: green;
            border-radius: 50%;
            font-size: 1.3rem;
            margin-right: 5px;
            color: white;
        }

        .virement {
            font-size: .8rem;
        }

        .carte {
            font-size: .8rem;
        }

        .lobster-regular {
            font-family: "Lobster", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .balance {
            font-family: "Acme", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 1.8rem;
        }
    </style>
    </head>

    @auth

    <div class="dashboard ">
        <nav class="pt-2">
            <div><i class="fas fa-bars menu-icon"></i> <strong class="fs-4">TRANSFERT</strong></div>
            <a href="{{route('info')}}" class="icon-circle">
                <i class="fas fa-user"></i>
            </a>

        </nav>
        <hr>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class=" my-5">
            <!-- <div class="alert alert-success">
                Un virement de <strong class="fw-bold">{{number_format($compte->account_balance, 2, ',', ' ').' '.$compte->devise}} </strong> reçu et crédité sur votre compte. Vous pouvez ajouter votre <strong>IBAN</strong> afin d'effectuer un virement externe vers votre <strong>banque</strong>.
            </div> -->
            <p> Hello {{$compte->nom.' '. $compte->prenom}}</p>
            <div class="account-balance">
                <div>
                    <p><i class="fas fa-coins"></i> Account balance :</p>
                </div>
                <h2 class="fw-bold mx-3 fs-4 mb-4 balance">{{number_format($compte->account_balance, 2, ',', ' ').' '.$compte->devise}}</h2>

                <a href="{{route('virement')}}" class="btn btn-warning virement ">Effectuer un virement <i class=" fas fa-arrow-right"></i></a>
                <a href="{{route('carte')}}" class="btn btn-success carte ">Ma carte <i class=" fas fa-arrow-right"></i></a>

            </div>



            <div class="transaction-history">
                <h4>Historique des transactions</h4>
                <ul class="list-group">
                    <ul class="list-group">
                        @isset($histories)
                        @forelse($histories as $history)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex ">
                                <div>
                                    @if($history->transaction_type == 'transfer received')
                                    <i class="fas fa-university text-success"></i>
                                    @elseif($history->transaction_type == 'Transfer sent')
                                    <i class="fas fa-arrow-up iconHist2"></i>
                                    @elseif($history->transaction_type == 'Refund received')
                                    <i class="fas fa-sync-alt iconHist"></i>
                                    @else
                                    <i class="fas fa-question text-warning"></i>
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ ucwords(str_replace('_', ' ', $history->transaction_type)) }}</strong><br>
                                    <small>{{ $history->description }}</small>
                                </div>
                            </div>
                            @if($history->transaction_type == 'Transfer sent')
                            <div>
                                <strong class="text-danger">{{ $history->amount < 0 ? '-' : '-' }}{{ number_format(abs($history->amount), 2) }} {{ $compte->devise}} </strong><br>
                                <small>{{ $history->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            @endif
                            @if($history->transaction_type == 'Refund received')
                            <div>
                                <strong class="text-success">{{ $history->amount < 0 ? '-' : '+' }}{{ number_format(abs($history->amount), 2) }} {{ $compte->devise}} </strong><br>
                                <small>{{ $history->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            @endif
                        </li>

                        @empty

                        @endforelse
                        @endisset
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex ">
                                <div>
                                    <i class="fas fa-university iconHist3 "></i>
                                </div>
                                <div>
                                    <strong>{{ ucwords(str_replace('_', ' ', "transfer received")) }}</strong><br>
                                    <small>TRANSFERT</small>
                                </div>
                            </div>
                            <div>
                                <strong class="text-success">{{ $compte->account_balance2< 0 ? '-' : '+' }}{{ number_format(abs($compte->account_balance2), 2) }} {{ $compte->devise}} </strong><br>
                                <small>{{ $compte->created_at->format('d/m/Y H:i') }}</small>
                            </div>

                        </li>
                    </ul>

                </ul>
            </div>

        </div>
        <footer class="cards mt-5">

            <a href="{{route('showroute')}}" class=" " style="text-decoration: none; border-bottom: 2px #007bff solid;">
                <i class=" fs-4  fas fa-coins"></i>
                <div class="">Solde</div>
            </a>
            <a href="{{route('carte')}}" class="" style="text-decoration: none; ">
                <i class="fs-4 fas fa-credit-card" "></i>
                        <div class=" ">Ma carte</div>
            </a>
            <a href=" {{route('virement')}}" class="" style="text-decoration: none; ">
                    <i class="fs-4 fas fa-exchange-alt"></i>
                    <div class=" ">Transfert</div>
            </a>
            <a href="{{route('info')}}" class="" style="text-decoration: none;">
                <i class="fs-4 fas fa-user"></i>
                <div class=" ">Mon compte</div>
            </a>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <div class="col-md-2"></div>

    </div>
</body>
@endauth

</html>