<?php 

namespace modulus\main\article\model;
use core\model;
use \library\error;
use \Valitron\Validator as v;
use old;
use User;
use Article;

class ArticleModel extends model
{
    public function ArticleColumn()
    {
        return $this->db->columns('article');
    }    

    public function ArticleRead($id)
    {
        $article = $this->db->t2where('article', 'user', 'article_status=1 AND article_id=?', [$id]) 
        ?: $this->return->code(404)->return('not_found')->get()->http();

        if(!Article::review($article->article_id)){
            $this->db->increment('article', 'article_view', $article->article_id);
            Article::create($article->article_id);
        }
        return $article;
    }

	public function ArticleCount()
    {
	    return $this->db->t1count('article', 'article_status=1 AND user_id=?', [
            User::user_id()
        ])->count;
    }    

    public function ArticleList($start, $limit)
    {
        return $this->db->t1where('article', "article_status=1 AND user_id=?
            ORDER BY article_id DESC LIMIT {$start}, {$limit}", [User::user_id()], 2, 2);
    }

    #
    public function UserById($id)
    {
        return $this->db->t1where('user', "user_id=?", [$id]);
    }

    #
    public function ArticleByUserId($id)
    {
        return $this->db->t1where('article', "user_id=? AND article_status=1 AND article_id = ?", [
            User::user_id(), $id
        ]) ?: $this->return->code(404)->return('not_found', 'article')
                ->get()->http('article/page/1');
    }

    public function ArticleCreate()
    {
        $http1 = 'article/create';

        $form = [
            'article_title',
            'article_text',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);

        if(isset($data['cancel']) && $data['cancel'] == 1){
            old::delete($data);
            $this->return->code(200)->return('success')->get()->referer();
        }

        old::create($data);

        #valitron
        $v = new v($data);

        $v->rule('required', 'article_title');
        $v->rule('required', 'article_text');

        $v->rule('lengthMin', 'article_title', 10);
        $v->rule('lengthMin', 'article_text', 100);

        $v->rule('lengthMax', 'article_title', 20);
        $v->rule('lengthMax', 'article_text', 500);

        error::valitron($v, $http1);

        #session user quota
        if(User::article_quota() < 1){
            old::delete($data);
            $this->return->code(404)->return('article_zero')->get()->referer();
        }

        #user
        $update = $this->db->update('user', [
            'user_id' => User::user_id(),
            'article_quota' => User::article_quota() - 1,
        ], ['id' => 'user_id']);

        #data
        $data += ['user_id' => User::user_id()];

        #create
        $create = $this->db->create('article', $data, 1);

        $create['status'] == TRUE && $update['status'] == TRUE ?: 
            $this->return->code(404)->return('error')->get()->referer();

        old::delete($data);

        User::update([
            'article_quota' => User::article_quota() - 1,
        ]);

        #unset variables
        unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();

    }

    public function ArticleUpdate()
    {
        $form = [
            'article_id',
            'article_title',
            'article_text',
        ];

        #array diff keys
        array_different($form, $_POST) ?: 
            $this->return->code(404)->return('error_form')->get()->referer();

        #peel tags of array
        $data = peel_tag_array($_POST);

        #check via valitron
        $v = new v($data);

        $v->rule('required', 'article_title');
        $v->rule('required', 'article_text');

        $v->rule('lengthMin', 'article_title', 3);
        $v->rule('lengthMin', 'article_text', 100);

        $v->rule('lengthMax', 'article_title', 20);
        $v->rule('lengthMax', 'article_text', 500);

        $http1 = "article/update/{$data['article_id']}";
        error::valitron($v, $http1);

        #article by user id
        $this->ArticleByUserId($data['article_id']);

        #if not found article
        $data += ['user_id' => User::user_id()];
        $data += ['article_updated' => date('Y-m-d H:i:s')];
        
        $update = $this->db->update('article', $data, ['id' => 'article_id']);

        $update['status'] == TRUE ?:
            $this->return->code(404)->return('error')->get()->referer();
        
        #unset variables
        unset($http1); unset($data); unset($_POST); unset($v); unset($form);

        $this->return->code(200)->return('success')->get()->referer();
    }

    public function ArticleDelete($id)
    {
        $article = $this->db->t1where('article', 'user_id=? AND article_id=?', [
            User::user_id(), $id
        ]) ?: $this->return->code(404)->return('not_found')->json();

        time_diff($article->article_created, date('Y-m-d H:i:s'))->i < 5 ?:
            $this->return->code(404)->return('time_up')->json();

        $user = $this->db->update('user', [
            'user_id' => User::user_id(),
            'article_quota' => User::article_quota() + 1,
        ], ['id' => 'user_id']);

        $update = $this->db->update('article', [
            'article_id' => $article->article_id,
            'article_status' => 0,
        ], ['id' => 'article_id']);

        $update['status'] == TRUE && $user['status'] == TRUE ?:
            $this->return->code(404)->return('error')->json();

        User::update([
            'article_quota' => User::article_quota() + 1,
        ]);


        unset($id); unset($delete); unset($article);

        $this->return->code(200)->return('success')->json();
    }

    public function ArticleSimilar()
    {
        return Array_chunk($this->db->t1where("article", 
            "article_id < ? AND article_status=1 ORDER BY article_id DESC LIMIT 6", [
            $this->db->t1count('article', 'article_status=1', [])->count
        ], 2) ?: $this->db->t1where("article", 
            "article_id > 0 AND article_status=1 ORDER BY article_view ASC LIMIT 6", [
        ], 2), 3);
    }

    public function CommentCountByArticle($id)
    {
        return $this->db->t2count('comment', 'user', "article_id=?", [$id])->count;
    }    

    public function CommentByArticle($id, $start, $limit)
    {
        return $this->db->t2where('comment', 'user', "article_id=?
            ORDER BY comment_id DESC LIMIT {$start}, {$limit}", [$id], 2, 2);
    }
}

