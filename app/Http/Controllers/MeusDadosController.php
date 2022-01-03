<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class MeusDadosController extends Controller
{
    public function index(){
        $dados = new stdClass;
        $dados->user = Auth::user();
        return view('admin.meusdados', compact('dados'));
    }
}
