<?php 
    function periodoMes($dataAtual = null){
        $data = [
            ['mes' => '01', 'nome' => 'JANEIRO'],
            ['mes' => '02', 'nome' => 'FEVEREIRO'],
            ['mes' => '03', 'nome' => 'MARÇO'],
            ['mes' => '04', 'nome' => 'ABRIL'],
            ['mes' => '05', 'nome' => 'MAIO'],
            ['mes' => '06', 'nome' => 'JUNHO'],
            ['mes' => '07', 'nome' => 'JULHO'],
            ['mes' => '08', 'nome' => 'AGOSTO'],
            ['mes' => '09', 'nome' => 'SETEMBRO'],
            ['mes' => '10', 'nome' => 'OUTUBRO'],
            ['mes' => '11', 'nome' => 'NOVEMBRO'],
            ['mes' => '12', 'nome' => 'DEZEMBRO'],
        ];
        
        if($dataAtual){
        $mesAtual = date_format(new DateTime(), 'm'); 
        $key = array_search($mesAtual, array_column($data, 'mes'));
        return $data[$key];
        }else{
        return $data;
        }
    }

    function verifica_cpf_cnpj($cnpjcpf){
        if(strlen($cnpjcpf) === 11){
           return 'CPF';
        }elseif(strlen($cnpjcpf) === 14){
           return 'CNPJ';
        }else{
           return false;
        }
     }

   function generateRandomString($size = 7){
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
      $randomString = '';
      for($i = 0; $i < $size; $i = $i+1){
         $randomString .= $chars[mt_rand(0,60)];
      }
      return $randomString;
   }
     
     function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0){
        for($i = 0; $i < strlen($digitos); $i++){
           $soma_digitos = $soma_digitos + ($digitos[$i] * $posicoes);
           $posicoes--;
     
           if ($posicoes < 2){
              $posicoes = 9;
           }
        }
     
        $soma_digitos = $soma_digitos % 11;
        if($soma_digitos < 2){
           $soma_digitos = 0;
        }else{
           $soma_digitos = 11 - $soma_digitos;
        }
        $cpf = $digitos . $soma_digitos;
     
        return $cpf;
     }
     
     function valida_cpf($cpf){
        $digitos = substr($cpf, 0, 9);
        $novo_cpf = calc_digitos_posicoes($digitos);
        $novo_cpf = calc_digitos_posicoes($novo_cpf, 11);
        if($novo_cpf === $cpf){
           return true;
        }else{
           return false;
        }
     }
     
     function valida_cnpj($cnpj){
        $cnpj_original = $cnpj;
        $primeiros_numeros_cnpj = substr($cnpj, 0, 12);
        $primeiro_calculo = calc_digitos_posicoes($primeiros_numeros_cnpj, 5);
        $segundo_calculo = calc_digitos_posicoes($primeiro_calculo, 6);
        $cnpj = $segundo_calculo;
        if ($cnpj === $cnpj_original){
           return true;
        }
     }
     
     function valida_cnpjcpf($cnpjcpf){
        if(verifica_cpf_cnpj($cnpjcpf) === 'CPF'){
           return valida_cpf($cnpjcpf) && verifica_sequencia($cnpjcpf, 11);
        }
        elseif(verifica_cpf_cnpj($cnpjcpf) === 'CNPJ'){
           return valida_cnpj($cnpjcpf) && verifica_sequencia($cnpjcpf, 14);
        }else{
           return false;
        }
     }
     
     function formata($cnpjcpf){
        $formatado = false;
        if (verifica_cpf_cnpj($cnpjcpf) === 'CPF'){
           if (valida_cpf($cnpjcpf)){
              $formatado  = substr($cnpjcpf, 0, 3) . '.';
              $formatado .= substr($cnpjcpf, 3, 3) . '.';
              $formatado .= substr($cnpjcpf, 6, 3) . '-';
              $formatado .= substr($cnpjcpf, 9, 2) . '';
           }
        }
        elseif (verifica_cpf_cnpj($cnpjcpf) === 'CNPJ'){
           if (valida_cnpj($cnpjcpf)){
              $formatado  = substr($cnpjcpf,  0,  2) . '.';
              $formatado .= substr($cnpjcpf,  2,  3) . '.';
              $formatado .= substr($cnpjcpf,  5,  3) . '/';
              $formatado .= substr($cnpjcpf,  8,  4) . '-';
              $formatado .= substr($cnpjcpf, 12, 14) . '';
           }
        }
        return $formatado;
    }
     
    function verifica_sequencia($cnpjcpf, $multiplos)
    {
        for($i=0; $i<10; $i++) {
            if (str_repeat($i, $multiplos) == $cnpjcpf) {
                return false;
            }
        }

        return true;
    }
     // Fim das funções de validação de CNPJ/CPF

   function formata_cep($cep) {
         return substr($cep, 0, 5).'-'.substr($cep, 5, 3);
   }

   function random_color_part() {
      return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
   }

   function randomColor() {
      return random_color_part() . random_color_part() . random_color_part();   
   }

   function posString($string, $length){
      if(strlen($string)<=$length)
         return $string;
      else 
         return substr($string,0,$length) . '...';
   }