<?php breadcump(); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar', (object) [
        'data' => 'page_data',
        'page' => $data->page
    ]); ?>  
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <h3>article</h3>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>text</th>
                    <th>created</th>
                    <th>comment</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->article as $article): ?>
                <tr>
                    <td><?php echo $article->article_id; ?></td>
                    <td>
                        <a href="/article/read/<?php echo $article->article_id; ?>/page/1" class="<?php echo !$article->article_deleted ?: 'text-warning'; ?>">
                        #<?php echo $article->article_title; ?>
                        </a>
                    </td>
                    <td><?php echo substr($article->article_text, 0, 10); ?></td>
                    <td><?php echo date_ymd($article->article_created); ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="/comment/user/article/<?php echo $article->article_id; ?>/page/1">
                            comment <?php echo $article->comment_count; ?>
                        </a>
                    </td>
                    <td><a class="btn btn-sm btn-success"
                        href="/article/show/<?php echo $article->article_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/article/update/<?php echo $article->article_id; ?>">update</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/article/delete/<?php echo $article->article_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>title</td>
                    <td>text</td>
                    <td>created</td>
                    <td>comment</td>
                    <td>show</td>
                    <td>update</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'article/'); ?>
        </ul>
    </div>
</div>