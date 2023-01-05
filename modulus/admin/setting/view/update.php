<?php breadcump();  ?>

<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $setting = $data->setting; ?>
        <form action="/panel/setting/update" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <h2>setting update</h2>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-sm btn-success">update</button>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-success" href="/panel/setting/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>id</label>
                        <input name="setting_id" class="form-control" value="<?php echo $setting->setting_id; ?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input name="setting_description" class="form-control" value="<?php echo $setting->setting_description; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>key</label>
                        <input name="setting_key" class="form-control" value="<?php echo $setting->setting_key; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>type</label>
                        <select class="form-control" name="setting_type" required>
                            <option value="<?php echo $setting->setting_type; ?>">
                                <?php echo $setting->setting_type; ?>
                            </option>
                            <option value="text">text</option>
                            <option value="textarea">textarea</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>updated</label>
                        <input class="form-control" value="<?php echo $setting->setting_updated; ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>text</label>
                        <?php if($setting->setting_type == 'textarea'): ?>
                        <textarea name="setting_value" type="text" class="form-control" rows="5" required><?php echo $setting->setting_value; ?></textarea>
                        <?php elseif($setting->setting_type == 'text'): ?>
                        <input name="setting_value" type="text" class="form-control" value="<?php echo $setting->setting_value; ?>" required>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>