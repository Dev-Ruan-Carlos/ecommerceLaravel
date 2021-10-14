@extends('layouts.app')
@section('body')
<form method="post" action="">
    @csrf
    @method('POST')
    <header class="header">
        <div class="head">
            <a href="" class="logosite">
                <img src="{{asset('img/logo.jpg')}}" alt="LOGO" class="logosite">
            </a>
            <div class="flex-c flex-ae gerente">
                @if(isset($user) && ($user->nivel_acesso == 1 || $user->nivel_acesso == 2))
                    @if($user->nivel_acesso == 1)
                        <a href="{{route('produto.indexproduto')}}">
                            <button class="gerencial" type="button">Gerencial</button>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </header>
    <aside class="aside"></aside>
    <nav class="nav"></nav>
    <div class="linha-horizontal black mt-2"></div>
    <main class="flex-c flex-ac main">
        <h1 class="mt-1">Produtos em ofertas</h1>
        <div class="corpo-produtos">
            @foreach ($produto as $p)
                <div class="card-produto">
                    <p class="">{{"Nome do produto: " . $p->produto}}</p>
                    <p class="">{{"Quantidade disponível: " . number_format($p->quantidade, 4, ',', '.' )}}</p>
                    <p class="">{{"Preço de custo: R$ " . number_format($p->precocusto, 2, ',', '.' )}}</p>
                    <p class="">{{"Preço de venda: R$ " . number_format($p->precovenda, 2, ',', '.' )}}</p>
                    <p class="">{{"Preço de promoção: R$ " . number_format($p->precopromocao, 2, ',', '.' )}}
                        <a href="{{route('carrinho.adicionaritem', $p->controle)}}">
                            <button type="button" class="comprar">Adicionar ao carrinho</button>
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    </main>
</form>
@endsection 