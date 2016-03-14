<?php

class Helper {

	static function debug($array) {
		echo "<pre>";
		
		if (isset($array)) {
			echo htmlentities(print_r($array,true));
		} else {
			echo htmlentities(print_r($GLOBALS,true));
		}

		echo "</pre>";
	}

}
