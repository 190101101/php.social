<?php 

namespace modulus\admin\contact\controller;
use modulus\admin\contact\model\ContactModel;
use core\controller;
use pagination;

class ContactController extends controller
{
    public $contact;
    
    public function __construct()
    {
        $this->contact = new ContactModel();
        $this->page = new pagination();
    }

    public function contact()
    {
        $this->layout('panel', 'admin', 'contact', 'contact', [
            'page' => $p = $this->page->page($this->contact->contactCount(), 5),
            'contact' => $this->contact->contactList($p->start, $p->limit),
            'column' => $this->contact->ContactColumn(),
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'contact', 'show', [
            'contact' => $this->contact->contactShow($id),
            'column' => $this->contact->ContactColumn(),
        ]);
    }

    public function contactDelete($id)
    {
        $this->contact->contactDelete($id);
    }

    public function contactDestroy($id)
    {
        $this->contact->contactDestroy($id);
    }

    public function ContactSearchEngine()
    {
        $this->contact->ContactSearchEngine();
    }

    public function ContactSearch($key, $value)
    {
        $this->layout('panel', 'admin', 'contact', 'search', [
            'page' => $p = $this->page->page($this->contact->ContactSearchCount($key, $value), 10),
            'contact' => $this->contact->ContactSearch($key, $value, $p->start, $p->limit),
            'column' => $this->contact->ContactColumn(),
            'search' => (object) ['key' => $key, 'value' => $value],
        ]);
    }
}
