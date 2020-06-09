<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Artigo;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo" => "Admin", "url" => ""]
        ]);

        $totalUsuarios = User::count();
        $totalArtigos = Artigo::count();
        $totalAutores = User::where('autor','=','S')->count();
        $totalAdmin = User::where('admin','=','S')->count();

        return view('admin', compact('listaMigalhas', 'totalUsuarios', 'totalArtigos', 'totalAutores', 'totalAdmin'));
    }
}
