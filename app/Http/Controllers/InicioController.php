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

    public function buscarProdutos(){
        $user = Auth::user();
        $produto = Produto::get();
        return view('welcome', compact('produto', 'user'));
    }

}
