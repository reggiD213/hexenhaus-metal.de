<?php

class Events extends Database {

	private $period;

	//array of all or upcomming events
	private $events;

	public function __construct($period = 'all', $event_id = null) {
		$this -> connect();
		if ($event_id == null) {
			if ($period == 'all') {
				$this -> getDataList();
			} elseif ($period == 'upcomming') {
				$this -> getDataListUpcomming();
			}
		} elseif ($period == 'single') {
			$this -> period = $period;
			$this -> getDataSingle($event_id);
		} else {
			echo 'Sorry, something went wrong!';
		}
	}

	private function getDataSingle($event_id) {
		$sql = "SELECT * FROM events WHERE event_id = '$event_id'";
		$this -> result = $this -> db_connection -> query($sql);
		//store result in array at key 0 
		$row = $this -> result -> fetch_assoc();
		$this -> events[] = $row;
	}

	private function getDataList() {
		$sql = "SELECT * FROM events ORDER BY date";
		$result = $this -> db_connection -> query($sql);
		//store results in array
		for ($this -> events = array(); $row = $result -> fetch_assoc(); $this -> events[] = $row);
	}

	private function getDataListUpcomming() {
		$this -> getDataList();
		$now = time();
		$upEvents = array();
		foreach ($this->events as $key => $value) {
			$date = $this -> events[$key]['date'];
			$date = strtotime($date);

			if ($date > $now) {
				$upEvents[] = $this -> events[$key];
			}
		}
		$this -> events = $upEvents;
	}

	public function getTotalEvents() {
		return sizeof($this -> events);
	}

	public function getEvent($list_id = 0) {
		return $this -> events[$list_id];
	}

	public function debug() {
		echo '<pre>';
		print_r($this->events);
		echo '</pre>';
	}

}
