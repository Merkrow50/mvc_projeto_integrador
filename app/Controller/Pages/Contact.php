<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Contact extends Page
{


    /*
    *@return string
    */
    public static function getContact(){

        // View da home
        $content =  View::render('pages/contact', [
        ]);

        // View da pagina
        return parent::getPage('Contato', $content);
    }

}