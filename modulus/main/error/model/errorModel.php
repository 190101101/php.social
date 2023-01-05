<?php 
namespace modulus\main\error\model;
use core\model;

class errorModel extends model
{
	public function errorType($type)
	{
		$type_arr = ['class', 'controller', 'method'];

		return in_array($type, $type_arr) === TRUE ? $type : 
            $this->return->code(404)->return('error')->get()->http();
	}
}