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

    public $isBlocked;

    /**
     * Metodo responsavel por retornar um usuario com base em seu email
     * @param $email
     * @return mixed
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select("email = "."'$email'")->fetchObject(self::class);
    }

    public function cadastrar(){

        $this->id_usuarios = (new Database('usuarios'))->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'role' => $this->role,
        ]);

        return true;
    }


    public function atualizar(){

        $this->id_usuarios = (new Database('usuarios'))->update('id_usuarios = '.$this->id_usuarios, [
            'nome' => $this->nome,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        return true;
    }

    public function blocked(){

        $this->id_usuarios = (new Database('usuarios'))->update('id_usuarios = '.$this->id_usuarios, [
            'isBlocked' => $this->isBlocked,
        ]);

        return true;
    }

    public function unblocked(){

        $this->id_usuarios = (new Database('usuarios'))->update('id_usuarios = '.$this->id_usuarios, [
            'isBlocked' => $this->isBlocked,
        ]);

        return true;
    }

    public function deletar(){

        $this->id_usuarios = (new Database('usuarios'))->delete('id_usuarios = ' . $this->id_usuarios);

        return true;
    }


    public static function getUsers($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('usuarios')) -> select($where, $order, $limit, $fields);
    }


}