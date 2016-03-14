<?php

class EventUpdate extends Database {
	
	private $event_id;
	private $title;
	private $thumbnail;
	private $image;
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
			if ($_FILES['image']['name'] != null) {
				$this -> doImages();
				$this -> updateImages();
				//$this -> doImage();
				//$this -> doThumbnail();
			}
		}
	}
		
	private function assignVars() {
		foreach ($_POST as $key => $value) {
			$this -> {$key} = mysqli_real_escape_string($this -> db_connection, $_POST[$key]);	
		}
	}

	private function doImages() {
		$eventfolder = EVENTIMAGEPATH . DS . $this -> event_id;
		
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

	private function doUpdate() {
		$sql = "UPDATE events SET
				title = '$this->title',
				desc_short = '$this->desc_short',
				desc_long = '$this->desc_long',
				price = '$this->price',
				guests = '$this->guests',
				date = '$this->date',
				time = '$this->time'
				WHERE event_id = '$this->event_id'";
				
		$this->result = $this->db_connection->query($sql);
	}

	private function updateImages() {
		$sql = "UPDATE events SET
				thumbnail = '$this->thumbnail',
				image = '$this->image'
				WHERE event_id = '$this->event_id'";
				
		$this->result = $this->db_connection->query($sql);
	}
	
}
