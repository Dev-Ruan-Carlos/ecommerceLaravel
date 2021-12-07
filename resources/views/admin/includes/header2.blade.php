<header class="header flex-jc flex-ac">
    <div class="flex-jb flex-ac">
        <img src="{{asset('img/logo-sgbr.png')}}" alt="LOGO" class="banners2" style="max-width: 150px; margin-right: 2rem;">
        <input type="text" style="background-color: white !important;" id="buscar" class="inputPadrao" autofocus 
        @isset($busca) value="{{$busca}}" @endisset>
        <i class="fas fa-search iconeInputRight" id="pesquisar" onclick="document.getElementById('formprodutos').submit()"></i>
        <a href="{{route('admin.gerencial')}}" class="botao3 mr-2" style="margin-left: 17rem;">Gerencial</a>
        <a href="{{route('inicio')}}" class="botao3">Deslogar</a>
    </div>
</header>