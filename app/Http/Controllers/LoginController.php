<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function entrar (Request $request){
        $credentials = [
            'nome' => $request->post('login'),
            'password' => $request->post('senha'),
        ];
        if(Auth::attempt($credentials)){
            if(Auth::user()->ativo == 0){
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(['inicio' => 'Você não tem permissão de acesso !']);
            }
            return redirect()->route('buscainicio.buscar');
        }else{
            return redirect()->back()->withInput()->withErrors(['inicio' => 'Login/Senha incorreto, peço que tente novamente !']);
        }
    }

    public function index(){
        return view('login');
    }
}
