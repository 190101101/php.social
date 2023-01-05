<?php 

use library\session;

class old
{
	public static function __callStatic($method, $arg)
	{
		return old::read('old')->{$method} ?? NULL;
	}

	public static function create($data = [])
	{
		session::create('old', (array) $data);
	}

	public static function read()
    {
		return (object) session::read('old');
    }

	public static function update($data = [])
	{
		session::update('old', (array) $data);
	}

    public static function delete()
    {
        session::delete('old');
    }

	public static function add($data = [])
	{
		session::add('old', $data);
	}

    public static function unset($key)
    {
        session::unset('old', $key);
    }

    public static function has()
    {
        return session::has('old');
    }
}


/*
old::old_level();
old::create(db()->t1('old'));
old::update(['old_level' => 100]);
old::update(db()->t1('old'));
old::delete();
old::unset('old_level');
old::add(['old_new' => 10]);
*/