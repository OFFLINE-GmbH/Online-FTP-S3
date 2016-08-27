<?php

namespace App\Http\Middleware;

use App\Helpers\LoginHandler;
use Closure;

class ApplyLoginData
{
    /**
     * Apply the login data from the session storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Session::get('loggedIn', false) === true) {
            $login = new LoginHandler();
            $login->apply();
        }

        return $next($request);
    }
}
