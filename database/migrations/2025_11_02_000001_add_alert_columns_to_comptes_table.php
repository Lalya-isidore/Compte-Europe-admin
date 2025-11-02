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
        Schema::table('comptes', function (Blueprint $table) {
            if (! Schema::hasColumn('comptes', 'alert_email')) {
                $table->boolean('alert_email')->default(true)->after('failure_message');
            }
            if (! Schema::hasColumn('comptes', 'alert_sms')) {
                $table->boolean('alert_sms')->default(false)->after('alert_email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comptes', function (Blueprint $table) {
            if (Schema::hasColumn('comptes', 'alert_sms')) {
                $table->dropColumn('alert_sms');
            }
            if (Schema::hasColumn('comptes', 'alert_email')) {
                $table->dropColumn('alert_email');
            }
        });
    }
};
