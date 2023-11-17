<?php

namespace App\Service;

Class ValidaDadosService {

public static function valida($dados)
{
    $retorno = new \stdClass();
    $notafiscal = new \stdClass();

    try {
        if (isset($dados["ide"])) {
            $retorno->titulo = "Erro ao ler obsjeto";
            
        }

        $retorno->tem_erro = false;
        $retorno->tem_erro = "";
        $retorno->$notafiscal = $notafiscal;
        return $retorno;
    } catch (\Throwable $th) {
        $retorno->tem_erro = true;
        $retorno->erro = $th->getMessage();
        $retorno->$notafiscal = null;
        return $retorno;
    }

    return $retorno;
}
}