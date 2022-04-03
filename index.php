<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;
use \App\Common\Environment;

Environment::load(__DIR__);

define('URL', getEnv('URL'));

//DEFINE O VALOR PADRÃO DAS VARIAVEIS
View::init([
  'URL' => URL
]);

//INICIA O ROUTER
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include __DIR__.'/routes/pages.php';

//IMPRIME O RESPONSE DA ROTA
$obRouter->run()
         ->sendResponse();
