<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Collaborators extends Page {

  public static function getCollaborators(){

    $content = View::render('pages/collaborators',[

    ]);

    return parent::getPage('DEPOIMENTOS DEV', $content);
  }

  public static function insertCollaborators($request){
    return self::getCollaborators();
  }

}
