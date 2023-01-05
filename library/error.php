<?php 

namespace library;

use \Valitron\Validator as v;

class error
{
    public static function valitron($v, $http = false, $time = 1)
    {
        $return = message::getInstance();
        
        if(!$v->validate())
        {
            foreach($v->errors() as $error)
            {
                foreach($error as $item)
                {
                    $return->code(404)->response($item)->time($time)->get()->http($http);
                }
            }
        }
    }
}