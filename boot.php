<?php 

/*vendor*/
require_once 'vendor/autoload.php';

/*boot*/
require_once 'boot/global.php';

require_once 'boot/define.php';

require_once 'boot/xcode.php';

require_once 'boot/init.php';

require_once 'boot/seo.php';

$routes = segment(1) == 'panel' ? 'admin' : 'main';
require_once "routes/{$routes}.php";

/*
require_once "routes/admin.php";
require_once "routes/main.php";
*/

