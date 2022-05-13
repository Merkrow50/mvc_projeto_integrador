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
        $quantidadeTotal = EntityCalled::getCalleds(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,3);

        $results = EntityCalled::getCalleds(null, 'chamado_id DESC', $obPagination->getLimit());

        $results2 = EntityCalled::getCalledsCollaborators(null, 'chamado_id DESC');

        while ($obCalleds = $results2->fetchObject(Called::class)){
            $getCollaborator = \App\Model\Entity\Collaborators::getCollaborators("colaborador_id = $obCalleds->colaborador_id", 'colaborador_id DESC');
            array_push($colaborador, $getCollaborator->fetchObject(Collaborators::class));
        }

        $i = 0;

        while ($obCalleds = $results->fetchObject(Called::class)){
            $getVehicle = \App\Model\Entity\Vehicles::getVehicle("veiculo_id = $obCalleds->veiculo_id", 'veiculo_id DESC');

            $itens .= View::render('pages/itensCalled1',[
                'veiculo' => $getVehicle->fetchObject(Vehicles::class)->modelo,
                'data' => $obCalleds->data,
                'distancia_percorrida' => $obCalleds->distancia_percorrida,
                'colaborador' => $colaborador[$i]->nome
            ]);
            ++$i;
        }

        return $itens;
    }


}