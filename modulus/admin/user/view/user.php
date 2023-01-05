<?php panel_breadcrumb($data->column, '/panel/user/search/key/value'); ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'user_data',
        'page' => $data->page
    ]); ?>  

    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <h2>user</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>login</th>
                    <th>email</th>
                    <th>status</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->user as $user): ?>
                <tr>
                    <td> 
                        <a class="text-warning" href="/panel/article/user/<?php echo $user->user_id; ?>/page/1">
                        <?php echo $user->user_id; ?>
                        </a>
                    </td>
                    <td> 
                        <a class="text-danger" href="/panel/comment/user/<?php echo $user->user_id; ?>/page/1">
                        @<?php echo $user->user_login; ?>
                        </a>
                    </td>
                    <td><?php echo $user->user_email; ?></td>
                    <td>
                        <label class="switch">
                        <input type="checkbox" class="data-get" 
                            data-get="/panel/user/status/<?php echo $user->user_id; ?>" 
                            <?php echo $user->user_status == 1 ? 'checked' : NULL; ?> > 
                        <span class="slider round"></span>
                        </label>
                    </td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/user/show/<?php echo $user->user_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/panel/user/update/<?php echo $user->user_id; ?>">update</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/user/delete/<?php echo $user->user_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>login</td>
                    <td>email</td>
                    <td>status</td>
                    <td>show</td>
                    <td>update</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'panel/user/'); ?>
        </ul>
    </div>
</div>