<?php

class Database {

	private $host = "localhost";
	private $name = "hexenhaus";
	private $user = "homepage";
	private $pass = "605635a05eabeaed5679c7aa6b522050";
	protected $db_connection = null;

	protected function connect() {
		$this -> db_connection = new mysqli($this -> host, $this -> user, $this -> pass, $this -> name);

		//check connection
		if ($this -> db_connection -> connect_errno) {
			printf("Connect failed: %s\n", $this -> db_connection -> connect_error);
			exit();
		}
	}

}
