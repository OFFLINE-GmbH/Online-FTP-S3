<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;

/**
 * Returns a unified json response
 *
 * Class AfterMiddleware
 * @package App\Http\Middleware
 */
class JsonResponseMiddleware implements Middleware
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $defaultResponseBody = [
            'errors' => new \ArrayObject(),
            'content' => ''
        ];

        $response->setContent($response->original + $defaultResponseBody);

        return $response;
    }
}