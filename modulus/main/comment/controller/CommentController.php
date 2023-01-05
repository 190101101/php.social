<?php 

namespace modulus\main\comment\controller;
use modulus\main\comment\model\CommentModel;
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
        $this->layout('general', 'main', 'comment', 'comment', [
            'page' => $p = $this->page->page($this->comment->commentCount(), 5),
            'comment' => $this->comment->commentList($p->start, $p->limit),
        ]);
    }

    public function OwnShow($id)
    {
        $this->layout('general', 'main', 'comment', 'show', [
            'comment' => $this->comment->OwnCommentShow($id),
        ]);
    }

    public function ByOwnArticle($id)
    {
        $this->layout('general', 'main', 'comment', 'ownArticle', [
            'page' => $p = $this->page->page($this->comment->ByOwnArticleCount($id), 5),
            'comment' => $this->comment->ByOwnArticleList($id, $p->start, $p->limit),
            'article' => $this->comment->article($id),
            'id' => $id
        ]);
    }

    public function CommentCreate()
    {
        $this->comment->CommentCreate();
    }
}
