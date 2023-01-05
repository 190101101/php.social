<?php 

namespace middleware;

use User;

class Authless
{
	public static function handle($next)
	{
		!User::has() ?: REDIRECT();
		return $next;
	}
}

