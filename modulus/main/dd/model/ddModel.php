<?php 

namespace modulus\main\dd\model;
use core\model;

class ddModel extends model
{
	public function dd()
	{
		dd(self::class);
	}	
}
