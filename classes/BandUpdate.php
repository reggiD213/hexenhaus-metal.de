<?php

class BandUpdate extends Database {
	
	private $band_id;
	private $name;
	private $thumbnail;
	private $desc;
	private $link;
	private $soundcloud;
	
	public function __construct($bandId) {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> band_id = $bandId;
			$this -> assignVars();
			$this -> doUpdate();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
		if ($_FILES['thumbnail']['name'] != null) {
			$this -> doThumbnail();
		}
		if (strlen($this -> soundcloud) > 8) {
			$this -> doSoundcloud();
		}
	}
	
	private function doUpdate() {
		$sql = "UPDATE bands SET
				name = '$this->name',";
		if ($this -> thumbnail != null) {
			$sql .=	"thumbnail = '$this->thumbnail',";
		}
		$sql .= "`desc` = '$this->desc',
				link = '$this->link',
				soundcloud = '$this->soundcloud'
				WHERE band_id = '$this->band_id'";
		
		$result = $this->db_connection->query($sql) or die(mysqli_error($this -> db_connection));
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
	
	private function doSoundcloud() {
		$firstCut = strstr($this -> soundcloud, '/users/');
		
		$this -> soundcloud = substr($firstCut, 7, 8); 
	}
	
}
