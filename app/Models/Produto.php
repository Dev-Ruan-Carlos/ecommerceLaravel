<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tproduto';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;
}
