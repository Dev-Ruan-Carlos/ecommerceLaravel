@extends('layouts.app')
@section('body')
<form action="{{route('admin.cliente.cadastro')}}" method="POST" class="fundoclaro flex-ac flex-jc">
    @csrf 
    @method('POST')
    <input type="text" name="id" @isset($allclientes) value="{{$allclientes->id}}" @endisset hidden>
    <section class="container flex-c flex-ac flex-jc">
        <div class="flex-r flex-jc flex-ac flex-c">
            <div class="body-card-principal-cliente flex-ac p-2">
                <div class="flex-c w-100 h-100">
                    <div class="field w-100 gap-1">
                        <h1>Tela de cadastro</h1>
                        <h2><strong>Informe seus dados pessoais logo a baixo</strong></h2>
                        @error('cadastro')
                            <span class="error">{{$message}}</span>
                        @enderror   
                        @if(session()->has('cadastro'))
                            <div class="alert alert-success">
                                {{ session()->get('cadastro') }}
                            </div>
                        @endif 
                        <div>
                            <label class="label mb-1" for="nome">Nome *</label>
                            <input name="nome" type="text" class="inputPadrao cl mt-1" required>
                        </div>
                        <div>
                            <label class="label mb-1" for="senha">Senha *</label>
                            <input name="senha" type="password" class="inputPadrao cl mt-1" required>
                        </div>
                        <div>
                            <label class="label mb-1" for="senha2">Confirmação da senha *</label>
                            <input name="senha2" type="password" class="inputPadrao cl mt-1" required>
                        </div>
                    </div>
                    <div class="flex-jc w-100 field">
                        <span class="mb-1 mt-1"><strong>Endereço</strong></span>
                        <div class="flex gap-2">
                            <div>
                                <label class="label mb-1" for="cep">CEP *</label>
                                <input name="cep" type="text" class="cep inputPadrao cl mt-1" required>
                            </div>
                            <div>
                                <label class="label mb-1" for="rua">Rua *</label>
                                <input name="rua" type="text" class="inputPadrao cl mt-1" required>
                            </div>
                            <div>
                                <label class="label mb-1" for="bairro">Bairro *</label>
                                <input name="bairro" type="text" class="inputPadrao cl mt-1" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex-jc w-100 field">
                        <div class="flex gap-2">
                            <div>
                                <label class="label mb-1" for="numero">Número *</label>
                                <input name="numero" type="text" class="inputPadrao cl mt-1" required>
                            </div>
                            <div>
                                <label class="label mb-1" for="uf">UF *</label>
                                <input name="uf" type="text" class="inputPadrao maiuscula cl mt-1" maxlength="2" required>
                            </div>
                            <div>
                                <label class="label mb-1" for="cidade">Cidade *</label>
                                <input name="cidade" type="text" class="inputPadrao cl mt-1" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 field gap-1">
                        <span class="mb-1 mt-1"><strong>Contato</strong></span>
                        <div>
                            <label class="label mb-1" for="celular">Celular *</label>
                            <input name="celular" type="text" class="celular inputPadrao cl mt-1" maxlength="12" required>
                        </div>
                        <div>
                            <label class="label mb-1" for="email">E-mail *</label>
                            <input name="email" type="text" class="inputPadrao cl mt-1" required>
                        </div>
                        <div>
                            <label class="label mb-1" for="telefone">Telefone *</label>
                            <input name="telefone" type="text" class="telefone inputPadrao cl mt-1" required>
                        </div>
                    </div>
                </div>
                <div class="flex-se w-100 mt-1">
                    <a href="{{route('inicio')}}" class="botao">Início</a>
                    <button class="botao">Cadastrar</button>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection 