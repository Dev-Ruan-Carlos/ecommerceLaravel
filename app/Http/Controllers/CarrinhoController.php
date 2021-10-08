<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function prodCarrinho(){
    return view('carrinho');
    }

    public function accessInfo(){
        $carrinho = Carrinho::where('session', session()->getId())->first();
        return view('carrinho', compact('carrinho'));
    }

    public function adicionaritem($id){
        $item = Produto::where('controle', $id)->first();
        $carrinho = Carrinho::where('session', session()->getId())->first();
        if($carrinho == null){
            $carrinho = new Carrinho();
            $carrinho->session = session()->getId();
            $carrinho->save();
        }
        $carrinhoItem = $carrinho->itens()->where('codproduto', $item->controle)->first();
        if(!$carrinhoItem){
            $carrinhoItem = new CarrinhoItem();
            $carrinhoItem->codproduto = $item->controle;
            $carrinhoItem->produto = $item->produto;
            $carrinhoItem->quantidade = 1;
            $carrinhoItem->precocusto = $item->precocusto;
            $carrinhoItem->precovenda = $item->precovenda;
            $carrinhoItem->precopromocao = $item->precopromocao;
        }else{
            $carrinhoItem->quantidade = $carrinhoItem->quantidade + 1;
        }
        $carrinho->itens()->save($carrinhoItem);
        return redirect()->route('acesso');
    }
}
