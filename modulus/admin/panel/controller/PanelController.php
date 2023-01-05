<?php 

namespace modulus\admin\panel\controller;
use modulus\admin\panel\model\PanelModel;
use core\controller;

class PanelController extends controller
{
    public $panel;
    
    public function __construct()
    {
        $this->panel = new PanelModel();
    }

    public function index()
    {
        $this->layout('panel', 'admin', 'panel', 'panel', [
            'user' => $this->panel->UserCount(),
            'guest' => $this->panel->GuestCount(),
            'article' => $this->panel->ArticleCount(),
            'comment' => $this->panel->CommentCount(),
            'contact' => $this->panel->ContactCount(),
            'rule' => $this->panel->FaqCount(),
            'faq' => $this->panel->RuleCount(),
            'setting' => $this->panel->SettingCount(),
        ]);
    }
}
