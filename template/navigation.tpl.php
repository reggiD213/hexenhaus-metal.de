<nav class="main_nav_table">
	<div class="main_nav_cell">
		<ul class="box layout">
			<?php
			$nav = array(
				'' => 'EVENTS',
				'apply' => 'BEWERBEN',
				'bands' => 'BANDS',
				'pics' => 'PICS',
				'contact' => 'KONTAKT',
				'about-us' => 'ÜBER UNS'
			);
			
			foreach ($nav as $fileName => $menuName) {
				echo '<li><a ';
				if ($page == $fileName || ($page == 'events' && $fileName == '')) echo 'class="active" ';
				echo 'href="' . BASEPATH . DS . $fileName . '">' . $menuName . '</a></li>';
			}
			?>
			

		</ul>
	</div>
</nav>