<?php 

namespace modulus\admin\faq\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;

class FaqModel extends model
{
	public function faqCount()
    {
	    return $this->db->t1count('faq', 'faq_id > 0', [])->count;
    }    

    public function faqList($start, $limit)
    {
        return $this->db->t1where('faq', "faq_id > 0
            ORDER BY faq_id DESC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    public function faqShow($id)
    {
        return $this->db->t1where('faq', "faq_id = ?", [$id]) ?:
            $this->return->code(404)->return('not_found')->get()->referer();
    }

    public function faqCreate()
    {
        $http1 = 'panel/faq/create';

        $form = [
            'faq_text',
            'faq_subtext',
            'faq_created',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'faq_text');
        $v->rule('required', 'faq_created');

        $v->rule('lengthMin', 'faq_text', 10);
        $v->rule('lengthMax', 'faq_text', 100);

        $v->rule('lengthMin', 'faq_subtext', 10);
        $v->rule('lengthMax', 'faq_subtext', 1000);
        
        error::valitron($v, $http1);

        #if not found faq
        $create = $this->db->create('faq', $data);

        $create['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

   public function faqUpdate()
    {
        $form = [
            'faq_id',
            'faq_text',
            'faq_subtext',
            'faq_created',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'faq_text');
        $v->rule('required', 'faq_subtext');
        $v->rule('required', 'faq_created');

        $v->rule('lengthMin', 'faq_text', 10);
        $v->rule('lengthMax', 'faq_text', 100);

        $v->rule('lengthMin', 'faq_subtext', 10);
        $v->rule('lengthMax', 'faq_subtext', 1000);
        
        $http1 = "panel/faq/update/{$data['faq_id']}";
        error::valitron($v, $http1);

        #data
        $data += ['faq_updated' => date('Y-m-d H:i:s')];

        #if not found faq
        $update = $this->db->update('faq', $data, ['id' => 'faq_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

    public function faqDelete($id)
    {
        $faq = $this->db->t1where('faq', 'faq_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->json();

        $delete = $this->db->delete('faq', [
            'faq_id' => $faq->faq_id
        ], ['id' => 'faq_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        unset($id); unset($delete); unset($faq);

        $this->return->code(200)->return('success')->json();
    }
    
    public function faqDestroy($id)
    {
        $http1 = 'panel/faq/page/1';
        $faq = $this->db->t1where('faq', 'faq_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->get()->http($http1);

        $delete = $this->db->delete('faq', [
            'faq_id' => $faq->faq_id
        ], ['id' => 'faq_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->http($http1);

        unset($id); unset($delete); unset($faq);

        $this->return->code(200)->return('success')->get()->http($http1);
    }

    public function faqStatus($faq_id)
    {
        $faq = $this->db->t1where('faq', 'faq_id=?', [$faq_id]) ?:
            $this->return->code(404)->return('not_found')->json();

        $update = $this->db->update('faq', [
            'faq_id' => $faq->faq_id,
            'faq_status' => $faq->faq_status == 1 ? 0 : 1,
        ], ['id' => 'faq_id']);

        $update['status'] == TRUE
            ? $this->return->code(200)->return('success')->json()
            : $this->return->code(200)->return('error')->json();
    }

}

