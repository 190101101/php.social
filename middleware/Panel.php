<?php 

namespace middleware;

use User;

class Panel
{
	public static function handle($next)
	{
		User::has() && User::user_level() >= 99 ?: REDIRECT();
		return $next;
	}
}

