@extends('layouts.app')
@section('body')
@csrf
@method('POST')
    <h1 class="flex-jc" style="margin-top: 2rem;">Carrinho de compras</h1>
    <a href="" class=" volta-carrinho"></a>
    <div class="flex-c">
        @php
            $quantidadeTotal = 0; 
            $valorTotal = 0; 
        @endphp
        @foreach ($carrinho->itens as $item)
            @php
                $quantidadeTotal += $item->quantidade;

                if ($item->precopromocao > 0) {
                    $valorTotal += $item->precopromocao*$item->quantidade;
                }else {
                    $valorTotal += $item->precovenda*$item->quantidade;
                }
            @endphp
            <div class="campo-maior flex-jc p-1">
                <article style="display: flex; width: 100%;">
                    <img src="{{asset('storage/banners/bannerrelogio9.jpg')}}" alt="LOGO" class="imgproduto-carrinho">
                    <div class="flex-se flex-c flex-jb ml-3" style="width: 40%;">
                        <span class="nome-produto">{{"Produto: " . $item->produto}}</span>
                        <span class="venda-item">{{"Preço venda R$ " . number_format($item->precovenda, 2, ',', '.' )}}</span>
                        <span class="promocao-item">{{"Promoção R$ " . number_format($item->precopromocao, 2, ',', '.' )}}</span>
                        @if($item->precopromocao > 0 )
                            <span class="total-item">{{"Valor subtotal R$ " . number_format($item->precopromocao*$item->quantidade, 2, ',', '.' )}}</span>
                        @else
                            <span class="total-item">{{"R$ " . number_format($item->precovenda*$item->quantidade, 2, ',', '.' )}}</span>
                        @endif
                    </div>
                    <div class="flex-c flex-jc">
                        <div class="flex-jb box-quantidade">
                            @if($item->produtos->quantidade <= $carrinhoItem )
                                <a href="javascript:void(0)" class="flex">
                                    <button type="button" onclick="incrementarItem(this)" data-id="{{$item->controle}}" class="mais">+</button>
                                </a>
                            @else 
                                <a href="javascript:void(0)" class="flex">
                                    <button type="button" onclick="incrementarItem(this)" data-id="{{$item->controle}}" class="mais" disabled>+</button>
                                </a>
                            @endif
                            <span class="quantidade-produto flex-ac">{{$item->quantidade}}</span>
                            <a href="javascript:void(0)" class="flex">
                                <button type="button" onclick="delimitarItem(this)" data-id="{{$item->controle}}" class="menos">-</button>
                            </a>
                        </div>
                        <span class="quantidade-produto mt-1">{{"Disponível: " . number_format($item->produtos->quantidade, 4, ',', '.' )}}</span>
                    </div>
                </article>
                <a href="javascript:void(0)" onclick="deletarItem(this)" data-id="{{$item->controle}}" class="deletar">Deletar</a>
            </div>
        @endforeach
    </div>
    <div class="info-carrinho">
        <div class="flex-c w-100 flex-jb">
            <div class=>
                <h4 style="display: flex; justify-content: center;">Resumo de pedido</h4>
                <span class="mt-2 flex quantidadeTotal">0</span>
                <br>
                <span class="flex valorTotal">0</span>
            </div>
            <div class="flex-c w-100">
                <a href="{{route('buscainicio.buscar')}}">
                    <button class="botao hover flex-ac flex-jc font-17" style="width: 100%;">Ir para o catálogo</button>
                </a>
                <a href="{{route('salvar')}}">
                    <button class="botao hover mt-1 flex-ac flex-jc font-17" style="width: 100%;">Finalizar compra</button>
                </a>
            </div>
        </div>
    </div>
    <script>

        function incrementarItem(el){
            $.ajax({
                url: "{{route('incrementarItem','_id_')}}".replace('_id_', el.dataset.id),
                type: "GET",
            }).done(response => {
                el.closest('.box-quantidade').querySelector('.quantidade-produto').innerHTML = response.quantidade
                carregarDados();
                if (response.quantidade >= response.quantidadeDisponivel) {
                    el.disabled = true;
                }
            })  
        }
        
        function delimitarItem(el){
            $.ajax({
                url: "{{route('delimitarItem','_id_')}}".replace('_id_', el.dataset.id),
                type: "GET",
            }).done(response => {
                el.closest('.box-quantidade').querySelector('.quantidade-produto').innerHTML    = response.quantidade;
                el.closest('.box-quantidade').querySelector('.mais').disabled                   = false;
                carregarDados();
            })  
        }

        function deletarItem(el){
            $.ajax({
                url: "{{route('deletarItem', '_id_')}}".replace('_id_', el.dataset.id),
                type: "GET",
            }).done(response => {
                el.closest('.campo-maior').remove();
                carregarDados();
            })
        }

        function carregarDados(){
            $.ajax({
                url: "{{route('carregarDados')}}",
                type: "GET",
            }).done(response =>{
                document.querySelector('.quantidadeTotal').innerHTML    = response.quantidade;
                document.querySelector('.valorTotal').innerHTML         = response.precovendaTotal; 
            })
        }
    </script>
@endsection 