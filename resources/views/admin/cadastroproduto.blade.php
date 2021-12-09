@extends('layouts.appadmin')
@section('body')
    <form id="form-produto" action="{{route('admin.catalogo.cadastro', (isset($allProdutos) ? $allProdutos->controle : null))}}" method="POST" enctype='multipart/form-data'>
        @csrf 
        @method('POST')
        <input type="text" name="id" @isset($allProdutos) value="{{$allProdutos->controle}}" @endisset hidden>
        <section class="container">
            <div class="flex-jb">
                <div class="flex-c ml-05">
                    <h1>@isset($allProdutos)
                        Alterar catálogo
                    @else
                        Cadastro catálogo @endisset</h1>
                    <h2>Informe os dados no formulário a baixo</h2>
                </div>
                    <div class="flex-ae mr-05">
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
            <div class="flex-r flex-jc mt-1 w-100">
                <div class="flex-c w-100 mr-05 ml-05">
                    <div class="flex">
                        <div class="body-card-principal p-2">
                            <span class="mb-2 subtitulo-card">@isset($allProdutos)
                                Alterar informações
                                @else
                                Cadastre seu produto/serviço @endisset
                            </span>
                            <div class="gap-1 flex-c">
                                <div class="w-100">
                                    {{-- <i class="iconeInput fas fa-box"></i> --}}
                                    <input type="text" class=" inputPadrao cl" name="produto" placeholder="Produto/serviço" required="required" maxlength="20" autofocus
                                    @isset($allProdutos) value="{{$allProdutos->produto}}" @endisset>
                                </div>
                                <div class="w-100">
                                    {{-- <i class="iconeInput fas fa-barcode"></i> --}}
                                    <input type="text" class=" inputPadrao" name="codbarras" placeholder="Código barras" maxlength="13"
                                    @isset($allProdutos) value="{{$allProdutos->codbarras}}" @endisset>
                                </div>
                            </div>
                        </div>
                        <div class="body-card-principal ml-1 p-2">
                            <span class="mb-2 subtitulo-card">@isset($allProdutos)
                                Alterar quantidade/valor
                                @else
                                Cadastre a quantidade/valor @endisset
                            </span>
                            <div class="gap-1 flex-c">
                                <div class="w-100 gap-1">
                                    <input type="text" class=" inputPadrao" name="quantidade" placeholder="Quantidade" required="required" maxlength="10"
                                    @isset($allProdutos) value="{{ $allProdutos->quantidade }}" @endisset>
                                    <input type="text" class=" inputPadrao vlr" id="precocusto" name="precocusto" placeholder="Preço custo R$" required="required"
                                    @isset($allProdutos) value="{{$allProdutos->precocusto}}" @endisset>
                                </div>
                                <div class="w-100 gap-1">
                                    <input type="text" class=" inputPadrao vlr" name="precovenda" placeholder="Preço venda R$" required="required"
                                    @isset($allProdutos) value="{{$allProdutos->precovenda}}" @endisset>
                                    <input type="text" class=" inputPadrao vlr" name="precopromocao" placeholder="Preço promoção R$" required="required"
                                    @isset($allProdutos) value="{{$allProdutos->precopromocao}}" @endisset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-card-imgprodutos p-2">
                        <div class="flex-jb flex-ac" style="width: 100%;">
                            <span class="subtitulo-card">Mídias</span>
                            <a href="javascript:void(0)" class="botao-secundario" onclick="excluirAllImg(this)">Excluir imagens</a>
                        </div>
                        <div style="width: 100%; height: 100%;" class="flex-as flex-w mt-05">
                            <div id="galeriaImagens" class="galeria flex-w">
                                <div class="area-upload">
                                    <label for="upload-file-produto" class="label-upload">
                                        <i class="fas fa-camera"></i>
                                        <div class="texto">Clique ou arraste imagens</div>
                                    </label>
                                    <input type="file" accept="image/*" name="image[]" id="upload-file-produto" multiple/>
                                    <input type="text" name="imagens" id="imagensProduto" hidden/>
                                </div>  
                            </div>
                            <div id="galeriaImagenss" class="flex">
                                @if (isset($allProdutos))
                                    @foreach ($allProdutos->galeria as $i => $imgproduto)
                                        <div style="position: static;">
                                            <a href="javascript:void(0)" class="fas fa-trash-alt flex-je iconeTrash" onclick="excluirImg(this)" data-id="{{$imgproduto->controle}}"></a>
                                            <img src="{{asset('storage/' . $allProdutos->galeria[$i]->descricaoimg)}}" alt="IMG" class="body-imgprodutos">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
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

        window.addEventListener('load', function() {

            var formProduto = document.getElementById('form-produto');

            formProduto.addEventListener('submit', function(e){
                e.preventDefault();
                var image = document.getElementById('upload-file-produto'),
                    galeriaImagens = document.querySelectorAll('#galeriaImagens .img'),
                    imagensProduto = document.getElementById('imagensProduto');
                    arrayImagens = [];

                if(galeriaImagens && galeriaImagens.length > 0){
                    galeriaImagens.forEach(element => {
                        arrayImagens.push(element.getAttribute('rel'));
                    });
                    imagensProduto.value = JSON.parse(JSON.stringify(arrayImagens));
                }
                formProduto.submit();
            })
            
            dropProdutoAdd_ = document.querySelector('.area-upload #upload-file-produto');

            if(dropProdutoAdd_){
                dropProdutoAdd_.addEventListener('dragenter', function(){
                    document.querySelector('.area-upload #upload-file-produto').previousElementSibling.classList.add('highlight');
                });
        
                dropProdutoAdd_.addEventListener('dragleave', function(){
                    document.querySelector('.area-upload #upload-file-produto').previousElementSibling.classList.remove('highlight');
                });
        
                dropProdutoAdd_.addEventListener('drop', function(){
                    document.querySelector('.area-upload #upload-file-produto').previousElementSibling.classList.remove('highlight');
                });
            }
    
            document.querySelector('#upload-file-produto').addEventListener('change', function() { 
                var 
                    files           = this.files,
                    images          = document.getElementById('galeriaImagens'),
                    countImg        = images.querySelectorAll('.img').length,
                    erroBanner      = document.getElementById('erroBanner');

                Array.prototype.forEach.call(files, function(item, indice, array){
                    var 
                        uploader    = document.createElement('input'),
                        div         = document.createElement('div'),
                        divAdc      = document.createElement('div'),
                        reader      = new FileReader();

                    if (countImg >= 24) {
                        return false;
                    }

                    ++countImg;
    
                    reader.onload = function(event) {
                        if (event.total < 10485760) {
                            div.classList.add('img');
                            div.classList.add('addNewImg');
                            div.style.backgroundImage = 'url(\'' + event.target.result + '\')';
                            div.setAttribute('rel', event.target.result);

                            div.innerHTML = `
                                <div class="group-buttons-galeria-produtos">
                                    <div class="flex-jc flex-ac divRemoveImg pointer" onclick="removerImagem(this)" data-tooltip="Remover imagem" data-tooltip-location="left">
                                        <svg class="svg-lixeira"></svg>
                                    </div>
                                </div>
                            `;
                            
                            images.append(div);
                        }
                    }
                    reader.readAsDataURL(item);

                    if (countImg >= 24) {
                        images.querySelector('.area-upload').style.display = 'none';
                    }else{
                        images.querySelector('.area-upload').style.display = 'block';
                    }
                });
            });
        });
    </script>
@endsection 