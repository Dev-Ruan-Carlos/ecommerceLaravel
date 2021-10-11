<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalizacaoController extends Controller
{
    public function indexFinalizacao() {
        // $user = Auth::user();
        $carrinhoItem = CarrinhoItem::where('controle');
        dd($carrinhoItem);
        // return view ('finalizacao');
    }
}
