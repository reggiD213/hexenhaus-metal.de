<?php

class EventDelete extends Database {
	
	private $event_id;
	private $thumbnail;
	private $folder;
	
	public function __construct($event) {
		if (isset($_POST['delete'])) {
			$this -> connect();
			$this -> event_id = $event -> getId();
			$this -> deleteFiles($event);
			$this -> doDelete();
		}
	}

	private function deleteFiles($event) {
		if ($event -> getThumb() != BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg') {
			$this -> thumbnail = $_SERVER['DOCUMENT_ROOT'] . DS . $event -> getThumb();
			unlink($this -> thumbnail);
		}
		
		$this -> folder = $_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . EVENTIMAGEPATH . DS . getDate('mysql');
		rmdir($this -> folder);
	}
	
	private function doDelete() {
		$sql = "DELETE
				FROM events
				WHERE event_id = '$this->event_id'";
				

		$result = $this -> db_connection -> query($sql) or die(mysqli_error($this -> db_connection));
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-events');
	}
		
}
