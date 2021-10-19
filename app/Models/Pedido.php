<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
