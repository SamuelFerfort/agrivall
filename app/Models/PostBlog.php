<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostBlog extends Model
{
    protected $table = 'posts_blog';

    protected $fillable = [
        'titulo',
        'noticia',
        'fecha_public',
        'imagen',
        'tipo_post_id',
    ];

    protected $casts = [
        'fecha_public' => 'date',
    ];

    public function tipoPost()
    {
        return $this->belongsTo(TipoPost::class, 'tipo_post_id');
    }
}
