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
        Schema::create('_campay_webhook_log', function (Blueprint $table) {
            $table->id();
            $table->string('campay_reference')->nullable();
            $table->json('payload')->nullable();
            $table->string('status_received')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_campay_webhook_log');
    }
};
