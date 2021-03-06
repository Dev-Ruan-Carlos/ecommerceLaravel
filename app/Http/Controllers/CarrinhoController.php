<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\CarrinhoItem;
use App\Models\ImageProduto;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    // public function prodCarrinho(){
    // return view('carrinho');
    // }

    public function accessInfo(){
        $carrinho       = Carrinho::where('session', session()->getId())->first();
        $carrinhoItem   = CarrinhoItem::get();
        $produto        = ImageProduto::get();
        // dd($carrinhoItem);
        // dd($produto);
        // dd($carrinhoItem);
        return view('carrinho', compact('carrinho', 'carrinhoItem', 'produto'));
    }

    public function adicionaritem($id){
        $user = Auth::user();
        $item = Produto::where('controle', $id)->first();
        $carrinho = Carrinho::where('session', session()->getId())->first();
        if($carrinho == null){
            $carrinho = new Carrinho();
            $carrinho->session = session()->getId();
            $carrinho->codusuario = $user->id;
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
        if($carrinhoItem->produtos->quantidade >= $carrinhoItem->quantidade + 1){
            $carrinhoItem->quantidade = $carrinhoItem->quantidade + 1;
            $carrinho->itens()->save($carrinhoItem);
        }
        // return redirect()->route('acesso');
        return response()->json([
            'message'               => 'Item incrementado com sucesso',
            'quantidade'            => $carrinhoItem->quantidade,
            'quantidadeDisponivel'  => $carrinhoItem->produtos->quantidade
        ]);
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
        // dd($carrinhoItem->quantidade);
        if($carrinhoItem->quantidade <= 0){
            $this->deletarItem($id);
        }else{
            $carrinho->itens()->save($carrinhoItem);
        }
        if($carrinho->itens->count() == 0){
            // return redirect()->route('buscainicio.buscar');
        }
        // return redirect()->route('acesso'); 
        return response()->json([
            'message'               => 'Item delimitado com sucesso',
            'quantidade'            => $carrinhoItem->quantidade,
            'quantidadeDisponivel'  => $carrinhoItem->produtos->quantidade
        ]);
    }

    public function deletarItem($id){
        CarrinhoItem::find($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Item deletado com sucesso'
        ]);
    }

    public function carregarDados(){
        $carrinho                   = Auth()->user()->carrinho;
        $resumo = $carrinho->itens()->select(  DB::raw('sum(quantidade) as quantidade'), 
                                        DB::raw('sum(precovenda) as precovenda'), 
                                        DB::raw('sum(precopromocao*quantidade) as precopromocaototal'),
                                        DB::raw('sum(precovenda*quantidade) as precovendatotal'))->first();
                                        // dd($resumo);
        return response()->json([
            'resumo' => $resumo
        ]);
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
        $numPedido = Pedido::orderBy('numpedido', 'desc')->first();
        if($numPedido){
            $numPedido = $numPedido->numpedido;
        }else{
            $numPedido = 0;
        } 
        $pedido = new Pedido();
        $pedido->codusuario = $carrinho->codusuario;
        $pedido->numpedido = ++$numPedido;
        $pedido->status = "Pendente";
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
