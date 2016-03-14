<?php

class BandDelete extends Database {

	private $band_id;
	private $thumbnail;

	public function __construct($band) {
		if (isset($_POST['delete'])) {
			$this -> connect();
			$this -> band_id = $band -> getId();
			$this -> deleteFiles($band);
			$this -> doDelete();
		}
	}

	private function deleteFiles($band) {
		unlink($_SERVER['DOCUMENT_ROOT'] . DS . $band -> getThumb());
	}

	private function doDelete() {
		$sql = "DELETE
				FROM bands
				WHERE band_id = '$this->band_id'";

		$result = $this -> db_connection -> query($sql) or die(mysqli_error($this -> db_connection));
		header('Location: ' . BASEPATH . DS . 'members' . DS . 'adm-bands');
	}

}
