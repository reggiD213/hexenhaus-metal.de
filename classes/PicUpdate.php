<?php

class PicUpdate extends Database {
	
	private $pic_id;
	private $name;
	private $filename;
	
	public function __construct($picId) {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> pic_id = $picId;
			$this -> assignVars();
			$this -> doUpdate();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
		if ($_FILES['image']['name'] != null) {
			$this -> doImage();
		}
	}
	
	private function doUpdate() {		
		$sql = "UPDATE pics SET
				name = '$this->name'";
		if ($this -> filename != null) {
			$sql .=	", filename = '$this->filename'";
		}
		$sql .= "WHERE pic_id = '$this->pic_id'";
						
		$result = $this->db_connection->query($sql) or die(mysqli_error($this -> db_connection));
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
}
