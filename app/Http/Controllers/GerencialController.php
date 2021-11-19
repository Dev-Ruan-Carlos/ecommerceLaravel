<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use stdClass;

class GerencialController extends Controller
{
    public function index(){
        $dados = new stdClass;
        // produtos
        $dados->produtos = Produto::get();
        $dados->totalProdutos = $dados->produtos->count();
        $dados->quantidadeDisponivel = array_sum(array_map('intval', $dados->produtos->pluck('quantidade')->toArray()));
        $dados->precoCusto = array_sum(array_map('intval', $dados->produtos->pluck('precocusto')->toArray()));
        $dados->precoCustoTotal = $dados->quantidadeDisponivel * $dados->precoCusto;
        $dados->precoVenda = array_sum(array_map('intval', $dados->produtos->pluck('precovenda')->toArray()));
        $dados->precoVendaTotal = $dados->quantidadeDisponivel * $dados->precoVenda;
        $dados->lucratividade = $dados->precoVendaTotal - $dados->precoCustoTotal;
        // clientes
        $dados->clientes = User::get();
        $dados->totalClientes = $dados->clientes->count();
        $dados->inadimplentes = 0;
        // pedidos
        $dados->pedidos = Pedido::get();
        $dados->totalPedidos = $dados->pedidos->count();
        $dados->statusPedidos = $dados->pedidos->pluck('status')->toArray();
        $dados->totalPedidosEmitidos = $dados->pedidos->where('status', 'Emitido')->count();
        $dados->totalPedidosCancelados = $dados->pedidos->where('status', 'Cancelado')->count();
        return view('admin.gerencial', compact('dados'));
    }

    public function chartProdutosMaisVendidos(){
        $produtos = PedidoItem::produtosMaisVendidos();
        if($produtos->count() == 0){
            return Response()->json([
                'status'    => 'success',
                'message'   => 'Não há informações a serem mostradas.'
            ]);
        }
        $total      = 0;
        $colors     = [];
        $labels     = $produtos->pluck('produto')->toArray();
        $dados      = $produtos->pluck('qtdeTotal')->toArray();

        foreach ($dados as $dado) {
            $total += (float)$dado;
            $colors[] = '#'.randomColor();
        }
        return compact('labels', 'dados', 'colors', 'total');
    }

    public function chartProdutosMaisLucrativos(){
        $produtosLucrativos = PedidoItem::produtosMaisLucrativos();
        if($produtosLucrativos->count() == 0){
            return Response()->json([
                'status'    => 'success',
                'message'   => 'Não há informações a serem mostradas.'
            ]);
        }
        $total      = 0;
        $colors     = [];
        $labels     = $produtosLucrativos->pluck('produto')->toArray();
        $dados      = $produtosLucrativos->pluck('lucratividade')->toArray();

        foreach ($dados as $dado) {
            $total += (float)$dado;
            $colors[] = '#'.randomColor();
        }
        return compact('labels', 'dados', 'colors', 'total');
    }
}



