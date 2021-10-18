<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Pagamento;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EspeciePagamentoController extends Controller
{
    public function formaPagamento(Request $request, $idPedido){
        $pedido = Pedido::where('controle', $idPedido)->first();
        // $pagamento = new Pagamento();
        // $pagamento->codpedido = $pedido->controle;
        // $pagamento->nomedonocartao = $request->get('nomecartao');
        // $pagamento->numcartao = $request->get('ncartao');
        // $pagamento->numseguranca = $request->get('numseguranca');
        // $pagamento->tipocartao = $request->get('tipoPagamento');
        // $pagamento->parcelas = $request->get('parcelas');
        return view('formapagamento', compact('pedido'));
    }

    public function salvarFormaPagamento(Request $request, $idPedido){
        $pedido = Pedido::where('controle', $idPedido)->first();
        $pagamento = new Pagamento();
        $pagamento->codpedido = $pedido->controle;
        $pagamento->codespecie = 3;
        $pagamento->nomedonocartao = $request->get('nomecartao');
        $pagamento->numcartao = $request->get('ncartao');
        $pagamento->numseguranca = $request->get('numseguranca');
        $pagamento->tipocartao = $request->get('tipoPagamento');
        $pagamento->parcelas = $request->get('parcelas');
        $pagamento->save();
        return redirect()->route('historico.detalhe', $pedido->controle);
    }
}
