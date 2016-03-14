<?php

class Autoloader {
	public static function ClassLoader($className) {
		include 'classes' . DIRECTORY_SEPARATOR . $className . '.php';
	}

}
