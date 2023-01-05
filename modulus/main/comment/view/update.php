<?php breadcump(); ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $comment = $data->comment; ?>
        <form action="/comment/update" method="POST">
            <div class="row">
                <div class="col-lg-10">
                    <h3>comment update</h3>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-sm btn-success" type="submit">update</button>
                    <a class="btn btn-sm btn-success" href="/comment/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>created</label>
                        <input class="form-control" value="<?php echo $comment->comment_created; ?>" required readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>updated</label>
                        <input type="text" class="form-control" value="<?php echo $comment->comment_updated; ?>" required readonly>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>comment text</label>
                    <textarea name="comment_text" rows="5" minlength="2" maxlength="500" type="text" class="form-control" placeholder="comment text" required><?php echo $comment->comment_text; ?></textarea>
                </div>

                <input name="comment_id" type="hidden" value="<?php echo $comment->comment_id; ?>" required readonly>
                <input name="article_id" type="hidden" value="<?php echo $comment->article_id; ?>" required readonly>
            </div>
        </form>
    </div>
</div>