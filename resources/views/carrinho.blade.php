@extends('layouts.app')
@section('body')
@csrf
@method('POST')
    <h1 class="flex-jc" style="margin-top: 2rem;">Carrinho de compras</h1>
    <a href="" class=" volta-carrinho"></a>
    <div class="flex-c">
        @php
            $itens = 0;
            $quantidadeTotal = 0; 
            $valorTotal = 0; 
        @endphp
        @if ($carrinho->itens->count() <= 0)
            <h1></h1>
        @else
            @foreach ($carrinho->itens as $item)
                @php
                    $quantidadeTotal += $item->quantidade;

                    if ($item->precopromocao > 0) {
                        $valorTotal += $item->precopromocao*$item->quantidade;
                    }else {
                        $valorTotal += $item->precovenda*$item->quantidade;
                    }
                @endphp
                @if ($carrinhoItem[0]->galeria)
                    @foreach ($carrinhoItem as $carrinho)
                        <div class="campo-maior flex-jc p-1">
                            <article style="display: flex; width: 100%;">
                                    @if ($carrinho->galeria->count() > 0)
                                    {{-- {{dd($carrinho->galeria[0])}} --}}
                                        <img src="{{asset('storage/' . $carrinho->galeria[0]->descricaoimg)}}" alt="LOGO" class="imgproduto">
                                    @else 
                                        <img src="{{asset('storage/produtos/semimagem.png')}}" alt="LOGO" class="imgproduto">
                                    @endif
                                    <div class="flex-se flex-c flex-jb ml-3" style="width: 40%;">
                                        <span class="nome-produto">{{"Produto: " . $item->produto}}</span>
                                        <span class="venda-item">{{"Preço venda R$ " . number_format($item->precovenda, 2, ',', '.' )}}</span>
                                        <span class="promocao-item">{{"Promoção R$ " . number_format($item->precopromocao, 2, ',', '.' )}}</span>
                                        @if( $item->precopromocao > 0 )
                                            <span class="total-item">{{"Valor subtotal R$ " . number_format($item->precopromocao*$item->quantidade, 2, ',', '.' )}}</span>
                                        @else
                                            <span class="total-item">{{"Valor subtotal R$ " . number_format($item->precovenda*$item->quantidade, 2, ',', '.' )}}</span>
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
                @endif
            @endforeach
        @endif
    </div>
    <div class="info-carrinho">
        {{-- {{dd($item)}} --}}
        <div class="flex-c w-100 flex-jb">
            <div class=>
                <h4 style="display: flex; justify-content: center;">Resumo de pedido</h4>
                <div class="flex-jb">
                    <span class="mt-2 flex">{{ "Quantidade total comprada: " }}</span>
                    {{-- {{dd('$item')}} --}}
                        <span class="quantidadeTotal mt-2 ml-05">{{$itens}}</span>
                </div>
                <br>
                <div class="flex-jb">
                    <span>{{ "Valor total: " }}</span>
                    @if (!$carrinho->itens)
                        <span class="flex valorTotal ml-05">{{"R$ " . number_format($valorTotal*$quantidadeTotal, 2, ',', '.' )}}</span>
                    @else 
                        <span class="flex valorTotal ml-05">{{"R$ " . number_format($valorTotal*$quantidadeTotal, 2, ',', '.' )}}</span>
                    @endif
                </div>
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
                if (response.resumo.precopromocaototal && response.resumo.precopromocaototal > 0 || response.resumo.precopromocaototal == true) {
                    document.querySelector('.valorTotal').innerHTML         = formatar(response.resumo.precopromocaototal); 
                }else{
                    document.querySelector('.valorTotal').innerHTML         = formatar(response.resumo.precovendatotal); 
                }
                document.querySelector('.quantidadeTotal').innerHTML    = response.resumo.quantidade;
            })
        }
    </script>
@endsection 