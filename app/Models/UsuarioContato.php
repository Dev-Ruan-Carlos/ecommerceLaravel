<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioContato extends Model
{
    protected $table = 'tusuariocontato';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;
}
