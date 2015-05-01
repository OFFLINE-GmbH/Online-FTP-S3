<?php namespace App\Http\Middleware;

use App\Repositories\FileRepository;
use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Exception\PostTooLargeException;

/**
 * Returns a unified json response
 *
 * Class AfterMiddleware
 * @package App\Http\Middleware
 */
class CheckFilesizeMiddleware implements Middleware
{

    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $fileRepository)
    {
        $this->file = $fileRepository;
    }

    public function handle($request, Closure $next)
    {

        if ($request->has('content') && $this->file->checkFilesize($request->get('content')) === false) {
            throw new PostTooLargeException('The uploaded file is too large');
        }

        $response = $next($request);

        return $response;
    }

}