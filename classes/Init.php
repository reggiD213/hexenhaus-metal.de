<?php

class Init {

	public function __construct()
    {
        $this->setLocale();
        $this->defineConstants();
    }

    private function setLocale()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            setlocale(LC_ALL, '');
        } else {
            setlocale(LC_ALL, 'de_DE.utf8');
        }
    }

    private function defineConstants()
    {
        define('DS', '/');
        define('PS', PATH_SEPARATOR);
        define('BASEPATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/'));
        define('IMAGEPATH', 'images');
        define('BANDIMAGEPATH', IMAGEPATH . '/bands');
        define('EVENTIMAGEPATH', IMAGEPATH . '/events');
        define('UPLOADIMAGEPATH', IMAGEPATH . '/uploads');
        define('PERPAGE', 10);
    }

    public function parseEnv()
    {
        return parse_ini_file('.env');
    }

}
?>
