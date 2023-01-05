<?php 

namespace modulus\main\info\controller;
use modulus\main\info\model\infoModel;
use core\controller;
use pagination;

class InfoController extends controller
{
    public $info;
    
    public function __construct()
    {
        $this->info = new infoModel();
        $this->page = new pagination();
    }

    public function AboutPage()
    {
        $this->layout('main', 'main', 'info', 'about', []);
    }

    public function RulePage()
    {
        $this->layout('main', 'main', 'info', 'rule', [
            'page' => $p = $this->page->page($this->info->RuleCount(), 5),
            'rule' => $this->info->RuleList($p->start, $p->limit)
        ]);
    }

    public function FaqPage()
    {
        $this->layout('main', 'main', 'info', 'faq', [
            'page' => $p = $this->page->page($this->info->FaqCount(), 10),
            'faq' => $this->info->FaqList($p->start, $p->limit)
        ]);
    }
}
