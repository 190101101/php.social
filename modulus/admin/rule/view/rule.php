<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'rule_data',
        'page' => $data->page
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>rule</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>text</th>
                    <th>created</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->rule as $rule): ?>
                <tr>
                    <td><?php echo $rule->rule_id; ?></td>
                    <td><?php echo substr($rule->rule_text, 0, 30); ?></td>
                    <td><?php echo date_ymd($rule->rule_created); ?></td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/rule/show/<?php echo $rule->rule_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/panel/rule/update/<?php echo $rule->rule_id; ?>">update</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/rule/delete/<?php echo $rule->rule_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>text</td>
                    <td>created</td>
                    <td>show</td>
                    <td>update</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'panel/rule/'); ?>
        </ul>
    </div>
</div>