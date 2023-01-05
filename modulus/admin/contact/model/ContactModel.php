<?php 

namespace modulus\admin\contact\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;

class ContactModel extends model
{
    public function ContactColumn()
    {
        return $this->db->columns('contact');
    }    

	public function contactCount()
    {
	    return $this->db->t1count('contact', 'contact_id > 0', [])->count;
    }    

    public function contactList($start, $limit)
    {
        return $this->db->t1where('contact', "contact_id > 0
            ORDER BY contact_id DESC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    public function contactShow($id)
    {
        return $this->db->t1where('contact', "contact_id = ?", [$id]) ?:
            $this->return->code(404)->return('not_found')->json();
    }

    public function contactDelete($id)
    {
        $contact = $this->db->t1where('contact', 'contact_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->json();

        $delete = $this->db->delete('contact', [
            'contact_id' => $contact->contact_id
        ], ['id' => 'contact_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        unset($id); unset($delete); unset($contact);

        $this->return->code(200)->return('success')->json();
    }

    public function contactDestroy($id)
    {
        $http1 = 'panel/contact/page/1';

        $contact = $this->db->t1where('contact', 'contact_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->get()->http($http1);

        $delete = $this->db->delete('contact', [
            'contact_id' => $contact->contact_id
        ], ['id' => 'contact_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->http($http1);

        unset($id); unset($delete); unset($contact);

        $this->return->code(200)->return('success')->get()->http($http1);
    }

    /**/
    public function ContactSearchEngine()
    {
        $http1 = 'panel/contact/search/data/';
        $http2 = 'panel/contact/page/1';

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
        $data += ['page_key' => 'panel/contact/search/key/value'];

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

    public function ContactSearchCount($key, $value)
    {
        $http1 = 'panel/contact/page/1';
        return $this->db->t1count('contact', "{$key} LIKE ? ", [
            "%{$value}%"
        ])->count ?: $this->return->code(404)->return('not_found')->get()->http($http1);
    }

    public function ContactSearch($key, $value, $start, $limit)
    {
        return $this->db->t1where('contact', "{$key} LIKE ? 
            ORDER BY contact.contact_id DESC LIMIT {$start}, {$limit}", [
            "%{$value}%"
        ], 2, 2);
    }
}

