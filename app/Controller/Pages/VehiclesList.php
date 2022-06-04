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
        $quantidadeTotal = EntityVehicles::getVehicle("deleted = '0'", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,5);

        $results = EntityVehicles::getVehicle("deleted = '0'", 'veiculo_id DESC', $obPagination->getLimit());

        while ($obVehicles = $results->fetchObject(Vehicles::class)){
                $itens .= View::render('pages/itensVehicles', [
                    'veiculo_id' => $obVehicles->veiculo_id,
                    'placa' => $obVehicles->placa,
                    'ano' => $obVehicles->ano,
                    'modelo' => $obVehicles->modelo,
                    'autonomia' => $obVehicles->autonomia,
                    'status' => $obVehicles->isEnable ? "Em espera" : "Em uso",
                ]);
        }




        return $itens;
    }


}