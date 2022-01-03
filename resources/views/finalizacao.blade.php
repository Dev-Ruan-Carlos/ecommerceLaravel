@extends('layouts.app')
@section('body')
    <form action="" method="post">
    @csrf
    @method('POST')
        <div class="fundoclaro flex-jc flex-ac flex-c">
            <div class="tela-pagamento flex-c p-2 mb-1">
                <h2 class="flex-jc">{{"Compra nº " . $pedido->numpedido}}</h2>
                @if(session()->has('finalizacao'))
                    <div class="alert alert-success mt-1">
                        {{ session()->get('finalizacao') }}
                    </div>
                @endif
                <h3 class="black mt-2">Dados para retidada</h3>
                <div class="flex-c">
                    <div class="flex-jb mt-05">
                        <span>Cliente:</span>
                        <span>{{$pedido->usuario->nome}}</span>
                    </div>
                    <div class="flex-jb mt-05">
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
                <h3 class="mt-1">Produtos</h3>
                <div class="flex-c mt-05 h-100 flex-jb mt-1">
                    <table>
                        <thead class="w-100">
                            <th><strong>Descrição</strong></th>
                            <th><strong>Qtde</strong></th>
                            <th><strong>Valor un</strong></th>
                            <th><strong>Promoção</strong></th>
                            <th><strong>Valor subtotal</strong></th>
                        </thead>
                        <tbody class="w-100">
                            @foreach ($pedido->pedidoItens as $p)
                                <tr class="">
                                        <td>{{$p->produto->produto}}</td>
                                        <td>{{number_format($p->quantidade, 4, ',', '.' )}}</td>
                                        <td>{{"R$ " . number_format($p->valorun, 2, ',', '.' )}}</td>
                                        <td>{{"R$ " . number_format($p->valorpromocao, 2, ',', '.' )}}</td>
                                    </div>
                                    @if($p->valorpromocao > 0)
                                        <td>{{"R$ " . number_format($p->valorpromocao*$p->quantidade, 2, ',', '.' )}}</td>
                                    @else 
                                        <td>{{"R$ " . number_format($p->valorun*$p->quantidade, 2, ',', '.' )}}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex-c">
                        <h3 class="mt-05">Totalizadores</h3>
                        <div class="flex-jb mt-1">
                            <span>Valor Total: </span>
                            <span>{{number_format($valorTotal, 2, ',', '.' )}}</span>
                        </div>
                        <div class="flex-jb mt-1">
                            <span>Desconto: </span>
                            <span>{{number_format($totalDesconto, 2, ',', '.' )}}</span>
                        </div>
                        <div class="flex-jb mt-1">
                            <span>Quantidade: </span>
                            <span>{{number_format($quantidadeTotal, 3, ',', '.' )}}</span>
                        </div>
                    </div>
                    <div class="flex-jb mt-1 flex-c">
                        <h3>Detalhes</h3>
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
                    <div class="flex-jb mt-1">
                        @if($pedido->status == "Pendente")
                            <div>
                                <a href="{{route('admin.pedido')}}" class="footer-finalizacao">Voltar</a>
                            </div>    
                            <div>
                                <a href="{{route('cancelarPedido', $pedido->controle)}}" class="footer-finalizacao">Cancelar pedido</a>
                            </div>
                            <div>
                                <a href="{{route('formaPagamento', $pedido->controle)}}" class="footer-pagamento">Forma de pagamento</a>
                            </div>
                        @else   
                            <div>
                                <a href="{{route('admin.pedido')}}" class="botao">Voltar</a>
                            </div>
                            @if($pedido->status <> "Cancelado")
                                <div>
                                    <a href="{{route('cancelarPedido', $pedido->controle)}}" class="botao">Cancelar pedido</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection 