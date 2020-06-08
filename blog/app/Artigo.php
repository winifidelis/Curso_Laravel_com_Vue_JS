<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\User;

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

    public function user()
    {
        return $this->belongsTo(User::class);
        //CASO AS CHAVES NÃO ESTEJAM NO PADRÃO DO LARAVEL
        //EU FAÇO COMO AL INHA ABAIXO
        //return $this->belongsTo('User','user_id');
        //user_id --> PADRÃO LARAVEL
    }

    public static function listaArtigos($paginate)
    {
        /*
        $listaArtigos = Artigo::select('id', 'titulo', 'descricao', 'user_id', 'data')->paginate($paginate);

        foreach ($listaArtigos as $key => $value) {
            //A forma abaixo é uma opções de obter o nome do autor
            //$value->user_id = User::find($value->user_id)->name;
            $value->user_id = $value->user->name;
            unset($value->user);
        }
        */

        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
            ->whereNull('artigos.deleted_at')
            ->paginate($paginate);

        return $listaArtigos;
    }

    public static function listaArtigosSite($paginate)
    {

        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data')
            ->whereNull('artigos.deleted_at')
            ->whereDate('data','<=',date('Y-m-d'))
            ->orderBy('data','DESC')
            ->paginate($paginate);
            
        return $listaArtigos;
    }
}
