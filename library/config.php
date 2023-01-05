<?php 

namespace library;

class config
{
    
    public $config;
    
    public $route = [];
    
    public $middleware;

    public function __construct($config)
    {
        $this->start($config);
        
        $this->middleware();
    }

    public function start($config)
    {
        $this->route = $config['home'];
        return $this->route;
    }

    public function middleware()
    {
        $this->middleware = require_once '../boot/middleware.php';
    }
}