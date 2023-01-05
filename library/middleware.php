<?php 

namespace library;

class middleware
{
	public static function call($class, $next)
	{
		return call_user_func_array([$class, "handle"], [$next]);
	}
}

