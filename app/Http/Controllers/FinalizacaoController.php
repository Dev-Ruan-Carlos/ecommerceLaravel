<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalizacaoController extends Controller
{
    public function indexFinalizacao($id) {
        $pedido = Pedido::find($id);
        return view('finalizacao', compact('pedido'));
    }
    
    public function cancelarPedido($id) {
        $pedidoEmitido = Pedido::where('controle', $id)->get()->first();
        $pedidoEmitido->status = 'Cancelado';
        $pedidoEmitido->save();
        return redirect()->back()->with(['finalizacao' => 'Pedido cancelado com sucesso !']);
    }
}
