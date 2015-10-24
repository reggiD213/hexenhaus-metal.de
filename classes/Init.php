<?php

class Init {

	public function __construct() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			setlocale(LC_ALL,'');
		} else {
			setlocale(LC_ALL, 'de_DE.utf8');			
		}

		define('DS', '/');
		define('PS', PATH_SEPARATOR);
		define('BASEPATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/'));
		define('IMAGEPATH', 'images');
		define('BANDIMAGEPATH', IMAGEPATH . '/bands');
		define('EVENTIMAGEPATH', IMAGEPATH . '/events');
		define('UPLOADIMAGEPATH', IMAGEPATH . '/uploads');
		define('PERPAGE', 10);
		set_include_path('includes' . PS . 'pages' . PS . 'template');
		
	}

}
?>
