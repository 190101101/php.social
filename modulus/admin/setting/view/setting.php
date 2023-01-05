<?php breadcump();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'setting_data',
        'page' => $data->page
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>setting</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>desc</th>
                    <th>key</th>
                    <th>value</th>
                    <th>type</th>
                    <th>show</th>
                    <th>update</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->setting as $setting): ?>
                <tr>
                    <td><?php echo $setting->setting_id; ?></td>
                    <td><?php echo substr($setting->setting_description, 0, 10); ?></td>
                    <td><?php echo substr($setting->setting_key, 0, 10); ?></td>
                    <td><?php echo substr($setting->setting_value, 0, 30); ?></td>
                    <td><?php echo substr($setting->setting_type, 0, 30); ?></td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/setting/show/<?php echo $setting->setting_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/panel/setting/update/<?php echo $setting->setting_id; ?>">update</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>desc</td>
                    <td>key</td>
                    <td>value</td>
                    <td>type</td>
                    <td>show</td>
                    <td>update</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'panel/setting/'); ?>
        </ul>
    </div>
</div>