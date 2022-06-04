<?php

namespace App\Controller\Pages;

use App\Utils\View;
use \App\Model\Entity\Collaborators as EntityCollaborators;
use \App\DatabaseManager\Pagination;

class CollaboratorsList extends Page
{

    /*
    *@return string
    */
    public static function getCollaboratorsList($request): string
    {

        // View da home
        $content = View::render('pages/collaboratorslist',[
            'itens' => self::getCollaboratorsItens($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        // View da pagina
        return parent::getPage('Lista de Colaboradores', $content);
    }

    public static function getCollaboratorsItens($request, &$obPagination): string

    {
        $itens = '';


        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityCollaborators::getCollaborators("deleted = '0'", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,5);

        $results = EntityCollaborators::getCollaborators("deleted = '0'", 'colaborador_id DESC', $obPagination->getLimit());

        while ($obCollaborators = $results->fetchObject(Collaborators::class)){

            $itens .= View::render('pages/itensCollaborators',[
                'colaborador_id' => $obCollaborators->colaborador_id,
                'nome' => $obCollaborators->nome,
                'matricula' => $obCollaborators->matricula,
                'habilitado' => $obCollaborators->habilitado ? 'SIM' : 'NÃO'
            ]);

        }

        return $itens;
    }


}