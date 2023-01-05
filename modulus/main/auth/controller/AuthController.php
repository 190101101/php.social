<?php 

namespace modulus\main\auth\controller;
use modulus\main\auth\model\AuthModel;
use core\controller;

class AuthController extends controller
{
    public $auth;
    
    public function __construct()
    {
        $this->auth = new AuthModel();
    }

    public function AuthPage()
    {
        $this->layout('main', 'main', 'auth', 'auth', []);
    }

    public function SignUp()
    {
        $this->auth->SignUp();
    }

    public function SignIn()
    {
        $this->auth->SignIn();   
    }

    public function SignOut()
    {
        $this->auth->SignOut();   
    }
}
