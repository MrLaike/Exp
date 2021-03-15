<?php

namespace Kernel\HttpRequest;

use Kernel\Singleton;

final class Request extends Singleton
{
    /**
     * Не реализованы
     * HEAD, OPTIONS, PATCH, TRACE, CONNECT, PURGE
     */
    public const METHOD_POST    = 'POST';
    public const METHOD_GET     = 'GET';
    public const METHOD_DELETE  = 'DELETE';
    public const METHOD_PUT     = 'PUT';

    /** @var array $request */
    private static $request = [];

    public static function init(): void
    {
        if (in_array(self::getMethod(), [self::METHOD_DELETE, self::METHOD_PUT])) {

            $request = json_decode(file_get_contents("php://input"), true);
        } else {
            $request = $_REQUEST;
        }
        self::$request = $request;
    }

    public static function request(): RequestBag
    {
        return new RequestBag(self::$request);
    }

    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /** Редеректим с POST на GET в браузере при отправке формы */
    public static function reset(): void
    {
        if ($_POST) {
            header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
            exit();
        }
    }
}