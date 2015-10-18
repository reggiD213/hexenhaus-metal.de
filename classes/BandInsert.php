<?php

class BandInsert extends Database {
	
	private $name;
	private $thumbnail;
	private $desc;
	private $link;
	private $soundcloud;
	
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
		if ($_FILES['thumbnail']['name'] != null) {
			$this -> doThumbnail();
		}
		if (strlen($this -> soundcloud) > 8) {
			$this -> doSoundcloud();
		}
	}
	
	private function doThumbnail() {
		$now = strftime("%Y_%m_%d",time());
		
		$name = $_FILES["thumbnail"]["name"];
		$ext = end(explode(".", $name));
		
		$newname = $now . $this -> name . '.' . $ext;
		
		$this -> thumbnail = mysqli_real_escape_string($this -> db_connection, $newname);
		
		$uploadfile = BANDIMAGEPATH . DS . $newname;
		move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadfile);	
	}
	
	private function doInsert() {		
		$sql = "INSERT INTO bands
				(name, thumbnail, `desc`, link, soundcloud) 
				values
				('$this->name', '$this->thumbnail', '$this->desc', '$this->link', '$this->soundcloud')";

		$result = $this->db_connection->query($sql);
		
		$newId = mysqli_insert_id($this->db_connection);
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-bands' . DS . $newId);
	}

	private function doSoundcloud() {
		$firstCut = strstr($this -> soundcloud, '/users/');
		
		$this -> soundcloud = substr($firstCut, 7, 8); 
	}
	
}
