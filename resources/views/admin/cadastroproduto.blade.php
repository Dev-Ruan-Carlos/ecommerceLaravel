@extends('layouts.appadmin')
@section('body')
    <form action="{{route('admin.catalogo.cadastro', (isset($allProdutos) ? $allProdutos->controle : null))}}" method="POST" enctype='multipart/form-data'>
        @csrf 
        @method('POST')
        <input type="text" name="id" @isset($allProdutos) value="{{$allProdutos->controle}}" @endisset hidden>
        <section class="container">
            <hgroup>
                <h1>@isset($allProdutos)
                    Alterar catálogo
                    @else
                    Cadastro catálogo @endisset</h1>
                <h2>Informe os dados no formulário a baixo</h2>
            </hgroup>
            @error('admin.catalogo.indexcadastro')
                <span class="error">{{$message}}</span>
            @enderror  
            @error('admin.catalogo.allProdutos')
                <span class="error">{{$message}}</span>
            @enderror  
            <div class="flex-r flex-jc mt-2">
                <div class="flex-c">
                    <div class="flex">
                        <div class="body-card-principal">
                            <span class="mb-3" style="font-size: 18px; font-weight: 400;">@isset($allProdutos)
                                Alterar cadastro do produto
                                @else
                                Cadastre seu produto/serviço @endisset</span>
                            <div>
                                <i class="iconeInput fas fa-box"></i>
                                <input type="text" class="mt-1" name="produto" placeholder="Produto/serviço" required="required" maxlength="20" autofocus
                                @isset($allProdutos) value="{{$allProdutos->produto}}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fas fa-bars"></i>
                                <input type="text" class="mt-1" name="codbarras" placeholder="Código barras" maxlength="13"
                                @isset($allProdutos) value="{{$allProdutos->codbarras}}" @endisset>
                            </div>
                            {{-- <div class="mt-4 w-100">
                                <a href="{{route('admin.catalogo')}}">
                                    <button type="button" class="botao">Voltar</button>
                                </a>
                                <button type="submit" class="botao">@isset($allProdutos)
                                    Salvar
                                    @else 
                                    Gravar @endisset</button>
                            </div> --}}
                        </div>
                        <div class="body-card-principal ml-1">
                            <span class="mb-3" style="font-size: 18px; font-weight: 400;">@isset($allProdutos)
                                Alterar cadastro do produto
                                @else
                                Cadastre seu produto/serviço @endisset</span>
                            <div>
                                <i class="iconeInput fas fa-poll"></i>
                                <input type="number" class="mt-1" name="quantidade" placeholder="Quantidade" required="required" maxlength="10"
                                @isset($allProdutos) value="{{ $allProdutos->quantidade }}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="number" class="mt-1" name="precocusto" placeholder="Preço custo R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precocusto}}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="number" class="mt-1" name="precovenda" placeholder="Preço venda R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precovenda}}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="number" class="mt-1" name="precopromocao" placeholder="Preço promoção R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precopromocao}}" @endisset>
                            </div>
                        </div>
                    </div>
                    @if ($allProdutos->galeria)
                        <div class="body-card-imgprodutos p-2">
                            <div class="flex-jb flex-ac" style="width: 318px; margin-left: 0.7rem;">
                                <span style="font-size: 18px; font-weight: 400;">Mídias</span>
                                <a href="" class="botao">Excluir as imagens</a>
                            </div>
                            <div style="width: 100%; height: 100%;" class="flex-as flex-w flex-jc mt-05">
                                <div class="upload-img">
                                    <i class="fas fa-camera"></i>
                                    <label for="image" style="pointer-events: none;">Clique ou arraste imagens</label>
                                    <input type="file" multiple="multiple" class="w-100 mt-05" id="image" hidden>
                                </div>
                                @foreach ($allProdutos->galeria as $i => $imgproduto)
                                    <img src="{{asset('storage/' . $allProdutos->galeria[$i]->descricaoimg)}}" alt="IMG" class="body-imgprodutos m-05">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </form>
    <script>
        let
            precocusto      = document.getElementsByName("precocusto")[0].value,
            precovenda      = document.getElementsByName("precovenda")[0].value,
            precopromocao   = document.getElementsByName("precopromocao")[0].value

            String(precocusto).replace(/(.)(?=(\d{3})+$)/g,'$1,')
            String(precovenda).replace(/(.)(?=(\d{3})+$)/g,'$1,')
            String(precopromocao).replace(/(.)(?=(\d{3})+$)/g,'$1,')
    </script>
@endsection 