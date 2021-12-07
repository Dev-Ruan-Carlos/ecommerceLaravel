<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    public function index(){
        return view('login');
    }

    public function buscarProdutos(Request $request){
        $user = Auth::user();
        $produto = Produto::get();
        if($request->get('buscar')){
            $busca = $request->get('buscar');
            $buscaProduto = Produto::where('produto', 'LIKE', '%'.$busca.'%')
                                    ->orWhere('codbarras', 'LIKE', '%'.$busca.'%')
                                    ->orderBy('produto')->get();
        }
        $buscaProduto = Produto::get();
        return view('welcome', compact('produto', 'user', 'buscaProduto'));
    }

}
