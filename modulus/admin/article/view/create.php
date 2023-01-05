<?php panel_breadcrumb($data->column, '/panel/article/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-md-9">
        <form action="/panel/article/create" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>article show</h2>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-success" type="submit">create</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/article/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>title</label>
                        <input name="article_title" class="form-control" type="text" minlength="3" maxlength="20" placeholder="title" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>user id</label>
                        <input name="user_id" type="number" class="form-control" value="<?php echo User::user_id(); ?>" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <label>article text</label>
                    <textarea name="article_text" rows="5" minlength="100" maxlength="500" type="text" class="form-control" placeholder="article text" required></textarea>
                </div>

            </div>
        </form>
    </div>
</div>


