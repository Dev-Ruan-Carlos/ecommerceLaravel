<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemUsuario extends Model
{
    protected $table = 'tgaleriausuario';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
    public $timestamps = false;

    public function usuario() {
        return $this->hasOne('App\Models\User', 'codusuario', 'id');
    }
}
