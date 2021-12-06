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
                            <input type="text" class="inputPadrao mt-2" placeholder="Nome">
                        </div>
                        <div>
                            <i class="iconeInput fas fa-unlock" style="font-size: 20px;"></i>
                            <input type="text" class="inputPadrao mt-1" placeholder="Senha">
                        </div>
                    </div>
                </div>
                <div class="body-card-principal ml-1 p-2">
                    <span>Endereço</span>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-2" placeholder="CEP">
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-2" placeholder="Rua">
                    </div>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-1" placeholder="Bairro">
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-1" placeholder="Número">
                    </div>
                    <div>
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-1" placeholder="UF">
                        <i class="iconeInput fas fa-map-marker-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao2 mt-1" placeholder="Cidade">
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="body-card-principal mt-1 p-2">
                    <span>Contato</span>
                    <div class="mt-1">
                        <i class="iconeInput fas fa-tablet-alt" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao mt-1" placeholder="Celular">
                    </div>
                    <div>
                        <i class="iconeInput fas fa-envelope-open-text" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao mt-1" placeholder="E-mail">
                    </div>
                    <div>
                        <i class="iconeInput fas fa-phone" style="font-size: 20px;"></i>
                        <input type="text" class="inputPadrao mt-1" placeholder="Telefone">
                    </div>
                </div>
                <div class="body-card-principal ml-1 mt-1 p-2">
    
                </div>
            </div>
                {{-- <div>
                    @isset($allclientes)
                        <i class="iconeInput fas fa-chalkboard-teacher"></i>
                        <input type="text" class="mt-1" name="nomeNivelAcesso" placeholder="Nome nível de acesso"
                        @isset($allclientes) value="{{$allclientes->nome_acesso}}" @endisset>
                    @endisset
                </div> --}}
        </div>
    </section>
</form>
@endsection 