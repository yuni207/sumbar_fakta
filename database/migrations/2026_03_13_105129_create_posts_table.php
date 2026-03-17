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
            $table->string('category'); // Politik, Ekonomi, dll
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('author');
            $table->date('release_date');
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable(); // Untuk link YouTube
            $table->enum('type', ['video', 'artikel', 'breaking'])->default('artikel');
            $table->timestamps();
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
