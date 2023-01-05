<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $rule = $data->rule; ?>
        <div class="row">
            <div class="col-md-10">
                <h2>rule show</h2>
            </div>
            <div class="col-md-1">
                <a href="/panel/rule/update/<?php echo $rule->rule_id; ?>" class="btn btn-sm btn-warning">update</a>
            </div>
            <div class="col-md-1">
                <a class="btn btn-sm btn-success" href="/panel/rule/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $rule->rule_id; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>created</label>
                    <input class="form-control" value="<?php echo $rule->rule_created; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>text</label>
                    <textarea class="form-control" rows="5" readonly><?php echo $rule->rule_text; ?></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/rule/destroy/<?php echo $rule->rule_id; ?>">delete</a>
            </div>
        </div>
    </div>
</div>