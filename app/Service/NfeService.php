<?php

namespace app\Service;

use App\Models\CofinsNfe;
use App\Models\Destinatario;
use App\Models\Duplicata;
use App\Models\Emitente;
use App\Models\Fatura;
use App\Models\IcmsNfe;
use App\Models\Ide;
use App\Models\IdeNfe;
use App\Models\IpiNfe;
use App\Models\Pagamento;
use App\Models\PisNfe;
use App\Models\Produto;
use App\Models\Reboque;
use App\Models\RetencaoTransporte;
use App\Models\Transportadora;
use App\Models\Veiculo;
use App\Models\Volume;
use Exception;
use NFePHP\DA\NFe\Daevento;
use NFePHP\DA\NFe\Danfe;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use NFePHP\NFe\Make;
use stdClass;

class NfeService{
    public static function gerarNfe($notafiscal){
        $nfe = new Make();
        $std = new stdClass();
        $std->versao = '4.00'; //versão do layout (string)
        $std->Id = ''; //se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL
        $nfe->taginfNFe($std);

        IdeNfe::montarXml($nfe, $notafiscal->ide);
        Emitente::montarXml($nfe, $notafiscal->emitente);
        Destinatario::montarXml($nfe, $notafiscal->destinatario);
        $cont = 1;
        foreach($notafiscal->itens as $item){
            $std = new \stdClass();
            $std->item  = $cont; //item da NFe
            $std->vTotTrib = Null;
            $nfe->tagimposto($std);

            Produto::montarXml($cont, $nfe, $item->produto);
            if(isset($item->ipi->CST)){
                IpiNfe::montarXml($cont,$nfe, $item->ipi);
            }
            IcmsNfe::montarXml($cont,$nfe, $item->icms);
            PisNfe::montarXml($cont,$nfe, $item->pis);
            CofinsNfe::montarXml($cont,$nfe, $item->cofins);
            

            
            $cont++;
        }

       i($nfe);
            

    }


    

}
