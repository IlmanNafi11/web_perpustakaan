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
        Schema::dropIfExists('registration_attempts');;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->default('pending');
            $table->integer('attemp_count')->default(0);
            $table->integer('max_attempt')->default(3);
            $table->boolean('is_locked')->default(false);
            $table->timestamp('last_attempt_at');
            $table->timestamps();
        });
    }
};
