@extends('layouts.app')
@section('body')
<form method="post" action="">
    @csrf
    @method('POST')
    <header class="header flex-jc flex-ac">
        <div class="flex-jb flex-ac">
            <img src="{{asset('img/logo-sgbr.png')}}" alt="LOGO" class="banners2" style="max-width: 150px; margin-right: 2rem;">
            <input type="text" style="background-color: white !important;"><i class="fas fa-search iconeInputRight"></i>
            <a href="{{route('admin.gerencial')}}" class="botao3 mr-2" style="margin-left: 17rem;">Gerencial</a>
            <a href="{{route('inicio')}}" class="botao3">Sair/Logout</a>
        </div>
    </header>
    <main class="flex-c flex-ac main mainAppBlade">
        <div class="main-container">
            <div class="swiper-container swiper-container-fade swiper-banner">
                <div class="swiper-wrapper swiper-banner mt-2">
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/bannerrelogio5.jpg')}}" alt="LOGO" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/bannerrelogio6.jpg')}}" alt="LOGO" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/bannerrelogio7.jpg')}}" alt="LOGO" class="banners">
                    </div>
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/bannerrelogio8.jpg')}}" alt="LOGO" class="banners">
                    </div>
                </div>
            </div>
            <h1 class="mt-2">Produtos em ofertas</h1>
            <div class="corpo-produtos mb-3 pb-1">
                @foreach ($produto as $p)
                    <div class="card-produto">
                        <div>
                            <img src="{{asset('storage/banners/bannerrelogio2.jpg')}}" alt="LOGO" class="imgproduto">
                        </div>
                        <div class="mt-05 p-1">
                            <p class="">{{"Produto: " . $p->produto}}</p>
                            <p class="mt-05">{{"Quantidade: " . number_format($p->quantidade, 4, ',', '.' )}}</p>
                            @if ($p->precopromocao <= $p->precovenda && $p->precopromocao <> 0)
                                <p class="mt-05">{{"Valor R$ " . number_format($p->precopromocao, 2, ',', '.' )}}</p>
                            @else
                                <p class="mt-05">{{"Valor R$ " . number_format($p->precovenda, 2, ',', '.' )}}</p>
                            @endif
                            <a href="{{route('carrinho.adicionaritem', $p->controle)}}">
                                <button type="button" class="comprar">Comprar</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <div class="swiper-container swiper-container-fade swiper-banner">
                    <div class="swiper-wrapper swiper-banner mt-2">
                        <div class="swiper-slide swiper-slide-banner">
                            <img src="{{asset('storage/banners/bannerrelogio9.jpg')}}" alt="LOGO" class="banners">
                        </div>
                    </div>
                </div>
                <h1 class="mt-2">Produtos em promoção</h1>
                <div class="corpo-produtos mb-3 pb-1">
                    @foreach ($produto as $p)
                        <div class="card-produto">
                            <div>
                                <img src="{{asset('storage/banners/bannerrelogio2.jpg')}}" alt="LOGO" class="imgproduto">
                            </div>
                            <div class="mt-05 p-1">
                                <p class="">{{"Produto: " . $p->produto}}</p>
                                <p class="mt-05">{{"Quantidade: " . number_format($p->quantidade, 4, ',', '.' )}}</p>
                                @if ($p->precopromocao <= $p->precovenda && $p->precopromocao <> 0)
                                    <p class="mt-05">{{"Valor R$ " . number_format($p->precopromocao, 2, ',', '.' )}}</p>
                                @else
                                    <p class="mt-05">{{"Valor R$ " . number_format($p->precovenda, 2, ',', '.' )}}</p>
                                @endif
                                <a href="{{route('carrinho.adicionaritem', $p->controle)}}">
                                    <button type="button" class="comprar">Comprar</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <footer class="footer-ecommerce flex-jc">
            <span class="white flex-ac">Developer Ruan Carlos | CNPJ 000.000.000-00 - Politíca de privacidade - Termos de uso</span>
        </footer>
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