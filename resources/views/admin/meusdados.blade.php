@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <div class="flex-c mr-1">
            <h1>Meus dados</h1>
            <h2>Informações do usuário logado</h2>
        </div>
        <div class="flex-c">
            <div class="flex">
                <div class="body-card-principal mt-1 flex-c p-2">
                    <span>Dados do usuário</span>
                    <div class="w-100 mt-1">
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Nome *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Sobrenome *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Cargo *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">CPF *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">RG *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="body-card-principal mt-1 flex-c p-2">
                    <span>Datas</span>
                    <div class="w-100 mt-1">
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Data de nascimento *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="flex w-100 gap-2">
                            <div class="w-100 field">
                                <label class="label mb-1" for="nome">Data admissão</label>
                                <input name="nome" type="text" class="inputPadrao cl mt-1"
                                @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                            </div>
                            <div class="w-100 field">
                                <label class="label mb-1" for="nome">Data rescisão</label>
                                <input name="nome" type="text" class="inputPadrao cl mt-1"
                                @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body-card-principal ml-1 mt-1 flex-c p-2">
                    <span>Complementar</span>
                    <div class="w-100 mt-1">
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Nome do pai *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div class="w-100 field">
                            <label class="label mb-1" for="nome">Nome da mãe *</label>
                            <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 