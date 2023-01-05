<?php panel_breadcrumb($data->column, '/panel/user/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $user = $data->user; ?>
        <form action="/panel/user/update" method="POST">
            <div class="row">
                <div class="col-lg-10">
                    <h2>user update</h2>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-sm btn-success" type="submit">update</button>
                    <a class="btn btn-sm btn-success" href="/panel/user/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>id</label>
                        <input name="user_id" type="number" class="form-control" value="<?php echo $user->user_id; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input name="user_email" type="email" class="form-control" value="<?php echo $user->user_email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>login</label>
                        <input name="user_login" type="text" class="form-control" value="<?php echo $user->user_login; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>gender</label>
                        <select class="form-control" name="user_gender" required>
                            <option value="<?php echo $user->user_gender; ?>" selected><?php echo $user->user_gender; ?></option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ip</label>
                        <input name="user_ip" type="text" class="form-control" value="<?php echo $user->user_ip; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>password</label>
                        <input name="user_password" class="form-control" value="<?php echo $user->user_password; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>confirm password</label>
                        <input name="confirm_password" class="form-control" value="<?php echo $user->user_password; ?>" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>created</label>
                        <input class="form-control" value="<?php echo $user->user_created; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>updated</label>
                        <input name="user_updated" text="text" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>last updated</label>
                        <input class="form-control" value="<?php echo $user->last_updated; ?>" required readonly>
                    </div>
                </div>
        </form>
        </div>
    </div>
</div>