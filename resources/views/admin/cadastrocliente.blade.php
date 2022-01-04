@extends('layouts.appadmin')
@section('body')
    <form action="{{route('admin.cliente.cadastro')}}" method="POST">
        @csrf 
        @method('POST')
        <input type="text" name="id" @isset($allclientes) value="{{$allclientes->id}}" @endisset hidden>
        <section class="container">
            <div class="flex-jb">
                <div class="flex-c">
                    <h1>@isset($allclientes)
                        Alterar cliente
                        @else
                        Cadastro cliente @endisset</h1>
                    <h2>Informe os dados no formulário a baixo</h2>
                </div>
                <div class="flex-ae">
                    <div class="flex flex-je">
                        <a href="{{route('admin.cliente')}}">
                            <button type="button" class="botao-secundario">Voltar</button>
                        </a>
                        <button type="submit" class="botao ml-1">
                            @isset($allclientes)
                                Alterar
                            @else
                                Cadastrar 
                            @endisset
                        </button>
                    </div>
                </div>
            </div>
            @error('admin.cliente.allClientes')
                <span class="error">{{$message}}</span>
            @enderror  
            @if(session()->has('admin.cliente.allClientes'))
                <div class="alert alert-success">
                    {{ session()->get('admin.cliente.allClientes') }}
                </div>
            @endif 
            <div class="flex-c">
                <div class="flex">
                    <div class="body-card-principal mt-1 flex-c p-2">
                        <span>Dados do Cliente</span>
                        <div class="w-100 mt-1">
                            <div class="w-100 field">
                                <label class="label mb-1" for="nome">Nome *</label>
                                <input name="nome" type="text" class="inputPadrao cl-12 mt-1"
                                @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                            </div>
                            <div class="w-100 field">
                                <label class="label mb-1" for="senha">Senha *</label>
                                <input name="senha" type="password" class="inputPadrao cl-12 mt-1"
                                @isset($allclientes) value="{{$allclientes->password}}" disabled @endisset>
                            </div>
                            <div class="w-100 field">
                                <label class="label mb-1" for="senha2">Confirmação da senha *</label>
                                <input name="senha2" type="password" class="inputPadrao cl-12 mt-1"
                                @isset($allclientes) value="{{$allclientes->password}}" disabled @endisset>
                            </div>
                        </div>
                    </div>
                    <div class="body-card-principal mt-1 flex-c ml-1 p-2">
                        <span>Endereço</span>
                        <div class="w-100 mt-1">
                            <div class="flex w-100 gap-2">
                                <div class="field w-100">
                                    <label class="label mb-1" for="cep">CEP *</label>
                                    <input name="cep" id="cep" type="text" class="cep inputPadrao cl mt-1" maxlength="9" 
                                    @isset($allclientes) value="{{$allclientes->endereco->cep}}" @endisset>
                                    <i class="fas fa-search iconeInputCep" id="pesquisar" onblur="pesquisacep(this.value)" 
                                    data-tooltip="Consultar dados do CEP !" data-tooltip-location="top"></i>
                                </div>
                                <div class="field w-100">
                                    <label class="label mb-1" for="rua">Rua *</label>
                                    <input name="rua" id="rua" type="text" class="inputPadrao cl mt-1"
                                    @isset($allclientes) value="{{$allclientes->endereco->rua}}" @endisset>
                                </div>
                            </div>
                            <div class="flex w-100 gap-2">
                                <div class="field w-100">
                                    <label class="label mb-1" for="bairro">Bairro *</label>
                                    <input name="bairro" id="bairro" type="text" class="inputPadrao cl mt-1"
                                    @isset($allclientes) value="{{$allclientes->endereco->bairro}}" @endisset>
                                </div>
                                <div class="field w-100">
                                    <label class="label mb-1" for="numero">Número *</label>
                                    <input name="numero" type="text" class="inputPadrao cl mt-1"
                                    @isset($allclientes) value="{{$allclientes->endereco->numero}}" @endisset>
                                </div>
                            </div>
                            <div class="flex w-100 gap-2">
                                <div class="field w-100">
                                    <label class="label mb-1" for="uf">UF *</label>
                                    <input name="uf" id="uf" type="text" class="inputPadrao cl maiuscula mt-1" maxlength="2"
                                    @isset($allclientes) value="{{$allclientes->endereco->uf}}" @endisset>
                                </div>
                                <div class="field w-100">
                                    <label class="label mb-1" for="cidade">Cidade *</label>
                                    <input name="cidade" id="cidade" type="text" class="inputPadrao cl mt-1"
                                    @isset($allclientes) value="{{$allclientes->endereco->cidade}}" @endisset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="body-card-principal flex-c mt-1 p-2">
                        <span>Contato</span>
                        <div class="mt-1 flex-c">
                            <div class="field flex">
                                <label class="label mb-1" for="celular">Celular *</label>
                                <input name="celular" type="text" class="celular inputPadrao cl mt-1"
                                @isset($allclientes) value="{{$allclientes->contato->celular}}" @endisset>
                            </div>
                            <div class="w-100 field flex">
                                <label class="label mb-1" for="email">E-mail *</label>
                                <input name="email" type="email" class="inputPadrao cl mt-1"
                                @isset($allclientes) value="{{$allclientes->contato->email}}" @endisset>
                            </div>
                            <div class="w-100 field flex">
                                <label class="label mb-1" for="telefone">Telefone *</label>
                                <input name="telefone" type="text" class="telefone inputPadrao cl mt-1"
                                @isset($allclientes) value="{{$allclientes->contato->telefone}}" @endisset>
                            </div>
                        </div>
                    </div>
                    @isset($allclientes)
                        <div class="body-card-principal ml-1 mt-1 p-2">
                            <div class="w-100 h-100 flex-c flex-js">
                                <div class="flex-jb">
                                    <span>Nível de acesso</span>
                                    <div class="flex gap-1">
                                        <span><strong>1 - Administrador</strong></span>
                                        <span><strong>2 - Supervisor</strong></span>
                                        <span><strong>3 - Limitado</strong></span>
                                    </div>
                                </div>
                                    <div class="w-100 mt-1">
                                        <div class="w-100 field flex">
                                            <label class="label mb-1" for="nivelNivelAcesso">Nível de acesso *</label>
                                            <input type="text" class="mt-1 inputPadrao cl" name="nivelNivelAcesso"
                                            @isset($allclientes) value="{{$allclientes->nivel_acesso}}" @endisset>
                                        </div>
                                        <div class="w-100 field flex">
                                            <label class="label mb-1" for="nomeNivelAcesso">Nome nível de acesso *</label>
                                            <input type="text" class="mt-1 inputPadrao cl" name="nomeNivelAcesso"
                                            @isset($allclientes) value="{{$allclientes->nome_acesso}}" @endisset>
                                        </div>
                                        <div class="w-100 field flex">
                                            <label class="label mb-1" for="ativo">Ativo/Inativo *</label>
                                            <input type="text" class="mt-1 inputPadrao cl" name="ativo"
                                            @isset($allclientes) value="{{$allclientes->ativo}}" @endisset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </section>
    </form>
<script>

    var cep = document.getElementById('cep');
    var rua = document.getElementById('rua');
    var bairro = document.getElementById('bairro');
    var cidade = document.getElementById('cidade');
    var estados = document.getElementById('uf');

    $("#cep").blur(function() {
    //Nova variável "cep" somente com dígitos.
    var numcep = cep.value.replace(/[^0-9]/g, '');

    //Verifica se campo cep possui valor informado.
    if (numcep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(numcep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            // $("#rua").val("...");
            // $("#bairro").val("...");
            // $("#cidade").val("...");
            // $("#estados").val("...");

            rua.value = 'Carregando/Loading...';
            bairro.value = 'Carregando/Loading...';
            cidade.value = 'Carregando/Loading...';
            estados.value = 'Carregando/Loading...';

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ numcep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    // $("#rua").val(dados.logradouro);
                    // $("#bairro").val(dados.bairro);
                    // $("#cidade").val(dados.localidade);
                    // $("#estados").val(dados.uf);

                    rua.value = dados.logradouro;
                    rua.setAttribute('value', dados.logradouro);
                    bairro.value = dados.bairro;
                    bairro.setAttribute('value', dados.bairro);
                    cidade.value = dados.localidade;
                    cidade.setAttribute('value', dados.localidade);
                    estados.value = dados.uf;
                    estados.setAttribute('value', dados.uf);
                }
            });
        }
    }
});
</script>
@endsection 