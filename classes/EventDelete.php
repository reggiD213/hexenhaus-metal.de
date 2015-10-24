<?php

class EventDelete extends Database {
	
	private $event_id;
	private $thumbnail;
	
	public function __construct($event) {
		if (isset($_POST['delete'])) {
			$this -> connect();
			$this -> event_id = $event -> getId();
			$this -> deleteFiles($event);
			$this -> doDelete();
		}
	}

	private function deleteFiles($event) {
		unlink($_SERVER['DOCUMENT_ROOT'] . DS . $event -> getThumb());
		unlink($_SERVER['DOCUMENT_ROOT'] . DS . $event -> getImage());
		rmdir($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . EVENTIMAGEPATH . DS . $this -> event_id);
	}
	
	private function doDelete() {
		$sql = "DELETE
				FROM events
				WHERE event_id = '$this->event_id'";

		$result = $this -> db_connection -> query($sql) or die(mysqli_error($this -> db_connection));
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-events');
	}
	
}
