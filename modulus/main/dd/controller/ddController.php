<?php 

namespace modulus\main\dd\controller;
use modulus\main\dd\model\ddModel;
use core\controller;

class ddController extends controller
{
    public $dd;
    
    public function __construct()
    {
        $this->dd = new ddModel();
    }

    public function dd()
    {
        $this->layout('debug', 'main', 'dd', 'dd', []);
    }
}

