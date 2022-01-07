@extends('layouts.appadmin')
@section('body')
    <form id="form-usuario" action="{{route('admin.meusdados.cadastro', (isset($dados->meusDados) ? $dados->meusDados->controle : null))}}" method="POST" enctype='multipart/form-data'>
        @csrf 
        @method('POST')
        <input type="text" name="id" @isset($dados->meusDados) value="{{$dados->meusDados->codusuario}}" @endisset hidden>
        {{-- {{dd($dados->meusDados->galeria)}} --}}
        <section class="container">
            <div class="flex-jb flex-ae flex-w">
                <div class="flex-c mr-1">
                    <h1>Meus dados</h1>
                    <h2>Informações do usuário logado</h2>
                </div>
                {{-- <a href="" class="botao"></a> --}}
                <button type="submit" class="botao">Cadastrar dados</button>
            </div>
            <div class="flex-c">
                <div class="flex">
                    <div class="body-card-principal mt-1 flex-c p-2">
                        <span>Dados do usuário</span>
                        <div class="w-100 mt-1">
                            <div class="flex w-100 gap-2">
                                <div class="w-100 field">
                                    <label class="label mb-1" for="nome">Nome *</label>
                                    <input name="nome" type="text" class="inputPadrao cl mt-1"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->nomeusuario}}" @endisset>
                                </div>
                                <div class="w-100 field">
                                    <label class="label mb-1" for="sobrenome">Sobrenome *</label>
                                    <input name="sobrenome" type="text" class="inputPadrao cl mt-1"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->sobrenomeusuario}}" @endisset>
                                </div>
                            </div>
                            <div class="flex w-100 gap-2">
                                <div class="w-100 field">
                                    <label class="label mb-1" for="cpf">CPF *</label>
                                    <input name="cpf" type="text" class="inputPadrao cl mt-1 cpf"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->cpf}}" @endisset>
                                </div>
                                <div class="w-100 field">
                                    <label class="label mb-1" for="rg">RG *</label>
                                    <input name="rg" type="text" class="inputPadrao cl mt-1 rg"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->rg}}" @endisset>
                                </div>
                            </div>
                            <div class="w-100 field">
                                <label class="label mb-1" for="cargo">Cargo *</label>
                                <input name="cargo" type="text" class="inputPadrao cl-12 mt-1"
                                @isset($dados->meusDados) value="{{$dados->meusDados->cargo}}" @endisset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="body-card-principal mt-1 flex-c p-2">
                        <span>Datas</span>
                        <div class="w-100 mt-1">
                            <div class="w-100 field">
                                <label class="label mb-1" for="datanascimento">Data de nascimento *</label>
                                <input name="datanascimento" type="date" class="inputPadrao mt-1 initRight"
                                @isset($dados->meusDados) value="{{$dados->meusDados->datanascimento}}" @endisset>
                            </div>
                            <div class="flex w-100 gap-2">
                                <div class="w-100 field">
                                    <label class="label mb-1" for="dataadmissao">Data admissão</label>
                                    <input name="dataadmissao" type="date" class="inputPadrao mt-1 initRight"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->dataadmissao}}" @endisset>
                                </div>
                                <div class="w-100 field">
                                    <label class="label mb-1" for="datarescisao">Data rescisão</label>
                                    <input name="datarescisao" type="date" class="inputPadrao mt-1 initRight"
                                    @isset($dados->meusDados) value="{{$dados->meusDados->datarescisao}}" @endisset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-card-principal ml-1 mt-1 flex-c p-2">
                        <span>Complementar</span>
                        <div class="w-100 mt-1">
                            <div class="w-100 field">
                                <label class="label mb-1" for="nomepai">Nome do pai *</label>
                                <input name="nomepai" type="text" class="inputPadrao cl-12 mt-1"
                                @isset($dados->meusDados) value="{{$dados->meusDados->nomepai}}" @endisset>
                            </div>
                            <div class="w-100 field">
                                <label class="label mb-1" for="nomemae">Nome da mãe *</label>
                                <input name="nomemae" type="text" class="inputPadrao cl-12 mt-1"
                                @isset($dados->meusDados) value="{{$dados->meusDados->nomemae}}" @endisset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body-card-imgprodutos p-2">
                    <div class="flex-jb flex-ac" style="width: 100%;">
                        <span class="subtitulo-card">Mídias</span>
                        @if ($dados->user->img)
                            <a href="javascript:void(0)" class="botao-secundario" onclick="excluirImg(this)" data-id="{{$dados->user->img->controle}}">Excluir imagem</a>
                        @endif
                    </div>
                    <div style="width: 100%; height: 100%;" class="flex-as flex-w mt-05">
                        @if (!$dados->meusDados->galeria->count() > 0)
                            <div id="galeriaImagens" class="galeria flex-w">
                                <div class="area-upload">
                                    <label for="upload-file-usuario" class="label-upload">
                                        <i class="fas fa-camera"></i>
                                        <div class="texto">Clique ou arraste imagens</div>
                                    </label>
                                    <input type="file" accept="image/*" name="image[]" id="upload-file-usuario" multiple/>
                                    <input type="text" name="imagens" id="imagensUsuario" hidden/>
                                </div>  
                            </div>
                        @endif
                        <div id="galeriaImagenss" class="flex">
                            @if (isset($dados->meusDados->galeria))
                                @foreach ($dados->meusDados->galeria as $i => $imgusuario)
                                    <div style="position: static;">
                                        {{-- <a href="javascript:void(0)" class="fas fa-trash-alt flex-je iconeTrash" onclick="excluirImg(this)" data-id="{{$imgusuario->controle}}"></a> --}}
                                        <img src="{{asset('storage/' . $dados->meusDados->galeria[$i]->descricaoimg)}}" alt="IMG" class="body-imgprodutos">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <script>
        function excluirImg(el){
            $.ajax({
                url: "{{route('admin.meusdados.deleteImg', '_id_')}}".replace('_id_', el.dataset.id),
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
                url: "{{route('admin.meusdados.deleteAllImg')}}".replace(el.dataset.id),
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

            var formProduto = document.getElementById('form-usuario');

            formProduto.addEventListener('submit', function(e){
                e.preventDefault();
                var image = document.getElementById('upload-file-usuario'),
                    galeriaImagens = document.querySelectorAll('#galeriaImagens .img'),
                    imagensUsuario = document.getElementById('imagensUsuario');
                    arrayImagens = [];
                    
                if(galeriaImagens && galeriaImagens.length > 0){
                    galeriaImagens.forEach(element => {
                        arrayImagens.push(element.getAttribute('rel'));
                    });
                    imagensUsuario.value = JSON.parse(JSON.stringify(arrayImagens));
                }
                formProduto.submit();
            })
            
            dropProdutoAdd_ = document.querySelector('.area-upload #upload-file-usuario');

            if(dropProdutoAdd_){
                dropProdutoAdd_.addEventListener('dragenter', function(){
                    document.querySelector('.area-upload #upload-file-usuario').previousElementSibling.classList.add('highlight');
                });
        
                dropProdutoAdd_.addEventListener('dragleave', function(){
                    document.querySelector('.area-upload #upload-file-usuario').previousElementSibling.classList.remove('highlight');
                });
        
                dropProdutoAdd_.addEventListener('drop', function(){
                    document.querySelector('.area-upload #upload-file-usuario').previousElementSibling.classList.remove('highlight');
                });
            }
    
            document.querySelector('#upload-file-usuario').addEventListener('change', function() { 
                var 
                    files           = this.files,
                    images          = document.getElementById('galeriaImagens'),
                    countImg        = images.querySelectorAll('.img').length,
                    erroBanner      = document.getElementById('erroBanner');

                if (files.length > 1) {
                    alert('Só é possível selecionar uma imagem por usuário !')
                }else{
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
    
                                // div.innerHTML = `
                                //     <div class="group-buttons-galeria-produtos">
                                //         <div class="flex-jc flex-ac divRemoveImg pointer" onclick="excluirImg(this)" data-tooltip="Remover imagem" data-tooltip-location="left">
                                //             <svg class="svg-lixeira"></svg>
                                //         </div>
                                //     </div>
                                // `;
                                
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
                }
            });
        });
    </script>
@endsection 