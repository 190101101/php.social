<?php 

	session_start();
	
	ob_start();
	
	ini_set('display_errors', DEBUG);
	
	ini_set('error_reporting', E_ALL);

	date_default_timezone_set('Asia/Baku');

	Guest::run();

?>