@extends('layouts.app')
@section('body')
    <div class="fundoazul">
        <h2 class="flex-jc white pt-2">Histórico de compra do usuário</h2>
        <div class="flex-c mt-4">
            @foreach ($pedidos as $pedido)
            @php
                $quantidadeTotal = 0;
                $valorTotal = 0;
                $valorun = 0;
                $valorpromocao = 0;
            @endphp
                <div class="campo-historico flex-jb p-1">
                    <div class="flex-jb flex-c" style="height: 21px; width: 11%;">
                        <span class="nowrap">Itens comprados: </span>
                        @foreach ($pedido->pedidoItens as $key => $pedidoItem)
                            @if ($key > 0)
                                <span>,&ensp;</span>
                            @endif
                            @php
                                $quantidadeTotal = $quantidadeTotal + $pedidoItem->quantidade;
                                    if($pedidoItem->valorpromocao > 0)
                                        $valorTotal += $pedidoItem->valorpromocao*$pedidoItem->quantidade;
                                    else
                                        $valorTotal += $pedidoItem->valorun*$pedidoItem->quantidade;   
                            @endphp
                                <span style="ml-05">{{ $pedidoItem->produto->produto}}</span>
                        @endforeach
                    </div>
                    <div class="mt-1 flex-jb flex-c h-100">
                        <div class="flex-c">
                            <div class="flex-ac">
                                <span class="">Data e hora cadastro: </span>
                                <span class="ml-05">{{$pedido->datahoracadastro}}</span>
                            </div>
                            <div class="flex-ac">
                                <span class="">Valor total: </span>
                                <span class="ml-05">{{number_format($valorTotal, 2, ',', '.' )}}</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="">Status pedido: </span>
                            <span class="ml-05">{{$pedido->status}}</span>
                        </div>
                    </div>
                    <div>
                        <button type="button">></button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="info-carrinho"></div>
    </div>
@endsection