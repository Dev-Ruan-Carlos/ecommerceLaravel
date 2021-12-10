<aside class="header-aside">
    <div class="header-logo">
        <img src="{{asset('img/logo-sgbr.png')}}" alt="">
    </div>
    <nav>
        <ul>
            <li><a href="{{route('admin.gerencial')}}" @if(request()->routeIs('admin.gerencial')) class="li-active" @endif><i class="fas fa-chart-pie"></i><span>Gerencial</span></a></li>
            <li><a href="{{route('admin.catalogo')}}" @if(request()->routeIs('admin.catalogo*')) class="li-active" @endif><i class="fas fa-box"></i><span>Catálogo</span></a></li>
            <li><a href="{{route('admin.cliente')}}" @if(request()->routeIs('admin.cliente*')) class="li-active" @endif><i class="fa fa-user" ></i><span>Clientes</span></a></li>
            <li><a href="{{route('admin.pedido')}}" @if(request()->routeIs('admin.pedido*')) class="li-active" @endif><i class="fas fa-shopping-cart"></i><span>Pedidos</span></a></li>
        </ul>
    </nav>
</aside>
<header>
    <div class="flex-ac">
        <button type="button" class="fas fa-bars btn-header" onclick="toggleMenu()"></button>
        <a href="{{route('buscainicio.buscar')}}" class="ml-1" style="color: #007bff;">Início</a>
    </div>
    <div class="header-conta">
        @if(request()->routeIs('admin.*'))
            <span class="mr-1">{{$dados->user->nome}}</span>
            <div class="header-conta-img">
                <img src="{{asset('img/user.jpg')}}" alt="">
            </div>
            <div class="toggleUser">
                <div class="toggleUserHeader">
                    <div class="flex-jc flex-ac flex-c h-100 mt-1">
                        <span class="mb-05">{{$dados->user->nome}}</span>
                        <img class="togglerUserImg " src="{{asset('img/user.jpg')}}" alt="FOTO">
                    </div>
                </div>
                <div class="toggleUserBody">

                </div>
            </div>
        @endif
    </div>
</header>
<script>
    function toggleMenu(){
        let 
            btnHeader       = document.querySelector('.btn-header'),
            headerAside     = document.querySelector('.header-aside'),
            main            = document.querySelector('main'),
            header          = document.querySelector('header');

        btnHeader.classList.toggle('active-mobile');
        headerAside.classList.toggle('active-mobile');
        main.classList.toggle('active-mobile');
        header.classList.toggle('active-mobile');
    }

    window.addEventListener('click', function(event){
        var toggleUser = document.querySelector('.toggleUser');
        if (event.target.classList.contains('header-conta')) {
            toggleUser.classList.toggle('toggleUserActive');
        }else if(!event.target.classList.contains('toggleUser')){
            toggleUser.classList.remove('toggleUserActive');
        }
    })
</script>