<?php panel_breadcrumb($data->column, '/panel/guest/search/key/value'); ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $guest = $data->guest; ?>
        <div class="row">
            <div class="col-md-11">
                <h2>guest show</h2>
            </div>
            <div class="col-md-1">
                <a class="btn btn-sm btn-success" href="/panel/guest/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $guest->guest_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>ip</label>
                    <input class="form-control" value="<?php echo $guest->guest_ip; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>created</label>
                    <input class="form-control" value="<?php echo $guest->guest_created; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>visit</label>
                    <input class="form-control" value="<?php echo date('Y-m-d H:i:s', $guest->guest_visit); ?>" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/guest/destroy/<?php echo $guest->guest_id; ?>">delete</a>
            </div>
        </div>
    </div>
</div>