<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'variedad',
        'formato',
        'precio',
        'imagen',
        'disponible',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'disponible' => 'boolean',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'linea_pedido')
            ->withPivot('cantidad', 'formato', 'precio_unitario')
            ->withTimestamps();
    }
}
