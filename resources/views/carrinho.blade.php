@extends('layouts.app')
@section('body')
<h1 class="flex-jc" style="margin-top: 2rem;">Carrinho de compras</h1>
<a href="" class=" volta-carrinho"></a>
<div class="flex-c">
    @php
      $quantidadeTotal = 0; 
      $valorTotal = 0; 
    @endphp
    @foreach ($carrinho->itens as $item)
    @php
        $quantidadeTotal += $item->quantidade;
        $valorTotal += $item->precovenda*$item->quantidade;
    @endphp
        <div class="campo-maior flex-jc">
            <article style="display: flex; width: 100%;">
                <span class="nome-produto">{{"Produto: " . $item->produto}}</span>
                <span class="quantidade-produto">{{"Quantidade á comprar = " . number_format($item->quantidade, 4, ',', '.' )}}</span>
                <span style="display: flex; position: relative; top: 43px; left: 73px;">Preço venda</span>
                <span class="venda-item">{{"R$ " . number_format($item->precovenda, 2, ',', '.' )}}</span>
                <span style="display: flex; position: relative; left: 66px; top: 43px;">Promoção</span>
                <span class="promocao-item">{{"R$ " . number_format($item->precopromocao, 2, ',', '.' )}}</span>
                <span style="display: flex; position: relative; left: 57px; top: 45px;">Valor subtotal</span>
                <span class="total-item">{{"R$ " . number_format($item->precovenda*$item->quantidade, 2, ',', '.' )}}</span>
            </article>
        </div>
    @endforeach
</div>
<div class="info-carrinho">
    <div class="flex-c w-100 flex-jb">
        <div class=>
            <h4 style="display: flex; justify-content: center;">Resumo de pedido</h4>
            <span class="mt-2 flex">{{"Quantidade de produtos: " . number_format($quantidadeTotal, 2, ',', '.' )}}</span>
            <br>
            <span class="flex">{{"Valor total R$ " . number_format($valorTotal, 2, ',', '.' )}}</span>
        </div>
        <div class="flex-c">
            <a href="{{route('inicio')}}">
                <button class="voltar-catalogo hover fas fa-arrow-circle-left">Ir para o catálogo</button>
            </a>
            <a href="{{route('indexFinalizacao')}}" class="">
                <button class="finalizar-compra hover fas fa-money-bill-alt mt-1">Finalizar compra</button>
            </a>
        </div>
    </div>
</div>
@endsection 