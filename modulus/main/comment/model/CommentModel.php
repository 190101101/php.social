<?php 

namespace modulus\main\comment\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;
use User;

class commentModel extends model
{
    public function CommentColumn()
    {
        return $this->db->columns('comment');
    }    

	public function commentCount()
    {
	    return $this->db->t2count('comment', 'article', 'comment.comment_status= 1 && comment.user_id=?', [User::user_id()])->count;
    }    

    public function commentList($start, $limit)
    {
        return $this->db->t2where('comment', 'article', "comment_status= 1 && comment.user_id=?
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [User::user_id()], 2, 2);
    }

    public function OwnCommentShow($id)
    {
        return $this->db->t2where('comment', 'article', 'comment.user_id=? && comment_id=?', [
            User::user_id(), $id
        ]) ?: $this->return->code(404)->return('not_found', 'comment')->get()->http('comment/page/1');
    }

    #
    public function ByOwnArticleCount($id)
    {
        return $this->db->p3count('comment', 'article', 'user', "article.user_id=? AND article.article_id=?", 
            [User::user_id(), $id])->count;
    }    

    public function ByOwnArticleList($id, $start, $limit)
    {
        return $this->db->p3where('comment', 'article', 'user', "article.user_id=? AND article.article_status=1 AND article.article_id=? 
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [User::user_id(), $id], 2, 2);
    }

    public function article($id)
    {
        return $this->db->t1where('article', "article_id=?", [$id]);
    }

    #
    public function CommentByUser($id)
    {
        return $this->db->t1where('comment', "comment_status= 1 && user_id=? && comment_id=?", [User::user_id(), $id]) ?:
            $this->return->code(404)->return('not_found', 'comment')->get()->http('comment/page/1');
    }

    #create
    public function CommentCreate()
    {
        $http1 = 'panel/comment/create';

        $form = [
            'comment_text',
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

        $v->rule('required', 'article_id');
        $v->rule('required', 'comment_text');

        $v->rule('lengthMin', 'comment_text', 3);
        $v->rule('lengthMax', 'comment_text', 500);

        error::valitron($v, $http1);

        #session user quota
        if(User::comment_quota() < 1){
            old::delete($data);
            $this->return->code(404)->return('article_zero')->get()->referer();
        }

        #article read
        $article = $this->db->t1where('article', 'article_status = 1 && article_id=?', [
            $data['article_id']
        ]) ?: $this->return->code(404)->return('not_found')->get()->referer();

        #comment read
        !$this->db->t1where('comment', 'article_id=? && user_id=?', [
            $data['article_id'], User::user_id()
        ]) ?: $this->return->code(404)->return('comment_already')->get()->referer();

        #if not found comment
        $data += ['user_id' => User::user_id()];
        $create = $this->db->create('comment', $data);

        #article update
        $article_update = $this->db->update('article', [
            'article_id' => $article->article_id,
            'comment_count' => $article->comment_count + 1,
        ], ['id' => 'article_id']);

       #user update
        $user_update = $this->db->update('user', [
            'user_id' => User::user_id(),
            'comment_quota' => User::comment_quota() - 1,
        ], ['id' => 'user_id']);

        #status
        $create['status'] == TRUE && $article_update['status'] == TRUE &&
            $user_update['status'] == TRUE ?:
                $this->return->code(404)->return('error')->get()->referer();
        
        old::delete($data);

        User::update([
            'comment_quota' => User::comment_quota() - 1,
        ]);

        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }
}

