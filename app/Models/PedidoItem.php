<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedidoItem extends Model
{
    protected $table = 'tpedidoitem';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function produto() {
        return $this->hasOne('App\Models\Produto', 'controle', 'codproduto');
    }

    public static function produtosMaisVendidos(){
        $produtos = Self::select(
                                    'tpedidoitem.codproduto',
                                    'tproduto.produto',
                                    DB::raw('SUM(tpedidoitem.quantidade) as qtdeTotal')
                                )->leftJoin('tproduto', 'tproduto.controle', '=', 'tpedidoitem.codproduto')
                                ->groupBy('tpedidoitem.codproduto', 'tproduto.produto')
                                ->orderBy('tpedidoitem.quantidade')
                                ->get();
        return ($produtos); 
    }

    public static function produtosMaisLucrativos(){
        $produtos = Self::select(
                                    'tpedidoitem.codproduto',
                                    'tproduto.produto',
                                    DB::raw('SUM((tpedidoitem.valorun - tproduto.precocusto) * tpedidoitem.quantidade)   as lucratividade')
                                )
                                ->leftJoin('tproduto', 'tproduto.controle', '=', 'tpedidoitem.codproduto')
                                ->groupBy('tpedidoitem.codproduto', 'tproduto.produto')
                                ->orderBy('lucratividade', 'desc')
                                ->get();
        return ($produtos); 
    }
}
