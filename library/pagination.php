<?php 

namespace library;

class pagination
{
    public $start;
    public $page;
    public $count;
    public $limit;
    public $length;

    public function caller()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET')
        {
            http_response_code(404); REDIRECT();
        } 

        if(isset($_GET['page'])) 
        {
            $explode = explode('/', $_GET['page']);
           
            $count = count(explode('/', $_GET['page'])) - 1;

            $replace = str_replace('/', '=', implode('/', $explode));

            if(preg_match('/page=0/', $replace))
            {
                REDIRECT('404');
            }

            $page = $explode[$count];
        }
        else
        {
            $page = 1;
        }

        if(ctype_digit($page) === false) 
        {
            $page = 1;
        }
        return $page;
    }

    public function page($count, $limit)
    {
        $this->count  = $count;
        $this->limit  = $limit;
        $this->page   = $this->caller();
        $this->start  = ($this->page * $this->limit) - $this->limit;
        $this->length = ceil($count / $this->limit);
        return $this;
    }

    public static function selector($p, $prefix = false)
    {
        $page = ceil($p->count / $p->limit);

        if($p->page > 1)
        {
            echo '<li class="page-item">
            <a class="page-link" href="/'.$prefix.'page/'.($p->page - 1).'" >&#171</a></li>';
        }
        if($page > 1)
        {
            for($i = ($p->page - 5); $i < ($page + 1); $i++)
            {
                if($i > 0 and $i <= ($p->page + 5))
                {
                    $swch = $p->page == $i ? 'bg-dark' : false;
                    echo '<li class="page-item">
                    <a class="page-link '.$swch.'" href="/'.$prefix.'page/'.$i.'">'.$i.'</a></li>';
                }
            }

            if(($p->page + 1) <= $p->length)
            {
                echo '<li class="page-item"><a class="page-link" href="/'.$prefix.'page/'.($p->page + 1).'" >&#187</a></li>';
            }
        }

        if($p->count >= 1 && $p->page > $p->length)
        {
            REDIRECT("{$prefix}page/1");
        }

        if($p->count < 1 && $p->page > 1 && $p->length == 0 || $p->page == 0)
        {
            REDIRECT("{$prefix}page/1");
        }
    }
}