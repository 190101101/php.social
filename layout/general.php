<?php $main = new core\controller; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $main->view('main', 'requires', 'main/meta'); ?>
        <?php $main->view('main', 'requires', 'main/css'); ?>
    </head>
    <body>
        <?php $main->view('main', 'requires', 'profile/navbar'); ?>
        <div class="container mt-3">
            <?php echo $data['VIEW']; ?>
        </div>
        <?php $main->view('main', 'requires', 'main/footer'); ?>
        <?php $main->view('main', 'requires', 'main/js'); ?>
    </body>
</html>