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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn');
            $table->string('descriptions');
            $table->integer('quantity')->default(0);
            $table->boolean('available')->default(false);
            $table->year('year');
            $table->string('publisher');
            $table->string('language')->default('indonesia');
            $table->string('type');
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
