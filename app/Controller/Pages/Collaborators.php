<?php

namespace App\Controller\Pages;

use App\Model\Entity\Vehicles as EntityVehicles;
use \App\Utils\View;
use \App\Model\Entity\Collaborators as EntityCollaborators;

class Collaborators extends Page {

  public static function getCollaborators(){

    $content = View::render('pages/collaborators',[
        'title' => 'Novo colaborador',
        'nome' => '',
        'matricula' => '',
        'selected_true' => '',
        'selected_false' => '',
    ]);

    return parent::getPage('Novo colaborador', $content);
  }

  public static function insertCollaborators($request){
      $postVars = $request->getPostVars();

      $obCollaborators = new EntityCollaborators;

      $obCollaborators->nome = $postVars['nome'];
      $obCollaborators->matricula = $postVars['matricula'];
      $obCollaborators->habilitado = $postVars['habilitado'];
      $obCollaborators->cadastrar();


      $request->getRouter()->redirect('/list/collaborators?status=created');
  }


    public static function getEditCollaborators($request, $id){

        $obCollaborators = EntityCollaborators::getCollaborators('colaborador_id = '."'$id' and deleted = '0'")->fetchObject(EntityCollaborators::class);

        $content = View::render('pages/collaborators',[
            'title' => 'Editar colaborador',
            'nome' => $obCollaborators->nome,
            'matricula' => $obCollaborators->matricula,
            'selected_true' => $obCollaborators->habilitado ? "" : 'selected',
            'selected_false' => $obCollaborators->habilitado ? "" : 'selected',
        ]);

        return parent::getPage('Editar colaborador', $content);
    }

    public static function editCollaborators($request, $id){
        $postVars = $request->getPostVars();

        $obCollaborators = EntityCollaborators::getCollaborators('colaborador_id = '."'$id' and deleted = '0'")->fetchObject(EntityCollaborators::class);


        $obCollaborators->nome = $postVars['nome'] ?? $obCollaborators->nome;
        $obCollaborators->matricula = $postVars['matricula'] ?? $obCollaborators->matricula;
        $obCollaborators->habilitado = $postVars['habilitado'] ?? $obCollaborators->habilitado;
        $obCollaborators->atualizar();

        $request->getRouter()->redirect('/list/collaborators?status=edited');
    }

    public static function deleteCollaborators($request, $id){
        $obCollaborators = EntityCollaborators::getCollaborators('colaborador_id = '."'$id' and deleted = '0'")->fetchObject(EntityCollaborators::class);

        $obCollaborators->deleted = true;

        $obCollaborators->deletar();

        $request->getRouter()->redirect('/list/collaborators?status=deleted');
    }

    public static function getDeleteCollaborators($request, $id){

        $content = View::render('pages/delete',[]);

        return parent::getPage('Deletar colaborador', $content);
    }


}
