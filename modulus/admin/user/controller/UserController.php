<?php 

namespace modulus\admin\user\controller;
use modulus\admin\user\model\UserModel;
use core\controller;
use pagination;

class UserController extends controller
{
    public $user;
    
    public function __construct()
    {
        $this->user = new UserModel();
        $this->page = new pagination();
    }

    public function user()
    {
        $this->layout('panel', 'admin', 'user', 'user', [
            'page' => $p = $this->page->page($this->user->UserCount(), 5),
            'user' => $this->user->UserList($p->start, $p->limit),
            'column' => $this->user->UserColumn()
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'user', 'show', [
            'user' => $this->user->UserShow($id),
            'column' => $this->user->UserColumn()
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'user', 'create', [
            'column' => $this->user->UserColumn()
        ]);
    }

    public function UserCreate()
    {
        $this->user->UserCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'user', 'update', [
            'user' => $this->user->UserShow($id),
            'column' => $this->user->UserColumn()
        ]);
    }

    public function UserUpdate()
    {
        $this->user->UserUpdate();
    }

    public function UserDelete($id)
    {
        $this->user->UserDelete($id);
    }

    public function UserDestroy($id)
    {
        $this->user->UserDestroy($id);
    }

    public function UserStatus($id)
    {
        $this->user->UserStatus($id);
    }

    public function UserSearchEngine()
    {
        $this->user->UserSearchEngine();
    }

    public function UserSearch($key, $value)
    {
        $this->layout('panel', 'admin', 'user', 'search', [
            'page' => $p = $this->page->page($this->user->UserSearchCount($key, $value), 10),
            'user' => $this->user->UserSearch($key, $value, $p->start, $p->limit),
            'column' => $this->user->UserColumn(),
            'search' => (object) ['key' => $key, 'value' => $value],
        ]);
    }
}
