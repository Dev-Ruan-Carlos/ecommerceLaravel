<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'tpedidopagamento';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';

    public $timestamps = false;

    public function pedidos() {
        return $this->hasOne('App\Models\Pedido', 'codpedido', 'controle');
    }  

    public function especies() {
        return $this->hasOne('App\Models\Especie', 'codespecie', 'controle');
    }  
}
