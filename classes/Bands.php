<?php

class Bands extends Database {

	//array of all bands
	private $bands;

	public function __construct($band_id = null) {
		$this -> connect();
		if ($band_id == null) {
			$this -> getDataList();
		} else {
			$this -> getDataSingle($band_id);
		}
	}

	private function getDataSingle($band_id) {
		$sql = "SELECT * FROM bands WHERE band_id = '$band_id'";
		$this -> result = $this -> db_connection -> query($sql);
		//store result in array at key 0
		$row = $this -> result -> fetch_assoc();
		$this -> bands[] = $row;
	}

	private function getDataList() {
		$sql = "SELECT * FROM bands ORDER BY name";
		$result = $this -> db_connection -> query($sql);
		//store results in array
		for ($this -> bands = array(); $row = $result -> fetch_assoc(); $this -> bands[] = $row);
	}

	public function getTotalBands() {
		return sizeof($this -> bands);
	}

	public function getBand($list_id = 0) {
		return $this -> bands[$list_id];
	}

	public function debug() {
		echo '<pre>';
		print_r($this -> bands);
		echo '</pre>';
	}

}
