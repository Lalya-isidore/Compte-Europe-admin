<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.connexion');
});
use App\Http\Controllers\CompteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SousCompteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VirementController;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

// Root route now points to the users connexion view



Route::middleware(['guest'])->group(function () {

    Route::get('inscription', [UserController::class, 'inscriptionRoute'])->name('inscription');
    Route::get('connexion', [UserController::class, 'connexionRoute'])->name('connexion');
    Route::get('connexion', [UserController::class, 'connexionRoute'])->name('login');
    Route::post('connexion', [UserController::class, 'connexion'])->name('connexion');
    Route::post('inscription', [UserController::class, 'inscription'])->name('inscription');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    // Route::post('/pages', [PageController::class, 'store'])->name('pages.store');

    // Route::get('/pages/show', [compteController::class, 'show'])->name('pagesshow');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    // Liste des comptes de l'utilisateur
    Route::get('/compte', [CompteController::class, 'compteview'])->name('compte.view');
    // Formulaire de création (affiche la vue de création)
    Route::get('/compte/create', [CompteController::class, 'compteview'])->name('compte.create');
    // Enregistrement du compte (soumission du formulaire)
    Route::post('/compte', [CompteController::class, 'comptecreate'])->name('compte.store');
    
});

//les route pour la connexion aux sous compte
// Route::get('/compte/login', [sousCompteController::class, 'sousComptelogin'])->name('sousCompte.login');
// Route::post('/compte/login',  [sousCompteController::class, 'sousCompteAuth'])->name('sousCompte.Auth');
// Route::get('/compte/{token}', [sousCompteController::class, 'show'])->name('pages.show');




    //Les routes pour editer les comptes

// Route pour afficher le formulaire de mise à jour
// Route::get('/compte/{id}', [sousCompteController::class, 'edit'])->name('pages.edit');

// Route pour traiter la mise à jour
Route::put('/compte/{id}', [SousCompteController::class, 'update'])->name('compte.edit');



Route::middleware(['auth'])->group(function () {
    Route::post('/logoutSous', [SousCompteController::class, 'logoutSous'])->name('logoutSous');
});


//les route pour acceder au diferent pages des sous comptes
// Route::get('/pages/carte', [sousCompteController::class, 'carte'])->name('carte');
// Route::get('/pages/info', [sousCompteController::class, 'info'])->name('info');
// Route::get('/pages/virement', [sousCompteController::class, 'virement'])->name('virement');
// Route::get('/pages/show', [sousCompteController::class, 'showroute'])->name('showroute');


// Route::post('/pages/virement', [VirementController::class, 'store'])->name('storeVirement');
// Route::get('/pages/virementDetail/{id}', [VirementController::class, 'virementDetail'])->name('virementDetail');

// Route::get('/pages/confirmVirement/{id}', [VirementController::class, 'confirmVirement'])->name('confirmVirement');
// web.php
// Route::post('/virement-confirmation', [VirementController::class, 'showConfirmation'])->name('virementConfirmation');
// Route::get('/virement-confirmation', [VirementController::class, 'showConfirmation'])->name('virementConfirmation');
// Route::get('/pages/virementDetail', [VirementController::class, 'virementDetailRoute2'])->name('virementDetailRoute2');
// Route::post('/pages/virementDetail', [VirementController::class, 'virementDetailRoute2'])->name('virementDetailRoute2');
// Route::post('/pages/virementDetail/{id}', [VirementController::class, 'virementDetail'])->name('virementDetail');


//pour la balance du compte a zero
Route::post('/compte/update-balance-to-zero/{id}', [VirementController::class, 'updateBalanceToZero'])->name('compte.updateBalanceToZero');

// Route pour le remboursement du compte
Route::get('/check-transfer/{id}', [SousCompteController::class, 'checkTransferExistence']);



Route::post('/rembourser/{compteId}', [CompteController::class, 'rembourser'])->name('rembourser');
// routes/web.php

Route::post('/rembourser-compte/{id}', [CompteController::class, 'rembourserCompte'])->name('rembourser.compte');
Route::post('/envoyerEmail/{id}', [CompteController::class, 'envoyerEmail'])->name('envoyerEmail');
Route::post('/envoyerCodeDeblocage/{id}', [CompteController::class, 'envoyerCodeDeblocage'])->name('envoyerCodeDeblocage');


// routes/web.php
Route::post('/send-failure-email/{compteId}', [VirementController::class, 'sendFailureEmail'])->name('sendFailureEmail');

Route::get('/compte/{id}/details', [CompteController::class, 'getCompteDetails']);

// Route::get('/compte/{id}/edit',[compteController::class, 'edit'])->name('compte.edit');

Route::put('/update-status/{id}', [CompteController::class, 'updateStatus'])->name('update.status');
Route::put('/update-solde/{id}', [CompteController::class, 'updateSolde'])->name('update.solde');
Route::put('/diminuer-solde/{id}', [CompteController::class, 'diminuerSolde'])->name('diminuer.solde');
Route::put('/modifier-pourcentages/{id}', [CompteController::class, 'modifierPourcentages'])->name('modifier.pourcentages');
Route::put('/modifier-failuremessage/{id}', [CompteController::class, 'modifierfailuremessage'])->name('modifier.failuremessage');

// Auth::routes();
// If you need Laravel UI auth scaffolding, run: composer require laravel/ui

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// routes/web.php
Route::get('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');


// Route pour le remboursement du compte
Route::get('/check-transfer/{id}', [SousCompteController::class, 'checkTransferExistence']);



// duplicate rembourser route removed (already defined above)
// routes/web.php

Route::post('public/rembourser-compte/{id}', [CompteController::class, 'rembourserCompte'])->name('rembourser.compte');
Route::post('public/envoyerEmail/{id}', [CompteController::class, 'envoyerEmail'])->name('envoyerEmail');
Route::post('public/envoyerCodeDeblocage/{id}', [CompteController::class, 'envoyerCodeDeblocage'])->name('envoyerCodeDeblocage');


Route::get('/api/comptes/{id}', [CompteController::class, 'getCompteDetails'])->name('comptes.details');
Route::post('/envoyerEmail/{id}', [CompteController::class, 'envoyerEmail'])->name('comptes.envoyerEmail');
Route::post('/envoyerCodeDeblocage/{id}', [CompteController::class, 'envoyerCodeDeblocage'])->name('comptes.envoyerCodeDeblocage');
Route::post('/rembourser-compte/{id}', [CompteController::class, 'rembourserCompte'])->name('comptes.rembourserCompte');

Route::get('/comptes/{id}/hasCompletedTransfer', [CompteController::class, 'hasCompletedTransfer'])->name('comptes.hasCompletedTransfer');

// routes/web.php
Route::post('/send-failure-email/{compteId}', [VirementController::class, 'sendFailureEmail'])->name('sendFailureEmail');

Route::get('/compte/{id}', [CompteController::class, 'getCompteDetails']);



Route::put('/update-status/{id}', [CompteController::class, 'updateStatus'])->name('update.status');
Route::put('/update-solde/{id}', [CompteController::class, 'updateSolde'])->name('update.solde');
Route::put('/diminuer-solde/{id}', [CompteController::class, 'diminuerSolde'])->name('diminuer.solde');
Route::put('/modifier-pourcentages/{id}', [CompteController::class, 'modifierPourcentages'])->name('modifier.pourcentages');
Route::put('/modifier-failuremessage/{id}', [CompteController::class, 'modifierfailuremessage'])->name('modifier.failuremessage');

Route::delete('/delete-account/{id}', [CompteController::class, 'destroy'])->name('account.destroy');

// route de paiement

Route::post('/payement5000/{id}', [CompteController::class, 'payement5000'])->name('payement.5000');
    Route::post('/payement10000/{id}', [CompteController::class, 'payement10000'])->name('payement.10000');
    Route::post('/payement25000/{id}', [CompteController::class, 'payement25000'])->name('payement.25000');
    Route::post('/payement50000/{id}', [CompteController::class, 'payement50000'])->name('payement.50000');