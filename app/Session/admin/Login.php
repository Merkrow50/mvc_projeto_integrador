<?php

namespace App\Session\admin;

class Login
{

    private static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Metodo responsavel por criar o login do usuario
     * @param $obUser
     * @return bool
     */
    public static function login($obUser): bool
    {
        self::init();

        var_dump($obUser);

        $_SESSION['admin']['usuario'] = [
            'id_usuario' => $obUser->id_usuarios,
            'nome' => $obUser->nome,
            'email' => $obUser->email,
            'role' => $obUser->role
        ];

        return true;
    }
    
    public static function isLogged(){
        self::init();
        
        return isset($_SESSION['admin']['usuario']['id_usuario']);
    }

    public static function logout(){
        self::init();

        unset($_SESSION['admin']['usuario']);

        return true;
    }

}