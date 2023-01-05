<?php breadcump();  ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <form action="/panel/setting/create" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>setting create</h2>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-success" type="submit">create</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/setting/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>created</label>
                        <input name="setting_created" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>text</label>
                        <textarea name="setting_text" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>