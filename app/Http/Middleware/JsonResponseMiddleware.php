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
        if(!preg_match('/\/[file|dir]/', $request->getRequestUri())) {
            return $response;
        }

        if ($response->original === null) {
            $this->setUnknownError($response);
        }

        // Merge response with defaults
        $response->setContent($response->original + $this->getDefaultResponseBody());

        return $response;
    }

    /**
     * @param $response
     */
    private function setUnknownError($response)
    {
        $response->original = [
            'errors' => new \ArrayObject([0 => 'Unknown error occurred'])
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