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

    document.querySelectorAll('input:not([type=hidden]):not([hidden])').forEach(input => {

        input.addEventListener('blur', function(){
            if (input.value === '') {
                input.parentElement.querySelector('label')?.classList.remove('moveUp');
            }
        });

        input.addEventListener('focusin', function(){
            input.parentElement.querySelector('label')?.classList.add('moveUp');
        });

        new MutationObserver(function(mutations) {
            for (mutation of mutations) {
                if (mutation.type == 'attributes') {
                    if (mutation.attributeName == 'value') {
                        if ((mutation.oldValue == '' || mutation.oldValue == null) && mutation.target.value !== '') {
                            mutation.target.parentElement.querySelector('label').classList.add('moveUp');
                        }
                    }
                }
            }
        }).observe(input, {attributes: true})
    });
    document.querySelector('.inputPadrao')?.focus();
})

jQuery(function() {
    $(".cep").mask("99999-999");
    $(".celular").mask('(99) 99999-9999');
    $(".telefone").mask('(99) 9999-9999');
    $(".cpf").mask("999.999.999-99");
    $(".rg").mask("9.999.999");
});
