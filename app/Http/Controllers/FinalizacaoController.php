<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalizacaoController extends Controller
{
    public function indexFinalizacao() {
        return view('finalizacao')
    }
}
