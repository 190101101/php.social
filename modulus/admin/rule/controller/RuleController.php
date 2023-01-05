<?php 

namespace modulus\admin\rule\controller;
use modulus\admin\rule\model\ruleModel;
use core\controller;
use pagination;

class RuleController extends controller
{
    public $rule;
    
    public function __construct()
    {
        $this->rule = new RuleModel();
        $this->page = new pagination();
    }

    public function rule()
    {
        $this->layout('panel', 'admin', 'rule', 'rule', [
            'page' => $p = $this->page->page($this->rule->ruleCount(), 5),
            'rule' => $this->rule->ruleList($p->start, $p->limit),
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'rule', 'show', [
            'rule' => $this->rule->ruleShow($id),
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'rule', 'create', []);
    }

    public function ruleCreate()
    {
        $this->rule->ruleCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'rule', 'update', [
            'rule' => $this->rule->ruleShow($id),
        ]);
    }

    public function ruleUpdate()
    {
        $this->rule->ruleUpdate();
    }

    public function ruleDelete($id)
    {
        $this->rule->ruleDelete($id);
    }

    public function ruleDestroy($id)
    {
        $this->rule->ruleDestroy($id);
    }

    public function ruleStatus($id)
    {
        $this->rule->ruleStatus($id);
    }

    public function ruleSearch()
    {
        $this->layout('panel', 'admin', 'rule', 'search', [
            'rule' => $this->post->ruleSearch(),
            'page' => peel_tag_array($_GET),
        ]);
    }
}
