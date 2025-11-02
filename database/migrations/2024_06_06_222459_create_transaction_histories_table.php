<?php
// database/migrations/xxxx_xx_xx_create_transaction_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('transaction_type'); // e.g., 'Transfer received', 'Transfer Add ', 'Transfer sent', 'Refund received'
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->text('devise');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_histories');
    }
}
