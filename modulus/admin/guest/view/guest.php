<?php panel_breadcrumb($data->column, '/panel/guest/search/key/value'); ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'guest_data',
        'page' => $data->page
    ]); ?>  

    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>guest</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ip</th>
                    <th>visit</th>
                    <th>created</th>
                    <th>show</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->guest as $guest): ?>
                <tr>
                    <td><?php echo $guest->guest_id; ?></td>
                    <td><?php echo $guest->guest_ip; ?></td>
                    <td>
                        <span class="text-<?php echo $guest->guest_visit > time() ? 'success' : 'warning'; ?>">
                            <?php echo date('Y-m-d H:i:s', $guest->guest_visit); ?>
                        </span>
                    </td>
                    <td><?php echo $guest->guest_created; ?></td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/guest/show/<?php echo $guest->guest_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/guest/delete/<?php echo $guest->guest_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>ip</td>
                    <td>visit</td>
                    <td>created</td>
                    <td>show</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'panel/guest/'); ?>
        </ul>
    </div>
</div>