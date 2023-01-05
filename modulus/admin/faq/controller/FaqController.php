<?php 

namespace modulus\admin\faq\controller;
use modulus\admin\faq\model\FaqModel;
use core\controller;
use pagination;

class FaqController extends controller
{
    public $faq;
    
    public function __construct()
    {
        $this->faq = new FaqModel();
        $this->page = new pagination();
    }

    public function faq()
    {
        $this->layout('panel', 'admin', 'faq', 'faq', [
            'page' => $p = $this->page->page($this->faq->faqCount(), 5),
            'faq' => $this->faq->faqList($p->start, $p->limit),
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'faq', 'show', [
            'faq' => $this->faq->faqShow($id),
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'faq', 'create', []);
    }

    public function faqCreate()
    {
        $this->faq->faqCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'faq', 'update', [
            'faq' => $this->faq->faqShow($id),
        ]);
    }

    public function faqUpdate()
    {
        $this->faq->faqUpdate();
    }

    public function faqDelete($id)
    {
        $this->faq->faqDelete($id);
    }

    public function faqDestroy($id)
    {
        $this->faq->faqDestroy($id);
    }

    public function faqStatus($id)
    {
        $this->faq->faqStatus($id);
    }

    public function faqSearch()
    {
        $this->layout('panel', 'admin', 'faq', 'search', [
            'faq' => $this->post->faqSearch(),
            'page' => peel_tag_array($_GET),
        ]);
    }
}
