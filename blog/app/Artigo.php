<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'descricao',
        'autor',
        'conteudo',
        'data'
    ];

    protected $dates = ['deleted_at'];
}
