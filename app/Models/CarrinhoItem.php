<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrinhoItem extends Model
{
    protected $table = 'tcarrinhoitem';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function produtos() {
        return $this->belongsTo('App\Models\Produto', 'codproduto', 'controle');
    }
}
