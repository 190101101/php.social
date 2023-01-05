<?php 

namespace modulus\main\contact\model;
use core\model;
use \library\session;
use \library\error;
use \Valitron\Validator as v;
use User;
use old;

class ContactModel extends model
{
    #sign up
	public function SendMessage()
    {
        $form = [
        	'contact_email',
        	'contact_message',
            'contact_theme',
        ];

        if(User::has()){
            $_POST += ['contact_email' => User::user_email()];
        }

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'contact_email');
        $v->rule('required', 'contact_message');

        $v->rule('lengthMin', 'contact_email', 7);
        $v->rule('lengthMin', 'contact_message', 10);

        $v->rule('lengthMax', 'contact_email', 30);
        $v->rule('lengthMax', 'contact_message', 1000);
        
        error::valitron($v, 'contact');
       	
        #create contact
        $data += ['contact_ip' => REMOTE_ADDR()];
        $create = $this->db->create('contact', $data);

        $create['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();

        old::delete($data);

        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }
}

