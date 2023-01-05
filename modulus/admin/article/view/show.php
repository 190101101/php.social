<?php panel_breadcrumb($data->column, '/panel/article/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $article = $data->article; ?>
        <div class="row">
            <div class="col-md-10">
                <h2>article show</h2>
            </div>
            <div class="col-md-1">
                <a href="/panel/article/update/<?php echo $article->article_id; ?>" class="btn btn-sm btn-warning">update</a>
            </div>
            <div class="col-md-1">
                <a class="btn btn-sm btn-success" href="/panel/article/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $article->article_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>key</label>
                    <input class="form-control" value="<?php echo $article->article_title; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>created</label>
                    <input type="text" class="form-control" value="<?php echo $article->article_created; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>updated</label>
                    <input type="text" class="form-control" value="<?php echo $article->article_updated; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>user</label>
                    <input type="text" class="form-control" value="<?php echo $article->user_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>view</label>
                    <input class="form-control" value="<?php echo $article->article_view; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <label>article text</label>
                <textarea type="text" rows="5" readonly class="form-control" placeholder="article text"><?php echo $article->article_text; ?></textarea>
            </div>
            <!--  -->
            <div class="col-md-12 mt-3">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/article/destroy/<?php echo $article->article_id; ?>">delete</a>
            </div>
            <!--  -->
        </div>
    </div>
</div>

