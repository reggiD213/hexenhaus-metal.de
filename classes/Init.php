<?php

class Init {

	public function __construct() {
      setlocale(LC_ALL, 'de_DE.utf8');

		define('DS', '/');
		define('PS', PATH_SEPARATOR);
		define('IMAGEPATH', 'images');
		define('BANDIMAGEPATH', IMAGEPATH . DS . 'bands');
		define('EVENTIMAGEPATH', IMAGEPATH . DS . 'events');
		define('UPLOADIMAGEPATH', IMAGEPATH . DS . 'uploads');
		define('PERPAGE', 10);
		set_include_path('includes' . PS . 'pages' . PS . 'template');
		
	}

}
?>
