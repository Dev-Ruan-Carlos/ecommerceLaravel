@extends('layouts.appadmin')
@section('body')
<form action="{{route('admin.cliente.cadastro')}}" method="GET">
    @csrf 
    @method('GET')
    <input type="text" name="id" @isset($allclientes) value="{{$allclientes->id}}" @endisset hidden>
    <section class="container">
        @error('admin.catalogo.allClientes')
            <span class="error">{{$message}}</span>
        @enderror 
        <hgroup>
            <h1>@isset($allclientes)
                Alterar cliente
                @else
                Cadastro cliente @endisset</h1>
            <h2>Informe os dados no formulário a baixo</h2>
        </hgroup>
        @error('admin.catalogo.indexcadastro')
            <span class="error">{{$message}}</span>
        @enderror  
        <div class="flex-r flex-jc mt-5">
            <div class="body-card-complemento-cliente">
                <img src="{{asset('storage/banners/bannercliente.jpg')}}" alt="" class="banners banner-cadastrocliente" style="width: 100%; height: 568px; border-radius: 5px;">
            </div>
            <div class="body-card-principal-cliente">
                <span class="mb-3" style="font-size: 18px; font-weight: 400;">@isset($allclientes)
                    Alterar cliente
                    @else
                    Cadastro cliente @endisset</span>
                <div>
                    <i class="iconeInput fas fa-user-alt"></i>
                    <input type="text" class="mt-1" name="nome" placeholder="Nome" autofocus
                    @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fas fa-envelope-open-text"></i>
                    <input type="email" class="mt-1" name="email" placeholder="E-mail"
                    @isset($allclientes) value="{{$allclientes->email}}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fas fa-lock"></i>
                    <input type="text" class="mt-1" name="senha" placeholder="Senha"
                    @isset($allclientes) value="{{$allclientes->password}}" disabled @endisset>
                </div>
                <div>
                    @isset($allclientes)
                        <i class="iconeInput fas fa-chalkboard-teacher"></i>
                        <input type="text" class="mt-1" name="nivelAcesso" placeholder="Nível de acesso 1 = administrador 2 = supervisor 3 = limitado"
                        @isset($allclientes) value="{{$allclientes->nivel_acesso}}" @endisset>
                    @endisset
                </div>
                <div>
                    @isset($allclientes)
                        <i class="iconeInput fas fa-chalkboard-teacher"></i>
                        <input type="text" class="mt-1" name="nomeNivelAcesso" placeholder="Nome nível de acesso"
                        @isset($allclientes) value="{{$allclientes->nome_acesso}}" @endisset>
                    @endisset
                </div>
                <div class="mt-4 w-100">
                    <a href="{{route('admin.cliente')}}">
                        <button type="button" class="botao">Voltar</button>
                    </a>
                    <button type="submit" class="botao">@isset($allclientes)
                        Alterar
                        @else
                        Cadastrar @endisset</button>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection 