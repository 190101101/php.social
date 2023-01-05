<?php 

namespace core;

class controller
{
    public function __construct() {}

	public function view($area, $modulus, $method, $data = [])
	{
		return view::view($area, $modulus, $method, $data);
	}

	public function layout($layout, $area, $modulus, $method, $data = [])
	{        
		return view::layout($layout, $area, $modulus, $method, $data);
	}
}