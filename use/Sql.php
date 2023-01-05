<?php 

class Sql
{
    public static function __callStatic($method, $arg)
    {
        return self::read($arg)->{$method} ?? NULL;
    }

    public static function read($arg = false)
    {
        return require '../tmp/array/array_article.php';
    }
}
