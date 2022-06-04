<?php

namespace App\Controller\Pages;

use App\Utils\View;
use \App\Model\Entity\User as EntityUser;
use \App\DatabaseManager\Pagination;

class UsersList extends Page
{

    /*
    *@return string
    */
    public static function getUsersList($request): string
    {

        // View da home
        $content = View::render('pages/userslist',[
            'itens' => self::getUserItens($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        // View da pagina
        return parent::getPage('Lista de Usuários', $content);
    }

    public static function getUserItens($request, &$obPagination): string

    {
        $itens = '';


        //QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityUser::getUsers("isBlocked = '0'", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();

        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal, $paginaAtual,5);

        $results = EntityUser::getUsers("isBlocked = '0'", 'id_usuarios DESC', $obPagination->getLimit());

        while ($obUsers = $results->fetchObject(User::class)){

            $itens .= View::render('pages/itensUsers',[
                'id_usuarios' => $obUsers->id_usuarios,
                'nome' => $obUsers->nome,
                'email' => $obUsers->email,
                'role' => $obUsers->role
            ]);

        }

        return $itens;
    }


}