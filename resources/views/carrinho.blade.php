@extends('layouts.app')
@section('body')
@csrf
@method('POST')
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

                if ($item->precopromocao > 0) {
                    $valorTotal += $item->precopromocao*$item->quantidade;
                }else {
                    $valorTotal += $item->precovenda*$item->quantidade;
                }
            @endphp
            <div class="campo-maior flex-jc p-1">
                <article style="display: flex; width: 100%;">
                    <img src="{{asset('storage/banners/bannerrelogio2.jpg')}}" alt="LOGO" class="imgproduto-carrinho">
                    <div class="flex-se flex-c ml-3" style="width: 40%;">
                        <span class="nome-produto">{{"Produto: " . $item->produto}}</span>
                        <span class="venda-item">{{"Preço venda R$ " . number_format($item->precovenda, 2, ',', '.' )}}</span>
                        <span class="promocao-item">{{"Promoção R$ " . number_format($item->precopromocao, 2, ',', '.' )}}</span>
                        @if($item->precopromocao > 0 )
                        <span class="total-item">{{"Valor subtotal R$ " . number_format($item->precopromocao*$item->quantidade, 2, ',', '.' )}}</span>
                        @else
                        <span class="total-item">{{"R$ " . number_format($item->precovenda*$item->quantidade, 2, ',', '.' )}}</span>
                        @endif
                    </div>
                    <div class="flex-c flex-jc">
                        <div class="flex-jb box-quantidade">
                            @if($item->produtos->quantidade >= $item->quantidade + 1)
                            <a href="{{route('incrementarItem', $item->controle)}}">
                                <button type="button" class="mais">+</button>
                            </a>
                            @else 
                            <a href="{{route('incrementarItem', $item->controle)}}">
                                <button type="button" class="mais" disabled>+</button>
                            </a>
                            @endif
                            <span class="quantidade-produto flex-ac">{{$item->quantidade}}</span>
                            <a href="{{route('delimitarItem', $item->controle)}}">
                                <button type="button" class="menos">-</button>
                            </a>
                        </div>
                        <span class="quantidade-produto mt-1">{{"Disponível: " . number_format($produto->quantidade, 4, ',', '.' )}}</span>
                    </div>
                </article>
                <a href="{{route('deletarItem', $item->controle)}}" class="deletar">Deletar</a>
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
            <div class="flex-c w-100">
                <a href="{{route('buscainicio.buscar')}}">
                    <button class="botao hover flex-ac flex-jc" style="width: 100%;"><i class="fas fa-long-arrow-alt-left mr-05"></i>Ir para o catálogo</button>
                </a>
                <a href="{{route('salvar')}}">
                    <button class="botao hover mt-1 flex-ac flex-jc" style="width: 100%;"><i class="fas fa-cart-arrow-down mr-05"></i>Finalizar compra</button>
                </a>
            </div>
        </div>
    </div>
@endsection 