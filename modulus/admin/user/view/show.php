<?php panel_breadcrumb($data->column, '/panel/user/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $user = $data->user; ?>
        <div class="row">
            <div class="col-lg-10">
                <h2>user show</h2>
            </div>
            <div class="col-lg-2">
                <a href="/panel/user/update/<?php echo $user->user_id; ?>" class="btn btn-sm btn-warning">update</a>
                <a class="btn btn-sm btn-success" href="/panel/user/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $user->user_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input class="form-control" value="<?php echo $user->user_email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>login</label>
                    <input class="form-control" value="<?php echo $user->user_login; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>gender</label>
                    <input value="<?php echo $user->user_gender; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>ip</label>
                    <input type="text" class="form-control" value="<?php echo $user->user_ip; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>password</label>
                    <input class="form-control" value="<?php echo $user->user_password; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>confirm password</label>
                    <input class="form-control" value="<?php echo $user->user_password; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>created</label>
                    <input type="text" class="form-control" value="<?php echo $user->user_created; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>updated</label>
                    <input type="text" class="form-control" value="<?php echo $user->user_updated; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>last updated</label>
                    <input type="text" class="form-control" value="<?php echo $user->last_updated; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-12">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/user/destroy/<?php echo $user->user_id; ?>">delete</a>
            </div>
        </div>
    </div>
</div>