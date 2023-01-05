<?php breadcump();  ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $setting = $data->setting; ?>
        <div class="row">
            <div class="col-md-10">
                <h2>setting show</h2>
            </div>
            <div class="col-md-1">
                <a href="/panel/setting/update/<?php echo $setting->setting_id; ?>" 
                    class="btn btn-sm btn-warning">update</a>
            </div>
            <div class="col-md-1">
                <a class="btn btn-sm btn-success" href="/panel/setting/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $setting->setting_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>description</label>
                    <input class="form-control" value="<?php echo $setting->setting_description; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>key</label>
                    <input class="form-control" value="<?php echo $setting->setting_key; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>type</label>
                    <input class="form-control" value="<?php echo $setting->setting_type; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>updated</label>
                    <input class="form-control" value="<?php echo $setting->setting_updated; ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>text</label>
                    <?php if($setting->setting_type == 'textarea'): ?>
                    <textarea type="text" class="form-control" rows="5" readonly><?php echo $setting->setting_value; ?></textarea>
                    <?php elseif($setting->setting_type == 'text'): ?>
                    <input type="text" class="form-control" value="<?php echo $setting->setting_value; ?>" readonly>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>