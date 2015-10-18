<?php

class EventUpdate extends Database {
	
	private $event_id;
	private $title;
	private $thumbnail;
	private $desc_short;
	private $desc_long;
	private $price;
	private $guests;
	private $date;
	
	public function __construct($eventId) {
		if (isset($_POST['action'])) {
			$this -> connect();
			$this -> event_id = $eventId;
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
	}
	
	private function doThumbnail() {
		$time = $this -> date;
		$time = strtotime($time);
		$eventfolder = EVENTIMAGEPATH . DS . strftime("%Y_%m_%d",$time);

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
		
	private function doUpdate() {		
		$sql = "UPDATE events SET
				title = '$this->title',";
		if ($this -> thumbnail != null) {
			$sql .=	"thumbnail = '$this->thumbnail',"; }
		$sql .= "desc_short = '$this->desc_short',
				desc_long = '$this->desc_long',
				price = '$this->price',
				guests = '$this->guests',
				date = '$this->date'
				WHERE event_id = '$this->event_id'";
				
		$this->result = $this->db_connection->query($sql);
	}

}
