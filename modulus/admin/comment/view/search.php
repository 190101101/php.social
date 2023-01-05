<?php panel_breadcrumb($data->column, '/panel/comment/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'page_data',
        'page' => $data->page,
        'search' => $data->search
        
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>comment search for: <?php echo segment(6); ?></h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>text</th>
                    <th>created</th>
                    <th>article</th>
                    <th>user</th>
                    <th>status</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->comment as $comment): ?>
                <tr>
                    <td><?php echo $comment->comment_id; ?></td>
                    <td><?php echo substr($comment->comment_text, 0, 20); ?></td>
                    <td><?php echo date_ymd($comment->comment_created); ?></td>
                    <td>
                        <a href="/panel/comment/article/<?php echo $comment->article_id; ?>/page/1">
                        #<?php echo $comment->article_title; ?>
                        </a>
                    </td>
                    <td>
                        <a href="/panel/article/user/<?php echo $comment->user_id; ?>/page/1">
                        @<?php echo $comment->user_login; ?>
                        </a>
                    </td>
                    <td>
                        <label class="switch">
                        <input type="checkbox" class="data-get" 
                            data-get="/panel/comment/status/<?php echo $comment->comment_id; ?>" 
                            <?php echo $comment->comment_status == 1 ? 'checked' : NULL; ?> > 
                        <span class="slider round"></span>
                        </label>
                    </td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/comment/show/<?php echo $comment->comment_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/panel/comment/update/<?php echo $comment->comment_id; ?>">update</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/comment/delete/<?php echo $comment->comment_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>text</td>
                    <td>created</td>
                    <td>article</td>
                    <td>user</td>
                    <td>status</td>
                    <td>show</td>
                    <td>update</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, breadcump_search()); ?>
        </ul>
    </div>
</div>