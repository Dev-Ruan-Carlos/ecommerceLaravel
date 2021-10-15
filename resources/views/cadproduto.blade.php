@extends('layouts.app')
@section('body')
@csrf
@method('GET')
<form action="{{route('produto.cadproduto')}}" method="get">
    <main class="fundoazul centralizar">
        @if(session()->has('produto.indexproduto'))
            <div class="alert alert-success flex-jc">
                {{ session()->get('produto.indexproduto') }}
            </div>
        @endif  
        @error('produto.indexproduto')
            <span class="alert">{{$message}}</span>
        @enderror
        <fieldset class="tela-form2">
            <h3 class="flex-jc cadastro-de-produtos">Cadastro de produtos</h3>
            <div class="" style="height: 91%;">
                <section class="m-1 mt-2 flex-js">
                    <label for="produto" class="">Nome do produto</label>
                    <input id="produto" class="ml-2 inputo produto" name="produto" type="text" placeholder="" required maxlength="15" autofocus/>
                </section>
                <section class="m-1 mt-2 flex-js">
                    <label for="quantidade">Quantidade</label>
                    <input id="quantidade" class="quantidade inputo" name="quantidade" type="text" placeholder="" required maxlength="30"/> 
                </section>
                <section class="m-1 mt-2 flex-js">
                    <label for="precocusto">Preço de custo</label>
                    <input id="precocusto" class="precocusto inputo" name="precocusto" type="text" placeholder="R$ " required maxlength="20"/> 
                </section>
                <section class="m-1 mt-2 flex-js">
                    <label for="precovenda">Preço de venda</label>
                    <input id="precovenda" class="precovenda inputo" name="precovenda" type="text" placeholder="R$ " required maxlength="20"/> 
                </section>
                <section class="m-1 mt-2 flex-js">
                    <label for="precopromocao">Preço de promoção</label>
                    <input id="precopromocao" class="precopromocao inputo" name="precopromocao" type="" placeholder="R$ " maxlength="20"/> 
                </section>
                <div class="flex-ja mt-2" style="51%">
                    <div class="">
                            <button type="submit" class="button-cad">Cadastrar</button>
                    </div>
                    <div class="">
                        <a href="{{route('buscainicio.buscar')}}">
                            <button class="button-cad" type="button">Voltar ao inicio</button>
                        </a>
                    </div>
                </div>
            </div>
        </fieldset>
    </main>
</form>
@endsection