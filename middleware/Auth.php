<?php 

namespace middleware;
use User;

class Auth
{
	public static function handle($next)
	{
		User::has() ?: REDIRECT();
		return $next;
	}
}

