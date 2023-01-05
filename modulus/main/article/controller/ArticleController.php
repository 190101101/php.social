<?php 

namespace modulus\main\article\controller;
use modulus\main\article\model\ArticleModel;
use core\controller;
use pagination;

class ArticleController extends controller
{
    public $article;
    
    public function __construct()
    {
        $this->article = new ArticleModel();
        $this->page = new pagination();
    }

    public function article()
    {
        $this->layout('general', 'main', 'article', 'article', [
            'page' => $p = $this->page->page($this->article->ArticleCount(), 5),
            'article' => $this->article->ArticleList($p->start, $p->limit),
            'column' => $this->article->ArticleColumn()
        ]);
    }

    public function show($id)
    {
        $this->layout('general', 'main', 'article', 'show', [
            'article' => $this->article->ArticleByUserId($id),
        ]);
    }

    public function create()
    {
        $this->layout('general', 'main', 'article', 'create', []);
    }

    public function ArticleCreate()
    {
        $this->article->ArticleCreate();
    }

    public function update($id)
    {
        $this->layout('general', 'main', 'article', 'update', [
            'article' => $this->article->ArticleByUserId($id),
        ]);
    }

    public function ArticleUpdate()
    {
        $this->article->ArticleUpdate();
    }

    public function ArticleDelete($id)
    {
        $this->article->ArticleDelete($id);
    }

    public function ArticleRead($id)
    {
        $this->layout('main', 'main', 'article', 'read', [
            'article' => $this->article->ArticleRead($id),
            'similar' => $this->article->ArticleSimilar(),
        ]);
    }
}
