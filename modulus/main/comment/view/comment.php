<?php breadcump(); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar', (object) [
        'data' => 'page_data',
        'page' => $data->page
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <h2>comment</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>text</th>
                    <th>created</th>
                    <th>article</th>
                    <th>show</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->comment as $comment): ?>
                <tr>
                    <td><?php echo $comment->comment_id; ?></td>
                    <td><?php echo substr($comment->comment_text, 0, 20); ?></td>
                    <td><?php echo date_ymd($comment->comment_created); ?></td>
                    <td>
                        <a href="/article/read/<?php echo $comment->article_id; ?>/page/1">
                            #<?php echo $comment->article_title; ?>
                        </a>
                    </td>
                    <td><a class="btn btn-sm btn-success"
                        href="/comment/own/show/<?php echo $comment->comment_id; ?>">show</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>text</td>
                    <td>created</td>
                    <td>article</td>
                    <td>show</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'comment/'); ?>
        </ul>
    </div>
</div>