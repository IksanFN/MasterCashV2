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
        Schema::table('payment_accounts', function (Blueprint $table) {
            $table->string('for_classroom')->nullable()->after('account_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_accounts', function (Blueprint $table) {
            $table->dropColumn('for_classroom');
        });
    }
};
