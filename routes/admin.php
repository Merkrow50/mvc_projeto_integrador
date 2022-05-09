<?php


use App\Controller\Admin\Login;
use \App\Http\Response;
use \App\Controller\Pages;

$obRouter->get('/admin',[
    'middlewares' => [
        'require-admin-login'
    ],
    function(){
        return new Response(200, 'admin');
    }
]);

$obRouter->get('/admin/login',[
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request){
        return new Response(200, Login::getLogin($request));
    }
]);

$obRouter->post('/admin/login',[
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request){
        return new Response(200, Login::setLogin($request));
    }
]);

$obRouter->get('/admin/logout',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Login::setLogout($request));
    }
]);