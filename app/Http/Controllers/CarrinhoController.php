<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function incrementarItem($id){
        $carrinho = Carrinho::where('session', session()->getId())->first();
        if($carrinho == null){
            $carrinho = new Carrinho();
            $carrinho->session = session()->getId();
            $carrinho->save();
        }
        $carrinhoItem = $carrinho->itens()->find($id);
        $carrinhoItem->quantidade = $carrinhoItem->quantidade + 1;
        $carrinho->itens()->save($carrinhoItem);
        return redirect()->route('acesso');
    }

    public function delimitarItem($id){
        $carrinho = Carrinho::where('session', session()->getId())->first();
        if($carrinho == null){
            $carrinho = new Carrinho();
            $carrinho->session = session()->getId();
            $carrinho->save();
        }
        $carrinhoItem = $carrinho->itens()->find($id);
        $carrinhoItem->quantidade = $carrinhoItem->quantidade - 1;
        if($carrinhoItem->quantidade <= 0){
            $this->deletarItem($id);
        }else{
            $carrinho->itens()->save($carrinhoItem);
        }
        return redirect()->route('acesso'); 
    }

    public function deletarItem($id){
        CarrinhoItem::find($id)->delete();
        return redirect()->route('acesso'); 
    }

    public function salvar(){
        $carrinho = Carrinho::where('session', session()->getId())->first();
        if(Auth::check()){
            $user = Auth::user();
            $carrinho->codusuario = $user->id;
            $carrinho->save();
        }else{
            return redirect()->route('loginPagamento');
        }
        $pedido = new Pedido();
        $pedido->codusuario = $carrinho->codusuario;
        $pedido->numpedido = ++Pedido::orderBy('numpedido', 'desc')->first()->numpedido;
        $pedido->status = "Emitido";
        $pedido->save();
        foreach( $carrinho->itens as $carrinhoItem ){
            $pedidoItem =  new PedidoItem();
            $pedidoItem->codpedido = $pedido->controle;
            $pedidoItem->codproduto = $carrinhoItem->codproduto;
            $pedidoItem->quantidade = $carrinhoItem->quantidade;
            $pedidoItem->valorun = $carrinhoItem->precovenda;
            $pedidoItem->valorpromocao = $carrinhoItem->precopromocao;
            $pedidoItem->save();
            $carrinhoItem->delete();
        }
        $carrinho->delete();
        return redirect()->route('indexFinalizacao', $pedido->controle);
    }
}
