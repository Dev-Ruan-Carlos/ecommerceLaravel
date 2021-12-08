@extends('layouts.appadmin')
@section('body')
<form action="{{route('admin.cliente.cadastro')}}" method="POST">
    @csrf 
    @method('POST')
    <input type="text" name="id" @isset($allclientes) value="{{$allclientes->id}}" @endisset hidden>
    <section class="container">
        @error('admin.catalogo.allClientes')
            <span class="error">{{$message}}</span>
        @enderror 
        <div class="flex-jb">
            <div class="flex-c">
                <h1>@isset($allclientes)
                    Alterar cliente
                    @else
                    Cadastro cliente @endisset</h1>
                <h2>Informe os dados no formulário a baixo</h2>
            </div>
            <div class="flex-ae">
                <a href="{{route('admin.cliente')}}">
                    <button type="button" class="botao">Voltar</button>
                </a>
                <button type="submit" class="botao ml-1 mr-2">@isset($allclientes)
                    Alterar
                    @else
                    Cadastrar @endisset</button>
            </div>
        </div>
        @error('admin.catalogo.indexcadastro')
            <span class="error">{{$message}}</span>
        @enderror  
        <div class="flex-c mt-1">
            <div class="flex">
                <div class="body-card-principal p-2">
                    <span>Dados do Cliente</span>
                    <div>
                        <div>
                            <i class="iconeInput fas fa-user-alt" style="font-size: 20px;"></i>
                            <input name="nome" type="text" class="inputPadrao mt-2" placeholder="Nome"
                            @isset($allclientes) value="{{$allclientes->nome}}" @endisset>
                        </div>
                        <div>
                            <i class="iconeInput fas fa-unlock" style="font-size: 20px;"></i>
                            <input name="senha" type="password" class="inputPadrao mt-1" placeholder="Senha"
                            @isset($allclientes) value="{{$allclientes->password}}" disabled @endisset>
                        </div>
                    </div>
                </div>
                <div class="body-card-principal ml-1 p-2">
                    <span>Endereço</span>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="cep" type="text" class="inputPadrao2 mt-2" placeholder="CEP"
                        @isset($allclientes) value="{{$allclientes->endereco->cep}}" @endisset>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="rua" type="text" class="inputPadrao2 mt-2" placeholder="Rua"
                        @isset($allclientes) value="{{$allclientes->endereco->rua}}" @endisset>
                    </div>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="bairro" type="text" class="inputPadrao2 mt-1" placeholder="Bairro"
                        @isset($allclientes) value="{{$allclientes->endereco->bairro}}" @endisset>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="numero" type="text" class="inputPadrao2 mt-1" placeholder="Número"
                        @isset($allclientes) value="{{$allclientes->endereco->numero}}" @endisset>
                    </div>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="uf" type="text" class="inputPadrao2 mt-1" placeholder="UF"
                        @isset($allclientes) value="{{$allclientes->endereco->uf}}" @endisset>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input name="cidade" type="text" class="inputPadrao2 mt-1" placeholder="Cidade"
                        @isset($allclientes) value="{{$allclientes->endereco->cidade}}" @endisset>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="body-card-principal mt-1 p-2">
                    <span>Contato</span>
                    <div class="mt-1">
                        <i class="iconeInput fas fa-tablet-alt" style="font-size: 20px;"></i>
                        <input name="celular" type="text" class="inputPadrao mt-1" placeholder="Celular"
                        @isset($allclientes) value="{{$allclientes->contato->celular}}" @endisset>
                    </div>
                    <div>
                        <i class="iconeInput fas fa-envelope-open-text" style="font-size: 20px;"></i>
                        <input name="email" type="email" class="inputPadrao mt-1" placeholder="E-mail"
                        @isset($allclientes) value="{{$allclientes->contato->email}}" @endisset>
                    </div>
                    <div>
                        <i class="iconeInput fas fa-phone" style="font-size: 20px;"></i>
                        <input name="telefone" type="text" class="inputPadrao mt-1" placeholder="Telefone"
                        @isset($allclientes) value="{{$allclientes->contato->telefone}}" @endisset>
                    </div>
                </div>
                @isset($allclientes)
                    <div class="body-card-principal ml-1 mt-1 p-2">
                        <div class="flex-jc flex-ac w-100 h-100 flex-c flex-js">
                            <span>Nível de acesso</span>
                                <div class="mt-1">
                                    <div>
                                        <i class="iconeInput fas fa-chalkboard-teacher"></i>
                                        <input type="text" class="mt-1 inputPadrao" name="nivelNivelAcesso" placeholder="nível de acesso"
                                        @isset($allclientes) value="{{$allclientes->nivel_acesso}}" @endisset>
                                    </div>
                                    <div>
                                        <i class="iconeInput fas fa-chalkboard-teacher"></i>
                                        <input type="text" class="mt-1 inputPadrao" name="nomeNivelAcesso" placeholder="Nome nível de acesso"
                                        @isset($allclientes) value="{{$allclientes->nome_acesso}}" @endisset>
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
@endsection 