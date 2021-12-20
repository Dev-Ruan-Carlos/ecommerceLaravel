@extends('layouts.app')
@section('body')
    <div class="fundoazul">
        <h2 class="flex-jc pt-2">Histórico de compra do usuário</h2>
        <div class="flex-c mt-4">
            @php
                $emitidos = 0;
                $cancelados = 0;
                $valorTotalPedidos = 0;
            @endphp
            @foreach ($pedidos as $pedido)
                @php
                    $quantidadeTotal = 0;
                    $valorTotal = 0;
                    $valorun = 0;
                    $valorpromocao = 0;
                    if ($pedido->status == "Emitido")
                        ++$emitidos; 
                    else
                        ++$cancelados;
                @endphp
                <div class="campo-historico flex-jb p-1">
                    <div class="flex-c" style="width: 100%; border-right: 1px solid #00000026;">
                        <div class="w-100" style="height: 21px">
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
                                    <span class="ml-05"><strong>{{ $pedidoItem->produto->produto}}</strong></span>
                            @endforeach
                            @php
                                $valorTotalPedidos += $valorTotal;   
                            @endphp
                        </div>
                        <div class="mt-1 flex-jb flex-c h-100">
                            <div class="flex-c">
                                <div class="flex-ac">
                                    <span class="">Valor total: </span>
                                    <span class="ml-05">{{number_format($valorTotal, 2, ',', '.' )}}</span>
                                </div>
                                <div class="flex-ac mt-1">
                                    <span class="">Data e hora cadastro: </span>
                                    <span class="ml-05">{{$pedido->datahoracadastro}}</span>
                                </div>
                            </div>
                            <div class="">
                                <span class="">Status pedido: </span>
                                <span class="ml-05">{{$pedido->status}}</span>
                            </div>
                        </div>
                    </div>
                    @if ($pedido->status <> 'Pendente')
                        <div class="flex-ac black ml-1">
                            <a href="{{route('historico.detalhe', $pedido->controle)}}" class="buttonhistorico"></a>
                        </div>
                    @else
                    <div class="flex-ac black ml-1">
                        <a href="{{route('formaPagamento', $pedido->controle)}}" class="buttonhistorico"></a>
                    </div>                      
                    @endif
                </div>
            @endforeach
        </div>
        <div class="info-historico flex-c">
            <span class="mt-2">Pedidos emitidos: {{$emitidos}}</span>
            <span class="mt-2">Pedidos Cancelados: {{$cancelados}}</span>
            <span class="mt-2">Valor total: {{number_format($valorTotalPedidos, 2, ',', '.' )}}</span>
            <div class="mt-1 flex w-100">
                <a href="{{route('buscainicio.buscar')}}" class="voltarHistorico flex-ac">Voltar</a>
            </div>
        </div>
    </div>
@endsection