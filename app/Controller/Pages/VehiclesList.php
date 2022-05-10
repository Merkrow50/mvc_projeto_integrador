<?php

namespace App\Controller\Pages;

use App\DatabaseManager\Pagination;
use App\Utils\View;
use \App\Model\Entity\Vehicles as EntityVehicles;

class VehiclesList extends Page
{

    /*
    *@return string
    */
    public static function getVehiclesList($request): string
    {

        // View da home
        $content = View::render('pages/vehiclesList',[
            'itens' => self::getVehiclesItens($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        // View da pagina
        return parent::getPage('Lista de veiculos', $content);
    }

    public static function getVehiclesItens($request, &$obPagination): string

    {
        $itens = '';

        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityVehicles::getVehicle(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,3);

        $results = EntityVehicles::getVehicle(null, 'veiculo_id DESC', $obPagination->getLimit());



        while ($obVehicles = $results->fetchObject(Vehicles::class)){

            $itens .= View::render('pages/itensVehicles',[
                'veiculo_id' => $obVehicles->veiculo_id,
                'ano' => $obVehicles->ano,
                'modelo' => $obVehicles->modelo,
                'autonomia' => $obVehicles->autonomia,
            ]);

        }




        return $itens;
    }


    public static function deleteVehicle($request){
        $postVars = $request->getPostVars();
        $veiculo_id = $postVars['veiculo_id'];

        $results = EntityVehicles::getVehicle("veiculo_id = $veiculo_id", 'veiculo_id DESC');
    }


}