<?php

class PicDelete extends Database {

	private $pic_id;
	private $filename;

	public function __construct($pic) {
		if (isset($_POST['delete'])) {
			$this -> connect();
			$this -> pic_id = $pic -> getId();
			$this -> deleteFiles($pic);
			$this -> doDelete();
		}
	}

	private function deleteFiles($pic) {
		$this -> filename = $_SERVER['DOCUMENT_ROOT'] . DS . $pic -> getFilename();
		
		unlink($this -> filename);
	}

	private function doDelete() {
		$sql = "DELETE
				FROM pics
				WHERE pic_id = '$this->pic_id'";

		$result = $this -> db_connection -> query($sql) or die(mysqli_error($this -> db_connection));
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-pics');
	}

}
