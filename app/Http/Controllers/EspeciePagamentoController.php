<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspeciePagamentoController extends Controller
{
    public function formaPagamento(){
        return view('formapagamento');
    }
}
