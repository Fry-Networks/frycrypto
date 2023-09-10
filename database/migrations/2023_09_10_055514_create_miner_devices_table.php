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
        Schema::create('miner_devices', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('license_number')->nullable();
            $table->string('order_number')->nullable();
            $table->string('algorand_address');
            $table->string('first_and_last_name')->nullable();
            $table->string('miner_key')->nullable();
            $table->string('byod_license_key')->nullable();
            $table->string('imei_number')->nullable();
            $table->enum('type', [
                'Indoor Decibel',
                'Indoor Decibel BYOD',
                'Indoor Pebble',
                'Bandwidth Hardware',
                'Satellite Hardware',
                'Satellite BYOD',
                'Bandwidth BYOD',
                'Other'
            ])->default('Other');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miner_devices');
    }
};
