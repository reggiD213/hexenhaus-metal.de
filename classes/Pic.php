<?php

class Pic {

	//array of one pic
	private $pic;

	public function __construct($pic) {
		if (isset($pic)) {
			$this -> pic = $pic;
		}
	}

	public function getId() {
		if (isset($this -> pic)) {
			return $this -> pic['pic_id'];
		} else {
			return "new";
		}
	}

	public function getName() {
		if (isset($this -> pic)) {
			return $this -> pic['name'];
		} else {
			return "";
		}
	}

	public function getFilename() {
		if (isset($this -> pic)) {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . DS . BASEPATH . DS . UPLOADIMAGEPATH . DS . $this -> pic['filename'])) {
				return BASEPATH . DS . UPLOADIMAGEPATH . DS . rawurlencode($this -> pic['filename']);
			} else {
				return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
			}
		} else {
			return BASEPATH . DS . IMAGEPATH . DS . 'not-available.jpg';
		}
	}

	public function debug() {
		echo '<pre>';
		print_r($this->pic);
		echo '</pre>';
	}

}
