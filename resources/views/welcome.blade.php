@extends('layouts.app')
@section('body')
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
        <h1 class="mt-2 flex-jc">Produtos em ofertas</h1>
        <section class="slide-group">
            <div class="@if($produto->count() < 7) flex-jc @endif swiper-wrapper w-100 mb-1">
                @foreach ($produto as $p)
                    <div class="card-produto swiper-slide flex-c flex-jc slide-inicio">
                        @if ($p->galeria->count() > 0)
                            <img src="{{asset('storage/' . $p->galeria[0]->descricaoimg)}}" alt="LOGO" class="imgproduto">
                        @else 
                            <img src="{{asset('storage/produtos/semimagem.png')}}" alt="LOGO" class="imgproduto">
                        @endif
                        <div>
                        </div>
                        <div class="mt-05 p-1">
                            <p class="">{{"Produto: " . $p->produto}}</p>
                            <p class="mt-05">{{"Disponível: " . number_format($p->quantidade, 0, ',', '.' ) . " Un"}}</p>
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
            <div class="swiper-pagination mt-1"></div>
        </section>
        <section class="slide-group">
            <div class="@if($produto->count() < 7) flex-jc @endif swiper-wrapper w-100 mb-1">
                @foreach ($produto as $p)
                    <div class="card-produto swiper-slide flex-c flex-jc slide-inicio">
                        @if ($p->galeria->count() > 0)
                            <img src="{{asset('storage/' . $p->galeria[0]->descricaoimg)}}" alt="LOGO" class="imgproduto">
                        @else 
                            <img src="{{asset('storage/produtos/semimagem.png')}}" alt="LOGO" class="imgproduto">
                        @endif
                        <div>
                        </div>
                        <div class="mt-05 p-1">
                            <p class="">{{"Produto: " . $p->produto}}</p>
                            <p class="mt-05">{{"Disponível: " . number_format($p->quantidade, 0, ',', '.' ) . " Un"}}</p>
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
            <div class="swiper-pagination mt-1"></div>
        </section>
        <div>
            <div class="swiper-container swiper-container-fade swiper-banner">
                <div class="swiper-wrapper swiper-banner mt-2">
                    <div class="swiper-slide swiper-slide-banner">
                        <img src="{{asset('storage/banners/bannerrelogio9.jpg')}}" alt="LOGO" class="banners">
                    </div>
                </div>
            </div>
            <h1 class="mt-2 flex-jc">Produtos em promoção</h1>
            <section class="slide-group">
                <div class="@if($produto->count() < 7) flex-jc @endif swiper-wrapper w-100 mb-1">
                    @foreach ($produto as $p)
                        <div class="card-produto swiper-slide flex-c flex-jc slide-inicio">
                            @if ($p->galeria->count() > 0)
                                <img src="{{asset('storage/' . $p->galeria[0]->descricaoimg)}}" alt="LOGO" class="imgproduto">
                            @else 
                                <img src="{{asset('storage/produtos/semimagem.png')}}" alt="LOGO" class="imgproduto">
                            @endif
                            <div>
                            </div>
                            <div class="mt-05 p-1">
                                <p class="">{{"Produto: " . $p->produto}}</p>
                                <p class="mt-05">{{"Disponível: " . number_format($p->quantidade, 0, ',', '.' ) . " Un"}}</p>
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
                <div class="swiper-pagination mt-1"></div>
            </section>
            <section class="slide-group">
                <div class="@if($produto->count() < 7) flex-jc @endif swiper-wrapper w-100 mb-1">
                    @foreach ($produto as $p)
                        <div class="card-produto swiper-slide flex-c flex-jc slide-inicio">
                            @if ($p->galeria->count() > 0)
                                <img src="{{asset('storage/' . $p->galeria[0]->descricaoimg)}}" alt="LOGO" class="imgproduto">
                            @else 
                                <img src="{{asset('storage/produtos/semimagem.png')}}" alt="LOGO" class="imgproduto">
                            @endif
                            <div>
                            </div>
                            <div class="mt-05 p-1">
                                <p class="">{{"Produto: " . $p->produto}}</p>
                                <p class="mt-05">{{"Disponível: " . number_format($p->quantidade, 0, ',', '.' ) . " Un"}}</p>
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
                <div class="swiper-pagination mt-1"></div>
            </section>
        </div>
    </div>
    <div>

    </div>
    <footer class="footer-ecommerce flex-jc mt-2">
        <span class="white flex-ac">Developer Ruan Carlos | CNPJ 000.000.000-00 - Politíca de privacidade - Termos de uso</span>
    </footer>
</main>
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
        slideGroup = new Swiper('.slide-group', {
            spaceBetween: 10,
                    centeredSlidesBounds: true,
                    autoplay: {
                        delay: 6000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.slide-group-next',
                        prevEl: '.slide-group-prev',
                    },
                    autoplay: false,
                    breakpoints: {
                        0: {
                            slidesPerView: 'auto',
                        },
                        500: {
                            slidesPerView: 'auto',
                        },
                        750: {
                            slidesPerView: 'auto',
                        },
                        1030: {
                            slidesPerView: 'auto',
                        },
                        1240: {
                            centeredSlides: false,
                            slidesPerView: 'auto',
                        },
                    }
        });   
    })

</script>
@endsection 