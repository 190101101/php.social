<?php 

namespace middleware;

use User as UserSession;
use library\message;

class User
{
	public static function handle($next)
	{
		$return = message::getInstance();

		!UserSession::has() || UserSession::user_status() == 1 ?: 
            $return->code(404)->return('status_zero')->get()->referer();

		return $next;
	}
}

