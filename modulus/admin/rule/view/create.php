<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <form action="/panel/rule/create" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>rule create</h2>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-success" type="submit">create</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/rule/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>created</label>
                        <input name="rule_created" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>text</label>
                        <textarea name="rule_text" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>