<div class="col-lg-3 mb-4">

    <?php if(User::admin()): ?>
    <div class="list-group mb-3">
        <a href="/panel/admin" class="list-group-item">panel</a>
    </div>
    <?php endif; ?>

    <div class="list-group">
        <a <?php if(segment(1).'/'.segment(2) != 'profile/info'): ?> href="/profile/info" <?php endif; ?> 
        class="list-group-item <?php echo segment(1).'/'.segment(2) != 'profile/info' ?: 'active'; ?>">profile</a>

        <a <?php if(segment(1).'/'.segment(2) != 'article/page'): ?> href="/article/page/1" <?php endif; ?>
         class="list-group-item <?php echo segment(1).'/'.segment(2) != 'article/page' ?: 'active'; ?>">article</a>

        <a <?php if(segment(1).'/'.segment(2) != 'comment/page'): ?> href="/comment/page/1" <?php endif; ?> 
        class="list-group-item <?php echo segment(1).'/'.segment(2) != 'comment/page' ?: 'active'; ?>">comment</a>
    </div>

    <?php if($data != false): ?>
        <?php if($data->data == 'article'): ?>
            <?php $article = $data->article; ?>

            <div class="list-group mt-3">
                <?php if($article->user_id == User::user_id()): ?>
                <a href="/comment/user/article/<?php echo $article->article_id ?>/page/1" class="list-group-item
                <?php echo segment(1).'/'.segment(2) != 'comment/user' ?: 'active'; ?>">comment by own article</a>
                <?php endif; ?>
            </div>
            
            <div class="list-group mt-3">
                <a class="list-group-item">article info</a>
                <a class="list-group-item">title: <?php echo $article->article_title; ?></a>
                <a class="list-group-item" href="/article/read/<?php echo $article->article_id; ?>/page/1">
                    id: <?php echo $article->article_id; ?>
                </a>
            </div>

        <?php elseif($data->data == 'page_data'): ?>
            <?php $page = $data->page; ?>
            <div class="list-group mt-3">
                <a class="list-group-item">data info</a>
                <a class="list-group-item">tapıldı <?php echo $page->count; ?> data</a>
                <a class="list-group-item">tapıldı <?php echo $page->length; ?> səhifə</a>
            </div>
            <?php if(isset($data->search)): ?>
                <?php $search = $data->search; ?>
                <div class="list-group mt-3">
                    <a class="list-group-item">search</a>
                    <a class="list-group-item">key: <?php echo $search->key; ?></a>
                    <a class="list-group-item">value: <?php echo $search->value; ?> səhifə</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="list-group mt-3">
        <a class="list-group-item">user info</a>
        <a class="list-group-item">email: <?php echo User::user_email(); ?></a>
        <a class="list-group-item">login: <?php echo User::user_login(); ?></a>
        <a class="list-group-item">article quota: <?php echo User::article_quota(); ?></a>
        <a class="list-group-item">comment quota: <?php echo User::comment_quota(); ?></a>
        <a class="list-group-item">status: <?php echo User::user_status(); ?></a>
        <a class="list-group-item">created: <?php echo date_dy(User::user_created()); ?></a>
        <a class="list-group-item">updated: <?php echo date_dy(User::user_updated()); ?></a>
        <a class="list-group-item">last: <?php echo date_dy(User::last_updated()); ?></a>
    </div>
    
</div>
