<?php 

namespace modulus\admin\user\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;
use User;

class UserModel extends model
{
	public function UserColumn()
    {
        return $this->db->columns('user');
    }    
    
    public function UserCount()
    {
        return $this->db->t1count('user', 'user_id > 0', [])->count;
    }    

    public function UserList($start, $limit)
    {
        return $this->db->t1where('user', "user_id > 0
            ORDER BY user_id DESC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    public function UserShow($id)
    {
        return $this->db->t1where('user', "user_id = ?", [$id]) ?:
            $this->return->code(404)->return('not_found')->get()->referer();
    }

    public function UserCreate()
    {
        $http1 = 'panel/user/create';

        $form = [
            'user_email',
            'user_login',
            'user_gender',
            'user_password',
            'confirm_password',
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
        $v->rule('required', 'user_gender');
        $v->rule('required', 'user_password');
        $v->rule('required', 'confirm_password');

        $v->rule('lengthMin', 'user_email', 7);
        $v->rule('lengthMin', 'user_login', 3);
        $v->rule('lengthMin', 'user_password', 3);

        $v->rule('lengthMax', 'user_email', 30);
        $v->rule('lengthMax', 'user_login', 30);
        $v->rule('lengthMax', 'user_password', 30);
        
        $v->rule('equals', 'user_password', 'confirm_password');

        error::valitron($v, $http1);
       
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

        $this->return->code(200)->return('success')->get()->referer();
    }

   public function UserUpdate()
    {
        $form = [
            'user_id',
            'user_email',
            'user_login',
            'user_gender',
            'user_ip',
            'user_password',
            'confirm_password',
            'user_updated',
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
        $v->rule('required', 'user_gender');
        $v->rule('required', 'user_password');
        $v->rule('required', 'confirm_password');

        $v->rule('lengthMin', 'user_email', 7);
        $v->rule('lengthMin', 'user_login', 3);
        $v->rule('lengthMin', 'user_password', 3);

        $v->rule('lengthMax', 'user_email', 30);
        $v->rule('lengthMax', 'user_login', 30);
        $v->rule('lengthMax', 'user_password', 30);
        
        $v->rule('equals', 'user_password', 'confirm_password');

        $http1 = "panel/user/update/{$data['user_id']}";
        error::valitron($v, $http1);

        #user
        !$this->db->t1where('user', 'user_id != ? AND user_login=?', [
            $data['user_id'], $data['user_login']
        ], 1) 
        &&
        !$this->db->t1where('user', 'user_id != ? AND user_email=?', [
            $data['user_id'], $data['user_email']
        ], 1) 
        ?: $this->return->code(404)->return('error')->get()->referer();

        $data = except($data, ['confirm_password']);

        #if not found user
        $update = $this->db->update('user', $data, ['id' => 'user_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

    public function UserDelete($id)
    {
        $user = $this->db->t1where('user', 'user_level < 99 && user_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->json();

        $this->db->delete('article', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $this->db->delete('comment', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $delete = $this->db->delete('user', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        unset($id); unset($delete); unset($user);

        $this->return->code(200)->return('success')->json();
    }
    
    public function UserDestroy($id)
    {
        $http1 = 'panel/user/page/1';
        $user = $this->db->t1where('user', 'user_level < 99 && user_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->get()->http($http1);

        $this->db->delete('article', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $this->db->delete('comment', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $delete = $this->db->delete('user', [
            'user_id' => $user->user_id
        ], ['id' => 'user_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->http($http1);

        unset($id); unset($delete); unset($user);

        $this->return->code(200)->return('success')->get()->http($http1);
    }

    public function userStatus($user_id)
    {
        $user = $this->db->t1where('user', 'user_id=?', [$user_id]) ?:
            $this->return->code(404)->return('not_found')->json();

        $update = $this->db->update('user', [
            'user_id' => $user->user_id,
            'user_status' => $user->user_status == 1 ? 0 : 1,
        ], ['id' => 'user_id']);

        $update['status'] == TRUE
            ? $this->return->code(200)->return('success')->json()
            : $this->return->code(200)->return('error')->json();
    }

    public function UserSearchEngine()
    {
        $http1 = 'panel/user/search/data/';
        $http2 = 'panel/user/page/1';

        $form = [
            'page',
            'field_key',
            'field_value',
        ];

        #array diff keys
        array_different($form, $_GET) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_GET);
        $data += ['page_key' => 'panel/user/search/key/value'];

        #valitron
        $v = new v($data);

        $v->rule('required', 'page');
        $v->rule('required', 'field_key');
        $v->rule('required', 'field_value');

        $v->rule('lengthMin', 'field_value', 1);
        $v->rule('lengthMin', 'field_key', 2);

        $v->rule('lengthMax', 'field_value', 20);
        $v->rule('lengthMax', 'field_key', 20);

        $v->rule('equals', 'page', 'page_key');

        error::valitron($v, $http2);
        
        $this->return->http("{$http1}{$data['field_key']}/{$data['field_value']}/page/1");
    }

    public function UserSearchCount($key, $value)
    {
        $http1 = 'panel/user/page/1';
        return $this->db->t1count('user', "{$key} LIKE ? ", [
            "%{$value}%"
        ])->count ?: $this->return->code(404)->return('not_found')->get()->http($http1);
    }

    public function UserSearch($key, $value, $start, $limit)
    {
        return $this->db->t1where('user', "{$key} LIKE ? 
            ORDER BY user.user_id DESC LIMIT {$start}, {$limit}", [
            "%{$value}%"
        ], 2, 2);
    }
}

