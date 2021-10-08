@extends('layouts.app')
@section('body')
<form action="">
    <h1 class="flex-jc" style="margin-top: 2rem;">Carrinho de compras</h1>
    <div class="flex-c">
        @foreach ($carrinho->itens as $item)
            <div class="campo-maior flex-jc">
                <article style="display: flex; width: 100%;">
                    <span class="nome-produto">{{"Produto: " . $item->produto}}</span>
                    <span class="quantidade-produto">{{" - Quantidade disponível " . $item->quantidade}}</span>
                    <span class="custo-item">{{"Custo R$ " . $item->precocusto}}</span>
                    <span class="venda-item">{{"Venda R$ " . $item->precovenda}}</span>
                    <span class="total-item">{{"Total R$ " . $item->precovenda*$item->quantidade}}</span>
                    <span class="promocao-item">{{"Promoção R$ " . $item->precopromocao}}</span>
                </article>
            </div>
        @endforeach
    </div>
    <div class="info-carrinho">
        <div class="">
            <h4 style="margin: 17px 0px 10px 103px;">Resumo de pedido</h4>
            
        </div>
    </div>
</form>
@endsection 