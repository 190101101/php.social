<?php 

namespace modulus\admin\requires\controller;
use modulus\admin\requires\model\requireModel;
use core\controller;

class requireController extends controller
{
    public $require;
    
    public function __construct()
    {
        $this->require = new requireModel();
    }
}

