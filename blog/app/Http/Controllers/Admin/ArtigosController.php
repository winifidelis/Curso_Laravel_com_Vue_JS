<?php

namespace App\Http\Controllers\Admin;

use App\Artigo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => route('admin')],
            ["titulo" => "Lista de artigos", "url" => ""]
        ]);

        /* PRIMEIRA OPÇÃO PARA BUSCAR OS DADOS COM O NOME DO AUTOR
        $listaArtigos = Artigo::select('id', 'titulo', 'descricao', 'user_id', 'data')->paginate(5);

        
        foreach($listaArtigos as $key => $value){
            //A forma abaixo é uma opções de obter o nome do autor
            //$value->user_id = User::find($value->user_id)->name;
            $value->user_id = $value->user->name;
            unset($value->user);
        }
        */

        //PQ ISSO AQUI whereNull ???
        //é para remover da lista os itens deletados, ou que tivram uma data
        //significam que foram excluidos e está setado o softdelete
        //ele coloca uma data no item que foi excluido
        //se for null o item não foi excluido

        /*
        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
            ->whereNull('artigos.deleted_at')
            ->paginate(5);
        */

        //TUDO QUE ESTÁ COMENTADO ACIMA EU PASSEI PARA O MODELO, ASSIM É MAIS FÁCIL A MANUTENÃO

        $listaArtigos = Artigo::listaArtigos(5);



        return view('admin.artigos.index', compact('listaMigalhas', 'listaArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        $validacao = Validator::make($data, [
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }



        $artigos = Artigo::create($data);
        //a linha abaixo retorna para a ultima página
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //o laravel retornará um json
        //dd($id);
        return Artigo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $data = $request->all();
        $validacao = Validator::make($data, [
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required",
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }



        $artigos = Artigo::find($id)->update($data);
        //a linha abaixo retorna para a ultima página
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artigos = Artigo::find($id)->delete();
        //dd($artigos);
        //a linha abaixo retorna para a ultima página
        return redirect()->back();
    }
}
