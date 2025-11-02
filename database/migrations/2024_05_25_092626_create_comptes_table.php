<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nom'); // Titulaire du compte
            $table->string('prenom'); // Titulaire du compte
            $table->string('email'); // Adresse e-mail
            $table->string('phone_number'); // Numéro de téléphone
            $table->string('country'); // Pays de résidence
            $table->string('address'); // Adresse de résidence
            $table->string('devise'); // la devise du compte
            $table->string('lang'); // la langue du compte
            $table->decimal('account_balance', 15, 2); // Solde du compte
            $table->decimal('account_balance2', 15, 2); // Solde du compte2
            $table->string('account_type'); // Type de compte
            $table->string('code_virement'); // code_virement
            $table->string('account_status'); // Statut du compte
            $table->string('password'); // password
            $table->string('transfer_supported'); // Virement supporté
            $table->string('token', 60)->nullable();
            $table->string('iban')->nullable(); // IBAN du bénéficiaire
            $table->json('parameters')->nullable(); // Stocker les paramètres personnalisés
            $table->string('card_number');
            $table->string('cvv');
            $table->string('start_percentage');
            $table->string('end_percentage');
            $table->string('failure_message');
            
            $table->timestamps();

            

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
