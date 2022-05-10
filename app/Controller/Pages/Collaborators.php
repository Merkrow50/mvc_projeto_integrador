<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Collaborators as EntityCollaborators;

class Collaborators extends Page {

  public static function getCollaborators(){

    $content = View::render('pages/collaborators',[]);

    return parent::getPage('Novo colaborador', $content);
  }

  public static function insertCollaborators($request){
      $postVars = $request->getPostVars();

      $obCollaborators = new EntityCollaborators;

      $obCollaborators->nome = $postVars['nome'];
      $obCollaborators->matricula = $postVars['matricula'];
      $obCollaborators->habilitado = $postVars['habilitado'];
      $obCollaborators->cadastrar();


      $request->getRouter()->redirect('/list/collaborators');
  }

}
