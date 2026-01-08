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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->longText('content');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->string('image_public_id')->nullable();
             $table->string('slug')->unique();
             $table->text('image')->nullable();
            $table->timestamp('published_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
