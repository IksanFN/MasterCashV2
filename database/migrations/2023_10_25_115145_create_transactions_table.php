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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('year_id')->references('id')->on('years')->cascadeOnDelete();
            $table->foreignId('month_id')->references('id')->on('months')->cascadeOnDelete();
            $table->foreignId('week_id')->references('id')->on('weeks')->cascadeOnDelete();
            $table->foreignId('payment_account_id')->nullable();
            $table->string('bill_code')->unique();
            $table->string('transaction_code')->unique()->nullable();
            $table->unsignedBigInteger('bill');
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_cancel')->default(false);
            $table->enum('payment_status', ['Waiting', 'Cancel', 'Pending', 'Paid', 'Verified', 'Process', 'Unpaid'])->default('Unpaid');
            $table->timestamp('payment_date')->nullable();
            $table->string('user_payment')->nullable();
            $table->boolean('payment_verified')->default(false);
            $table->string('payment_receipt')->nullable();
            $table->string('payment_description')->nullable();
            $table->string('message_verification')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_date')->nullable();
            $table->timestamp('cancel_date')->nullable();
            $table->string('user_cancel')->nullable();
        
            $table->foreign('payment_account_id')->references('id')->on('payment_accounts')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
