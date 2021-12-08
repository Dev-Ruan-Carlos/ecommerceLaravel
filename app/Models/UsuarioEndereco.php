<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioEndereco extends Model
{
    protected $table = 'tusuarioendereco';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;
}
