<h1 class="mt-4 mb-3">
    <small>sign in / sign up</small>
</h1>
<?php breadcump();  ?>
<div class="row">
    <div class="col-lg-6 mb-4">
        <h3>sign in</h3>
        <form action="/signin" method="POST">
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="user_email" required
                        <?php if(UserCookie::user_password()): ?>
                        value="<?php echo UserCookie::user_email(); ?>" 
                        <?php else: ?>
                        placeholder="email" 
                        <?php endif; ?>
                        <?php if(old::user_email()): ?>
                        value="<?php echo old::user_email(); ?>" 
                        <?php else: ?>
                        placeholder="email" 
                        <?php endif; ?>
                        >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="user_password" 
                        <?php if(UserCookie::user_password()): ?>
                        value="<?php echo UserCookie::user_password(); ?>" 
                        <?php else: ?>
                        placeholder="password" 
                        <?php endif; ?>
                        required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">sign in</button>
        </form>
    </div>
    <!-- ------- -->
    <div class="col-lg-6 mb-4">
        <h3>sign up</h3>
        <form action="/signup" method="POST">
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="user_email" required
                        <?php if(old::user_email()): ?>
                        value="<?php echo old::user_email(); ?>" 
                        <?php else: ?>
                        placeholder="email" 
                        <?php endif; ?>
                        >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="user_login" required
                        <?php if(old::user_login()): ?>
                        value="<?php echo old::user_login(); ?>" 
                        <?php else: ?>
                        placeholder="login" 
                        <?php endif; ?>
                        >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="user_password" required placeholder="password">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <input type="text" class="form-control" name="confirm_password" required placeholder="password" >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <select class="form-control" name="user_gender" required>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">sign up</button>
        </form>
    </div>
</div>