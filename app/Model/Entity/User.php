<?php

namespace App\Model\Entity;

use App\DatabaseManager\Database;

class User
{

    public $id_usuarios;

    public $nome;

    public $email;

    public $senha;

    public $role;

    /**
     * Metodo responsavel por retornar um usuario com base em seu email
     * @param $email
     * @return mixed
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select("email = "."'$email'")->fetchObject(self::class);
    }


}