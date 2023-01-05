<?php

namespace library;

class session
{
    public static function create($session, $key)
    {
        $_SESSION[$session] = $key;
    }

    public static function read($session)
    {
        if(self::has($session) == TRUE)
        {
            return $_SESSION[$session];
        }
    }

    public static function update($session, $data = [])
    {
        if(self::has($session) == TRUE)
        {
            foreach($data as $key => $value){
                $_SESSION[$session][$key] = $value;
            }
        }
    }

    public static function delete($session)
    {
        if(self::has($session) == TRUE)
        {
            unset($_SESSION[$session]);
        }
    }

    public static function add($session, $key = [])
    {
        if(self::has($session) == TRUE)
        {
            return $_SESSION[$session] += $key;
        }
    }

    public static function unset($session, $key)
    {
        if(self::has($session) == TRUE)
        {
            unset($_SESSION[$session][$key]);
        }
    }

    public static function has($session)
    {
        return isset($_SESSION[$session]) ? TRUE : FALSE;
    }
}