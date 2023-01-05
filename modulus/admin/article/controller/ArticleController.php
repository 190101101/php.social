<?php 

namespace modulus\admin\article\controller;
use modulus\admin\article\model\ArticleModel;
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
        $this->layout('panel', 'admin', 'article', 'article', [
            'page' => $p = $this->page->page($this->article->ArticleCount(), 5),
            'article' => $this->article->ArticleList($p->start, $p->limit),
            'column' => $this->article->ArticleColumn()
        ]);
    }

    public function articleByUser($id)
    {
        $this->layout('panel', 'admin', 'article', 'byUser', [
            'page' => $p = $this->page->page($this->article->ArticleCountByUser($id), 5),
            'article' => $this->article->ArticleListByUser($id, $p->start, $p->limit),
            'user' => $this->article->userById($id),
            'column' => $this->article->ArticleColumn()
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'article', 'show', [
            'article' => $this->article->ArticleShow($id),
            'column' => $this->article->ArticleColumn()
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'article', 'create', [
            'column' => $this->article->ArticleColumn(),
        ]);
    }

    public function ArticleCreate()
    {
        $this->article->ArticleCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'article', 'update', [
            'article' => $this->article->ArticleShow($id),
            'column' => $this->article->ArticleColumn(),
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

    public function ArticleDestroy($id)
    {
        $this->article->ArticleDestroy($id);
    }

    public function ArticleStatus($id)
    {
        $this->article->ArticleStatus($id);
    }

    public function ArticleSearchEngine()
    {
        $this->article->ArticleSearchEngine();
    }

    public function ArticleSearch($key, $value)
    {
        $this->layout('panel', 'admin', 'article', 'search', [
            'page' => $p = $this->page->page($this->article->articleSearchCount($key, $value), 5),
            'article' => $this->article->ArticleSearch($key, $value, $p->start, $p->limit),
            'column' => $this->article->ArticleColumn(),
            'search' => (object) ['key' => $key, 'value' => $value],
        ]);
    }
}
