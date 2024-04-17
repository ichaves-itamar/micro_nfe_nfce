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

        if (!isset($dados["emitente"])) {
            $retorno->titulo = "Erro ao ler objeto Emitente";
            throw new \Exception("É obrigatorio o node EMITENTE");

        }

        if (!isset($dados["destinatario"])) {
            $retorno->titulo = "Erro ao ler objeto Destinatario";
            throw new \Exception("É obrigatorio o node DESTINATARIO");

        }


        //NODE ide
        $ide = self::validaIde($dados["ide"]);
        $notafiscal->ide = $ide;

        //NODE Emitente
        $emitente = self::validaEmitente($dados["emitente"]);
        $notafiscal->emitente = $emitente;

        //NODE destinatario
        $destinatario = self::validaDestinatario($dados["destinatario"]);
        $notafiscal->destinatario = $destinatario;

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
    throw new \Exception("o campo nNF do node IDE é obrigatorio node IDE");
}

if (!isset($dados->natOp) || blank($dados->natOp) || is_null($dados->natOp)) {
    throw new \Exception("o campo natOp do node IDE é obrigatorio node IDE");
}
if (!isset($dados->mod) || blank($dados->mod) || is_null($dados->mod)) {
    throw new \Exception("o campo mod do node IDE é obrigatorio node IDE");
}
if (!isset($dados->serie) || blank($dados->serie) || is_null($dados->serie)) {
    throw new \Exception("o campo serie do node IDE é obrigatorio node IDE");
}
if (!isset($dados->dhEmi) || blank($dados->dhEmi) || is_null($dados->dhEmi)) {
    throw new \Exception("o campo dhEmi do node IDE é obrigatorio node IDE");
}
if (!isset($dados->tpImp) || blank($dados->tpImp) || is_null($dados->tpImp)) {
    throw new \Exception("o campo tpImp do node IDE é obrigatorio node IDE");
}

if (!isset($dados->tpEmis) || blank($dados->tpEmis) || is_null($dados->tpEmis)) {
    throw new \Exception("o campo tpEmis do node IDE é obrigatorio node IDE");
}

if (!isset($dados->tpImp) || blank($dados->tpImp) || is_null($dados->tpImp)) {
    throw new \Exception("o campo tpImp do node IDE é obrigatorio node IDE");
}

if (!isset($dados->tpAmb) || blank($dados->tpAmb) || is_null($dados->tpAmb)) {
    throw new \Exception("o campo tpAmp do node IDE é obrigatorio node IDE");
}

if (!isset($dados->indFinal) || blank($dados->indFinal) || is_null($dados->indFinal)) {
    throw new \Exception("o campo indFinal do node IDE é obrigatorio node IDE");
}


if (!isset($dados->procEmi) || blank($dados->procEmi) || is_null($dados->procEmi)) {
    throw new \Exception("o campo procEmi do node IDE é obrigatorio node IDE");
}


if (!isset($dados->verProc) || blank($dados->verProc) || is_null($dados->verProc)) {
    throw new \Exception("o campo verProc do node IDE é obrigatorio node IDE");
}


if (!isset($dados->modFrete) || blank($dados->modFrete) || is_null($dados->modFrete)) {
    throw new \Exception("o campo modFrete do node IDE é obrigatorio node IDE");
}

if (!isset($dados->vTroco) || blank($dados->vTroco) || is_null($dados->vTroco)) {
    throw new \Exception("o campo vTroco do node IDE é obrigatorio node IDE");
}


return $dados;
}

public static function validaEmitente($array)
{
$dados = (object) $array;

if (!isset($dados->xNome) || blank($dados->xNome) || is_null($dados->xNome)) {
    throw new \Exception("o campo nNF do node xNome é obrigatorio no node Emitente");
}

if (!isset($dados->xCnpj) || blank($dados->xCnpj) || is_null($dados->xCnpj)) {
    throw new \Exception("o campo nNF do node xCnpj é obrigatorio no node Emitente");
}

if (!isset($dados->xLgr) || blank($dados->xLgr) || is_null($dados->xLgr)) {
    throw new \Exception("o campo nNF do node xLgr é obrigatorio no node Emitente");
}

if (!isset($dados->nro) || blank($dados->nro) || is_null($dados->nro)) {
    throw new \Exception("o campo nNF do node nro é obrigatorio no node Emitente");
}

if (!isset($dados->xBairro) || blank($dados->xBairro) || is_null($dados->xBairro)) {
    throw new \Exception("o campo nNF do node xBairro é obrigatorio no node Emitente");
}

if (!isset($dados->cMun) || blank($dados->cMun) || is_null($dados->cMun)) {
    throw new \Exception("o campo nNF do node cMun é obrigatorio no node Emitente");
}

if (!isset($dados->UF) || blank($dados->UF) || is_null($dados->UF)) {
    throw new \Exception("o campo nNF do node UF é obrigatorio no node Emitente");
}

if (!isset($dados->CEP) || blank($dados->CEP) || is_null($dados->CEP)) {
    throw new \Exception("o campo nNF do node CEP é obrigatorio no node Emitente");
}

if (!isset($dados->IE) || blank($dados->IE) || is_null($dados->IE)) {
    throw new \Exception("o campo nNF do node IE é obrigatorio no node Emitente");
}

if (!isset($dados->CRT) || blank($dados->CRT) || is_null($dados->CRT)) {
    throw new \Exception("o campo nNF do node CRT é obrigatorio no node Emitente");
}
}
public static function validaDestinatario($array)
{
$dados = (object) $array;

if (!isset($dados->xNome) || blank($dados->xNome) || is_null($dados->xNome)) {
    throw new \Exception("o campo nNF do node xNome é obrigatorio  no node Destinatario");
}

if (!isset($dados->xLgr) || blank($dados->xLgr) || is_null($dados->xLgr)) {
    throw new \Exception("o campo nNF do node xLgr é obrigatorio no node Destinatario");
}

if (!isset($dados->nro) || blank($dados->nro) || is_null($dados->nro)) {
    throw new \Exception("o campo nNF do node nro é obrigatorio  no node Destinatario");
}

if (!isset($dados->xBairro) || blank($dados->xBairro) || is_null($dados->xBairro)) {
    throw new \Exception("o campo nNF do node xBairro é obrigatorio no node Destinatario");
}

if (!isset($dados->cMun) || blank($dados->cMun) || is_null($dados->cMun)) {
    throw new \Exception("o campo nNF do node cMun é obrigatorio no node Destinatario");
}
if (!isset($dados->UF) || blank($dados->UF) || is_null($dados->UF)) {
    throw new \Exception("o campo nNF do node UF é obrigatorio no node Destinatario");
}
if (!isset($dados->CEP) || blank($dados->CEP) || is_null($dados->CEP)) {
    throw new \Exception("o campo nNF do node CEP é obrigatorio no node Destinatario");
}
if (!isset($dados->CPF_CNPJ) || blank($dados->CPF_CNPJ) || is_null($dados->CPF_CNPJ)) {
    throw new \Exception("o campo nNF do node CPF_CNPJ é obrigatorio no node Destinatario");
}

if (!isset($dados->indIEDest) || blank($dados->indIEDest) || is_null($dados->indIEDest)) {
    throw new \Exception("o campo nNF do node indIEDest é obrigatorio no node Destinatario");
}

if (!isset($dados->CPF_CNPJ) || blank($dados->CPF_CNPJ) || is_null($dados->CPF_CNPJ)) {
    throw new \Exception("o campo nNF do node CPF_CNPJ é obrigatorio no node Destinatario");
}

if (!isset($dados->CPF_CNPJ) || blank($dados->CPF_CNPJ) || is_null($dados->CPF_CNPJ)) {
    throw new \Exception("o campo nNF do node CPF_CNPJ é obrigatorio no node Destinatario");
}
}


}
