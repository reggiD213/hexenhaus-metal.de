<?php

class EventInsert extends Database {
	
	private $title;
	private $thumbnail;
	private $image;
	private $desc_short;
	private $desc_long;
	private $price;
	private $guests;
	private $date;
	private $time;
	private $newId;
	
	public function __construct() {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> assignVars();
			$this -> doInsert();
			$this -> doImages();
			$this -> updateImages();
			$this -> doRedirect();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
	}
	
	private function doImages() {
		$eventfolder = EVENTIMAGEPATH . DS . $this -> newId;

		if (!file_exists($eventfolder)) {
		    mkdir($eventfolder, 0777, true);
		}
		
		$name = $_FILES["image"]["name"];
		$ext = strtolower(end(explode(".", $name)));
		
		$uploadname = 'upload.' .$ext;
		$imagename = 'image.'. $ext;
		$thumbname = 'thumbnail.'. $ext;
		
		
		$this -> image = mysqli_real_escape_string($this -> db_connection, $imagename);
		$this -> thumbnail = mysqli_real_escape_string($this -> db_connection, $thumbname);
		
		$uploadfile = $eventfolder . DS . $uploadname;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
		
		$resize = new ResizeImage($uploadfile, $ext);
		$resize -> resizeImage(234, 234, 'landscape');
		$resize -> saveImage($eventfolder . DS . 'thumbnail', 90);
				
		$resize -> resizeImage(800, 800, 'landscape');
		$resize -> saveImage($eventfolder . DS . 'image', 90);
		
		unlink($uploadfile);
	}
	
	private function doInsert() {
		$sql = "INSERT INTO events
				(title, desc_short, desc_long, price, guests, date, time) 
				values
				('$this->title', '$this->desc_short', '$this->desc_long', '$this->price', '$this->guests', '$this->date', '$this->time')";

		$result = $this -> db_connection -> query($sql);

		$this -> newId = mysqli_insert_id($this -> db_connection);
	}
	
	private function updateImages() {		
		$sql = "UPDATE events SET
				thumbnail = '$this->thumbnail',
				image = '$this->image'
				WHERE event_id = '$this->newId'";
				
		$this->result = $this->db_connection->query($sql);
	}
	
	
	private function doRedirect() {
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-events' . DS . $this -> newId);
	}
	
}
