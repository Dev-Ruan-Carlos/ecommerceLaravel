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
            <div class="body-card-complemento">
                <img src="{{asset('storage/banners/bannerproduto.jpg')}}" alt="" class="banners" style="width: 100%; height: 651px; border-radius: 5px;">
            </div>
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
                <div>
                    <i class="iconeInput fas fa-poll"></i>
                    <input type="number" class="mt-1" name="quantidade" placeholder="Quantidade" required="required" maxlength="10"
                    @isset($allProdutos) value="{{ number_format($allProdutos->quantidade, 4 , '.', ',') }}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                    <input type="number" class="mt-1" name="precocusto" placeholder="Preço custo R$" required="required"
                    @isset($allProdutos) value="{{number_format($allProdutos->precocusto, 2, '.', ',' )}}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                    <input type="number" class="mt-1" name="precovenda" placeholder="Preço venda R$" required="required"
                    @isset($allProdutos) value="{{number_format($allProdutos->precovenda, 2, '.', ',' )}}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                    <input type="number" class="mt-1" name="precopromocao" placeholder="Preço promoção R$" required="required"
                    @isset($allProdutos) value="{{number_format($allProdutos->precopromocao, 2, '.', ',' )}}" @endisset>
                </div>
                <div>
                    <i class="iconeInput fas fa-file-image" style="font-size: 20px;"></i>
                    <input type="file" multiple="multiple" class="mt-1 w-100" name="image[]" placeholder="Imagem do produto"
                    @isset($allProdutos) value="" @endisset>
                </div>
                @isset ($allProdutos->galeria)
                    <div class="w-100 flex-jb">
                        <img src="{{asset('storage/' . $allProdutos->galeria[0]->descricaoimg)}}" alt="">
                    </div>
                @endisset
                <div class="mt-4 w-100">
                    <a href="{{route('admin.catalogo')}}">
                        <button type="button" class="botao">Voltar</button>
                    </a>
                    <button type="submit" class="botao">@isset($allProdutos)
                        Salvar
                        @else 
                        Gravar @endisset</button>
                </div>
            </div>
        </div>
    </section>
</form>
<script>
    let
        precocusto = document.getElementsByName("precocusto")[0].value,
        precovenda = document.getElementsByName("precovenda")[0].value,
        precopromocao = document.getElementsByName("precopromocao")[0].value

        String(precocusto).replace(/(.)(?=(\d{3})+$)/g,'$1,')
        String(precovenda).replace(/(.)(?=(\d{3})+$)/g,'$1,')
        String(precopromocao).replace(/(.)(?=(\d{3})+$)/g,'$1,')
</script>
@endsection 