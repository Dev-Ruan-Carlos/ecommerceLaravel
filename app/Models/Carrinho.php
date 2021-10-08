<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $table = 'tcarrinho';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function itens() {
        return $this->hasMany('App\Models\CarrinhoItem', 'codcarrinho', 'controle');
    }
}
