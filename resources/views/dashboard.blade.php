@extends('layouts.app')

@section('page-content')
@php
    $user = auth()->user();
    $creditDisponible = $user->credit_user ?? 0;
    $totalComptes = $user ? \App\Models\Compte::where('user_id', $user->id)->count() : 0;
    $hasAlertSmsColumn = \Illuminate\Support\Facades\Schema::hasColumn('comptes', 'alert_sms');
    $comptesSms = ($user && $hasAlertSmsColumn)
        ? \App\Models\Compte::where('user_id', $user->id)->where('alert_sms', true)->count()
        : 0;
    $comptesActifs = $user ? \App\Models\Compte::where('user_id', $user->id)->where('account_status', 'Activé')->count() : 0;
@endphp

<div class="dashboard-shell">
    <section class="dashboard-hero">
        <div class="hero-copy">
            <span class="hero-eyebrow">Bonjour {{ $user ? $user->name : 'Admin' }}</span>
            <h1 class="hero-title">Votre tableau de bord Compte Europe</h1>
            <p class="hero-subtitle">Pilotez vos Flash Comptes, suivez les alertes clients et restez concentré sur l'essentiel : une expérience fluide pour vos utilisateurs.</p>
            <div class="hero-actions">
                <a href="{{ route('compte.create') }}" class="hero-btn hero-btn--primary">
                    <i class="fas fa-bolt"></i>
                    Créer un nouveau Flash Compte
                </a>
                <a href="{{ route('compte.view') }}" class="hero-btn hero-btn--ghost">
                    <i class="fas fa-layer-group"></i>
                    Voir mes comptes existants
                </a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="hero-stat-card">
                <span class="stat-label">Crédits disponible</span>
                <span class="stat-value">{{ number_format($creditDisponible, 0, ',', ' ') }}</span>
                <span class="stat-foot">Crédits prêts à être investis</span>
            </div>
            <div class="hero-stat-card">
                <span class="stat-label">Comptes actifs</span>
                <span class="stat-value">{{ number_format($comptesActifs, 0, ',', ' ') }}</span>
                <span class="stat-foot">Visibles et opérationnels</span>
            </div>
            <div class="hero-stat-card">
                <span class="stat-label">Alertes SMS Pro</span>
                <span class="stat-value">{{ number_format($comptesSms, 0, ',', ' ') }}</span>
                <span class="stat-foot">Clients suivis en temps réel</span>
            </div>
        </div>
    </section>

    <section class="insight-grid">
        <article class="insight-card">
            <div class="insight-icon insight-icon--blue">
                <i class="fas fa-wand-magic-sparkles"></i>
            </div>
            <div class="insight-body">
                <h2>Flux rapide</h2>
                <p>Créez ou mettez à jour un Flash Compte en quelques clics tout en conservant la cohérence des alertes e-mail et SMS.</p>
            </div>
            <a href="{{ route('compte.create') }}" class="insight-link">Accéder au formulaire</a>
        </article>

        <article class="insight-card">
            <div class="insight-icon insight-icon--green">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="insight-body">
                <h2>{{ $totalComptes }} comptes pilotés</h2>
                <p>Gardez une vue consolidée de vos comptes et identifiez rapidement ceux nécessitant une intervention.</p>
            </div>
            <a href="{{ route('compte.view') }}" class="insight-link">Voir la liste détaillée</a>
        </article>

        <article class="insight-card">
            <div class="insight-icon insight-icon--purple">
                <i class="fas fa-bell"></i>
            </div>
            <div class="insight-body">
                <h2>Alertes client proactives</h2>
                <p>Configurez des notifications personnalisées pour engager vos clients et sécuriser leurs opérations.</p>
            </div>
            <a href="{{ route('compte.create') }}#infoModal" class="insight-link">Configurer les alertes</a>
        </article>
    </section>

    <section class="next-steps">
        <div class="next-steps__header">
            <h3>Prochaines étapes suggérées</h3>
            <span>Optimisez votre gestion quotidienne</span>
        </div>
        <div class="next-steps__list">
            <div class="step-item">
                <div class="step-icon step-icon--primary"><i class="fas fa-sync"></i></div>
                <div class="step-content">
                    <h4>Mettre à jour les pourcentages de virement</h4>
                    <p>Ajustez les pourcentages de progression pour aligner vos flux clients sur les opérations récentes.</p>
                </div>
                <a href="{{ route('compte.create') }}#infoModal" class="step-action">Ouvrir les détails</a>
            </div>
            <div class="step-item">
                <div class="step-icon step-icon--warning"><i class="fas fa-comment-dots"></i></div>
                <div class="step-content">
                    <h4>Actualiser les messages d'échec</h4>
                    <p>Personnalisez les messages visibles par vos clients pour anticiper leurs demandes de support.</p>
                </div>
                <a href="{{ route('compte.create') }}#failuremessage" class="step-action">Mettre à jour</a>
            </div>
            <div class="step-item">
                <div class="step-icon step-icon--success"><i class="fas fa-envelope-open-text"></i></div>
                <div class="step-content">
                    <h4>Renforcer la communication</h4>
                    <p>Profitez des alertes e-mail gratuites pour envoyer des confirmations et des rappels ciblés.</p>
                </div>
                <a href="{{ route('compte.create') }}#envoyer-email-form" class="step-action">Envoyer un e-mail</a>
            </div>
        </div>
    </section>
</div>

<style>
    .dashboard-shell {
        max-width: 1180px;
        margin: 0 auto 3rem;
        padding: 0 1.5rem;
    }

    .dashboard-hero {
        background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.05)),
                    linear-gradient(120deg, #1f68ff 0%, #4257ff 45%, #5f3bff 100%);
        border-radius: 28px;
        padding: 3rem;
        color: #f7f9ff;
        box-shadow: 0 25px 55px rgba(35, 73, 255, 0.2);
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
        gap: 2.5rem;
        margin-top: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        inset: 20% -10% auto auto;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        filter: blur(0);
        transform: rotate(25deg);
    }

    .hero-copy {
        position: relative;
        z-index: 1;
    }

    .hero-eyebrow {
        text-transform: uppercase;
        letter-spacing: 0.12rem;
        font-weight: 600;
        font-size: 0.78rem;
        opacity: 0.8;
    }

    .hero-title {
        font-size: clamp(1.9rem, 3vw, 2.6rem);
        font-weight: 800;
        margin: 1rem 0 1.25rem;
    }

    .hero-subtitle {
        font-size: 1.02rem;
        line-height: 1.6;
        opacity: 0.92;
        margin-bottom: 1.75rem;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.85rem;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        border-radius: 999px;
        padding: 0.75rem 1.4rem;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hero-btn i {
        font-size: 1.05rem;
    }

    .hero-btn--primary {
        background: #fff;
        color: #1f68ff;
        box-shadow: 0 12px 25px rgba(20, 53, 165, 0.25);
    }

    .hero-btn--primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(20, 53, 165, 0.28);
    }

    .hero-btn--ghost {
        background: rgba(255, 255, 255, 0.18);
        color: #f7f9ff;
        border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .hero-btn--ghost:hover {
        transform: translateY(-1px);
        background: rgba(255, 255, 255, 0.28);
    }

    .hero-stats {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 1rem;
    }

    .hero-stat-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 22px;
        padding: 1.2rem 1.4rem;
        backdrop-filter: blur(8px);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.18);
    }

    .stat-label {
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.08rem;
        opacity: 0.75;
        font-weight: 600;
    }

    .stat-value {
        font-size: 1.9rem;
        font-weight: 800;
        display: block;
        margin: 0.35rem 0;
    }

    .stat-foot {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .insight-grid {
        margin-top: 2.75rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .insight-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 1.8rem;
        box-shadow: 0 12px 32px rgba(15, 42, 100, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .insight-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 1.2rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .insight-icon--blue { background: linear-gradient(140deg, #4facfe, #38c0ff); }
    .insight-icon--green { background: linear-gradient(140deg, #43e97b, #38f9d7); }
    .insight-icon--purple { background: linear-gradient(140deg, #a18cd1, #fbc2eb); }

    .insight-body h2 {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0c1f4b;
    }

    .insight-body p {
        color: #4a5876;
        line-height: 1.55;
        font-size: 0.98rem;
    }

    .insight-link {
        color: #1f68ff;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .insight-link::after {
        content: '\f061';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        font-size: 0.85rem;
        transition: transform 0.2s ease;
    }

    .insight-link:hover::after {
        transform: translateX(4px);
    }

    .next-steps {
        background: #ffffff;
        border-radius: 24px;
        padding: 2.25rem;
        margin-top: 3rem;
        box-shadow: 0 14px 34px rgba(15, 42, 100, 0.08);
    }

    .next-steps__header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 1.75rem;
    }

    .next-steps__header h3 {
        font-weight: 700;
        font-size: 1.3rem;
        margin: 0;
    }

    .next-steps__header span {
        color: #6c7a99;
        font-size: 0.95rem;
    }

    .next-steps__list {
        display: flex;
        flex-direction: column;
        gap: 1.4rem;
    }

    .step-item {
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 1.2rem;
        padding: 1.1rem 1.3rem;
        border-radius: 18px;
        background: #f5f7fb;
    }

    .step-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 1.15rem;
    }

    .step-icon--primary { background: linear-gradient(130deg, #1f68ff, #57c0ff); }
    .step-icon--warning { background: linear-gradient(130deg, #ff9a44, #ff6b6b); }
    .step-icon--success { background: linear-gradient(130deg, #00c6ff, #0072ff); }

    .step-content h4 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .step-content p {
        margin: 0;
        color: #5c6789;
        font-size: 0.95rem;
    }

    .step-action {
        color: #1f68ff;
        font-weight: 600;
        text-decoration: none;
    }

    .step-action:hover {
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .dashboard-hero {
            grid-template-columns: 1fr;
            padding: 2.5rem 2rem;
        }

        .hero-stats {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .step-item {
            grid-template-columns: 1fr;
            text-align: left;
        }

        .step-action {
            justify-self: start;
        }
    }

    @media (max-width: 576px) {
        .dashboard-shell {
            padding: 0 1rem;
        }

        .dashboard-hero {
            padding: 2.2rem 1.6rem;
        }

        .hero-actions {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
@endsection