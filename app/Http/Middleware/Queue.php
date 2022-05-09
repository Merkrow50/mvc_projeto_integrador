<?php

namespace App\Http\Middleware;

use App\Http\Response;
use Closure;

class Queue
{

    /**
     * Mapeamento dos middlewares
     * @var array
     */
    private static $map = [];

    /**
     * mapeamento de middleware que serao carregados em todas as rotas
     * @var array
     */
    private static $defaults = [];

    /**
     * middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de execução do controller
     * @var Closure
     */
    private $controller;

    /**
     * argumentos da função do controller
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Método responsavel por construir a classe de file de middlewares
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     */
    public function __construct(array $middlewares, Closure $controller, array $controllerArgs){
        $this->middlewares = array_merge(self::$defaults, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Método responsavel por executar o proximo nivel da fila de middlewares
     * @param $request
     * @return Response
     * @throws \Exception
     */
    public function next($request){
        //Verifica se a fila esta vazia
        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        $middleware = array_shift($this->middlewares);

        //VERIFICA O MAPEAMENTO
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Problemas ao processar o middleware da requisição", 500);
        }

        //NEXT
        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };

        return (new self::$map[$middleware])->handle($request, $next);
    }

    public static function setMap($map){
        self::$map = $map;
    }

    public static function setDefault($default){
        self::$defaults = $default;
    }
}