<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemanaCasilla extends Model
{
    protected $table = 'semanas_casilla';

    protected $fillable = [
        'anyo',
        'numero_sem',
        'descriptor',
        'precio',
        'estado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];
}
