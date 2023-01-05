<?php 

namespace modulus\admin\comment\controller;
use modulus\admin\comment\model\CommentModel;
use core\controller;
use pagination;

class CommentController extends controller
{
    public $comment;
    
    public function __construct()
    {
        $this->comment = new CommentModel();
        $this->page = new pagination();
    }

    public function comment()
    {
        $this->layout('panel', 'admin', 'comment', 'comment', [
            'page' => $p = $this->page->page($this->comment->commentCount(), 5),
            'comment' => $this->comment->commentList($p->start, $p->limit),
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function CommentByarticle($id)
    {
        $this->layout('panel', 'admin', 'comment', 'byarticle', [
            'page' => $p = $this->page->page($this->comment->CommentCountByarticle($id), 5),
            'comment' => $this->comment->CommentListByarticle($id, $p->start, $p->limit),
            'article' => $this->comment->articleById($id),
            'article_id' => $id,
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function CommentByUser($id)
    {
        $this->layout('panel', 'admin', 'comment', 'byUser', [
            'page' => $p = $this->page->page($this->comment->CommentCountByUser($id), 5),
            'comment' => $this->comment->CommentListByUser($id, $p->start, $p->limit),
            'user' => $this->comment->UserById($id),
            'user_id' => $id,
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function show($id)
    {
        $this->layout('panel', 'admin', 'comment', 'show', [
            'comment' => $this->comment->commentShow($id),
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function create()
    {
        $this->layout('panel', 'admin', 'comment', 'create', [
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function CommentCreate()
    {
        $this->comment->CommentCreate();
    }

    public function update($id)
    {
        $this->layout('panel', 'admin', 'comment', 'update', [
            'comment' => $this->comment->commentShow($id),
            'column' => $this->comment->CommentColumn()
        ]);
    }

    public function CommentUpdate()
    {
        $this->comment->CommentUpdate();
    }

    public function CommentDelete($id)
    {
        $this->comment->CommentDelete($id);
    }

    public function CommentDestroy($id)
    {
        $this->comment->CommentDestroy($id);
    }

    public function CommentStatus($id)
    {
        $this->comment->CommentStatus($id);
    }


    public function CommentSearchEngine()
    {
        $this->comment->CommentSearchEngine();
    }

    public function CommentSearch($key, $value)
    {
        $this->layout('panel', 'admin', 'comment', 'search', [
            'page' => $p = $this->page->page($this->comment->CommentSearchCount($key, $value), 5),
            'comment' => $this->comment->CommentSearch($key, $value, $p->start, $p->limit),
            'column' => $this->comment->CommentColumn(),
            'search' => (object) ['key' => $key, 'value' => $value],
        ]);
    }
}
