<?php

namespace App\Http\Middleware;
use App\Session\admin\Login as SessionAdminLogin;

class RequireAdminLogout
{

    public function handle($request, $next)
    {

        if(SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/');
        }

        return $next($request);
    }


}