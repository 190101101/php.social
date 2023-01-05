<?php panel_breadcrumb($data->column, '/panel/contact/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'page_data',
        'page' => $data->page
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>contact</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>theme</th>
                    <th>email</th>
                    <th>message</th>
                    <th>show</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->contact as $contact): ?>
                <tr>
                    <td><?php echo $contact->contact_id; ?></td>
                    <td><?php echo $contact->contact_theme; ?></td>
                    <td><?php echo $contact->contact_email; ?></td>
                    <td><?php echo substr($contact->contact_message, 0, 20); ?></td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/contact/show/<?php echo $contact->contact_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/contact/delete/<?php echo $contact->contact_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>theme</td>
                    <td>email</td>
                    <td>message</td>
                    <td>show</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, breadcump_search()); ?>
        </ul>
    </div>
</div>