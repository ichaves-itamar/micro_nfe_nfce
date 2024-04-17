<?php

namespace App\Service;

Class ValidaDadosService {

public static function valida($dados)
{
   // i($dados);
    $retorno = new \stdClass();
    $notafiscal = new \stdClass();

    try {
        if (!isset($dados["ide"])) {
            $retorno->titulo = "Erro ao ler objeto ide";
            throw new \Exception("É obrigatorio o node IDE");

        }

        //NODE ide
        $ide = self::validaIde($dados["ide"]);

        $notafiscal->ide = $ide;

        $retorno->tem_erro = false;
        $retorno->tem_erro = "";
        $retorno->notafiscal = $notafiscal;
        return $retorno;
    } catch (\Throwable $th) {
        $retorno->tem_erro = true;
        $retorno->erro = $th->getMessage();
        $retorno->notafiscal = null;
        return $retorno;
    }

    return $retorno;
}

public static function validaIde($array)
{
$dados = (object) $array;

if (!isset($dados->nNF) || blank($dados->nNF) || is_null($dados->nNF)) {
    throw new \Exception("o campo nNF do node IDE é obrigatorio");
}

if (!isset($dados->natOp) || blank($dados->natOp) || is_null($dados->natOp)) {
    throw new \Exception("o campo natOp do node IDE é obrigatorio");
}
if (!isset($dados->mod) || blank($dados->mod) || is_null($dados->mod)) {
    throw new \Exception("o campo mod do node IDE é obrigatorio");
}
if (!isset($dados->serie) || blank($dados->serie) || is_null($dados->serie)) {
    throw new \Exception("o campo serie do node IDE é obrigatorio");
}
if (!isset($dados->dhEmi) || blank($dados->dhEmi) || is_null($dados->dhEmi)) {
    throw new \Exception("o campo dhEmi do node IDE é obrigatorio");
}
if (!isset($dados->tpImp) || blank($dados->tpImp) || is_null($dados->tpImp)) {
    throw new \Exception("o campo tpImp do node IDE é obrigatorio");
}

if (!isset($dados->tpEmis) || blank($dados->tpEmis) || is_null($dados->tpEmis)) {
    throw new \Exception("o campo tpEmis do node IDE é obrigatorio");
}

if (!isset($dados->tpImp) || blank($dados->tpImp) || is_null($dados->tpImp)) {
    throw new \Exception("o campo tpImp do node IDE é obrigatorio");
}

if (!isset($dados->tpAmb) || blank($dados->tpAmb) || is_null($dados->tpAmb)) {
    throw new \Exception("o campo tpAmp do node IDE é obrigatorio");
}

if (!isset($dados->indFinal) || blank($dados->indFinal) || is_null($dados->indFinal)) {
    throw new \Exception("o campo indFinal do node IDE é obrigatorio");
}


if (!isset($dados->procEmi) || blank($dados->procEmi) || is_null($dados->procEmi)) {
    throw new \Exception("o campo procEmi do node IDE é obrigatorio");
}


if (!isset($dados->verProc) || blank($dados->verProc) || is_null($dados->verProc)) {
    throw new \Exception("o campo verProc do node IDE é obrigatorio");
}


if (!isset($dados->modFrete) || blank($dados->modFrete) || is_null($dados->modFrete)) {
    throw new \Exception("o campo modFrete do node IDE é obrigatorio");
}

if (!isset($dados->vTroco) || blank($dados->vTroco) || is_null($dados->vTroco)) {
    throw new \Exception("o campo vTroco do node IDE é obrigatorio");
}


return $dados;
}

}
