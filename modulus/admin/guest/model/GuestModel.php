<?php 

namespace modulus\admin\guest\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;

class GuestModel extends model
{
	public function GuestColumn()
    {
        return $this->db->columns('guest');
    }    
    
    public function GuestCount()
    {
        return $this->db->t1count('guest', 'guest_id > 0', [])->count;
    }    

    public function GuestList($start, $limit)
    {
        return $this->db->t1where('guest', "guest_id > 0
            ORDER BY guest_visit DESC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    public function GuestShow($id)
    {
        return $this->db->t1where('guest', "guest_id = ?", [$id]) ?:
            $this->return->code(404)->return('not_found')->get()->referer();
    }

    public function GuestDelete($id)
    {
        $guest = $this->db->t1where('guest', 'guest_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->json();

        $delete = $this->db->delete('guest', [
            'guest_id' => $guest->guest_id
        ], ['id' => 'guest_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        unset($id); unset($delete); unset($guest);

        $this->return->code(200)->return('success')->json();
    }
    
    public function GuestDestroy($id)
    {
        $http1 = 'panel/guest/page/1';
        $guest = $this->db->t1where('guest', 'guest_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->get()->http($http1);

        $delete = $this->db->delete('guest', [
            'guest_id' => $guest->guest_id
        ], ['id' => 'guest_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->http($http1);

        unset($id); unset($delete); unset($guest);

        $this->return->code(200)->return('success')->get()->http($http1);
    }

    public function guestSearchEngine()
    {
        $http1 = 'panel/guest/search/data/';
        $http2 = 'panel/guest/page/1';

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
        $data += ['page_key' => 'panel/guest/search/key/value'];

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

    public function guestSearchCount($key, $value)
    {
        $http1 = 'panel/guest/page/1';
        return $this->db->t1count('guest', "{$key} LIKE ? ", [
            "%{$value}%"
        ])->count ?: $this->return->code(404)->return('not_found')->get()->http($http1);
    }

    public function guestSearch($key, $value, $start, $limit)
    {
        return $this->db->t1where('guest', "{$key} LIKE ? 
            ORDER BY guest.guest_id DESC LIMIT {$start}, {$limit}", [
            "%{$value}%"
        ], 2, 2);
    }
}

