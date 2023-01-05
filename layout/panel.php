<?php $main = new core\controller; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $main->view('admin', 'requires', 'admin/meta'); ?>
        <?php $main->view('admin', 'requires', 'admin/css'); ?>
    </head>
    <body>
        <?php $main->view('admin', 'requires', 'admin/navbar'); ?>
        <div class="container mt-3">
            <?php echo $data['VIEW']; ?>
        </div>
        <?php $main->view('admin', 'requires', 'admin/footer'); ?>
        <?php $main->view('admin', 'requires', 'admin/js'); ?>
    </body>
</html>