<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CadastroProdutoController extends Controller
{
    public function index(){
        return view('cadproduto');
    }
    
    public function cadProduto(Request $request) {
        $produto = new Produto();
        $produto->produto = $request->get('produto');
        $produto->quantidade = (float) preg_replace(['/\./', '/\,/'], ['', '.'], $request->get('quantidade')); 
        $produto->precocusto = (float) preg_replace(['/\./', '/\,/'], ['', '.'], $request->get('precocusto'));
        $produto->precovenda = (float) preg_replace(['/\./', '/\,/'], ['', '.'], $request->get('precovenda'));
            if($produto->precocusto > $produto->precovenda){
                return redirect()->back()->withInput()->withErrors(['produto.indexproduto' => 'Preço de venda superior ao preço de custo! TENTE NOVAMENTE']);        
            }
        $produto->precopromocao = (float) preg_replace(['/\./', '/\,/'], ['', '.'], $request->get('precopromocao'));
            if($produto->precopromocao > $produto->precovenda) {
                return redirect()->back()->withInput()->withErrors(['produto.indexproduto' => 'Preço de promoção superior ao preço de venda! TENTE NOVAMENTE']);        
            }   
        $produto->ativo = 1;
        $produto->save();
        return redirect()->back()->withInput()->with(['produto.indexproduto' => 'Produto cadastrado com sucesso!']);
    } 
}
