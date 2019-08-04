<?php

use Contract\RequestInterface;
use Module\Http\Request;
use Module\Http\Response;
use Traits\Registry;

abstract class Controller {

    use Registry;

    private static ?Request $_request = null;

    /**
     * @return RequestInterface
     */
    protected static function __getRequest(): RequestInterface
    {
        if (self::$_request === null) {
            try {
                self::$_request = new Request();
            } catch (Exception $exception) {
                self::setError(500, $exception);
            }
        }

        return self::$_request;
    }

    public static function setError(int $status, ?Throwable $exception)
    {
        $header = $_SERVER['SERVER_PROTOCOL'] . " " . $status . " " . Response::STATUS_PHRASE[$status];
        header($header);
        switch ($status) {
            case 404:
            default:
                /** @noinspection PhpIncludeInspection */
                include_once $_SERVER['DOCUMENT_ROOT'] . '/404.html';
                break;
        }

        unset($exception);
        exit(0);
    }

}