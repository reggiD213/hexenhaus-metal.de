<?php
class Url {

	public $path;

	public function __construct() {
		$this -> path = $this -> getPath();

		define('BASEPATH', $this -> path['base']);

		return $this -> path;
	}

	private function getPath() {
		if (isset($_SERVER['REQUEST_URI'])) {
			$request_path = explode('?', $_SERVER['REQUEST_URI']);

			$this -> path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
			$this -> path['call_utf8'] = substr(urldecode($request_path[0]), strlen($this -> path['base']) + 1);
			$this -> path['call'] = utf8_decode($this -> path['call_utf8']);
			if ($this -> path['call'] == basename($_SERVER['PHP_SELF'])) {
				$this -> path['call'] = '';
			}
			$this -> path['call_parts'] = explode('/', $this -> path['call']);

			$this -> path['query_utf8'] = urldecode($request_path[1]);
			$this -> path['query'] = utf8_decode(urldecode($request_path[1]));
			$vars = explode('&', $this -> path['query']);
			foreach ($vars as $var) {
				$t = explode('=', $var);
				$this -> path['query_vars'][$t[0]] = $t[1];
			}
		}
		return $this -> path;
	}

	public function getPage() {
		if (!isset($this -> path['call_parts'][0]) || $this -> path['call_parts'][0] == '') {
			$this -> path['call_parts'][0] = 'events';

		}

		return $this -> path['call_parts'][0];
	}

	public function getTab() {
		if (!isset($this -> path['call_parts'][1]) || $this -> path['call_parts'][1] == '') {
			$this -> path['call_parts'][1] = 'adm-events';

		}

		return $this -> path['call_parts'][1];
	}

	public function getPeriod($page) {
		if ($page == members) {
			if (!isset($this -> path['call_parts'][2]) || $this -> path['call_parts'][2] == '') {
				$this -> path['call_parts'][2] = 'all';
			}
	
			return $this -> path['call_parts'][2];
		} else {
			if (!isset($this -> path['call_parts'][1]) || $this -> path['call_parts'][1] == '') {
				$this -> path['call_parts'][1] = 'upcomming';
			}
	
			return $this -> path['call_parts'][1];
		}
	}
	
	public function getPagenum() {
		foreach ($this -> path['call_parts'] as $key => $value) {
			if ($this -> path['call_parts'][$key] == 'page') {
				return $this -> path['call_parts'][$key+1];
			}
		}
		return null;
	}
	
	public function getId() {
		foreach ($this -> path['call_parts'] as $key => $value) {
			if (is_numeric($this -> path['call_parts'][$key]) || $this -> path['call_parts'][$key] == 'new') {
				return $this -> path['call_parts'][$key];
			}
		}
	}

}
