<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Vehicles as EntityVehicles;

class Vehicles extends Page {

  public static function getVehicles(){

    $content = View::render('pages/vehicles',[
        'placa' => '',
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
      $obVehicle->placa  = $postVars['placa'];
      $obVehicle->autonomia = $postVars['autonomia'];
      $obVehicle->cadastrar();

      $request->getRouter()->redirect('/list/vehicles?status=created');
  }

    public static function getEditVehicle($request, $id){

        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id' and deleted = '0'")->fetchObject(EntityVehicles::class);

        $content = View::render('pages/vehicles',[
            'title' => 'Editar veículo',
            'modelo' => $obVehicle->modelo,
            'autonomia' => $obVehicle->autonomia,
            'placa' => $obVehicle->placa,
            'ano' => $obVehicle->ano
        ]);

        return parent::getPage('Editar veiculo', $content);
    }

    public static function editVehicle($request, $id){
        $postVars = $request->getPostVars();

        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id' and deleted = '0'")->fetchObject(EntityVehicles::class);

        $obVehicle->ano = $postVars['ano'] ?? $obVehicle->ano;
        $obVehicle->modelo = $postVars['modelo'] ?? $obVehicle->modelo;
        $obVehicle->autonomia = $postVars['autonomia'] ?? $obVehicle->autonomia;
        $obVehicle->placa  = $postVars['placa'];
        $obVehicle->atualizar();

        $request->getRouter()->redirect('/list/vehicles?status=edited');
    }

    public static function deleteVehicle($request, $id){
        $obVehicle = EntityVehicles::getVehicle('veiculo_id = '."'$id' and deleted = '0'")->fetchObject(EntityVehicles::class);

        $obVehicle->deleted = true;

        $obVehicle->deletar();

        $request->getRouter()->redirect('/list/vehicles?status=deleted');
    }

    public static function getDeleteVehicle($request, $id){

        $content = View::render('pages/delete',[]);

        return parent::getPage('Deletar veiculo', $content);
    }

}
