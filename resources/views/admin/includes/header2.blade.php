<header class="header flex-jc flex-ac">
    <div class="flex-jb flex-ac w-100 flex-jc">
        <img src="{{asset('img/logo-sgbr.png')}}" alt="LOGO" class="banners2" style="max-width: 150px; margin-right: 2rem;">
        <input type="text" style="background-color: white !important;" id="buscar" class="inputPadrao ml-1 cl-3" autofocus 
        @isset($busca) value="{{$busca}}" @endisset>
        <i class="fas fa-search iconeInputRight" id="pesquisar" onclick="document.getElementById('formprodutos').submit()"></i>
        <a href="{{route('admin.gerencial')}}" class="botao mr-2" style="margin-left: 17rem;">Gerencial</a>
        @if (request()->routeIs('buscainicio.buscar'))
            <a href="{{route('inicio')}}" class="botao">Deslogar</a>
        @else
            <a href="{{route('buscainicio.buscar')}}" class="botao">Início</a>
        @endif
    </div>
</header>