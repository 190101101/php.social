<?php 

namespace Pattern\Creational\Singleton;
use Exception;

class Singleton
{
    private static $instance = [];

    private function __construct() {}

    private function __clone() {}
    
    /*
    private function __wakeup() 
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    */

    public static function getInstance()
    {
        $class = static::class;
        if(!isset(self::$instance[$class]))
        {
            self::$instance[$class] = new static();
        }
        return self::$instance[$class];
    }
}


?>