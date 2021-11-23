@extends('layouts.appadmin')
@section('body')
<form action="{{route('admin.catalogo.cadastro')}}">
    <section class="container">
        <hgroup>
            <h1>Cadastro catálogo</h1>
            <h2>Informe os dados no formulário a baixo</h2>
        </hgroup>
        @error('admin.catalogo.indexcadastro')
            <span class="error">{{$message}}</span>
        @enderror  
        <div class="flex-r flex-jc mt-2">
            <div class="body-card-complemento">
                <img src="{{asset('storage/banners/frutas.jpg')}}" alt="" class="banners mt-1" style="width: 100%; max-height: 135px; border-radius: 5px;">
                <img src="{{asset('storage/banners/frutas2.jpg')}}" alt="" class="banners mt-1" style="width: 100%; max-height: 135px; border-radius: 5px;">
                <img src="{{asset('storage/banners/melancia.png')}}" alt="" class="banners mt-1" style="width: 100%; max-height: 135px; border-radius: 5px;">
                <img src="{{asset('storage/banners/caminhao.jpg')}}" alt="" class="banners mt-1" style="width: 100%; max-height: 135px; border-radius: 5px;">
            </div>
            <div class="body-card-principal">
                <span class="mb-3" style="font-size: 18px; font-weight: 400;">Cadastre seu produto/serviço</span>
                <input type="text" class="mt-1" name="produto" placeholder="Produto/serviço">
                <input type="text" class="mt-1" name="codbarras" placeholder="Código barras">
                <input type="text" class="mt-1" name="quantidade" placeholder="Quantidade">
                <input type="text" class="mt-1" name="precocusto" placeholder="Preço custo R$">
                <input type="text" class="mt-1" name="precovenda" placeholder="Preço venda R$">
                <input type="text" class="mt-1" name="precopromocao" placeholder="Preço promoção R$">
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