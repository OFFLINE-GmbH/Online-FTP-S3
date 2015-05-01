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

        if ($response->original === null) {
            $this->setUnkownError($response);
        }

        // Merge response with defaults
        $response->setContent($response->original + $this->getDefaultResponseBody());

        return $response;
    }

    /**
     * @param $response
     */
    private function setUnkownError($response)
    {
        $response->original = [
            'errors' => new \ArrayObject([0 => 'Unkown error occured'])
        ];
    }

    /**
     * @return array
     */
    private function getDefaultResponseBody()
    {
        return [
            'errors'  => new \ArrayObject(),
            'content' => ''
        ];
    }

}