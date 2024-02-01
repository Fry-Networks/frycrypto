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
            $table->string('transaction_id')->unique();
            $table->string('sender');
            $table->string('tx_type');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('confirmed_round');
            $table->unsignedBigInteger('round_time');
            $table->decimal('amount', 20, 6)->nullable(); // Assuming you extract the amount
            $table->string('receiver')->nullable(); // Assuming you extract the receiver address
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
