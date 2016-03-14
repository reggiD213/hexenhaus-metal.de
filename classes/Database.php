<?php

class Database {

	private $host;
	private $name;
	private $user;
	private $pass;

	protected $db_connection = null;

    protected function getConfig()
    {
        $env = $GLOBALS['ENV'];
        $this->host = $env['DB_HOST'];
        $this->name = $env['DB_DATABASE'];
        $this->user = $env['DB_USERNAME'];
        $this->pass = $env['DB_PASSWORD'];
    }

    protected function connect() {

        $this->getConfig();
		$this -> db_connection = new mysqli($this -> host, $this -> user, $this -> pass, $this -> name);

		//check connection
		if ($this -> db_connection -> connect_errno) {
			printf("Connect failed: %s\n", $this -> db_connection -> connect_error);
			exit();
		}
	}

}
