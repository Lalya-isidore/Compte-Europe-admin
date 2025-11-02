@extends('./../layouts/app')
@section('page-content')
    @if (session()->has('success'))
        <div class="alert alert-success"> {{ session()->get('success') }} </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger"> {{ session()->get('error') }} </div>
    @endif
    <div class="container">
        <div class="heading">Confirmer le mot de passe</div>
        <p class="text-center">{{ __('Please confirm your password before continuing.') }}</p>
        <form action="{{ route('password.confirm') }}" method="post" class="form-product form">
            @csrf
            <input type="password" placeholder="Password" class="form-control my-2 input @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password">
            @error('password')
                <div class="text text-danger">
                    {{ $message }}
                </div>
            @enderror
            <input value="Confirmer le mot de passe" type="submit" class="login-button" />

            @if (Route::has('password.request'))
                <span class="forgot-password"><a href="{{ route('password.request') }}">Mot de passe oublié?</a></span>
            @endif
        </form>
    </div>

    <style>
        .container {
            height: 100%;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            max-width: 350px;
            background: #f8f9fd;
            background: linear-gradient(0deg, rgb(255, 255, 255) 0%, rgb(244, 247, 251) 100%);
            border-radius: 40px;
            padding: 25px 35px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
            margin-top: 50px;
        }

        .heading {
            text-align: center;
            font-weight: 900;
            font-size: 30px;
            color: rgb(16, 137, 211);
        }

        .form {
            margin-top: 20px;
        }

        .form .input {
            width: 100%;
            background: white;
            border: none;
            padding: 15px 20px;
            border-radius: 20px;
            margin-top: 15px;
            box-shadow: #cff0ff 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
        }

        .form .input::-moz-placeholder {
            color: rgb(170, 170, 170);
        }

        .form .input::placeholder {
            color: rgb(170, 170, 170);
        }

        .form .input:focus {
            outline: none;
            border-inline: 2px solid #12b1d1;
        }

        .form .login-button {
            display: block;
            width: 100%;
            font-weight: bold;
            background: linear-gradient(45deg, rgb(16, 137, 211) 0%, rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;
            margin: 20px auto;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .form .login-button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .form .login-button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .form .forgot-password {
            display: block;
            margin-top: 10px;
            margin-left: 10px;
            text-align: center;
        }

        .form .forgot-password a {
            font-size: 11px;
            color: #0099ff;
            text-decoration: none;
        }

        /* Media query for larger screens */
        @media (min-width: 768px) {
            .container {
                max-width: 500px;
                /* Adjust the max-width for larger screens */
            }
        }

        @media (min-width: 1024px) {
            .container {
                max-width: 600px;
                /* Further adjust the max-width for even larger screens */
            }
        }
    </style>
@endsection
