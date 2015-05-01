<?php namespace App;

class ErrorCodeResolver
{
    /**
     * @var array
     */
    protected static $errorCodes = [
        // Flysystem
        'League\Flysystem\FileNotFoundException'                               => 1000,
        'League\Flysystem\FileExistsException'                                 => 1001,

        // HTTP
        'Illuminate\Http\Exception\PostTooLargeException'                      => 413,
        'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException' => 405,
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException'         => 404,
    ];

    /**
     * @var array
     */
    protected static $errorMessages = [
        // HTTP
        'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException' => 'This HTTP method is now allowed',
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException'         => 'The requestet URL does not exist',
    ];

    /**
     * Returns the error code for an exception
     *
     * @param \Exception $e
     *
     * @return array
     */
    public static function getCodeByException(\Exception $e)
    {
        $class = get_class($e);
        return (array_key_exists($class, self::$errorCodes)) ? self::$errorCodes[$class] : $class;
    }

    /**
     * Returns the message code for an exception
     *
     * @param \Exception $e
     *
     * @return array
     */
    public static function getMessageByException(\Exception $e)
    {
        $class = get_class($e);
        return (array_key_exists($class, self::$errorMessages)) ? self::$errorMessages[$class] : $e->getMessage();
    }

}