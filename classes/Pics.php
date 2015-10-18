<?php

class Pics extends Database {

	//array of all pics
	private $pics;

	public function __construct($pic_id = null) {
		$this -> connect();
		if ($pic_id == null) {
			$this -> getDataList();
		} else {
			$this -> getDataSingle($pic_id);
		}
	}

	private function getDataSingle($pic_id) {
		$sql = "SELECT * FROM pics WHERE pic_id = '$pic_id'";
		$this -> result = $this -> db_connection -> query($sql);
		//store result in array at key 0
		$row = $this -> result -> fetch_assoc();
		$this -> pics[] = $row;
	}

	private function getDataList() {
		$sql = "SELECT * FROM pics ORDER BY pic_id";
		$result = $this -> db_connection -> query($sql);
		//store results in array
		for ($this -> pics = array(); $row = $result -> fetch_assoc(); $this -> pics[] = $row);
	}

	public function getTotalPics() {
		return sizeof($this -> pics);
	}

	public function getPic($list_id = 0) {
		return $this -> pics[$list_id];
	}

	public function debug() {
		echo '<pre>';
		print_r($this -> pics);
		echo '</pre>';
	}

}
