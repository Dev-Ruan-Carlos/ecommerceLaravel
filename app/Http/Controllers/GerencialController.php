<?php

namespace App\Http\Controllers;

use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Response;

class GerencialController extends Controller
{
    public function index(){
        return view('admin.gerencial');
    }

    public function chartProdutosMaisVendidos(){
        $produtos = PedidoItem::produtosMaisVendidos();
        if($produtos->count() == 0){
            return Response::json([
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
            return Response::json([
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



