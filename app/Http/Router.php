<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router {

 /*
  * URL completa do projeto (raiz)
  * @var string
  */
  private $url = '';

 /*
  * Prefixo de todas as rotas
  * @var string
  */
  private $prefix = '';

 /*
  * Índice de rotas
  * @var array
  */
  private $routes = [];

 /*
  * Instância de Request
  * @var Request
  */
  private $request;

 /*
  * Instância de Request
  * @var Request
  */
  public function __construct($url){
    $this->request = new Request();
    $this->url = $url;
    $this->setPrefix();
  }

  /*
  * Método responsavel por definir o prefixo das rotas
  */
  private function setPrefix(){
    $parseUrl = parse_url($this->url);

    $this->prefix = $parseUrl['path'] ?? '';
  }

  private function addRoute($method, $route, $params = []){
    foreach($params as $key=>$value){
      $params['controller'] = $value;
      unset($params[$key]);
      continue;
    }

    //VARIAVEIS DA ROTA
    $param['variables'] = [];

    //PADRA DE VALIDACAO DAS VARIAVEIS DAS ROTAS
    $patternVariable = '/{(.*?)}/';
    if(preg_match_all($patternVariable, $route, $matches)){
      $route = preg_replace($patternVariable, '(.*?)', $route);
      $param['variables'] = $matches[1];
    }

    $patternRoute = '/^'.str_replace('/','\/',$route).'$/';
    // ADICIONA A ROTA DENTRO DA CLASSE
    $this->routes[$patternRoute][$method] = $params;
  }

  /*
  * Metodo repsonsavel por definir uma rota de GET
  * @param string $route
  * @param array $params
  */
  public function get($route, $params = []){
    return $this->addRoute('GET', $route, $params);
  }

  /*
  * Metodo repsonsavel por definir uma rota de POST
  * @param string $route
  * @param array $params
  */
  public function post($route, $params = []){
    return $this->addRoute('POST', $route, $params);
  }

  /*
  * Metodo repsonsavel por definir uma rota de PUT
  * @param string $route
  * @param array $params
  */
  public function put($route, $params = []){
    return $this->addRoute('PUT', $route, $params);
  }

  /*
  * Metodo repsonsavel por definir uma rota de DELETE
  * @param string $route
  * @param array $params
  */
  public function delete($route, $params = []){
    return $this->addRoute('DELETE', $route, $params);
  }

  /*
  * Metodo responsavel por retornar a uri
  */
  private function getUri(){
   //URI DA REQUEST
   $uri = $this->request->getUri();

   // FATIA A URI COM Prefixo
   $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

   //RETORNA A URI SEM Prefixo
   return end($xUri);
  }


  /*
  * Metodo responsavel por retornar os dados da rota atual
  * @return array
  */
  private function getRoute(){
    $uri = $this->getUri();

    $httpMethod = $this->request->getHttpMethod();

    foreach($this->routes as $patternRoute=>$methods){

     if(preg_match($patternRoute, $uri, $matches)){

      if(isset($methods[$httpMethod])){

        unset($matches[0]);

        $keys = $methods[$httpMethod]['variables'];
        $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
        $methods[$httpMethod]['variables']['request'] = $this->request;

        return $methods[$httpMethod];
      }
      throw new Exception('Método não permitido', 405);
     }
    }
    throw new Exception('URL não encontrada', 404);
  }

  /*
  * Metodo responsavel por executar a rota atual
  * @return Response
  */
  public function run(){
    try{
      $route = $this->getRoute();

      if(!isset($route['controller'])){
        throw new Exception('A URL não pôde ser processada', 500);
      }

      $args = [];

      $reflection = new ReflectionFunction($route['controller']);
      foreach($reflection->getParameters() as $parameter){
        $name = $parameter->getName();
        $args[$name] = $route['variables'][$name] ?? '';
      }

      return call_user_func_array($route['controller'], $args);

    }catch(Exception $e){
      return new Response($e->getCode(), $e->getMessage());
    }
  }


}
