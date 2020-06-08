<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//a classe abaixo me ajudará quanto a atualização de email de usuários
//ou atualização de usuários quando o email existir e o dados estiver vindo junto com o bloco
use Illuminate\Validation\Rule;
use App\User;

class UsuariosController extends Controller
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
            ["titulo" => "Lista de usuários", "url" => ""]
        ]);


        $listaModelo = User::select('id', 'name', 'email')->paginate(5);


        return view('admin.usuarios.index', compact('listaMigalhas', 'listaModelo'));
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
        $data = $request->all();
        $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        $data['password'] = bcrypt($data['password']);


        $modelo = User::create($data);
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
        return User::find($id);
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
        $data = $request->all();

        if (isset($data['password']) && $data['password'] != "") {
            //atualizando senha
            $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $data['password'] = bcrypt($data['password']);
        }else{
            //atualizando somente dados, senha não
            $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            ]);
            unset($data['password']);
        }

        //$validacao = Validator::make($data, [
        //    'name' => ['required', 'string', 'max:255'],
        //    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //    'password' => ['required', 'string', 'min:8'],
        //]);
        if ($validacao->fails()) {
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        //$data['password'] = bcrypt($data['password']);

        $artigos = User::find($id)->update($data);
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
        $artigos = User::find($id)->delete();
        return redirect()->back();
    }
}
