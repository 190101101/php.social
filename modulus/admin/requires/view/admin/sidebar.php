<div class="col-lg-3 mb-4">

    <div class="list-group mb-3">
        <a href="/profile/info" class="list-group-item">profile</a>
    </div>

    <div class="list-group">
        <a <?php if(segment(2) != 'admin'): ?> href="/panel/admin" <?php endif; ?> class="list-group-item
        <?php echo segment(2) != 'admin' ?: 'active'; ?>">panel</a>

        <a <?php if(segment(2) != 'user'): ?> href="/panel/user/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2) != 'user' ?: 'active'; ?>">user</a>

        <a <?php if(segment(2) != 'article/page'): ?> href="/panel/article/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2).'/'.segment(3) != 'article/page' ?: 'active'; ?>">article</a>

        <a <?php if(segment(2) != 'comment/page'): ?> href="/panel/comment/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2).'/'.segment(3) != 'comment/page' ?: 'active'; ?>">comment</a>
    </div>

    <?php if($data != false): ?>
        <?php if($data->data == 'article'): ?>
            <?php $article = $data->article; ?>
            <div class="list-group mt-3">
                <a class="list-group-item
                <?php echo segment(2).'/'.segment(3) != 'comment/article' ?: 'active'; ?>">comment by article</a>
            </div>
            
            <div class="list-group mt-3">
                <a class="list-group-item">article info</a>
                <a class="list-group-item" href="/panel/article/show/<?php echo $article->article_id; ?>">
                    go to article: <?php echo $article->article_id; ?>
                </a>
                <a class="list-group-item">title: <?php echo $article->article_title; ?></a>
            </div>

        <?php elseif($data->data == 'user'): ?>
            <?php $user = $data->user; ?>
            <div class="list-group mt-3">

                <?php if(segment(2).'/'.segment(3) == 'article/user'): ?>
                    <a class="list-group-item active">article by user</a>
                <?php endif; ?>

                <?php if(segment(2).'/'.segment(3) == 'comment/user'): ?>
                    <a class="list-group-item active">comment by user</a>
                <?php endif; ?>
                
            </div>
            
            <div class="list-group mt-3">
                <a class="list-group-item">user info</a>
                <a class="list-group-item" href="/panel/user/show/<?php echo $user->user_id; ?>">
                    go to user: <?php echo $user->user_login; ?>
                </a>
                <a class="list-group-item">email: <?php echo $user->user_email; ?></a>
                <a class="list-group-item">login: <?php echo $user->user_login; ?></a>
                <a class="list-group-item">gender: <?php echo $user->user_created; ?></a>
                <a class="list-group-item">created: <?php echo $user->user_created; ?></a>
                <a class="list-group-item">updated: <?php echo $user->user_updated; ?></a>
            </div>

        <?php elseif($data->data == 'page_data'): ?>
            <?php $page = $data->page; ?>
            <div class="list-group mt-3">
                <a class="list-group-item">data info</a>
                <a class="list-group-item">found <?php echo $page->count; ?></a>
                <a class="list-group-item">found <?php echo $page->length; ?> pages</a>
            </div>
            <?php if(isset($data->search)): ?>
                <?php $search = $data->search; ?>
                <div class="list-group mt-3">
                    <a class="list-group-item">search</a>
                    <a class="list-group-item">key: <?php echo $search->key; ?></a>
                    <a class="list-group-item">value: <?php echo $search->value; ?> pages</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
