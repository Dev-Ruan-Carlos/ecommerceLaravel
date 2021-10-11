<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinalizacaoController extends Controller
{
    public function indexFinalizacao() {
        return view ('finalizacao');
    }
}
