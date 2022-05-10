<?php

namespace App\Controller\Pages;

use App\Model\Entity\Vehicles as EntityVehicles;
use App\Model\Entity\Collaborators as EntityCollaborators;
use \App\Utils\View;
use \App\Model\Entity\Called as EntityCalled;

class Called extends Page
{

    public static function getCalled()
    {

        $content = View::render('pages/called', [
            'options-collaborators' => self::getOptionsCollaborators(),
            'options-vehicles' => self::getOptionsVehicles()
        ]);

        return parent::getPage('Novo colaborador', $content);
    }

    public static function getOptionsCollaborators(){

        $options = '';

        $results = EntityCollaborators::getCollaborators(null, 'colaborador_id DESC');

        while ($obCollaborators = $results->fetchObject(Collaborators::class)){

            $options .= View::render('pages/options-selector',[
                'option' => $obCollaborators->nome,
                'value' => $obCollaborators->colaborador_id
            ]);

        }

        return $options;

    }

    public static function getOptionsVehicles(){

        $options = '';

        $results = EntityVehicles::getVehicle(null, 'veiculo_id DESC');

        while ($obVehicles = $results->fetchObject(Collaborators::class)){

            $options .= View::render('pages/options-selector',[
                'option' => $obVehicles->modelo,
                'value' => $obVehicles->veiculo_id
            ]);

        }

        return $options;

    }


    public static function insertCalled($request)
    {
        $postVars = $request->getPostVars();

        $obCalled = new EntityCalled;

        $obCalled->veiculo_id = $postVars['veiculo_id'];
        $obCalled->data = $postVars['data'];
        $obCalled->colaborador_id = $postVars['colaborador_id'];
        $obCalled->distancia_percorrida = $postVars['distancia_percorrida'];
        $obCalled->cadastrar();

        $request->getRouter()->redirect('/list/called');
    }

}
