<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoCompraController extends Controller
{
    public function index(){
        $user = Auth::user();
        $pedidos = Pedido::where('codusuario', $user->id)->get();
        return view('historico', compact('pedidos'));
    }

    public function detalhe($id){
        $pedido = Pedido::find($id);
        return view('historicodetalhe', compact('pedido'));
    }
}
