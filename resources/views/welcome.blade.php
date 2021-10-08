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
            <div class="flex-je">
                <span class="fas fa-users icone-registro black flex-je"></span>
                <span class=bemvindo>Bem vindo,</span>
                <span>
                    <a href="{{route('login.indexlog')}}" class="entre-registre"><strong>Entre</strong></a>
                       <h4 class="ou">ou</h4>
                    <a href="{{route('cadastro.indexcad')}}" class="cadastre-registre"><strong>Cadastre-se</strong></a>
                </span>
            </div>
        </div>
    </header>
    <aside class="aside"></aside>
    <nav class="nav"></nav>
    <nav class="faixademonstracao flex-jc">
        <ul class="demonstracao flex-jc">Versão demonstrativa</ul>
    </nav>
    <main class="flex-c flex-ac main">
        <h1>Produtos em ofertas</h1>
        <div class="corpo-produtos">
            @foreach ($produto as $p)
                <div class="card-produto">
                    <p class="">{{"Nome do produto: " . $p->produto}}</p>
                    <p class="">{{"Quantidade disponível: " . $p->quantidade}}</p>
                    <p class="">{{"Preço de custo R$: " . $p->precocusto}}</p>
                    <p class="">{{"Preço de venda R$: " . $p->precovenda}}</p>
                    <p class="">{{"Preço de promoção R$: " . $p->precopromocao}}
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