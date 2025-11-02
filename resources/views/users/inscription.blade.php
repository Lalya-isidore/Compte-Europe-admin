@extends('./../layouts/app')
@section('page-content')
    <div class="auth-wrapper">
        <div class="auth-illustration">
            <span class="auth-illustration__badge">CRÉEZ VOTRE ESPACE</span>
            <h2>Une inscription rapide pour piloter tous vos comptes</h2>
            <p>Activez votre tableau de bord FlashCompte et gérez vos clients, virements et remboursements en toute simplicité.</p>
            <ul class="auth-highlights">
                <li>
                    <span class="auth-highlights__icon">01</span>
                    <span class="auth-highlights__text">Coordonnées clients centralisées et prêtes à être utilisées.</span>
                </li>
                <li>
                    <span class="auth-highlights__icon">02</span>
                    <span class="auth-highlights__text">Virements simulés, remboursements et codes de déblocage en un clic.</span>
                </li>
                <li>
                    <span class="auth-highlights__icon">03</span>
                    <span class="auth-highlights__text">Tableau de bord responsive pour travailler depuis n'importe quel support.</span>
                </li>
            </ul>
        </div>

        <div class="auth-card">
            @if (session()->has('error'))
                <div class="auth-alert alert-danger">{{ session()->get('error') }}</div>
            @endif

            <div class="auth-card__header">
                <span class="auth-card__eyebrow">Rejoignez FlashCompte</span>
                <h1>Inscription</h1>
                <p>Complétez les informations ci-dessous pour accéder à l'espace d'administration.</p>
            </div>

            <form action="{{ route('inscription') }}" method="post" class="auth-form" id="register-form">
                @csrf
                <div class="auth-form__field">
                    <label for="nom">Nom</label>
                    <div class="input-wrapper">
                        <span class="input-icon">N</span>
                        <input type="text" id="nom" name="nom" class="input-control"
                               placeholder="Dupont" value="{{ old('nom') }}" autocomplete="family-name" required>
                    </div>
                    @error('nom')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__field">
                    <label for="prenom">Prénom</label>
                    <div class="input-wrapper">
                        <span class="input-icon">P</span>
                        <input type="text" id="prenom" name="prenom" class="input-control"
                               placeholder="Alice" value="{{ old('prenom') }}" autocomplete="given-name" required>
                    </div>
                    @error('prenom')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__field">
                    <label for="email">E-mail</label>
                    <div class="input-wrapper">
                        <span class="input-icon">@</span>
                        <input type="email" id="email" name="email" class="input-control"
                               placeholder="nom.prenom@email.com" value="{{ old('email') }}"
                               autocomplete="email" required>
                    </div>
                    @error('email')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__field">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <span class="input-icon">PW</span>
                        <input type="password" id="password" name="password" class="input-control"
                               placeholder="Mot de passe sécurisé" autocomplete="new-password" required>
                        <button type="button" class="password-toggle" aria-label="Afficher le mot de passe">
                            <span class="password-toggle__label">Afficher</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="auth-button" id="register-submit">
                    <span class="button-text">Inscription</span>
                    <span class="button-loader d-none" aria-hidden="true"></span>
                </button>

                <div class="auth-form__meta">
                    Déjà membre&nbsp;? <a href="{{ route('connexion') }}">Connectez-vous</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('register-form');
            const submitButton = document.getElementById('register-submit');
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

        .auth-alert.alert-danger {
            background: #ffe9e8;
            color: #b32121;
            border: 1px solid #ffc9c6;
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

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -22px rgba(22, 100, 245, 0.7);
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
        }
    </style>
@endsection
