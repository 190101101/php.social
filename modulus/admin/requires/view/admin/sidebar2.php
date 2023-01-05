<div class="col-lg-3 mb-4">

    <div class="list-group mb-3">
        <a href="/profile/info" class="list-group-item">profile</a>
    </div>

    <div class="list-group">
        <a <?php if(segment(2) != 'admin'): ?> href="/panel/admin" <?php endif; ?> class="list-group-item
        <?php echo segment(2) != 'admin' ?: 'active'; ?>">panel</a>

        <a <?php if(segment(2) != 'user'): ?> href="/panel/user/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2) != 'user' ?: 'active'; ?>">user</a>

        <a <?php if(segment(2) != 'category'): ?> href="/panel/category/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2) != 'category' ?: 'active'; ?>">category</a>

        <a <?php if(segment(2) != 'article/page'): ?> href="/panel/article/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2).'/'.segment(3) != 'article/page' ?: 'active'; ?>">article</a>

        <a <?php if(segment(2) != 'comment/page'): ?> href="/panel/comment/page/1" <?php endif; ?> class="list-group-item
        <?php echo segment(2).'/'.segment(3) != 'comment/page' ?: 'active'; ?>">comment</a>
    </div>
</div>
