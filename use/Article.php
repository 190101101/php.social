<?php 

use library\cookie;

class Article
{
    public static function create($id)
    {
        if(Article::counter()){
            cookie::create("article[{$id}]", 1, 60);
            return TRUE;
        }
    }

    private static function counter()
    {
        $has = cookie::has('article') ? cookie::has('article') : [];

        return count($has) >= 5 ? Article::delete(array_key_first($has)) : TRUE;
    }

    public static function review($article_id)
    {
        $cookie = cookie::has('article') ? cookie::has('article') : [];
        return in_array($article_id, array_keys($cookie)) ? TRUE : FALSE;
    }


    public static function delete($id)
    {
        if(cookie::has('article', $id) != NULL){
            cookie::delete("article[{$id}]");
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

}

#Article::review($id);
#Article::create($id);

?>