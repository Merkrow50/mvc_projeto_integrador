<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Collaborators as EntityCollaborators;

class Collaborators extends Page {

  public static function getCollaborators(){

    $content = View::render('pages/collaborators',[
//        'itens' => self::getCollaboratorsItens()
    ]);

    return parent::getPage('Novo colaborador', $content);
  }

  public static function insertCollaborators($request){
      $postVars = $request->getPostVars();

      $obCollaborators = new EntityCollaborators;

      $obCollaborators->nome = $postVars['nome'];
      $obCollaborators->cnh = $postVars['cnh'];
      $obCollaborators->matricula = $postVars['matricula'];
      $obCollaborators->data_nascimento = $postVars['data_nascimento'];
      $obCollaborators->atribuicao = $postVars['atribuicao'];
      $obCollaborators->cadastrar();


    return self::getCollaborators();
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
