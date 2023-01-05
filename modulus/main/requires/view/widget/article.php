<a href="/article/read/<?php echo $article->article_id; ?>/page/1" class="card h-100 bordered border-danger">
    <div class="card-body">
        <h6 class="text-danger">
            @<?php echo $article->user_login; ?>
        </h6>
        <p class="card-text"><?php echo substr($article->article_text, 0, 200); ?>...</p>
        <h6 class="text-center text-info">
            #<?php echo $article->article_title; ?>
        </h6>
        <small><?php echo date_ymd($article->article_created); ?></small>
        <small>/ # <?php echo $article->article_id; ?></small>
        <small>/ view: <?php echo $article->article_view; ?></small>
    </div>
</a>
