<?php

namespace App\Http\Middleware;


class Maintenance
{

    /**
     * Método repsonsavel por
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        if(getenv('MAINTENANCE') == 'true'){
            throw new \Exception("Página em manutenção. Tente novamente mais tarde.", 200);
        }

        return $next($request);
    }

}