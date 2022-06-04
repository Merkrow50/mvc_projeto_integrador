<?php

namespace App\Controller\Pages;

use App\Model\Entity\Collaborators as EntityCollaborators;
use App\Model\Entity\User as EntityUser;
use App\Utils\View;

class User extends Page
{

    public static function getUser(){

        $content = View::render('pages/user',[
            'title' => 'Novo usuário',
            'nome' => '',
            'email' => '',
            'senha' => '',
            'role' => '',
        ]);

        return parent::getPage('Novo usuário', $content);
    }

    public static function insertUser($request){
        $postVars = $request->getPostVars();

        $obUsers = new EntityUser;

        $obUsers->nome = $postVars['nome'];
        $obUsers->email = $postVars['email'];
        $obUsers->senha = $postVars['senha'];
        $obUsers->role = $postVars['role'];
        $obUsers->cadastrar();


        $request->getRouter()->redirect('/list/users?status=created');
    }


    public static function getEditUser($request, $id){

        $obUsers = EntityUser::getUsers('id_usuarios = '."'$id'")->fetchObject(EntityUser::class);

        $content = View::render('pages/user',[
            'title' => 'Editar usuário',
            'nome' => $obUsers->nome,
            'email' => $obUsers->email,
            'role' => $obUsers->role,
            'operator' => $obUsers->role === 'operator' ? 'selected' : '',
            'driver' => $obUsers->role === 'driver' ? 'selected' : '',
            'admin' => $obUsers->role === 'admin' ? 'selected' : '',
            'super' => $obUsers->role === 'super' ? 'selected' : '',
        ]);

        return parent::getPage('Editar usuario', $content);
    }

    public static function editUser($request, $id){
        $postVars = $request->getPostVars();

        $obUsers = EntityUser::getUsers('id_usuarios = '."'$id'")->fetchObject(EntityUser::class);


        $obUsers->nome = $postVars['nome'] ?? $obUsers->nome;
        $obUsers->email = $postVars['email'] ?? $obUsers->email;
        $obUsers->role = $postVars['role'] ?? $obUsers->role;
        $obUsers->atualizar();

        $request->getRouter()->redirect('/list/users?status=edited');
    }


}