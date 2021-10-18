@extends('layouts.app')
@section('body')
    <div class="fundoazul flex-jc flex-ac">
        <div class="telaPagamentoFinalizacao flex-c flex-ac p-2 mb-1">
            <h2 class="flex-jc">Forma de pagamento</h2>
                <div class="flex-c flex-jb">
                    <div class="formDinheiro flex-jc mt-5 font">
                        <input class="radio" name="dinheiro" value="dinheiro" id="dinheiro" type="radio">
                        <i class=" ml-2 fas fa-money-bill-alt flex-ac"></i>
                        <label for="dinheiro" class="ml-2 flex-ac">Dinheiro</label>
                    </div>
                    <div class="formBoleto flex-jc mt-5 font">
                        <input class="radio" name="boleto" style="right: 7px;" value="Boleto" id="boleto" type="radio">
                        <i class=" ml-2 fas fas fa-envelope-open-text flex-ac"></i>
                        <label for="boleto" class="ml-3 flex-ac">Boleto</label>
                    </div>
                    <div class="formCartao flex-jc mt-5 font">
                        <input class="radio" name="cartao" style="right: 6px" value="Cartao" id="cartao" type="radio">
                        <i class=" ml-2 fas fas fa-mail-bulk flex-ac"></i>
                        <label for="cartao" class="ml-3 flex-ac">Cartão</label>
                    </div>
                </div>
        </div>
    </div>
@endsection