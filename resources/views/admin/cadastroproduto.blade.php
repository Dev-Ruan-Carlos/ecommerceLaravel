@extends('layouts.appadmin')
@section('body')
    <form action="{{route('admin.catalogo.cadastro', (isset($allProdutos) ? $allProdutos->controle : null))}}" method="GET" enctype='multipart/form-data'>
        @csrf 
        @method('GET')
        <input type="text" name="id" @isset($allProdutos) value="{{$allProdutos->controle}}" @endisset hidden>
        <section class="container">
            <div class="flex-jb">
                <div class="flex-c">
                    <h1>@isset($allProdutos)
                        Alterar catálogo
                    @else
                        Cadastro catálogo @endisset</h1>
                    <h2>Informe os dados no formulário a baixo</h2>
                </div>
                    <div class="flex-ae w-100 mr-1">
                        <a href="{{route('admin.catalogo')}}">
                            <button type="button" class="botao">Voltar</button>
                        </a>
                        <button type="submit" class=" ml-1 botao">@isset($allProdutos)
                            Salvar
                            @else 
                            Gravar @endisset</button>
                    </div>
                </div>
            @error('admin.catalogo.indexcadastro')
                <span class="error mt-1">{{$message}}</span>
            @enderror  
            @error('admin.catalogo.allProdutos')
                <span class="error mt-1">{{$message}}</span>
            @enderror  
            <div class="flex-r flex-jc mt-2">
                <div class="flex-c">
                    <div class="flex">
                        <div class="body-card-principal p-2">
                            <span class="mb-3" style="font-size: 18px; font-weight: 400;">@isset($allProdutos)
                                Alterar informações
                                @else
                                Cadastre seu produto/serviço @endisset</span>
                            <div>
                                <i class="iconeInput fas fa-box"></i>
                                <input type="text" class="mt-1 inputPadrao" name="produto" placeholder="Produto/serviço" required="required" maxlength="20" autofocus
                                @isset($allProdutos) value="{{$allProdutos->produto}}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fas fa-bars"></i>
                                <input type="text" class="mt-1 inputPadrao" name="codbarras" placeholder="Código barras" maxlength="13"
                                @isset($allProdutos) value="{{$allProdutos->codbarras}}" @endisset>
                            </div>
                        </div>
                        <div class="body-card-principal ml-1 p-2">
                            <span class="mb-3" style="font-size: 18px; font-weight: 400;">@isset($allProdutos)
                                Alterar quantidade/valor
                                @else
                                Cadastre a quantidade/valor @endisset</span>
                            <div>
                                <i class="iconeInput fas fa-poll"></i>
                                <input type="text" class="mt-1 inputPadrao2" name="quantidade" placeholder="Quantidade" oninput="formatar(this)" required="required" maxlength="10"
                                @isset($allProdutos) value="{{ $allProdutos->quantidade }}" @endisset>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="text" class="mt-1 inputPadrao2" id="precocusto" name="precocusto" oninput="formatar(this)" placeholder="Preço custo R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precocusto}}" @endisset>
                            </div>
                            <div>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="text" class="mt-1 inputPadrao2" name="precovenda" oninput="formatar(this)" placeholder="Preço venda R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precovenda}}" @endisset>
                                <i class="iconeInput fa fa-dollar-sign" style="font-size: 20px;"></i>
                                <input type="text" class="mt-1 inputPadrao2" name="precopromocao" oninput="formatar(this)" placeholder="Preço promoção R$" required="required"
                                @isset($allProdutos) value="{{$allProdutos->precopromocao}}" @endisset>
                            </div>
                        </div>
                    </div>
                    @if ($allProdutos->galeria)
                        <div class="body-card-imgprodutos p-2">
                            <div class="flex-jb flex-ac" style="width: 100%; margin-left: 0.7rem;">
                                <span style="font-size: 18px; font-weight: 400;">Mídias</span>
                                <a href="javascript:void(0)" class="botao" onclick="excluirAllImg(this)">Excluir imagens</a>
                            </div>
                            <div style="width: 100%; height: 100%;" class="flex-ae flex-w mt-05">
                                <div class="upload-img">
                                    <i class="fas fa-camera"></i>
                                    <label for="image" style="pointer-events: none;">Clique ou arraste imagens</label>
                                    <input type="file" multiple="multiple" class="w-100 mt-05" id="image">
                                </div>
                                @foreach ($allProdutos->galeria as $i => $imgproduto)
                                    <div class="flex">
                                        <a href="javascript:void(0)" class="fas fa-trash-alt flex-je iconeTrash" onclick="excluirImg(this)" data-id="{{$imgproduto->controle}}"></a>
                                        <img src="{{asset('storage/' . $allProdutos->galeria[$i]->descricaoimg)}}" alt="IMG" class="body-imgprodutos m-05">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </form>
    <script>
        function excluirImg(el){
            $.ajax({
                url: "{{route('admin.catalogo.deleteImg', '_id_')}}".replace('_id_', el.dataset.id),
                type: "DELETE",
                data: {
                    id: el.dataset.id
                },
                beforeSend: function(request){
                    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                }
            }).done(response => {
                window.location.reload();
            })
        }

        function excluirAllImg(el){
            $.ajax({
                url: "{{route('admin.catalogo.deleteAllImg')}}".replace(el.dataset.id),
                type: "DELETE",
                data: {
                    id: el.dataset.id
                },
                beforeSend: function(request){
                    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
                }
            }).done(response => {
                window.location.reload();
            })  
        }
    </script>
@endsection 