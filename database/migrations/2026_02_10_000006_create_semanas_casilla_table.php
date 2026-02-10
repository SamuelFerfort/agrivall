<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semanas_casilla', function (Blueprint $table) {
            $table->id();
            $table->integer('anyo');
            $table->integer('numero_sem');
            $table->string('descriptor');
            $table->decimal('precio', 8, 2);
            $table->string('estado')->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semanas_casilla');
    }
};
