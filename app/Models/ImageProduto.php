<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduto extends Model
{
    protected $table = 'tgaleriaproduto';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function produto() {
        return $this->hasMany('App\Models\Produto', 'codproduto', 'controle');
    }
}
