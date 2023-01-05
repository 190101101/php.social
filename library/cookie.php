<?php

namespace library;

class cookie
{
    public static function create
    (
        $key, 
        $value,
        $expire = false, 
        $path = '/', 
        $domain = 'current', 
        $secure = 0, 
        $httponly = true
    )
    {
        if($domain == 'current') {
            $domain = $_SERVER['HTTP_HOST'];
        }
         
        if(!$expire) {
            $expire = time() + (3600 * 24);
        } else {
            $expire = time() + $expire;
        }

        setcookie($key, json_encode($value), $expire, $path, $domain, $secure, $httponly);
        return true;
    }

    public static function read($key, $value = false)
    {
        if(self::has($key, $value))
        {
            if($value == FALSE)
            {
                return $_COOKIE[$key];
            }
            else
            {
                return $_COOKIE[$key][$value];
            }
        }
    }

    public static function update
    (
        $key, 
        $value,
        $expire = false, 
        $path = '/', 
        $domain = 'current', 
        $secure = 0, 
        $httponly = true
    )
    {
        if($domain == 'current') {
            $domain = $_SERVER['HTTP_HOST'];
        }
         
        if(!$expire) {
            $expire = time() + (3600 * 24);
        } else {
            $expire = time() + $expire;
        }

        if(!self::has($key)){
            return false;
            exit;
        }

        $data = json_decode(self::read($key));

        foreach($value as $keys => $values){
            $data->{$keys} = $values;
        }

        setcookie($key, json_encode($data), $expire, $path, $domain, $secure, $httponly);
        return true;
    }


    public static function delete
    (
        $key, 
        $value = '', 
        $expire = 1, 
        $path = '/', 
        $domain = 'current', 
        $secure = 0, 
        $httponly = false
    ) 
    {
        if($domain == 'current') {
            $domain = $_SERVER['HTTP_HOST'];
        }
        
        setcookie($key,$value,$expire,$path,$domain,$secure, $httponly);
        return true;
    }

    public static function has($cookie, $value = false)
    {
        if(isset($_COOKIE[$cookie])){

            if($value == FALSE){
                return $_COOKIE[$cookie];
            }
            else{
                if(isset($_COOKIE[$cookie][$value])){
                    return $_COOKIE[$cookie][$value];
                }
                else{
                    return FALSE;
                }
            }
        }else{
            return FALSE;
        }
    }
}

/*
cookie::create('user', ['login' => 'apsi']);
cookie::read('user');
cookie::update('user', ['login' => 'apsi'])
cookie::delete('user');
cookie::has('user');
*/