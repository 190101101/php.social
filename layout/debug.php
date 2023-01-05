<?php $main = new core\controller; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $main->view('main', 'requires', 'debug/css'); ?>
    </head>
    <body>
        <?php echo $data['VIEW']; ?>
    </body>
</html>