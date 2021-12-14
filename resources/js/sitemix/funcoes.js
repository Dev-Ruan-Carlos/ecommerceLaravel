function formatar(valor, tp = null) {
    var moeda = 'R$ ';
    if(valor){
        valor = ('' + valor).replace(',', '.');
        valor = ('' + valor).split('.');
        var parteInteira = valor[0];
        var parteDecimal = valor[1];
    
        // tratar a parte inteira
        var rx = /(\d+)(\d{3})/;
        parteInteira = parteInteira.replace(/^\d+/, function(w) {
            while (rx.test(w)) {
            w = w.replace(rx, '$1.$2');
            }
            return w;
        });
    
        // tratar a parte decimal
        var formatoDecimal = 2;
    
        if (parteDecimal) parteDecimal = parteDecimal.slice(0, formatoDecimal);
        else if ((!parteDecimal) && formatoDecimal) {
            parteDecimal = '';
            while (parteDecimal.length < formatoDecimal) {
                parteDecimal = '0' + parteDecimal;
            }
        }
        if (parteDecimal.length < formatoDecimal) {
            while (parteDecimal.length < formatoDecimal) {
            parteDecimal = parteDecimal + '0';
            }
        }
        if(tp)
            var string = (parteDecimal ? [parteInteira, parteDecimal].join(',') : parteInteira);
        else
            var string = moeda + (parteDecimal ? [parteInteira, parteDecimal].join(',') : parteInteira);
    }else{
        if(tp)
            var string = '0,00';
        else
            var string = moeda + '0,00';
    }
    return string;
}

window.addEventListener('load', function(){
    $('.vlr').blur(function() {
        if($(this).val()) {
            var valor = $(this).val();
            var possuiVirgula = valor.indexOf(',');
            if (possuiVirgula == -1) {
                valor = valor + ',00';
                $(this).val(valor);
            }
        }
    })
    $('.vlr').mask("000.000,00", {reverse: true});

    
    document.addEventListener('focusin', function(event){
        var input = event.target.parentElement;
        if (input && input.querySelector('label') && !event.target.value) {
            input.querySelector('label').classList.add('moveUp');
        }
    });

    document.addEventListener('focusout', function(event){
        var input = event.target.parentElement;
        if (input && input.querySelector('label') && event.target.value == '') {
            input.querySelector('label').classList.remove('moveUp', 'moveUpNotFx');
        }
    });

    document.querySelectorAll('input:not([type=hidden]):not([hidden])').forEach(input => {
        if (input.value) {
            input.parentElement.querySelector('label').classList.add('moveUpNotFx');
        }
    });
    document.querySelector('.inputPadrao').focus();
})


window.addEventListener('click', function(){
    //  AJAX consulta CEP

    var cep = document.querySelector('[name="cep"]').value
    var rua = document.querySelector('[name="rua"]').value
    var bairro = document.querySelector('[name="bairro"]').value
    var cidade = document.querySelector('[name="cidade"]').value
    var estados = document.querySelector('[name="uf"]').value

    function formatarCEP(obj) {
        var startPos = obj.selectionStart;
        if(startPos == obj.value.length)
            startPos = -1;
            
        if(startPos < 0){
            obj.value = obj.value.replace(/[^0-9]/g,'');
            obj.value = obj.value.trim();
            if (obj.value.length > 8)
                obj.value = obj.value.slice(0, 8);    
            if (obj.value.length > 0) {
                obj.value = obj.value.replace(/(\d{5})(\d)/, '$1-$2');
            }
        }
        if(startPos > 0){
            obj.value = obj.value.replace(/[^0-9]/g,'');
            obj.value = obj.value.trim();
            if (obj.value.length > 8)
                obj.value = obj.value.slice(0, 8);    
            if (obj.value.length > 0) {
                obj.value = obj.value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            obj.setSelectionRange(startPos, startPos);
        }
    }

    $(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        // $("#rua").val("");
        // $("#bairro").val("");
        // $("#cidade").val("");
        // $("#estados").val("");

        rua.value = '';
        bairro.value = '';
        cidade.value = '';
        estados.value = '';
    }

    //Quando o campo cep perde o foco.
        
    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var numcep = cep.value.replace(/[^0-9]/g, '');

        //Verifica se campo cep possui valor informado.
        if (numcep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(numcep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                // $("#rua").val("...");
                // $("#bairro").val("...");
                // $("#cidade").val("...");
                // $("#estados").val("...");

                rua.value = 'Carregando/Loading...';
                bairro.value = 'Carregando/Loading...';
                cidade.value = 'Carregando/Loading...';
                estados.value = 'Carregando/Loading...';

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ numcep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        // $("#rua").val(dados.logradouro);
                        // $("#bairro").val(dados.bairro);
                        // $("#cidade").val(dados.localidade);
                        // $("#estados").val(dados.uf);

                        rua.value = dados.logradouro;
                        bairro.value = dados.bairro;
                        cidade.value = dados.localidade;
                        estados.value = dados.ibge.substr(0,2);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
    });
})
