<?php
error_reporting(0);

//autoloading
require_once ('classes' . DIRECTORY_SEPARATOR . 'Autoloader.php');
spl_autoload_register('Autoloader::ClassLoader');

// sets constants and paths
$init = new Init();

$url = new Url();

$page = $url -> getPage();

require_once 'overall-header.tpl.php';

if (file_exists('pages' . DS . $page . '.php')) {
	require_once ($page . '.php');
} else {
	require_once 'error.php';
}

require_once 'overall-footer.tpl.php';
