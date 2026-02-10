<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPost extends Model
{
    protected $table = 'tipo_posts';

    protected $fillable = ['tipo'];

    public function posts()
    {
        return $this->hasMany(PostBlog::class, 'tipo_post_id');
    }
}
