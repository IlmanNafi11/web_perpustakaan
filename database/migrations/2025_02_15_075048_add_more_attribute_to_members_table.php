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
        Schema::table('members', function (Blueprint $table) {
            $table->string('status')->default('pending');
            $table->integer('attempt_count')->default(0);
            $table->integer('max_attempt')->default(3);
            $table->boolean('is_locked')->default(false);
            $table->timestamp('last_attempt_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('attempt_count');
            $table->dropColumn('max_attempt');
            $table->dropColumn('is_locked');
            $table->dropColumn('last_attempt_at');
        });
    }
};
