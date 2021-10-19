@extends('layouts.app')
@section('body')
<form action="" method="post">
@csrf
@method('POST')
    <div class="fundoazul flex-jc flex-ac flex-c">
        @if(session()->has('finalizacao'))
            <div class="alert alert-success">
                {{ session()->get('finalizacao') }}
            </div>
        @endif
        <div class="tela-pagamento flex-c p-2 mb-1">
            <h2 class="flex-jc">{{"Compra nº " . $pedido->numpedido}}</h2>
            <h3 class="black mt-2">Dados para retidada</h3>
            <div class="flex-c">
                <div class="flex-jb mt-2">
                    <span>Cliente:</span>
                    <span>{{$pedido->usuario->nome}}</span>
                </div>
                <div class="flex-jb">
                    <span>Email do cliente:</span>
                    <span>{{$pedido->usuario->email}}</span>
                </div>
            </div>
            @php
                $quantidadeTotal = 0; 
                $valorTotal = 0; 
                $totalUn = 0;
                $totalPromo = 0;
                $totalDesconto = 0;
            @endphp
            <h3 class="mt-2">Produtos</h3>
            <div class="flex-c mt-1 h-100 flex-jb">
                <table class="w-100">
                    <tr class="w-100">
                        <td><strong>Descrição</strong></td>
                        <td><strong>Qtde</strong></td>
                        <td><strong>Valor un</strong></td>
                        <td><strong>Promoção</strong></td>
                        <td><strong>Valor subtotal</strong></td>
                    </tr>
                    <tr class="w-100 mt-1">
                        @foreach ($pedido->pedidoItens as $p)
                            <tr>
                                <td>{{$p->produto->produto}}</td>
                                <td>{{number_format($p->quantidade, 4, ',', '.' )}}</td>
                                <td>{{number_format($p->valorun, 2, ',', '.' )}}</td>
                                <td>{{number_format($p->valorpromocao, 2, ',', '.' )}}</td>
                                @if($p->valorpromocao > 0)
                                    <td>{{number_format($p->valorpromocao*$p->quantidade, 2, ',', '.' )}}</td>
                                @else 
                                    <td>{{number_format($p->valorun*$p->quantidade, 2, ',', '.' )}}</td>
                                @endif
                                {{-- @if($p->valorpromocao < $p->valorun)
                                    <td>{{number_format($p->valorpromocao, 2, ',', '.' )}}</td>
                                @else
                                    <td>{{number_format($p->valorpromocao == 0, 2, ',', '.' )}}</td>
                                @endif --}}
                            </tr>
                            @php
                                $quantidadeTotal = $quantidadeTotal + $p->quantidade;
                                if($p->valorpromocao > 0)
                                    $valorTotal += $p->valorpromocao*$p->quantidade;
                                else
                                    $valorTotal += $p->valorun*$p->quantidade;
                                $totalUn += $p->valorun;
                                $totalPromo += $p->valorpromocao;
                                $totalDesconto +=  ($p->valorun*$p->quantidade) - ($p->valorpromocao*$p->quantidade);   
                            @endphp
                        @endforeach
                    </tr>
                </table>
                <h3 class="mt-1">Totalizadores</h3>
                <div class="flex-c">
                    <div class="flex-jb mt-1">
                        <span class="">Valor Total: </span>
                        <span class="">{{number_format($valorTotal, 2, ',', '.' )}}</span>
                    </div>
                    <div class="flex-jb mt-1">
                        <span class="">Desconto: </span>
                        <span class="">{{number_format($totalDesconto, 2, ',', '.' )}}</span>
                    </div>
                    <div class="flex-jb mt-1">
                        <span class="">Quantidade: </span>
                        <span class="">{{number_format($quantidadeTotal, 3, ',', '.' )}}</span>
                    </div>
                </div>
                <div class="flex-jb mt-3 flex-c">
                    <h3 class="">Detalhes</h3>
                    <div class="mt-1">
                        <div class="flex-jb">
                            <span>Status</span>
                            <span>{{$pedido->status}}</span>
                        </div>
                        <div class="flex-jb mt-1">
                            <span>Data e hora emissão do pedido:</span>
                            <span>{{(new DateTime($p->dataehoracadastro))->format('d/m/Y H:i:s')}}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-jb mt-3">
                    @if($pedido->status == "Pendente")
                        <div class="">
                            <a href="{{route('cancelarPedido', $pedido->controle)}}" class="footer-finalizacao">Cancelar pedido</a>
                        </div>
                    @else   
                        <div class="">
                            <a href="{{route('buscainicio.buscar')}}" class="footer-finalizacao">Voltar</a>
                        </div>    
                    @endif
                        <div class="">
                            <a href="{{route('formaPagamento', $pedido->controle)}}" class="footer-pagamento">Forma de pagamento</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection 