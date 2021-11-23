@extends('layouts.appadmin')
@section('body')
<form action="{{route('admin.catalogo.cadastro')}}">
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
                <img src="{{asset('storage/banners/cliente.jpg')}}" alt="" class="banners" style="width: 100%; height: 520px; border-radius: 5px;">
            </div>
            <div class="body-card-principal-cliente">
                <span class="mb-3" style="font-size: 18px; font-weight: 400;">Cadastre o cliente</span>
                <input type="text" class="mt-1" name="" placeholder="Nome">
                <input type="text" class="mt-1" name="" placeholder="E-mail">
                <input type="text" class="mt-1" name="" placeholder="Senha">
                <div class="mt-4 w-100">
                    <a href="{{route('admin.catalogo')}}">
                        <button type="button" class="botao">Voltar</button>
                    </a>
                    <button type="submit" class="botao">Cadastrar</button>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection 