<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts_blog', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('noticia');
            $table->date('fecha_public');
            $table->string('imagen')->nullable();
            $table->foreignId('tipo_post_id')->constrained('tipo_posts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts_blog');
    }
};
