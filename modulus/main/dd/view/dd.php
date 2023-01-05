<?php 

$article = db()->t1where('article', 'article_id=?', [1001]);

dd($article);

$time_diff = time_diff($article->article_created, date('Y-m-d H:i:s'));

dd($time_diff);

dd($time_diff->i);