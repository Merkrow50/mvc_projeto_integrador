<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Common\Environment;
use \App\DatabaseManager\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;

Environment::load(__DIR__.'/../');

Database::config(
  getEnv('DB_HOST'),
  getEnv('DB_NAME'),
  getEnv('DB_USER'),
  getEnv('DB_PASS'),
  getEnv('DB_PORT')
);

define('URL', getEnv('URL'));

//DEFINE O VALOR PADRÃO DAS VARIAVEIS
View::init([
  'URL' => URL
]);

//DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'require-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
    'require-admin-login' => \App\Http\Middleware\RequireAdminLogin::class
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES PADRÕES(EXECUTADO EM TODAS AS ROTAS)
MiddlewareQueue::setDefault([
    'maintenance'
]);