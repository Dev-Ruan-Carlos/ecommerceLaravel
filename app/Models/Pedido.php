<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    protected $table = 'tpedido';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function usuario() {
        return $this->hasOne('App\Models\User', 'id', 'codusuario');
    }

    public function pagamentos() {
        return $this->hasOne('App\Models\Pagamento', 'codpedido', 'controle');
    }

    public function pedidoItens() {
        return $this->hasMany('App\Models\PedidoItem', 'codpedido', 'controle');
    }

    public static function listagemPedidos(){
        $valor = Self::select(
                                'tpedido.controle',
                                'tpedido.status',
                                'tpedidopagamento.especie',
                                'tpedido.datahoracadastro',
                                DB::raw('SUM(tpedidoitem.valorun * tpedidoitem.quantidade) AS valorUnTotal'),
                                DB::raw('SUM(tpedidoitem.valorpromocao * tpedidoitem.quantidade) AS valorPromocaoTotal')
                                )
                                ->leftJoin('tpedidoitem', 'tpedidoitem.codpedido', '=', 'tpedido.controle')
                                ->leftJoin('tpedidopagamento', 'tpedidopagamento.codpedido', '=', 'tpedido.controle')
                                ->groupBy('tpedido.controle', 'tpedido.status', 'tpedidopagamento.especie', 'tpedido.datahoracadastro')
                                ->get();
        return ($valor);
    }
}
