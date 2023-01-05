<?php panel_breadcrumb($data->column, '/panel/comment/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $comment = $data->comment; ?>
        <form action="/panel/comment/update" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>comment update</h2>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-success" type="submit">update</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/comment/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>id</label>
                        <input name="comment_id" class="form-control" type="text" value="<?php echo $comment->comment_id; ?>"  required readonly>
                    </div>
                    <div class="form-group">
                        <label>status</label>
                        <input name="comment_status" class="form-control" type="text" value="<?php echo $comment->comment_status; ?>"  required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>article id</label>
                        <input name="article_id" type="text" class="form-control" value="<?php echo $comment->article_id; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>user id</label>
                        <input name="user_id" type="number" class="form-control" value="<?php echo $comment->user_id; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>created</label>
                        <input type="text" class="form-control" value="<?php echo $comment->comment_created; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>updated</label>
                        <input name="comment_updated" type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <label>comment text</label>
                    <textarea name="comment_text" rows="5" minlength="2" maxlength="500" type="text" class="form-control" placeholder="comment text" required><?php echo $comment->comment_text; ?></textarea>
                </div>
            </div>
        </form>
    </div>
</div>