<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido');
            $table->string('nombre_cliente');
            $table->string('tlf_cliente');
            $table->string('email_cliente');
            $table->string('direccion_envio');
            $table->string('metodo_pago');
            $table->string('estado')->default('iniciado');
            $table->decimal('precio_pedido', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
