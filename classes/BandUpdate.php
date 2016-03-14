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
			if ($_FILES['thumbnail']['name'] != null) {
				$this -> doThumbnail();
				$this -> updateThumbnail();
			}
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
		if (strlen($this -> soundcloud) > 10) {
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
	
		private function updateThumbnail() {		
		$sql = "UPDATE bands SET
				thumbnail = '$this->thumbnail'
				WHERE band_id = '$this->band_id'";
				
		$this->result = $this->db_connection->query($sql);
	}
	
	private function doSoundcloud() {
		//removes everything behind "/users/"
		$firstCut = strstr($this -> soundcloud, '/users/');
		$this -> soundcloud = substr($firstCut, 7); 
		
		//remove everything from '&' leaving only the number behind
		$this->soundcloud = strstr($this->soundcloud, '&', true);
	}
	
}