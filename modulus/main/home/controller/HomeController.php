<?php 

namespace modulus\main\home\controller;
use modulus\main\home\model\HomeModel;
use core\controller;
use pagination;

class HomeController extends controller
{
    public $home;
    
    public function __construct()
    {
        $this->home = new HomeModel();
        $this->page = new pagination();
    }

    public function index()
    {
        $this->layout('main', 'main', 'home', 'home', [
            'page' => $p = $this->page->page($this->home->ArticleCount(), 12),
            'article' => $this->home->ArticleList($p->start, $p->limit)
        ]);
    }

    public function mode($mode)
    {
        $this->home->mode($mode);
    }
}
