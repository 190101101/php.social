<?php panel_breadcrumb($data->column, '/panel/user/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <form action="/panel/user/create" method="POST">
            <div class="row">
                <div class="col-lg-10">
                    <h2>user create</h2>
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-sm btn-success" type="submit">create</button>
                </div>
                <div class="col-lg-1">
                    <a class="btn btn-sm btn-success" href="/panel/user/page/1">back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>email</label>
                        <input name="user_email" type="text" class="form-control" placeholder="user email" required>
                    </div>
                    <div class="form-group">
                        <label>login</label>
                        <input name="user_login" type="text" class="form-control" placeholder="user login" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>gender</label>
                        <select class="form-control" name="user_gender" required>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>password</label>
                        <input name="user_password" type="text" class="form-control" placeholder="user password" required>
                    </div>
                    <div class="form-group">
                        <label>confirm password</label>
                        <input name="confirm_password" type="text" class="form-control" placeholder="confirm password" required>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>