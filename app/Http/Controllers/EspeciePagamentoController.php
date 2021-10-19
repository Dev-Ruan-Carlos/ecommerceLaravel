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
        return view('formapagamento', compact('pedido'));
    }

    public function salvarFormaPagamento(Request $request, $idPedido){
        $pedido = Pedido::where('controle', $idPedido)->first();
        $pagamento = new Pagamento();
        $pagamentoLocal = false;
        switch ($request->get('pagamento')) {
            case 'dinheiro':
                $pagamento->codespecie = 1;
                break;
            case 'local':
                $pagamentoLocal = true;
                break;
            case 'cartao':
                if($request->get('tipoPagamento') == 1)
                    $pagamento->codespecie = 3;
                else{
                    $pagamento->nomedonocartao = $request->get('nomecartao');
                    $pagamento->numcartao = $request->get('ncartao');
                    $pagamento->numseguranca = $request->get('numseguranca');
                    $pagamento->tipocartao = $request->get('tipoPagamento');
                    $pagamento->parcelas = $request->get('parcelas');
                    $pagamento->codespecie = 2;
                }
                break;
            
            default:
                $pagamento->codespecie = 1;
                break;
        }
        $pedido->status = 'Emitido';
        $pedido->save();
        if($pagamentoLocal){
            return redirect()->route('historico.detalhe', $pedido->controle);
        }
        $pagamento->codpedido = $pedido->controle;
        $pagamento->save();
        return redirect()->route('historico.detalhe', $pedido->controle);
    }
}
