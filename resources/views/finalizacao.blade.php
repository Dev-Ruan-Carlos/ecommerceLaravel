@extends('layouts.app')
@section('body')
<form action="" method="post">
@csrf
@method('POST')
    <div class="fundoazul flex-jc flex-ac">
        <div class="tela-pagamento flex-c p-2">
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
            <h3 class="mt-3">Produtos</h3>
            <div class="flex-c mt-1 h-100 flex-jb">
                <table class="w-100">
                    <tr class="w-100">
                        <td><strong>Descrição</strong></td>
                        <td><strong>Qtde</strong></td>
                        <td><strong>Valor Un</strong></td>
                        <td><strong>Valor Total</strong></td>
                    </tr>
                    <tr class="w-100 mt-1">
                        @foreach ($pedido->pedidoItens as $p)
                        <tr>
                            <td>{{$p->produto->produto}}</td>
                            <td>{{number_format($p->quantidade, 4, ',', '.' )}}</td>
                            <td>{{number_format($p->valorun, 2, ',', '.' )}}</td>
                            <td>{{number_format($p->valorun*$p->quantidade, 2, ',', '.' )}}</td>
                        </tr>
                        @endforeach
                    </tr>
                </table>
                <div class="flex-jb mt-5 flex-c">
                    <h3 class="">Detalhes</h3>
                    <div class=" flex-jb mt-1">
                        <span>Data e hora emissão do pedido:</span>
                        <span>{{(new DateTime($p->dataehoracadastro))->format('d/m/Y H:i:s')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection 