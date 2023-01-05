<?php 

namespace modulus\main\auth\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use UserCookie;
use User;
use old;

class AuthModel extends model
{
    #sign up
	public function signUp()
    {
        $form = [
        	'user_email',
        	'user_login',
        	'user_password',
        	'confirm_password',
        	'user_gender',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'user_email');
        $v->rule('required', 'user_login');
        $v->rule('required', 'user_password');
        $v->rule('required', 'confirm_password');
        $v->rule('required', 'user_gender');

        $v->rule('lengthMin', 'user_email', 7);
        $v->rule('lengthMin', 'user_login', 3);
        $v->rule('lengthMin', 'user_password', 3);

        $v->rule('lengthMax', 'user_email', 30);
        $v->rule('lengthMax', 'user_login', 30);
        $v->rule('lengthMax', 'user_password', 30);

        $v->rule('equals', 'user_password', 'confirm_password');

        error::valitron($v, 'auth');
       
        #user
        $user = $this->db->t1where('user', 'user_email=? || user_login=?', [
            $data['user_email'], $data['user_login']
        ], 1);

        !$user ?: $this->return->code(404)->return('error')->get()->referer();

        $data = except($data, ['confirm_password']);
        $data += ['user_ip' => REMOTE_ADDR()];

        #if not found user
        $create = $this->db->create('user', $data);

        $create['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('login')->get()->referer();
    }

    #sign in
    public function signIn()
    {
        $http1 = 'auth';

        $form = [
            'user_email',
            'user_password',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'user_email');
        $v->rule('required', 'user_password');

        $v->rule('lengthMin', 'user_email', 7);
        $v->rule('lengthMin', 'user_password', 3);

        $v->rule('lengthMax', 'user_email', 30);
        $v->rule('lengthMax', 'user_password', 30);
        error::valitron($v, $http1);
        
        #user
        $user = $this->db->t1where('user', 'user_email=? && user_password=?', [
            $data['user_email'], $data['user_password']
        ]);

        $user ?: $this->return->code(404)->return('user_not_found')->get()->referer();
        
        $update = $this->db->update('user', [
            'user_id' => $user->user_id,
            'user_ip' => REMOTE_ADDR(),
            'user_updated' => date('Y-m-d H:i:s')
        ], ['id' => 'user_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();

        UserCookie::create([
            'user_email' => $user->user_email,
            'user_login' => $user->user_login,
            'user_password' => $user->user_password,
        ]);

        User::create($user);

        old::delete($data);

        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($user); unset($form);

        $this->return->code(200)->return('login', User::user_login())->get()->http();
    }

    public function signOut()
    {
        $login = User::user_login();
        $http1 = 'auth';

        User::delete('user');

        User::has() 
            ? $this->return->code(404)->return('error')->get()->referer() 
            : $this->return->code(200)->return('logout', $login)->get()->http();
    }

}

