<?php

namespace App\Controller\Pages;

use App\Model\Entity\Collaborators as EntityCollaborators;
use App\Model\Entity\EnumRole;
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

        $roles = array('admin', 'super', 'operator', 'driver');

        $obUser = \App\Model\Entity\User::getUserByEmail($postVars['email']);

        if(is_null($obUser)){
            $request->getRouter()->redirect('/list/users?status=exist');
            return;
        }

        $obUsers = new EntityUser;

        if(!in_array($postVars['role'], $roles)){
            throw new \Error('Função Inválida');
        }

        $obUsers->nome = $postVars['nome'];
        $obUsers->email = $postVars['email'];
        $obUsers->senha = password_hash($postVars['senha'], PASSWORD_DEFAULT);
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
        $roles = array('admin', 'super', 'operator', 'driver');

        $obUsers = EntityUser::getUsers('id_usuarios = '."'$id'")->fetchObject(EntityUser::class);

        if(!in_array($postVars['role'], $roles)){
            throw new \Error('Função Inválida');
        }

        $obUsers->nome = $postVars['nome'] ?? $obUsers->nome;
        $obUsers->email = $postVars['email'] ?? $obUsers->email;
        $obUsers->role = $postVars['role'] ?? $obUsers->role;
        $obUsers->atualizar();

        $request->getRouter()->redirect('/list/users?status=edited');
    }

    public static function blockedUser($request, $id){

        $obUsers = EntityUser::getUsers('id_usuarios = '."'$id'")->fetchObject(EntityUser::class);


        $obUsers->isBlocked = true;

        $obUsers->blocked();

        $request->getRouter()->redirect('/list/users?status=blocked');
    }

    public static function getBlockedUser($request, $id){

        $content = View::render('pages/block',[

        ]);

        return parent::getPage('Bloquear usuario', $content);
    }

    public static function unBlockedUser($request, $id){

        $obUsers = EntityUser::getUsers('id_usuarios = '."'$id'")->fetchObject(EntityUser::class);

        $obUsers->isBlocked = false;

        $obUsers->unblocked();

        $request->getRouter()->redirect('/list/users?status=unblocked');
    }

    public static function getUnBlockedUser($request, $id){

        $content = View::render('pages/unblock',[

        ]);

        return parent::getPage('Desbloquear usuario', $content);
    }


}