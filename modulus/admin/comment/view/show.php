<?php panel_breadcrumb($data->column, '/panel/comment/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $comment = $data->comment; ?>
        <div class="row">
            <div class="col-md-10">
                <h2>comment show</h2>
            </div>
            <div class="col-md-1">
                <a href="/panel/comment/update/<?php echo $comment->comment_id; ?>" class="btn btn-sm btn-warning">update</a>
            </div>
            <div class="col-md-1">
                <a class="btn btn-sm btn-success" href="/panel/comment/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $comment->comment_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>status</label>
                    <input type="text" class="form-control" value="<?php echo $comment->comment_status; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>created</label>
                    <input type="text" class="form-control" value="<?php echo $comment->comment_created; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>updated</label>
                    <input type="text" class="form-control" value="<?php echo $comment->comment_updated; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>article</label>
                    <input type="text" class="form-control" value="<?php echo $comment->article_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>user</label>
                    <input type="text" class="form-control" value="<?php echo $comment->user_id; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <label>comment text</label>
                <textarea type="text" rows="5" readonly class="form-control" placeholder="comment text"><?php echo $comment->comment_text; ?></textarea>
            </div>
            <div class="col-md-12 mt-3">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/comment/destroy/<?php echo $comment->comment_id; ?>">delete</a>
            </div>
        </div>
    </div>
</div>