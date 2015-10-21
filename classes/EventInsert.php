<?php

class EventInsert extends Database {
	
	private $title;
	private $thumbnail;
	private $desc_short;
	private $desc_long;
	private $price;
	private $guests;
	private $date;
	private $time;
	
	
	public function __construct() {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> assignVars();
			$this -> doInsert();
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
		if ($_FILES['thumbnail']['name'] != null) {
			$this -> doThumbnail();
		}
	}
	
	private function doThumbnail() {
		$time = $this -> date;
		$eventfolder = EVENTIMAGEPATH . DS . $time;

		if (!file_exists($eventfolder)) {
		    mkdir($eventfolder, 0777, true);
		}
		
		$name = $_FILES["thumbnail"]["name"];
		$ext = end(explode(".", $name));
		
		$newname = 'thumbnail.'. $ext;
		
		$this -> thumbnail = mysqli_real_escape_string($this -> db_connection, $newname);
		
		$uploadfile = $eventfolder . DS . $newname;
		
		move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadfile);
	}
	
	private function doInsert() {
		$sql = "INSERT INTO events
				(title, thumbnail, desc_short, desc_long, price, guests, date, time) 
				values
				('$this->title', '$this->thumbnail', '$this->desc_short', '$this->desc_long', '$this->price', '$this->guests', '$this->date', '$this->time')";

		$result = $this -> db_connection -> query($sql);
		
		$newId = mysqli_insert_id($this -> db_connection);
		
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-events' . DS . $newId);
	}
	
}
