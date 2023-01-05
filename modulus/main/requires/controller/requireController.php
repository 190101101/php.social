<?php 

namespace modulus\main\requires\controller;
use modulus\main\requires\model\requireModel;
use core\controller;

class requireController extends controller
{
    public $require;
    
    public function __construct()
    {
        $this->require = new requireModel();
    }
}

