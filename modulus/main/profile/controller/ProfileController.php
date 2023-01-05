<?php 

namespace modulus\main\profile\controller;
use modulus\main\profile\model\ProfileModel;
use core\controller;

class ProfileController extends controller
{
    public $profile;
    
    public function __construct()
    {
        $this->profile = new ProfileModel();
    }

    public function ProfileInfo()
    {
        $this->layout('general', 'main', 'profile', 'profile', [
            'article' => $this->profile->ArticleCount(),
            'comment' => $this->profile->CommentCount(),
        ]);
    }

    public function update()
    {
        $this->layout('general', 'main', 'profile', 'update', []);
    }

    public function ProfileUpdate()
    {
        $this->profile->ProfileUpdate();
    }
}
