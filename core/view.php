<?php 

namespace core;

class view
{
    public static function view($area, $modulus, $method, $data = [])
    {
        if(file_exists($file = "../modulus/{$area}/{$modulus}/view/{$method}.php")){
            require_once $file;
        }
        else{
            REDIRECT('error/type/view');
        }
    }

	private static function render($area, $modulus, $method, $data = [])
	{
		if(file_exists($file = "../modulus/{$area}/{$modulus}/view/{$method}.php")){
            ob_start();
            require_once $file;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
		}
        else{
            REDIRECT('error/type/render');
		}
	}

	public static function layout($layout, $area, $modulus, $method, $data = [])
	{
        $data['VIEW'] = $method == NULL ?: 
            view::render($area, $modulus, $method, (object) $data);
        require_once "../layout/{$layout}.php";
	}
}