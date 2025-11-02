<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('remboursements', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('compte_id');
        $table->decimal('montant', 15, 2);
        $table->timestamps();

        $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remboursements');
    }
};
