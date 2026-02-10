<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'fecha_pedido',
        'nombre_cliente',
        'tlf_cliente',
        'email_cliente',
        'direccion_envio',
        'metodo_pago',
        'estado',
        'precio_pedido',
    ];

    protected $casts = [
        'fecha_pedido' => 'date',
        'precio_pedido' => 'decimal:2',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'linea_pedido')
            ->withPivot('cantidad', 'formato', 'precio_unitario')
            ->withTimestamps();
    }
}
