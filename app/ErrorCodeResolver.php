<?php namespace App;

class ErrorCodeResolver
{
    /**
     * @var array
     */
    protected static $errorCodes = [
        'League\Flysystem\FileNotFoundException' => 1000
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
        return (array_key_exists($class, self::$errorCodes)) ? self::$errorCodes[$class] : 0;
    }

}