<?php

namespace App\Controller\Pages;

use App\Utils\View;
use \App\Model\Entity\Collaborators as EntityCollaborators;

class CollaboratorsList extends Page
{

    /*
    *@return string
    */
    public static function getCollaboratorsList(){

        // View da home
        $content = View::render('pages/collaboratorslist',[
            'itens' => self::getCollaboratorsItens()
        ]);

        // View da pagina
        return parent::getPage('Lista de Colaboradores', $content);
    }

    public static function getCollaboratorsItens()

    {
        $itens = '';

        $results = EntityCollaborators::getCollaborators(null, 'id DESC');

        while ($obCollaborators = $results->fetchObject(Collaborators::class)){

            $itens .= View::render('pages/itens',[
                'nome' => $obCollaborators->nome,
                'cnh' => $obCollaborators->cnh,
                'matricula' => $obCollaborators->matricula,
                'data_nascimento' => date('d/m/Y', strtotime($obCollaborators->data_nascimento)),
                'atribuicao' => $obCollaborators->atribuicao
            ]);

        }

        return $itens;
    }


}