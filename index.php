<?php
error_reporting(0);

//autoloading
require_once ('classes/Autoloader.php');
spl_autoload_register('Autoloader::ClassLoader');

// sets constants and paths, load config
$init = new Init();

$GLOBALS['ENV'] = $init->parseEnv();

$url = new Url();

$page = $url -> getPage();

require_once 'template/overall-header.tpl.php';

if (file_exists('pages/' . $page . '.php')) {
	require_once ('pages/'. $page . '.php');
} else {
	require_once 'pages/error.php';
}

require_once 'template/overall-footer.tpl.php';
