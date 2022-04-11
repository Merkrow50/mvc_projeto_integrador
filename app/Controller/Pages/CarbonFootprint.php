<?php

namespace App\Controller\Pages;

use App\Utils\View;

class CarbonFootprint extends Page
{
    /*
     *@return string
     */
    public static function getCarbonFootprint(){

        $obCarbonFootprint = new \App\Model\Entity\CarbonFootprint();

        // View da home
        $content =  View::render('pages/home', [
            'name' => $obCarbonFootprint->name,
            'description' => $obCarbonFootprint->description,
        ]);

        // View da pagina
        return parent::getPage('O que é pegada de carbono?', $content);
    }

}