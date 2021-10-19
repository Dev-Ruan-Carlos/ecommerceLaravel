@extends('layouts.app')
@section('body')
<div class="fundoazul flex-jc flex-ac flex-c">
    <form action="{{route('pagamento.finalizarCompra', $pedido->controle)}}" method="POST">
        @csrf 
        @method('POST')
        <div class="telaPagamentoFinalizacao flex-jc flex-c flex-ac p-2 mb-1">
            <h2 class="flex-jc">Forma de pagamento</h2>
                <div class="flex-c flex-js">
                    <div class="formDinheiro flex-js mt-3 font">
                        <input class="radio" name="pagamento" value="dinheiro" id="dinheiro" type="radio" onchange="mostrardiv(this)">
                        <i class=" ml-2 fas fa-money-bill-alt flex-ac"></i>
                        <label for="pagamento" class="ml-2 flex-ac">Dinheiro</label>
                    </div>
                    <div class="formBoleto flex-js mt-3 font">
                        <input class="radio" name="pagamento" value="local" id="local" type="radio" onchange="mostrardiv(this)">
                        <i class=" ml-2 fas fa-home flex-ac"></i>
                        <label for="pagamento" class="ml-3 flex-ac">Pagamento no local</label>
                    </div>
                    <div class="formCartao flex-js mt-3 font">
                        <input class="radio" name="pagamento" value="cartao" id="cartao" type="radio" onchange="mostrardiv(this)">
                        <i class=" ml-2 fas fas fa-mail-bulk flex-ac"></i>
                        <label for="pagamento" class="ml-3 flex-ac">Cartão</label>
                    </div>
                    <div class="mt-2 flex-jb">
                        <a href="{{route('buscainicio.buscar')}}" class="footer-finalizacao">Voltar</a>
                        <button type="submit" class="ml-5 footer-finalizacao">Finalizar compra</button>
                    </div>
                </div> 
        </div>
        <div class="mt-3">
            <div class="telaCartaoFinalizacao flex-c" id="telacartao" style="display: none;">
                <div class="tela-cartao" id="">
                    <img src="{{asset('img/cartão2.jpg')}}" alt="" style="max-width: 195px; max-height: 103px;">
                </div>
                <div class="flex-c mt-1">
                    <input type="text" name="nomecartao" class="tamanhoinput black" placeholder="Nome ( Igual no cartão )">
                    <div class="mt-05">
                        <input type="text" class="tamanhoinput black" name="ncartao" id="ncartao" placeholder="Número do cartão" maxlength="19">
                        <input type="text" class="tamanhoinput black ml-05" value="00/00" name="validadecartao" id="validadecartao" placeholder="Validade mês/ano" style="width: 116px;" maxlength="5">
                        <input type="text" class="tamanhoinput black ml-05" name="numseguranca" placeholder="CVV" style="width: 70px;" maxlength="3">
                        <label for="" class="ml-05">Tipo pag</label>
                        <select id="tipoPagamento" class="tamanhoinput black mt-05 ml-05" placeholder="Tipo Cartão" name="tipoPagamento" style="width: 75px;" oninput="mostrarDivParcelas(this)">
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