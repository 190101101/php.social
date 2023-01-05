<?php 

namespace modulus\main\profile\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use User;

class ProfileModel extends model
{
	public function ArticleCount()
	{
		return $this->db->t1count('article', 'article_status=1 && user_id=?', [User::user_id()])->count;
	}

	public function CommentCount()
	{
		return $this->db->t1count('comment', 'user_id=? AND comment_status=1', [User::user_id()])->count;
	}

	public function ProfileUpdate()
    {
        $form = [
            'user_password',
            'confirm_password',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);

        #valitron
        $v = new v($data);
        
        $v->rule('required', 'user_password');
        $v->rule('lengthMin', 'user_password', 3);
        $v->rule('lengthMax', 'user_password', 30);
        $v->rule('equals', 'user_password', 'confirm_password');

        error::valitron($v, 'profile/update');

        #create
        $update = $this->db->update('user', [
            'user_id' => User::user_id(),
            'user_updated' => date('Y-m-d H:i:s'),
            'user_password' => $data['user_password'],
        ], ['id' => 'user_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();

        User::update([
            'user_password' => $data['user_password'],
            'user_updated' => date('Y-m-d H:i:s'),
        ]);

        #unset variables
        unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }
}

