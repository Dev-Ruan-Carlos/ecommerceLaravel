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