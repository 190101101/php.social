<?php 

namespace modulus\admin\comment\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;
use User;

class CommentModel extends model
{
    public function CommentColumn()
    {
        return $this->db->columns('comment');
    }    

	public function commentCount()
    {
        return $this->db->p3count('comment', 'user', 'article', 'comment.comment_id > 0', [])->count;
    }    

    public function commentList($start, $limit)
    {
        return $this->db->p3where('comment', 'user', 'article', "comment.comment_id > 0
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    #
    public function CommentCountByarticle($id)
    {
        return $this->db->p3count('comment', 'user', 'article', 'article.article_id=?', [$id])->count;
    }    

    public function CommentListByarticle($id, $start, $limit)
    {
        return $this->db->p3where('comment', 'user', 'article', "article.article_id=?
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [$id], 2, 2);
    }

    public function UserById($id)
    {
        return $this->db->t1where('user', "user_id=?", [$id]);
    }

    #
    public function CommentCountByUser($id)
    {
        return $this->db->p3count('comment', 'user', 'article', 'comment.user_id=?', [$id])->count;
    }    

    public function CommentListByUser($id, $start, $limit)
    {
        return $this->db->p3where('comment', 'user', 'article', "comment.user_id=?
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [$id], 2, 2);
    }

    public function articleById($id)
    {
        return $this->db->t1where('article', "article_id=?", [$id]);
    }

    #
    public function commentShow($id)
    {
        return $this->db->t1where('comment', "comment_id = ?", [$id]) ?:
            $this->return->code(404)->return('not_found')->get()->referer();
    }

    public function CommentCreate()
    {
        $http1 = 'panel/comment/create';

        $form = [
            'comment_text',
            'comment_created',
            'comment_updated',
            'user_id',
            'article_id',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'comment_text');
        $v->rule('required', 'comment_created');
        $v->rule('required', 'comment_updated');
        $v->rule('required', 'article_id');
        $v->rule('required', 'user_id');

        $v->rule('lengthMin', 'comment_text', 3);
        $v->rule('lengthMax', 'comment_text', 500);

        error::valitron($v, $http1);

        $this->db->t1where('user', 'user_id=?', [$data['user_id']])
            &&
        $this->db->t1where('article', 'article_id=?', [$data['article_id']])
            ?: 
        $this->return->code(404)->return('not_found')->get()->referer();

        #if not found comment
        $create = $this->db->create('comment', $data);

        $create['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        old::delete($data);

        #unset variables
        unset($http1); unset($data); unset($_comment); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

    public function CommentUpdate()
    {
        $form = [
            'comment_updated',
            'comment_text',
            'article_id',
            'user_id',
            'comment_id',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);
        old::create($data);
        
        #check via valitron
        $http1 = "panel/comment/update/{$data['comment_id']}";
        $v = new v($data);

        $v->rule('required', 'comment_updated');
        $v->rule('required', 'comment_text');
        $v->rule('required', 'user_id');
        $v->rule('required', 'article_id');
        $v->rule('required', 'comment_id');

        $v->rule('lengthMin', 'comment_text', 3);
        $v->rule('lengthMax', 'comment_text', 500);

        error::valitron($v, $http1);

        $this->db->t1where('user', 'user_id=?', [$data['user_id']])
            &&
        $this->db->t1where('article', 'article_id=?', [$data['article_id']])
            ?: 
        $this->return->code(404)->return('not_found')->get()->referer();
        
        #if not found comment
        $update = $this->db->update('comment', $data, ['id' => 'comment_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        old::delete($data);
        
        #unset variables
        unset($http1); unset($data); unset($_comment); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

    public function commentDelete($id)
    {
        $comment = $this->db->t1where('comment', 'comment_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->json();

        $delete = $this->db->delete('comment', [
            'comment_id' => $comment->comment_id
        ], ['id' => 'comment_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        unset($id); unset($delete); unset($comment);

        $this->return->code(200)->return('success')->json();
    }
    
    public function commentDestroy($id)
    {
        $http1 = 'panel/comment/page/1';

        $comment = $this->db->t1where('comment', 'comment_id=?', [$id]) ?: 
            $this->return->code(404)->return('not_found')->get()->http($http1);

        $delete = $this->db->delete('comment', [
            'comment_id' => $comment->comment_id
        ], ['id' => 'comment_id']);

        $delete['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->http($http1);

        unset($id); unset($delete); unset($comment);

        $this->return->code(200)->return('success')->get()->http($http1);
    }

    public function commentStatus($comment_id)
    {
        $comment = $this->db->t1where('comment', 'comment_id=?', [$comment_id]) ?:
            $this->return->code(404)->return('not_found')->json();

        $update = $this->db->update('comment', [
            'comment_id' => $comment->comment_id,
            'comment_status' => $comment->comment_status == 1 ? 0 : 1,
        ], ['id' => 'comment_id']);

        $update['status'] == TRUE
            ? $this->return->code(200)->return('success')->json()
            : $this->return->code(200)->return('error')->json();
    }

    /*-*/

    public function CommentSearchEngine()
    {
        $http1 = 'panel/comment/search/data/';
        $http2 = 'panel/comment/page/1';

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
        $data += ['page_key' => 'panel/comment/search/key/value'];

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

    public function commentSearchCount($key, $value)
    {
        $http1 = 'panel/comment/page/1';
        return $this->db->p3count('comment', 'article', 'user', "comment.{$key} LIKE ? ", [
            "%{$value}%"
        ])->count ?: $this->return->code(404)->return('not_found')->get()->http($http1);
    }

    public function commentSearch($key, $value, $start, $limit)
    {
        return $this->db->p3where('comment', 'article', 'user', "comment.{$key} LIKE ? 
            ORDER BY comment.comment_id DESC LIMIT {$start}, {$limit}", [
            "%{$value}%"
        ], 2, 2);
    }

}

