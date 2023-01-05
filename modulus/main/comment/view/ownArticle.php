<?php breadcump(); ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar', (object) [
        'data' => 'article',
        'article' => $data->article,
        ]); ?>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <h3>sənə gələnlər</h3>
            </div>

            <div class="col-lg-12">
            <?php foreach($data->comment as $comment): ?>
                <div class="media">
                    <div class="media-body">
                        <div class="d-flex justify-content-between">
                            <span class="text-danger" style="font-size: 20px;">@<?php echo $comment->user_login; ?></span>
                            <span><?php echo date_dy($comment->comment_created); ?> / <?php echo $comment->user_gender; ?></span>
                        </div>
                        <?php echo $comment->comment_text; ?>
                    </div>
                </div>
                <hr>
                
            <?php endforeach; ?>
            </div>
        </div>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, "comment/user/article/{$data->id}/"); ?>
        </ul>
    </div>
</div>
