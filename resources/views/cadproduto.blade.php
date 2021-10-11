@extends('layouts.app')
@section('body')
@csrf
<main class="fundoazul centralizar">
    @if(session()->has('produto.cadproduto'))
        <div class="alert alert-success flex-jc">
            {{ session()->get('produto') }}
        </div>
    @endif  
    <fieldset class="tela-form2">
        <div class="">
            <section class="m-1 mt-2 flex-js">
                <label for="produto" class="">Nome do produto</label>
                <input id="produto" class="ml-2 inputo produto" name="produto" type="text" placeholder="" maxlength="15" autofocus/>
            </section>
            <section class="m-1 mt-2 flex-js">
                <label for="quantidade">Quantidade</label>
                <input id="quantidade" class="quantidade inputo" name="quantidade" type="text" placeholder="" maxlength="30"/> 
            </section>
            <section class="m-1 mt-2 flex-js">
                <label for="precocusto">Preço de custo</label>
                <input id="precocusto" class="precocusto inputo" name="precocusto" type="text" placeholder="R$ " maxlength="20"/> 
            </section>
            <section class="m-1 mt-2 flex-js">
                <label for="precovenda">Preço de venda</label>
                <input id="precovenda" class="precovenda inputo" name="precovenda" type="text" placeholder="R$ " maxlength="20"/> 
            </section>
            <section class="m-1 mt-2 flex-js">
                <label for="precopromocao">Preço de promoção</label>
                <input id="precopromocao" class="precopromocao inputo" name="precopromocao" type="" placeholder="R$ " maxlength="20"/> 
            </section>
            <div class="flex-js">
                <div class="cad-inicioo">
                    <a href="{{route('produto.cadproduto')}}">
                        <button type="button" class="button-cad">Cadastrar</button>
                    </a>
                </div>
                <div class="voltainicio">
                    <a href="{{route('inicio')}}">
                        <button class="button-cad ml-1">Voltar ao inicio</button>
                    </a>
                </div>
            </div>
        </div>
    </fieldset>
</main>
@endsection