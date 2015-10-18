<?php

class Band {

	//array of one band
	private $band;

	public function __construct($band) {
		if (isset($band)) {
			$this -> band = $band;
		}
	}

	public function getId() {
		if (isset($this -> band)) {
			return $this -> band['band_id'];
		} else {
			return "new";
		}
	}

	public function getName() {
		if (isset($this -> band)) {
			return $this -> band['name'];
		} else {
			return "";
		}
	}

	public function getThumb() {
		if (isset($this -> band)) {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . BANDIMAGEPATH . DS . $this -> band['thumbnail'])) {
				return BASEPATH . DS . BANDIMAGEPATH . DS . $this -> band['thumbnail'];
			} else {
				return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
			}
		} else {
			return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
		}
	}

	public function getDesc() {
		if (isset($this -> band)) {
			return $this -> band['desc'];
		} else {
			return "";
		}
	}

	public function getLink() {
		if (isset($this -> band)) {
			return $this -> band['link'];
		} else {
			return "";
		}
	}
	
	public function getSoundcloud() {
		if (isset($this -> band)) {
			return $this -> band['soundcloud'];
		} else {
			return "";
		}
	}

	public function debug() {
		echo '<pre>';
		print_r($this -> band);
		echo '</pre>';
	}

}
