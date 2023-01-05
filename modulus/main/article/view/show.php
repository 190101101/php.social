<?php breadcump(); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar', []); ?>  
    
    <div class="col-md-9">
        <?php $article = $data->article; ?>
        <div class="row">
            <div class="col-md-10">
                <h2>article show</h2>
            </div>
            <div class="col-md-2">
                <a href="/article/update/<?php echo $article->article_id; ?>" class="btn btn-sm btn-warning">update</a>
                <a class="btn btn-sm btn-success" href="/article/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $article->article_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>title</label>
                    <input class="form-control" value="<?php echo $article->article_title; ?>" readonly>
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>type</label>
                    <input class="form-control" value="<?php echo $article->article_type ? 'public' : 'draft'; ?>" readonly>
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
            <div class="col-md-12">
                <label>article text</label>
                <textarea type="text" rows="7" readonly class="form-control" placeholder="article text"><?php echo $article->article_text; ?></textarea>
            </div>
        </div>
    </div>
</div>