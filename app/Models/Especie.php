<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'tespecie';
    protected $primaryKey = 'controle';
    protected $connection = 'criador';
}
