<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', (object) [
        'data' => 'faq_data',
        'page' => $data->page
        ]); ?>  
    <div class="col-lg-9">
        <div class="row">
            <div class="col-md-6">
                <h2>faq</h2>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>text</th>
                    <th>sub text</th>
                    <th>created</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->faq as $faq): ?>
                <tr>
                    <td><?php echo $faq->faq_id; ?></td>
                    <td><?php echo substr($faq->faq_text, 0, 20); ?></td>
                    <td><?php echo substr($faq->faq_subtext, 0, 30); ?></td>
                    <td><?php echo date_ymd($faq->faq_created); ?></td>
                    <td><a class="btn btn-sm btn-success"
                        href="/panel/faq/show/<?php echo $faq->faq_id; ?>">show</a></td>
                    <td><a class="btn btn-sm btn-warning"
                        href="/panel/faq/update/<?php echo $faq->faq_id; ?>">update</a></td>
                    <td><a class="btn btn-sm btn-danger data-del"
                        data-get="/panel/faq/delete/<?php echo $faq->faq_id; ?>">delete</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>id</td>
                    <td>text</td>
                    <td>sub text</td>
                    <td>created</td>
                    <td>show</td>
                    <td>update</td>
                    <td>delete</td>
                </tr>
            </tfoot>
        </table>
        <ul class="pagination justify-content-center">
            <?php pagination::selector($data->page, 'panel/faq/'); ?>
        </ul>
    </div>
</div>