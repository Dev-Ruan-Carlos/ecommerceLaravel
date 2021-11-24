@extends('layouts.appadmin')
@section('body')
<form action="{{route('admin.cliente.cadastro')}}">
    <section class="container">
        <hgroup>
            <h1>Cadastro cliente</h1>
            <h2>Informe os dados no formulário a baixo</h2>
        </hgroup>
        @error('admin.catalogo.indexcadastro')
            <span class="error">{{$message}}</span>
        @enderror  
        <div class="flex-r flex-jc mt-5">
            <div class="body-card-complemento-cliente">
                <img src="{{asset('storage/banners/teste2.jpg')}}" alt="" class="banners" style="width: 100%; height: 551px; border-radius: 5px;">
            </div>
            <div class="body-card-principal-cliente">
                <span class="mb-3" style="font-size: 18px; font-weight: 400;">Cadastre o cliente</span>
                <div>
                    <i class="iconeInput fas fa-user-alt"></i>
                    <input type="text" class="mt-1" name="" placeholder="Nome" autofocus>
                </div>
                <div>
                    <i class="iconeInput fas fa-envelope-open-text"></i>
                    <input type="text" class="mt-1" name="" placeholder="E-mail">
                </div>
                <div>
                    <i class="iconeInput fas fa-lock"></i>
                    <input type="text" class="mt-1" name="" placeholder="Senha">
                </div>
                <div class="mt-4 w-100">
                    <a href="{{route('admin.cliente')}}">
                        <button type="button" class="botao">Voltar</button>
                    </a>
                    <button type="submit" class="botao">Cadastrar</button>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection 