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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->string('title');
            $table->longText('content');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->string('slug')->unique();
             $table->string('thumbnail')->nullable();
             $table->string('images')->nullable();
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
