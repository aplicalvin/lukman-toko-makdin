<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->timestamp('expires_at');
            $table->enum('status', ['active', 'used', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_sessions');
    }
};