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
	
	public function getImage() {
		if (isset($this -> event)) {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . EVENTIMAGEPATH . DS . $this -> getId() . DS . $this -> event['image'])) {
				return BASEPATH . DS . EVENTIMAGEPATH . DS . $this -> getId() . DS . $this -> event['image'];
			} else {
				return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
			}
		} else {
			return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
		}
	}

	public function getThumb() {
		if (isset($this -> event)) {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . EVENTIMAGEPATH . DS . $this -> getId() . DS . $this -> event['thumbnail'])) {
				return BASEPATH . DS . EVENTIMAGEPATH . DS . $this -> getId() . DS . $this -> event['thumbnail'];
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
			return "0,00";
		}
	}

	public function getGuests() {
		if (isset($this -> event)) {
			return $this -> event['guests'];
		} else {
			return null;
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

	public function getDate($format = 'readable') {
		if (isset($this -> event)) {
			$date = $this -> event['date'];
			if ($format == 'mysql') {
				return $date;
			}
			$date = strtotime($date);
			if ($format == 'timestamp') {
				return $date;
			}
			if ($format == 'jquery') {
				$y = strftime("%Y", $date);
				$m = intval(strftime("%m", $date)) - 1;
				$d = strftime("%d", $date);
				$date = "$y, $m, $d";
								
				return $date;
			}
			if ($format == 'readable') {
				$date = strftime("%A, %d.%m.%Y", $date);
				return $date;
			}
		} else {
			return strftime("%Y, %m, %d", time());
		}
	}
		
	public function getTime() {
		if (isset($this -> event)) {
			$time = substr($this -> event['time'],0,5);
			return $time;
		} else {
			return "20:00";
		}
	}

	public function debug() {
		echo '<pre>';
		print_r($this -> event);
		echo '</pre>';
	}

}
