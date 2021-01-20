<?php

namespace App\HttpFoundation;

class Cookie
{
    public static function get($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        } else {
            return NULL;
        }
    }
}