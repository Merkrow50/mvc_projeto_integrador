<?php

namespace App\Http\Middleware;

class UserBlocked
{
    /**
     * Método repsonsavel por
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){

        if($_SESSION['admin']['usuario']['isBlocked'] != null) {
            if ($_SESSION['admin']['usuario']['isBlocked']) {
                session_destroy();
                $request->getRouter()->redirect('/admin/login?status=isBlocked');
            }
        }

        return $next($request);
    }
}