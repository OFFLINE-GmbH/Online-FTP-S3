<?php namespace App\Exceptions;

use App\ErrorCodeResolver;
use Exception;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $errorCode = ErrorCodeResolver::getCodeByException($e);

        // if the error code is below 600 we use it as HTTP response code
        $httpErrorCode = ($errorCode < 600 && $errorCode >= 200) ? $errorCode : 500;

        return response([
            'content' => '',
            'errors'  => new \ArrayObject([
                $errorCode => ErrorCodeResolver::getMessageByException($e)
            ])
        ], $httpErrorCode);
    }

}
