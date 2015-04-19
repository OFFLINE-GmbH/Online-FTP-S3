<?php namespace App\Http\Middleware;

use Closure;

class UrlDecoderMiddleware
{

    /**
     * Handle an incoming request. urldecodes all parameters
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $decodedInput = [];
        foreach ($request->route()[2] as $key => $value) {
            $decodedInput[$key] = rawurldecode($value);
        }
        $request->replace($decodedInput);

        return $next($request);
    }

}
