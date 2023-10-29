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
        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('account_name');
            $table->string('account_title')->nullable();
            $table->string('account_number')->unique()->nullable();
            $table->enum('account_type', ['Bank', 'E-Wallet', 'Treasurer Wallet']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_accounts');
    }
};
