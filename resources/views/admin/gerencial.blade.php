@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <hgroup>
            <h1>Gerencial</h1>
            <h2>Estatística gerencial de uso</h2>
        </hgroup>
        <div class="body-card">
            <div class="card">
                <div class="flex-jb">
                    <span style="font-size: 23px;">Produtos</span>
                    <i class="fas fa-box aumentaIcone"></i>
                </div>
                <div>
                    <div class="flex-jb">
                        <p>Total de produtos:</p>
                        <p>{{$dados->totalProdutos}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Quantidade disponível:</p>
                        <p>{{number_format($dados->quantidadeDisponivel, 2, ',', '.' )}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Totalizador preço de custo:</p>
                        <p>R$ {{number_format($dados->precoCustoTotal, 2, ',', '.' )}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Totalizador preço de venda:</p>
                        <p>R$ {{number_format($dados->precoVendaTotal, 2, ',', '.' )}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Totalizador lucratividade:</p>
                        <p>R$ {{number_format($dados->lucratividade, 2, ',', '.' )}}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="flex-jb">
                    <span style="font-size: 23px;">Clientes</span>
                    <i class="fa fa-user aumentaIcone"></i>
                </div>
                <div class="mb-4">
                    <div class="flex-jb">
                        <p>Total de clientes cadastrados</p>
                        <p>{{$dados->totalClientes}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Total de clientes inadimplentes:</p>
                        <p>{{$dados->inadimplentes}}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="flex-jb">
                    <span style="font-size: 23px;">Pedidos</span>
                    <i class="fas fa-shopping-cart aumentaIcone"></i>
                </div>
                <div class="mb-3">
                    <div class="flex-jb">
                        <p>Quantidade total de pedidos:</p>
                        <p>{{$dados->totalPedidos}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Quantidade de pedidos emitidos:</p>
                        <p>{{$dados->totalPedidosEmitidos}}</p>
                    </div>
                    <div class="flex-jb">
                        <p>Quantidade de pedidos cancelados:</p>
                        <p>{{$dados->totalPedidosCancelados}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="body-chart">
            @include('admin.includes.chartprodutomaisvendido')
            @include('admin.includes.chartprodutomaislucrativos')
        </div>
    </section>
@endsection 