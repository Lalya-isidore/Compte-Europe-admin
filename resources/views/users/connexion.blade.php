@extends('./../layouts/app')
@section('page-content')
    <div class="auth-wrapper">
        <div class="auth-illustration">
            <span class="auth-illustration__badge">NOUVEAUTÉ</span>
            <h2>FlashCompte, votre tableau de bord financier</h2>
            <p>Suivez vos comptes, transferts et remboursements sur une interface simple et sécurisée.</p>
            <ul class="auth-highlights">
                <li>
                    <span class="auth-highlights__icon">01</span>
                    <span class="auth-highlights__text">Sécurité multi-niveaux et notifications instantanées.</span>
                </li>
                <li>
                    <span class="auth-highlights__icon">02</span>
                    <span class="auth-highlights__text">Création de comptes flash en quelques secondes.</span>
                </li>
                <li>
                    <span class="auth-highlights__icon">03</span>
                    <span class="auth-highlights__text">Historique clair pour vos virements et remboursements.</span>
                </li>
            </ul>
        </div>
        <div class="auth-card">
            @if (session()->has('success'))
                <div class="auth-alert alert-success">{{ session()->get('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="auth-alert alert-danger">{{ session()->get('error') }}</div>
            @endif

            <div class="auth-card__header">
                <span class="auth-card__eyebrow">Heureux de vous revoir</span>
                <h1>Connexion</h1>
                <p>Connectez-vous pour alimenter vos comptes flash et suivre vos opérations en temps réel.</p>
            </div>

            <form action="{{ route('connexion') }}" method="post" class="auth-form">
                @csrf
                <div class="auth-form__field">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-wrapper">
                        <span class="input-icon">@</span>
                        <input type="email" id="email" name="email" class="input-control"
                               placeholder="nom.prenom@email.com"
                               value="{{ old('email') }}" autocomplete="email" required>
                    </div>
                    @error('email')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__field">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <span class="input-icon">•••</span>
                        <input type="password" id="password" name="password" class="input-control"
                               placeholder="Votre mot de passe sécurisé" autocomplete="current-password" required>
                        <button type="button" class="password-toggle" aria-label="Afficher le mot de passe">
                            <span class="password-toggle__label">Afficher</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__options">
                    <label class="remember">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Se souvenir de moi</span>
                    </label>
                    <a class="auth-link" href="{{ route('password.request') }}">Mot de passe oublié&nbsp;?</a>
                </div>

                <button type="submit" class="auth-button" id="auth-submit">
                    <span class="button-text">Connexion</span>
                    <span class="button-loader d-none" aria-hidden="true"></span>
                </button>

                <div class="auth-form__meta">
                    Première visite&nbsp;? <a href="{{ route('inscription') }}">Créez votre compte en un clic</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.auth-form');
            const submitButton = document.querySelector('#auth-submit');
            const buttonText = submitButton?.querySelector('.button-text');
            const loader = submitButton?.querySelector('.button-loader');

            if (form && submitButton && buttonText && loader) {
                form.addEventListener('submit', function () {
                    submitButton.disabled = true;
                    buttonText.classList.add('is-hidden');
                    loader.classList.remove('d-none');

                    setTimeout(() => {
                        if (document.querySelector('.input-error')) {
                            submitButton.disabled = false;
                            buttonText.classList.remove('is-hidden');
                            loader.classList.add('d-none');
                        }
                    }, 400);
                });
            }

            const alerts = document.querySelectorAll('.auth-alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('is-hiding');
                    setTimeout(() => alert.remove(), 250);
                }, 5000);
            });

            const inputs = document.querySelectorAll('.input-control');
            inputs.forEach(input => {
                input.addEventListener('invalid', event => {
                    event.preventDefault();
                    input.classList.add('is-invalid');
                });

                input.addEventListener('input', () => {
                    input.classList.remove('is-invalid');
                });
            });

            const toggle = document.querySelector('.password-toggle');
            const passwordInput = document.getElementById('password');
            if (toggle && passwordInput) {
                toggle.addEventListener('click', () => {
                    const show = passwordInput.type === 'password';
                    passwordInput.type = show ? 'text' : 'password';
                    toggle.classList.toggle('is-active', show);
                    const label = toggle.querySelector('.password-toggle__label');
                    if (label) {
                        label.textContent = show ? 'Masquer' : 'Afficher';
                    }
                    passwordInput.focus({ preventScroll: true });
                });
            }
        });
    </script>

    <style>
        :root {
            --auth-primary: #1664f5;
            --auth-secondary: #1bb8d2;
            --auth-accent: #f97316;
            --auth-bg: #f3f6fb;
            --auth-shadow: 0 28px 60px -40px rgba(13, 60, 120, 0.65);
        }

        .auth-wrapper {
            position: relative;
            min-height: calc(100vh - 160px);
            background: var(--auth-bg);
            padding: clamp(2.5rem, 6vw, 4.5rem) clamp(1.5rem, 4vw, 4.5rem);
            display: grid;
            gap: clamp(2rem, 5vw, 3.5rem);
            grid-template-columns: minmax(0, 1fr);
            align-items: stretch;
            overflow: hidden;
        }

        .auth-wrapper::before,
        .auth-wrapper::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(0);
            opacity: 0.35;
            z-index: 0;
        }

        .auth-wrapper::before {
            width: 360px;
            height: 360px;
            top: -120px;
            right: -120px;
            background: radial-gradient(circle at center, rgba(22, 100, 245, 0.35), transparent 65%);
        }

        .auth-wrapper::after {
            width: 420px;
            height: 420px;
            bottom: -160px;
            left: -120px;
            background: radial-gradient(circle at center, rgba(27, 184, 210, 0.28), transparent 70%);
        }

        .auth-illustration,
        .auth-card {
            position: relative;
            z-index: 1;
            border-radius: 30px;
        }

        .auth-illustration {
            background: linear-gradient(140deg, rgba(22, 100, 245, 0.97), rgba(17, 180, 209, 0.9));
            color: #ffffff;
            padding: clamp(2rem, 5vw, 3.25rem);
            box-shadow: 0 25px 60px -30px rgba(18, 76, 170, 0.55);
            display: grid;
            gap: 1.5rem;
            overflow: hidden;
        }

        .auth-illustration::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.15), transparent 60%);
            pointer-events: none;
        }

        .auth-illustration__badge {
            align-self: start;
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.12em;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            font-size: 0.78rem;
            text-transform: uppercase;
            width: fit-content;
        }

        .auth-illustration h2 {
            font-size: clamp(1.85rem, 5vw, 2.6rem);
            line-height: 1.3;
            margin: 0;
        }

        .auth-illustration p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.88);
        }

        .auth-highlights {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 1.15rem;
        }

        .auth-highlights li {
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            gap: 0.85rem;
            font-size: 0.95rem;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.92);
        }

        .auth-highlights__icon {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.2);
            display: grid;
            place-content: center;
            font-size: 0.9rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.05em;
        }

        .auth-highlights__text {
            color: inherit;
        }

        .auth-card {
            background: #ffffff;
            padding: clamp(2rem, 4vw, 3rem);
            box-shadow: var(--auth-shadow);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .auth-card__header {
            display: grid;
            gap: 0.75rem;
        }

        .auth-card__eyebrow {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: rgba(22, 100, 245, 0.9);
            font-weight: 700;
        }

        .auth-card__header h1 {
            margin: 0;
            font-size: clamp(1.9rem, 4vw, 2.35rem);
            color: #0f1f40;
        }

        .auth-card__header p {
            margin: 0;
            color: #5f6c83;
            line-height: 1.7;
        }

        .auth-alert {
            border-radius: 16px;
            padding: 0.85rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        .auth-alert.alert-success {
            background: #e8f9f2;
            color: #1f7a4d;
            border: 1px solid #bff0d6;
        }

        .auth-alert.alert-danger {
            background: #ffe9e8;
            color: #b32121;
            border: 1px solid #ffc9c6;
        }

        .auth-alert.is-hiding {
            opacity: 0;
            transform: translateY(-6px);
        }

        .auth-form {
            display: grid;
            gap: 1.3rem;
        }

        .auth-form__field label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #24304a;
            margin-bottom: 0.55rem;
            display: inline-block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 1.1rem;
            transform: translateY(-50%);
            color: #95a2c5;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.2em;
            pointer-events: none;
        }

        .input-control {
            width: 100%;
            border-radius: 18px;
            border: 1px solid transparent;
            background: #f4f6fb;
            padding: 0.9rem 1rem 0.9rem 3.25rem;
            font-size: 0.95rem;
            color: #1a2333;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .input-control:focus {
            outline: none;
            background: #ffffff;
            border-color: rgba(22, 100, 245, 0.45);
            box-shadow: 0 0 0 4px rgba(22, 100, 245, 0.15);
        }

        .input-control.is-invalid {
            border-color: rgba(239, 68, 68, 0.8);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
        }

        .input-error {
            margin: 0.4rem 0 0;
            font-size: 0.82rem;
            color: #d64545;
            font-weight: 500;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 0.6rem;
            transform: translateY(-50%);
            border: none;
            background: rgba(16, 31, 64, 0.06);
            color: #4e5a73;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .password-toggle:hover {
            background: rgba(22, 100, 245, 0.12);
            color: var(--auth-primary);
        }

        .password-toggle.is-active {
            background: rgba(22, 100, 245, 0.18);
            color: var(--auth-primary);
        }

        .auth-form__options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            cursor: pointer;
            font-weight: 500;
            color: #404b61;
        }

        .remember input {
            width: 18px;
            height: 18px;
            accent-color: var(--auth-primary);
            cursor: pointer;
        }

        .auth-link {
            color: var(--auth-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .auth-link:hover {
            color: #0f53d4;
            text-decoration: underline;
        }

        .auth-button {
            border: none;
            border-radius: 18px;
            padding: 0.95rem 1.25rem;
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, var(--auth-primary), var(--auth-secondary));
            box-shadow: 0 16px 30px -18px rgba(22, 100, 245, 0.65);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-button::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18), rgba(255, 255, 255, 0));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -22px rgba(22, 100, 245, 0.7);
        }

        .auth-button:hover::after {
            opacity: 1;
        }

        .auth-button:disabled {
            opacity: 0.65;
            transform: none;
            box-shadow: none;
            cursor: wait;
        }

        .button-text {
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .button-text.is-hidden {
            opacity: 0;
            transform: translateY(-4px);
        }

        .button-loader {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.7);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .auth-form__meta {
            text-align: center;
            font-size: 0.92rem;
            color: #5f6c83;
            margin-top: 0.25rem;
        }

        .auth-form__meta a {
            color: var(--auth-primary);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-form__meta a:hover {
            text-decoration: underline;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 991px) {
            .auth-wrapper {
                grid-template-columns: minmax(0, 1fr);
                padding: 2.5rem 1.25rem 3.5rem;
            }

            .auth-illustration {
                order: 2;
                text-align: center;
                padding: 2rem;
            }

            .auth-highlights {
                grid-template-columns: minmax(0, 1fr);
            }

            .auth-highlights li {
                justify-content: center;
                text-align: left;
            }

            .auth-card {
                order: 1;
            }
        }

        @media (max-width: 576px) {
            .auth-wrapper {
                padding: 2rem 1rem 3rem;
            }

            .auth-card {
                padding: 1.75rem 1.5rem 2rem;
            }

            .auth-form__options {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-illustration {
                padding: 1.75rem;
            }
        }
    </style>
@endsection
