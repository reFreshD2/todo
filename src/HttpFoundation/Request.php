<?php

namespace App\HttpFoundation;

class Request
{
    public static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function get($name) {
        return $_POST[$name];
    }

    public static function getContent() {
        return $_POST;
    }
}