<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Vehicles as EntityVehicles;

class Vehicles extends Page {

  public static function getVehicles(){

    $content = View::render('pages/vehicles',[]);

    return parent::getPage('Novo veiculo', $content);
  }

  public static function insertVehicle($request){
      $postVars = $request->getPostVars();

      $obCollaborators = new EntityVehicles;

      $obCollaborators->ano = $postVars['ano'];
      $obCollaborators->modelo = $postVars['modelo'];
      $obCollaborators->autonomia = $postVars['autonomia'];
      $obCollaborators->cadastrar();


    return self::getVehicles();
  }
//
//    public static function getCollaboratorsItens()
//
//    {
//        $itens = '';
//
//        $results = EntityCollaborators::getCollaborators(null, 'id DESC');
//
//        while ($obCollaborators = $results->fetchObject(Collaborators::class)){
//
//            $itens = View::render('pages/itens',[
//               'nome' => $obCollaborators->nome,
//               'cnh' => $obCollaborators->cnh,
//               'matricula' => $obCollaborators->matricula,
//               'data_nascimento' => $obCollaborators->data_nascimento,
//               'atribuicao' => $obCollaborators->atribuicao
//            ]);
//
//        }
//
//        return $itens;
//    }

}
