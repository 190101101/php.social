<?php 

namespace modulus\admin\guest\controller;
use modulus\admin\guest\model\guestModel;
use core\controller;
use pagination;

class GuestController extends controller
{
    public $guest;
    
    public function __construct()
    {
        $this->guest = new GuestModel();
        $this->page = new pagination();
    }

    public function guest()
    {
        $this->layout('panel', 'admin', 'guest', 'guest', [
            'page' => $p = $this->page->page($this->guest->guestCount(), 5),
            'guest' => $this->guest->guestList($p->start, $p->limit),
            'column' => $this->guest->guestColumn()
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'guest', 'show', [
            'guest' => $this->guest->guestShow($id),
            'column' => $this->guest->guestColumn()
        ]);
    }

    public function guestDelete($id)
    {
        $this->guest->guestDelete($id);
    }

    public function guestDestroy($id)
    {
        $this->guest->guestDestroy($id);
    }

    public function guestSearchEngine()
    {
        $this->guest->guestSearchEngine();
    }

    public function guestSearch($key, $value)
    {
        $this->layout('panel', 'admin', 'guest', 'search', [
            'page' => $p = $this->page->page($this->guest->GuestSearchCount($key, $value), 10),
            'guest' => $this->guest->GuestSearch($key, $value, $p->start, $p->limit),
            'column' => $this->guest->GuestColumn(),
            'search' => (object) ['key' => $key, 'value' => $value],
        ]);
    }
}
