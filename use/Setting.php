<?php 

class Setting
{
	public static function __callStatic($method, $arg = false)
	{
		return self::key($method) ?? NULL;
	}

	public static function key($method)
	{

		$data = db()->t1('setting', 2);

		foreach($data as $key)
		{
			$setting[$key->setting_key] = $key->setting_value;
		}

		return $setting[$method] ?? NULL;
	}
}

/*
Setting::keyword();
Setting::about();
*/
