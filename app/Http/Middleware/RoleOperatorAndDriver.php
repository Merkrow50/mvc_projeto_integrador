<?php

namespace App\Http\Middleware;

class RoleOperatorAndDriver
{
    /**
     * Método repsonsavel por
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        if($_SESSION['admin']['usuario']['role'] != 'operator' && $_SESSION['admin']['usuario']['role'] != 'driver' && $_SESSION['admin']['usuario']['role'] != 'super'){
            throw new \Exception("Página bloqueada. Peça o acesso ao administrador.", 200);
        }

        return $next($request);
    }
}