@extends('layouts.app')
@section('body')
    <form action="" method="post">
    @csrf
    @method('POST')
        <div class="fundoazul flex-jc flex-ac">
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
                    <div class="flex-jb mt-1">
                        <span>Email:</span>
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
                    <div class="w-100 flex-jb">
                        <td><strong>Descrição</strong></td>
                        <td><strong>Quantidade</strong></td>
                        <td><strong>Valor unitário</strong></td>
                        <td><strong>Promoção</strong></td>
                        <td><strong>Valor subtotal</strong></td>
                    </div>
                    <div class="flex-jb w-100 flex-c">
                        <div class="flex-c">
                            @foreach ($pedido->pedidoItens as $p)
                            <div class="flex-jb">
                                <span>{{$p->produto->produto}}</span>
                                <span>{{number_format($p->quantidade, 4, ',', '.' )}}</span>
                                <span>{{number_format($p->valorun, 2, ',', '.' )}}</span>
                                <span>{{number_format($p->valorpromocao, 2, ',', '.' )}}</span>
                                @if($p->valorpromocao > 0)
                                    <span>{{number_format($p->valorpromocao*$p->quantidade, 2, ',', '.' )}}</span>
                                @else 
                                    <span>{{number_format($p->valorun*$p->quantidade, 2, ',', '.' )}}</span>
                                @endif
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
                            </div>
                            @endforeach
                        </div>
                    </div>
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
                            <div class="flex-jb mt-1">
                                <span>Forma de pagamento:</span>
                                @if ($pedido->pagamentos)
                                    <span>{{$pedido->pagamentos->especies->especie}}</span>
                                @else
                                    <span>Pagamento Local</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-jb mt-3 mb-1">
                        <div class="">
                            <a href="{{route('historico.index')}}" class="footer-finalizacao">Voltar</a>
                        </div>
                        @if ($pedido->status <> 'Cancelado')
                            <div class="">
                                <a href="{{route('cancelarPedido', $pedido->controle)}}" class="footer-finalizacao">Cancelar pedido</a>
                            </div>  
                        @endif
                    </div>
                </div>
            </div> 
        </div>
    </form>
@endsection 