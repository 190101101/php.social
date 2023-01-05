<?php 

namespace modulus\admin\setting\controller;
use modulus\admin\setting\model\SettingModel;
use core\controller;
use pagination;

class SettingController extends controller
{
    public $setting;
    
    public function __construct()
    {
        $this->setting = new SettingModel();
        $this->page = new pagination();
    }

    public function setting()
    {
        $this->layout('panel', 'admin', 'setting', 'setting', [
            'page' => $p = $this->page->page($this->setting->settingCount(), 5),
            'setting' => $this->setting->settingList($p->start, $p->limit),
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'setting', 'show', [
            'setting' => $this->setting->settingShow($id),
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'setting', 'create', []);
    }

    public function settingCreate()
    {
        $this->setting->settingCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'setting', 'update', [
            'setting' => $this->setting->settingShow($id),
        ]);
    }

    public function settingUpdate()
    {
        $this->setting->settingUpdate();
    }

    public function settingSearch()
    {
        $this->layout('panel', 'admin', 'setting', 'search', [
            'setting' => $this->post->settingSearch(),
            'page' => peel_tag_array($_GET),
        ]);
    }
}
