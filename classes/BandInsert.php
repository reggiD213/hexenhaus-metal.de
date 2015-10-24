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
			$this -> doThumbnail();
			$this -> updateThumbnail();
			$this -> doRedirect();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this->db_connection,$_POST[$key]);	
		}
		if (strlen($this -> soundcloud) > 8) {
			$this -> doSoundcloud();
		}
	}
	
	private function doThumbnail() {
		$name = $_FILES["thumbnail"]["name"];
		$ext = strtolower(end(explode(".", $name)));
		
		$uploadname = 'upload.' . $ext;
		$thumbname = $this -> name . '.' . $ext;
		
		$this -> thumbnail = mysqli_real_escape_string($this -> db_connection, $thumbname);
		
		$uploadfile = BANDIMAGEPATH . DS . $uploadname;
		move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadfile);
		
		$resize = new ResizeImage($uploadfile, $ext);
		$resize -> resizeImage(234, 234, 'landscape');
		$resize -> saveImage(BANDIMAGEPATH . DS . $this -> name, 90);
		
		unlink($uploadfile);
	}

	private function doInsert() {		
		$sql = "INSERT INTO bands
				(name, `desc`, link, soundcloud) 
				values
				('$this->name', '$this->desc', '$this->link', '$this->soundcloud')";

		$result = $this->db_connection->query($sql);
		
		$this -> newId = mysqli_insert_id($this->db_connection);
		
	}
	
	private function updateThumbnail() {		
		$sql = "UPDATE bands SET
				thumbnail = '$this->thumbnail'
				WHERE band_id = '$this->newId'";
				echo "check";
		$this->result = $this->db_connection->query($sql);
	}

	private function doSoundcloud() {
		$firstCut = strstr($this -> soundcloud, '/users/');
		
		$this -> soundcloud = substr($firstCut, 7, 8); 
	}
	
	private function doRedirect() {
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-bands' . DS . $this -> newId);
	}
	
}
