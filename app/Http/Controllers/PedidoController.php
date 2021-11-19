<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(){
        return view('admin.pedido');
    }

    public function get(){
        $pedidos = Pedido::listagemPedidos();
        return Datatables()->of($pedidos)
        ->addColumn('acoes', function ($pedidos){
            $botao = '<a href='. route('indexFinalizacao', $pedidos->controle) .' data-tooltip="Editar pedidos" data-tooltip-location="left">';
                $botao .= '<svg width="18px" height="18px" viewBox="0 0 4233 4233">';
                    $botao .= '<g id="Camada_x0020_1">';
                        $botao .= '<g id="_1913567360560">';
                            $botao .= '<path class="fill-blue" d="M454 4233l2721 0c251,0 454,-203 454,-453l0 -1512c0,-84 -68,-151 -152,-151 -83,0 -151,67 -151,151l0 1512c0,83 -67,151 -151,151l-2721 0c-84,0 -152,-68 -152,-151l0 -3024c0,-84 68,-151 152,-151l1814 0c83,0 151,-68 151,-151 0,-84 -68,-152 -151,-152l-1814 0c-251,0 -454,203 -454,454l0 3024c0,250 203,453 454,453z"/>';
                            $botao .= '<path class="fill-blue" d="M3850 774l-1965 1966 -588 196 196 -586 1966 -1966c108,-108 283,-108 391,0 52,52 81,122 81,195 0,73 -29,144 -81,195zm383 -193l0 -5c0,-147 -57,-294 -169,-406 -109,-109 -256,-170 -409,-170 -154,0 -301,61 -410,170l-1991 1991c-17,17 -29,37 -37,59l-302 907c-26,79 16,165 96,191 15,6 31,8 47,8 17,0 33,-2 48,-8l907 -302c23,-7 43,-20 59,-36l1992 -1992c112,-112 169,-259 169,-407z"/>';
                        $botao .= '</g>';
                    $botao .= '</g>';
                $botao .= '</svg>';
            $botao .= '</a>';
            return $botao;
        })->rawColumns(['acoes'])
        ->make(true);
    }
}
