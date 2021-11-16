@extends('layouts.app')
@section('body')
<form method="post" action="">
    @csrf
    @method('POST')
    <header class="header flex-jc flex-ac">
        <div class="head">
            <a href="" class="">
                <img src="{{asset('img/logo.jpg')}}" alt="LOGO" class="logosite">
            </a>
            <div class="flex-jc" style="width: 64%;">
                <input type="text" class="buscarProduto mr-2">
                <i class="fas fa-search lupa"></i>
                <a href="{{route('admin.gerencial')}}" class="historico mr-2">Gerencial</a>
                <a href="{{route('historico.index')}}" class="historico mr-2">Histórico de compra</a> 
                <a href="{{route('inicio')}}" class="historico">Sair/Logout</a>
            </div>
        </div>
    </header>
    {{-- <div class="linha-horizontal black"></div> --}}
    <aside class="aside"></aside>
    <nav class="nav"></nav>
    <main class="flex-c flex-ac main">
        <div class="main-container">
            <div class="swiper-container swiper-container-fade swiper-banner">
                <div class="swiper-wrapper swiper-banner mt-2">
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/melancia.png')}}" alt="" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/frutas.jpg')}}" alt="" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/frutas2.jpg')}}" alt="" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/macaco.jpg')}}" alt="" class="banners">
                    </div>
                </div>
            </div>
            <h1 class="mt-1">Produtos em ofertas</h1>
            <div class="corpo-produtos">
                @foreach ($produto as $p)
                    <div class="card-produto">
                        <p class="">{{"Nome do produto: " . $p->produto}}</p>
                        <p class="mt-05">{{"Quantidade disponível: " . number_format($p->quantidade, 4, ',', '.' )}}</p>
                        @if ($p->precopromocao <= $p->precovenda && $p->precopromocao <> 0)
                            <p class="mt-05">{{"Preço de promoção: R$ " . number_format($p->precopromocao, 2, ',', '.' )}}</p>
                        @else
                            <p class="mt-05">{{"Preço de venda: R$ " . number_format($p->precovenda, 2, ',', '.' )}}</p>
                        @endif
                        <a href="{{route('carrinho.adicionaritem', $p->controle)}}">
                            <button type="button" class="comprar">Adicionar ao carrinho</button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</form>
<script>
    var
        swiper = null;

    window.addEventListener('load', () => {
        swiper = new Swiper('.swiper-container', {
            spaceBetween: 0,
            centeredSlides: true,
            effect: 'fade',
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            }
        });    
    })
</script>
@endsection 