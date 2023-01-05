<?php panel_breadcrumb($data->column, '/panel/comment/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <form action="/panel/comment/create" method="POST">
            <div class="row">
                <div class="col-lg-10">
                    <h2>comment create</h2>
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-sm btn-success" type="submit">create</button>
                </div>
                <div class="col-lg-1">
                    <a class="btn btn-sm btn-success" href="/panel/comment/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>created</label>
                        <input name="comment_created" type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>updated</label>
                        <input name="comment_updated" type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>user id</label>
                        <input name="user_id" type="number" class="form-control" value="<?php echo User::user_id(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>article id</label>
                        <input name="article_id" type="number" class="form-control" placeholder="article id" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>comment text</label>
                    <textarea name="comment_text" rows="5" minlength="2" maxlength="500" type="text" class="form-control" placeholder="comment text" required></textarea>
                </div>
            </div>
        </form>
    </div>
</div>