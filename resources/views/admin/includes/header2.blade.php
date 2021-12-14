<header class="header flex-jc flex-ac">
    <div class="flex-jb flex-ac w-100 flex-jc main-container">
        <img src="{{asset('img/logo-sgbr.png')}}" alt="LOGO" class="banners2" style="max-width: 150px; margin-right: 2rem;">
        <form action="{{route('buscainicio.buscar.detalhesprodutos')}}" method="GET" class="w-100">
            <div class="inputBusca w-100">
                <input type="text" id="buscar" name="buscar" class="ml-1 cl-10" autofocus
                    @if (!request()->routeIs('buscainicio.buscar') && !request()->routeIs('buscainicio.buscar.detalhesprodutos'))
                        disabled
                    @else
                        autofocus @isset($busca) value="{{$busca}}" @endisset
                    @endif
                >
                <button type="submit" class="fas fa-search iconeInputRight" id="pesquisar"></button>
            </div>
        </form>
        <div class="w-100 flex-je">
            <a href="{{route('admin.gerencial')}}" class="botao mr-2">Gerencial</a>
            @if (request()->routeIs('buscainicio.buscar'))
                <a href="{{route('inicio')}}" class="botao">Deslogar</a>
            @else
                <a href="{{route('buscainicio.buscar')}}" class="botao">Início</a>
            @endif
        </div>
    </div>
</header>