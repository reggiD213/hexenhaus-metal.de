<?php
class Calendar {

	private $year;
	private $month;
	private $monthNames = array('Januar','Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
	private $dayNames = array('Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So');
	
	public function __construct() {
		$this -> year = $this -> getYear();
		$this -> month = $this -> getMonth();
	}
	
	public function showCalendar() {
		echo '<table class="box calendar">';
		$this -> showYears();
		$this -> showMonths();
		$this -> showDaynames();
		$this -> showDays();
		echo '</table>';
	}

	private function showYears() {
		
		echo '<tr>';
		echo '<th colspan="2"><a class="left" href=""><i class="fa fa-arrow-circle-left"></i> ' . ($this -> year-1) . '</a></th>';
		echo '<th colspan="3"><span class="active">' . $this -> year . '</span></th>';
		echo '<th colspan="2"><a class="right" href="">' . ($this -> year+1) . ' <i class="fa fa-arrow-circle-right"></i></a></th>';
		echo '</tr>';
	}
	
	private function showMonths() {
		echo '<tr>';
		echo '<th colspan="2"><a class="left" href=""><i class="fa fa-arrow-circle-left"></i> ' . $this -> monthNames[($this -> month-2)] . '</a></th>';
		echo '<th colspan="3"><span class="active">' . $this -> monthNames[($this -> month-1)] . '</span></th>';
		echo '<th colspan="2"><a class="right" href="">' . $this -> monthNames[($this -> month-0)] . ' <i class="fa fa-arrow-circle-right"></i></a></th>';
		echo '</tr>';
	}
	
	private function showDaynames() {
		echo '<tr>';
		foreach ($this -> dayNames as $key => $value) {
			echo '<td>' . $value . '</td>';
		}
		echo '</tr>';
	}
	
	private function showDays() {
		$firstDayOfMonth = date("$this->year-$this->month-01");
		echo $firstDayOfMonth;
		$firstDayOfMonth = date(l,$firstDayOfMonth);
		echo $firstDayOfMonth;
		$offset = $this -> month;
		for ($i = 0; $i < 7; $i++) {
			
		}
		echo '<tr>';
		foreach ($this -> dayNames as $key => $value) {
			echo '<td>' . $value . '</td>';
		}
		echo '</tr>';
	}
	
	private function getYear() {
		return strftime('%Y');
	}

	private function getMonth() {
		return strftime('%m');
	}
	
}
