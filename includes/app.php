<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Common\Environment;
use \App\DatabaseManager\Database;

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
