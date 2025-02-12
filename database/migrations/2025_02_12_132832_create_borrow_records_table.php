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
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_request_id')->references('id')->on('borrow_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('borrow_at')->useCurrent();
            $table->timestamp('return_at');
            $table->timestamp('due_date');
            $table->string('status')->default('borrowed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_records');
    }
};
