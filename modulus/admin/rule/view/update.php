<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $rule = $data->rule; ?>
        <form action="/panel/rule/update" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>rule update</h2>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-success" type="submit">update</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/rule/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>id</label>
                        <input name="rule_id" class="form-control" value="<?php echo $rule->rule_id; ?>" readonly required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>created</label>
                        <input name="rule_created" class="form-control" value="<?php echo $rule->rule_created; ?>" readonly required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>text</label>
                        <textarea name="rule_text" class="form-control" rows="5" minlength="10" maxlength="1000" required><?php echo $rule->rule_text; ?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>