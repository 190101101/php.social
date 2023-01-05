<?php 

namespace modulus\main\error\controller;
use modulus\main\error\model\errorModel;
use core\controller;

class errorController extends controller
{
    public $error;

    public function __construct()
    {        
        $this->error = new errorModel();
    }

    public function pageNotFound()
    {
        $this->layout('main', 'main', 'error', '404', [
            'error' => 'error not found'
        ]);
    }

    public function errorType($type)
    {
        $this->layout('main', 'main', 'error', 'errorType', [
            'error' => $this->error->errorType($type)
        ]);
    }
}