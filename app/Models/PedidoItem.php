<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'tpedidoitem';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function produto() {
        return $this->hasOne('App\Models\Produto', 'controle', 'codproduto');
    }
}
