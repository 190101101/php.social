<?php 

use library\cookie;

class UserCookie
{
	public static function __callStatic($method, $arg)
	{
		if(self::has('user')){
			$json = (object) json_decode(cookie::read('user'));
			return $json->{$method} ?? NULL;
		}
	}

	public static function create($data = [])
	{
		return cookie::create('user', $data);
	}

	public static function read()
    {
    	if(self::has()){
			return (object) json_decode(cookie::read('user'));
    	}
    }

	public static function update($data = [])
	{
    	if(self::has()){
			return cookie::update('user', $data);
		}
	}

    public static function delete()
    {
    	if(self::has()){
	        return cookie::delete('user');
	    }
    }

    public static function has()
    {
        return cookie::has('user');
    }
}


/*
UserCookie::create(db()->t1('user'));
UserCookie::update(['user_level' => 100]);
UserCookie::update(db()->t1('user'));
UserCookie::delete();
*/