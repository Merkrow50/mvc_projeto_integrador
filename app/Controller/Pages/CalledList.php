<?php

namespace App\Controller\Pages;

use App\DatabaseManager\Pagination;
use App\Utils\View;
use \App\Model\Entity\Called as EntityCalled;

class CalledList extends Page
{

    /*
    *@return string
    */
    public static function getCalledList($request): string
    {

        // View da home
        $content = View::render('pages/calledlist',[
            'itens' => self::getCalledItens($request,$obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        // View da pagina
        return parent::getPage('Lista de chamados', $content);
    }

    public static function getCalledItens($request, &$obPagination): string

    {
        $itens = '';

        $colaborador = [];

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityCalled::getCalleds("deleted = '0'", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,5);

        $results = EntityCalled::getCalleds("deleted = '0'", 'chamado_id DESC', $obPagination->getLimit());

        $results2 = EntityCalled::getCalledsCollaborators("deleted = '0'", 'chamado_id DESC');

        while ($obCalleds = $results2->fetchObject(Called::class)){
            $getCollaborator = \App\Model\Entity\Collaborators::getCollaborators("colaborador_id = $obCalleds->colaborador_id", 'colaborador_id DESC');
            array_push($colaborador, $getCollaborator->fetchObject(Collaborators::class));
        }

        $i = 0;

        while ($obCalleds = $results->fetchObject(Called::class)){
            $getVehicle = \App\Model\Entity\Vehicles::getVehicle("veiculo_id = $obCalleds->veiculo_id", 'veiculo_id DESC');

            $obVehicle = $getVehicle->fetchObject(Vehicles::class);

            $CG = ($obCalleds->hodometro_finish - $obCalleds->hodometro_start) / $obVehicle->autonomia;
            $pegada = ($CG * 0.73 * 0.75 * 3.7);


            $itens .= View::render('pages/itensCalled1',[
                'hidden_finish' => $obCalleds->status != "EM_ANDAMENTO" || $_SESSION['admin']['usuario']['role'] === 'operator' ? "hidden" : "",
                'hidden_status' => $obCalleds->status == "FINALIZADO" ? "hidden" : '',
                'hidden' => $_SESSION['admin']['usuario']['role'] === 'driver' ? "hidden" : "",
                'canceled' => $obCalleds->status == "CANCELADO" ? 'hidden': '',
                'chamado_id' => $obCalleds->chamado_id,
                'veiculo' => $obVehicle->modelo,
                'data' => $obCalleds->data,
                'hodometro_start' => $obCalleds->hodometro_start,
                'hodometro_finish' => $obCalleds->hodometro_finish,
                'distancia_percorrida' => $obCalleds->status == "FINALIZADO" ?  $obCalleds->hodometro_finish - $obCalleds->hodometro_start." Km" : '',
                'pegada' => $obCalleds->status == "FINALIZADO" ? $pegada." Kg/L" : '',
                'status' => $obCalleds->status,
                'colaborador' => $colaborador[$i]->nome
            ]);
            ++$i;
        }

        return $itens;
    }


}