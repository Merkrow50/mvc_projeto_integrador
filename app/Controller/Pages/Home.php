<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page{

  /*
  *@return string
  */
  public static function getHome(){
    $obOrganization = new Organization;

    // View da home
    $content =  View::render('pages/home', [
      'name' => $obOrganization->name,
      'description' => $obOrganization->description,
      'site' => $obOrganization->site
    ]);

    // View da pagina
    return parent::getPage('Carbon FootPrint', $content);
  }

}
