<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeusDados extends Model
{
    protected $table = 'tusuariomeusdados';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function usuario() {
        return $this->hasOne('App\Models\User', 'codusuario', 'id');
    }

    public function galeria() {
        return $this->hasMany('App\Models\ImagemUsuario', 'codusuario', 'codusuario');
    }
}
