<?php

class PicInsert extends Database {
	
	private $name;
	private $filename;
	
	public function __construct() {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> assignVars();
			$this -> doInsert();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this->db_connection,$_POST[$key]);	
		}
		if ($_FILES['image']['name'] != null) {
			$this -> doImage();
		}
	}
	
	private function doImage() {
		$now = time();
		
		$name = $_FILES["image"]["name"];
		$ext = end(explode(".", $name));
		
		$newname = $now . $this -> name . '.' . $ext;
		
		$this -> filename = mysqli_real_escape_string($this -> db_connection, $newname);
		
		$uploadfile = UPLOADIMAGEPATH . DS . $newname;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
	}
	
	private function doInsert() {		
		$sql = "INSERT INTO pics
				(name, filename) 
				values
				('$this->name', '$this->filename')";

		$result = $this->db_connection->query($sql);
		
		$newId = mysqli_insert_id($this->db_connection);
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-pics' . DS . $newId);
	}
	
}
