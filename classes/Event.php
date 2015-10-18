<?php

class Event {

	//array of one events
	public $event;

	public function __construct($event) {
		if (isset($event)) {
			$this -> event = $event;
		}
	}

	public function getId() {
		if (isset($this -> event)) {
			return $this -> event['event_id'];
		} else {
			return "new";
		}
	}

	public function getTitle() {
		if (isset($this -> event)) {
			return $this -> event['title'];
		} else {
			return "";
		}

	}

	public function getThumb() {
		if (isset($this -> event)) {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . EVENTIMAGEPATH . DS . strftime("%Y_%m_%d", $this -> getTimestamp()) . DS . $this -> event['thumbnail'])) {
				return BASEPATH . DS . EVENTIMAGEPATH . DS . strftime("%Y_%m_%d", $this -> getTimestamp()) . DS . $this -> event['thumbnail'];
			} else {
				return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
			}
		} else {
			return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
		}

	}

	public function getDescShort() {
		if (isset($this -> event)) {
			return $this -> event['desc_short'];
		} else {
			return "";
		}
	}

	public function getDescLong() {
		if (isset($this -> event)) {
			return $this -> event['desc_long'];
		} else {
			return "";
		}
	}

	public function getPrice($divider = ',') {
		if (isset($this -> event)) {
			$price = $this -> event['price'];
			$price = number_format($price, 2, $divider, '');
			return $price;
		} else {
			return "0";
		}
	}

	public function getGuests() {
		if (isset($this -> event)) {
			return $this -> event['guests'];
		} else {
			return "0";
		}
	}

	public function getTimestamp() {
		if (isset($this -> event)) {
			$timestamp = $this -> event['date'];
			$timestamp = strtotime($timestamp);
			return $timestamp;
		} else {
			return time();
		}
	}

	public function getDate() {
		$date = $this -> getTimestamp();
		$date = strftime("%A, %d.%m.%Y, %H:%M", $date);
		return $date;
	}

	public function debug() {
		echo '<pre>';
		print_r($this -> event);
		echo '</pre>';
	}

}
