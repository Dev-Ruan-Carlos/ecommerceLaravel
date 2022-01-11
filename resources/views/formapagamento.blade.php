@extends('layouts.app')
@section('body')
    <div class="flex-jc flex-ac flex-c" style="min-height: 89vh !important;">
        <form action="{{route('pagamento.finalizarCompra', $pedido->controle)}}" method="POST">
            @csrf 
            @method('POST')
            <div class="telaPagamentoFinalizacao flex-jc flex-c flex-ac p-2 mb-1 mt-1">
                <h1 class="flex-jc">Forma de pagamento</h1>
                <div class="w-100">
                    <div class="flex-c w-100">
                        <div class="formDinheiro borderFormaPagamento flex-ac mt-3 font w-100 p-05">
                            <input class="radio ml-1" name="pagamento" value="dinheiro" id="dinheiro" type="radio" onchange="mostrardiv(this)" style="width: 20px !important; height: 20px !important; ">
                            <label for="pagamento" class="ml-2 flex-ac mt-025" style="margin-bottom: 0 !important; font-size: 18px !important">Dinheiro *</label>
                        </div>
                        <div class="formBoleto borderFormaPagamento flex-ac mt-3 font w-100 p-05">
                            <input class="radio ml-1" name="pagamento" value="local" id="local" type="radio" onchange="mostrardiv(this)" style="width: 20px !important; height: 20px !important; ">
                            <label for="pagamento" class="ml-2 flex-ac mt-025" style="margin-bottom: 0 !important; font-size: 18px !important">Pagamento no local *</label>
                        </div>
                        <div class="formCartao borderFormaPagamento flex-ac mt-3 font w-100 p-05">
                            <input class="radio ml-1" name="pagamento" value="cartao" id="cartao" type="radio" onchange="mostrardiv(this)" style="width: 20px !important; height: 20px !important; ">
                            <label for="pagamento" class="ml-2 flex-ac mt-025" style="margin-bottom: 0 !important; font-size: 18px !important">Cartão *</label>
                        </div>
                    </div>
                </div> 
                <div class="mt-3 flex-jb w-100">
                    <a href="{{route('admin.pedido')}}" class="botao">Voltar</a>
                    <button type="submit" class="botao">Finalizar compra</button>
                </div>
            </div>
            <div class="mt-1">
                <div class="telaCartaoFinalizacao flex-c" id="telacartao" style="display: none;">
                    <div class="tela-cartao">
                        <img src="{{asset('img/cartão2.jpg')}}" alt="" style="max-width: 300px; max-height: 103px;">
                    </div>
                    <div class="flex-c mt-1">
                        <input type="text" name="nomecartao" class="inputPadrao black" placeholder="Nome ( Igual no cartão )">
                        <div class="mt-05">
                            <input type="text" class="inputPadrao black" name="ncartao" id="ncartao" placeholder="Número do cartão" maxlength="19">
                            <input type="text" class="inputPadrao black" value="00/00" name="validadecartao" id="validadecartao" placeholder="Validade mês/ano" style="width: 116px;" maxlength="5">
                            <input type="text" class="inputPadrao black" id="seguranca" name="numseguranca" placeholder="CVV" style="width: 70px; padding: 1rem !important;" maxlength="3">
                            <span for="" class="ml-05">Tipo pagamento</span>
                            <select id="tipoPagamento" class="tamanhoinput black mt-05 ml-05" placeholder="Tipo Cartão" name="tipoPagamento" style="width: 228px;" oninput="mostrarDivParcelas(this)">
                                <option class="p-1 black" value="1">Débito</option>
                                <option class="p-1 black" value="2">Crédito</option>
                            </select>
                        </div>
                        <div class="flex-c mt-05" id="parcelamento" style="display: none;">
                            <label for="" class="ml-05">Parcelas</label>
                            <select id="parcelas" class="tamanhoinput black mt-05 p-05" placeholder="Nº de parcelas" name="parcelas">
                                <option class="p-1 black" value="1">1x Sem juros</option>
                                <option class="p-1 black" value="2">2x Sem juros</option>
                                <option class="p-1 black" value="3">3x Sem juros</option>
                                <option class="p-1 black" value="4">4x Sem juros</option>
                                <option class="p-1 black" value="5">5x Sem juros</option>
                                <option class="p-1 black" value="6">6x Sem juros</option>
                                <option class="p-1 black" value="7">7x Sem juros</option>
                                <option class="p-1 black" value="8">8x Sem juros</option>
                                <option class="p-1 black" value="9">9x Sem juros</option>
                                <option class="p-1 black" value="10">10x Sem juros</option>
                                <option class="p-1 black" value="11">11x Sem juros</option>
                                <option class="p-1 black" value="12">12x Sem juros</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mcc(v){
            v=v.replace(/\D/g,"");
            v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
            v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
            v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('ncartao').onkeypress = function(){
                mascara( this, mcc );
            }
        }

        function mostrardiv(el) {
            if(el.id == 'cartao'){
                id('telacartao').style.display = 'block';
            }else{
                id('telacartao').style.display = 'none';
            }
        }

        function mostrarDivParcelas(el){
            if(el.value == 2){
                id('parcelamento').style.display = 'flex'
            }else{
                id('parcelamento').style.display = 'none'
            }
        }
    </script>
@endsection