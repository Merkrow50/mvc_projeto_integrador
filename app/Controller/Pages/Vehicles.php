<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Vehicles as EntityVehicles;

class Vehicles extends Page {

  public static function getVehicles(){

    $content = View::render('pages/vehicles',[
        'title' => 'Novo veículo',
        'modelo' => '',
        'autonomia' => '',
        'ano' => ''
    ]);

    return parent::getPage('Novo veículo', $content);
  }

  public static function insertVehicle($request){
      $postVars = $request->getPostVars();

      $obVehicle = new EntityVehicles;

      $obVehicle->ano = $postVars['ano'];
      $obVehicle->modelo = $postVars['modelo'];
      $obVehicle->autonomia = $postVars['autonomia'];
      $obVehicle->cadastrar();

      $request->getRouter()->redirect('/list/vehicles');
  }

    public static function getEditVehicle($request, $id){

        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id'")->fetchObject(EntityVehicles::class);

        $content = View::render('pages/vehicles',[
            'title' => 'Editar veículo',
            'modelo' => $obVehicle->modelo,
            'autonomia' => $obVehicle->autonomia,
            'ano' => $obVehicle->ano
        ]);

        return parent::getPage('Novo veiculo', $content);
    }

    public static function editVehicle($request, $id){
        $postVars = $request->getPostVars();

        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id'")->fetchObject(EntityVehicles::class);

        $obVehicle->ano = $postVars['ano'] ?? $obVehicle->ano;
        $obVehicle->modelo = $postVars['modelo'] ?? $obVehicle->modelo;
        $obVehicle->autonomia = $postVars['autonomia'] ?? $obVehicle->autonomia;
        $obVehicle->atualizar();

        $request->getRouter()->redirect('/list/vehicles');
    }

    public static function deleteVehicle($request, $id){
        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id'")->fetchObject(EntityVehicles::class);

        $obVehicle->deletar();

        $request->getRouter()->redirect('/list/vehicles');
    }

}
