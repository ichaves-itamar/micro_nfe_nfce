<?php

namespace App\Http\Controllers\Nfe;

use App\Http\Controllers\Controller;
use App\Service\ValidaDadosService;
use Illuminate\Http\Request;

class NFeController extends Controller
{
    public function transmitir(Request $request){
        $dados = ($request->all());
        $dados_validos = ValidaDadosService::valida($dados);
        echo "dados_validos";
        i($dados_validos);
    }

}
