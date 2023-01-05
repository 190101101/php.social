<?php 

use library\session;

class User
{
	public static function __callStatic($method, $arg)
	{
		return self::read()->{$method} ?? NULL;
	}

	public static function create($data = [])
	{
		session::create('user', (array) $data);
	}

	public static function read()
    {
		return (object) session::read('user');
    }

	public static function update($data = [])
	{
		session::update('user', (array) $data);
	}

    public static function delete()
    {
        session::delete('user');
    }

	public static function add($data = [])
	{
		session::add('user', $data);
	}

    public static function unset($key)
    {
        session::unset('user', $key);
    }

    public static function has()
    {
        return session::has('user');
    }

    public static function admin()
    {
        return session::has('user') ? self::user_level() >= 99 : FALSE;
    }
}


/*
User::user_level();
User::create(db()->t1('user'));
User::update(['user_level' => 100]);
User::update(db()->t1('user'));
User::delete();
User::unset('user_level');
User::add(['user_new' => 10]);
*/