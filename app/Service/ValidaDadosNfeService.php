<?php

namespace App\Service;

use App\Models\Destinatario;
use App\Models\Emitente;
use App\Models\Ide;
use App\Models\IdeNfe;
use App\Models\Produto;
use App\Models\Total;
use stdClass;

Class ValidaDadosNfeService {

public static function validaDadosNfe($dados)
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
        if(!isset($dados["itens"])){
            $retorno->titulo =  "Erro ao ler objeto";
            throw new \Exception("É Obrigatório o envio do node Itens para emissão da NFE");
        }

        /*if(!isset($dados["pagamentos"])){
            $retorno->titulo =  "Erro ao ler objeto";
            throw new \Exception("É Obrigatório o envio do node pagamentos para emissão da NFE");
        } */

        //NODE ide
        $ide = self::validaIde($dados["ide"], $dados["emitente"], $dados["destinatario"]);
        $notafiscal->ide = $ide;

        //NODE Emitente
        $emitente = self::validaEmitente($dados["emitente"]);
        $notafiscal->emitente = $emitente;

        //NODE destinatario
        $destinatario = self::validaDestinatario($dados["destinatario"]);
        $notafiscal->destinatario = $destinatario;

        foreach($dados['itens'] as $itens){
            if(!isset($itens["produto"])){
                throw new \Exception("è obrigatorio o envio de por ao menos um produto para emissão de NFe");
            }

            $ipi = null;
            if(!isset($itens["ipi"])){
                $ipi = ValidarImpostoService::validarIpi($itens["ipi"]);
            }

            if(!isset($itens["icms"])){
                throw new \Exception('É obrigatório o envio do node icms para emissão da nota');
            }

            if(!isset($itens["pis"])){
                throw new \Exception('É obrigatório o envio do node pis para emissão da nota');
            }
            
            if(!isset($itens["cofins"])){
                throw new \Exception('É obrigatório o envio do node cofins para emissão da nota');
            } 
            $it = new stdClass;
            $it->produto = self::validaProduto($itens["produto"]);
        }

      

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

public static function validaIde($array, $emitente, $destinatario)
{
$dados = (object) $array;
$emitente = (object) $emitente;
$destinatario = (object) $destinatario;


if(!isset($dados->nNF)  || is_null($dados->nNF)) {
    throw new \Exception('O Campo nNF é Obrigatório');
}

if(!isset($dados->natOp)  || is_null($dados->natOp)) {
    throw new \Exception('O Campo natOp é Obrigatório');
}

if(!isset($dados->mod)  || is_null($dados->mod)) {
    throw new \Exception('O Campo mod é Obrigatório');
}

if(!isset($dados->serie)   || is_null($dados->serie)) {
    throw new \Exception('O Campo serie é Obrigatório');
}

if(!isset($dados->dhEmi)   || is_null($dados->dhEmi)) {
    throw new \Exception('O Campo dhEmi é Obrigatório');
}

if(!isset($dados->tpImp)   || is_null($dados->tpImp)) {
    throw new \Exception('O Campo tpImp é Obrigatório');
}

if(!isset($dados->tpEmis)   || is_null($dados->tpEmis)) {
    throw new \Exception('O Campo tpEmis é Obrigatório');
}

if(!isset($dados->tpAmb)   || is_null($dados->tpAmb)) {
    throw new \Exception('O Campo tpAmb é Obrigatório');
}
if(!isset($dados->finNFe)   || is_null($dados->finNFe)) {
    throw new \Exception('O Campo finNFe é Obrigatório');
}
if(!isset($dados->indFinal)   || is_null($dados->indFinal)) {
    throw new \Exception('O Campo indFinal é Obrigatório');
}

if(!isset($dados->procEmi)   || is_null($dados->procEmi)) {
    throw new \Exception('O Campo procEmi é Obrigatório');
}
if(!isset($dados->verProc)   || is_null($dados->verProc)) {
    throw new \Exception('O Campo verProc é Obrigatório');
}

if(!isset($dados->modFrete)  || is_null($dados->modFrete)) {
    throw new \Exception('O Campo modFrete do node Ide é Obrigatório');
}

if(!isset($emitente->UF) ||  is_null($emitente->UF)) {
    throw new \Exception('O Campo UF do node Emitente é Obrigatório');
}
if(!isset($destinatario->UF) || is_null($destinatario->UF)) {
    throw new \Exception('O Campo UF do node Destinatario é Obrigatório');
}

if($emitente->UF !="EX"){
    if($emitente->UF == $destinatario->UF){
        $dados->idDest = config("constanteNota.idDest.INTERNA");
    }else{
        $dados->idDest = config("constanteNota.idDest.INTERESTADUAL");
    }
}else{
    $dados->idDest = config("constanteNota.idDest.EXTERIOR");
}

$ide = new IdeNfe();
$ide->setarDados($array);
return $ide;

}

public static function validaEmitente($array)
{
$dados = (object) $array;
if(!isset($dados->CNPJ) ||  is_null($dados->CNPJ)) {
    throw new \Exception('O Campo CNPJ do node Emitente é Obrigatório');
}
if(!isset($dados->xNome) ||  is_null($dados->xNome)) {
    throw new \Exception('O Campo xNome  do node Emitente é Obrigatório');
}
if(!isset($dados->xLgr) ||  is_null($dados->xLgr)) {
    throw new \Exception('O Campo xLgr do node Emitente é Obrigatório');
}
if(!isset($dados->nro) ||  is_null($dados->nro)) {
    throw new \Exception('O Campo nro do node Emitente é Obrigatório');
}
if(!isset($dados->xBairro) ||  is_null($dados->xBairro)) {
    throw new \Exception('O Campo xBairro do node Emitente é Obrigatório');
}
if(!isset($dados->cMun) ||  is_null($dados->cMun)) {
    throw new \Exception('O Campo cMun do node Emitente é Obrigatório');
}
if(!isset($dados->xMun) ||  is_null($dados->xMun)) {
    throw new \Exception('O Campo xMun do node Emitente é Obrigatório');
}
if(!isset($dados->UF) ||  is_null($dados->UF)) {
    throw new \Exception('O Campo UF do node Emitente é Obrigatório');
}
if(!isset($dados->CEP) ||  is_null($dados->CEP)) {
    throw new \Exception('O Campo CEP do node Emitente é Obrigatório');
}
if(!isset($dados->IE) ||  is_null($dados->IE)) {
    throw new \Exception('O Campo IE do node Emitente é Obrigatório');
}
if(!isset($dados->CRT) ||  is_null($dados->CRT)) {
    throw new \Exception('O Campo CRT do node Emitente é Obrigatório');
}

$emitente = new Emitente();
$emitente->setarDados($array);
return $emitente;

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

$cnpj  = tira_mascara($dados->CPF_CNPJ);
        if(strlen($cnpj) == 14){
            $dados->CNPJ = $cnpj;
            $dados->CPF  = null;

        }else{
           $dados->CPF = $cnpj;
            $dados->CNPJ  = null;
        }

        $destinatario = new Destinatario();
        $destinatario->setarDados($array);
        return $destinatario;
}

public static function validaProduto($array){

    $dados = (object) $array;

    if(!isset($dados->cProd) ||  is_null($dados->cProd)) {
        throw new \Exception('O Campo cProd do node Produto é Obrigatório');
    }
    if(!isset($dados->xProd) ||  is_null($dados->xProd)) {
        throw new \Exception('O Campo xProd do node Produto é Obrigatório');
    }
    if(!isset($dados->NCM) ||  is_null($dados->NCM)) {
        throw new \Exception('O Campo NCM do node Produto é Obrigatório');
    }
    if(!isset($dados->CFOP) ||  is_null($dados->CFOP)) {
        throw new \Exception('O Campo CFOP do node Produto é Obrigatório');
    }
    if(!isset($dados->uCom) ||  is_null($dados->uCom)) {
        throw new \Exception('O Campo uCom do node Produto é Obrigatório');
    }
    if(!isset($dados->qCom) ||  is_null($dados->qCom)) {
        throw new \Exception('O Campo qCom do node Produto é Obrigatório');
    }
    if(!isset($dados->vUnCom) ||  is_null($dados->vUnCom)) {
        throw new \Exception('O Campo vUnCom do node Produto é Obrigatório');
    }
    if(!isset($dados->vProd) ||  is_null($dados->vProd)) {
        throw new \Exception('O Campo vProd do node Produto é Obrigatório');
    }
    if(!isset($dados->uTrib) ||  is_null($dados->uTrib)) {
        throw new \Exception('O Campo uTrib do node Produto é Obrigatório');
    }

    if(!isset($dados->qTrib) ||  is_null($dados->qTrib)) {
        throw new \Exception('O Campo qTrib do node Produto é Obrigatório');
    }
    if(!isset($dados->vUnTrib) ||  is_null($dados->vUnTrib)) {
        throw new \Exception('O Campo vUnTrib do node Produto é Obrigatório');
    }

    if(!isset($dados->indTot) ||  is_null($dados->indTot)) {
        throw new \Exception('O Campo indTot do node Produto é Obrigatório');
    }

    $produto = new Produto();
    $produto->setarDados($array);
    return $produto;
}

}
