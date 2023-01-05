<?php 

use library\cookie;

class Guest
{
	private static function count()
	{
		return db()->t1count('guest', 'guest_visit > ?', [time()])->count;
	}

	private static function thisIp()
	{
		return db()->t1where('guest', 'guest_ip=?', [REMOTE_ADDR()]);
	}

	private static function CreateGuest()
	{
		self::create();
		self::cookie(self::count());
	}

	private static function UpdateGuest($id)
	{
		self::update($id);
		self::cookie(self::count());
	}

	public static function run()
	{
		if(cookie::has('guest'))
		{
			if(self::read()->guest_visit < time())
			{
				$guest = self::thisIp();

				!$guest ? self::CreateGuest() : self::UpdateGuest($guest->guest_id);
			}
		}
		else
		{
			$guest = self::thisIp();

			!$guest ? self::CreateGuest() : self::UpdateGuest($guest->guest_id);
		}
	}

	private static function create()
	{
		db()->create('guest', [
			'guest_ip' => REMOTE_ADDR(),
			'guest_visit' => time() + 3600
		]);
	}

	private static function read()
	{
		return cookie::read('guest') 
			? json_decode(cookie::read('guest')) 
			: (object) ['guest_count' => 0];
	}

	private static function update($id)
	{
		db()->update('guest', [
			'guest_id' => $id,
			'guest_ip' => REMOTE_ADDR(),
			'guest_visit' => time() + 3600
		], ['id' => 'guest_id']);	
	}

	private static function cookie($guest_count)
	{
		cookie::create('guest', [
			'guest_ip' => REMOTE_ADDR(),
			'guest_visit' => time() + 600,
			'guest_count' => $guest_count
		]);	
	}

	public static function online()
	{
		return self::read();
	}
}

