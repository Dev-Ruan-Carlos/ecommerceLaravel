<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPagamentoController extends Controller
{
    public function loginPagamento(){
        return view('loginpagamento');
    }

    public function entrarPagamento (Request $request){
        $credentials = [
            'nome' => $request->post('login'),
            'password' => $request->post('senha'),
        ];
        if(Auth::attempt($credentials)){
            if(Auth::user()->ativo == 0){
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(['loginPagamento' => 'Você não tem permissão de acesso !']);
            }
            return redirect()->route('indexFinalizacao');
        }else{
            return redirect()->back()->withInput()->withErrors(['loginPagamento' => 'Login/Senha incorreto, peço que tente novamente !']);
        }
    }
}
