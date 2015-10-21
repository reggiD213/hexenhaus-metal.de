<?php
$period = $url -> getPeriod();

$events = new Events($period);

$pages = ceil($events -> getTotalEvents()/PERPAGE);

$pagination = array();

for ($i = 0; $i < $pages; $i++) {
	$pagination[] = $i+1;
}

?>

<div class="row">
	<div class="content67">
		<h2>
			<?php if ($period == "upcomming") echo 'Kommende Veranstaltungen'; ?> 
			<?php if ($period == "all")	echo 'Vergangene und kommende Veranstaltungen'; ?>
		</h2>
		<hr>
		<ul class="events layout list">
			<?php for($i = ($pagenum - 1) * PERPAGE; $i < $events -> getTotalEvents() && $i < ($pagenum * PERPAGE); $i++) {
				$event = new Event($events -> getEvent($i));
				?>
				<li class="box">

					<div class="leftdiv left">
						<a href="<?php echo BASEPATH . DS . $page . DS . $event -> getId(); ?>">
							<img src="<?php echo $event -> getThumb(); ?>" alt="<?php echo $event -> getTitle(); ?>">
						</a>
					</div>
					
					<div class="vr left"></div>
					
					<div class="rightdiv left">
						<a href="<?php echo BASEPATH . DS . $page . DS . $event -> getId(); ?>">
							<h3 class="glow"><?php echo $event -> getDate('readable'); ?></h3>
							<hr>
							<h3><?php echo $event -> getTitle(); ?></h3>
						</a>
						<hr>
						<p><?php echo $event -> getDescShort(); ?></p>
						<span class="dull">Eintritt: <?php echo $event -> getPrice() . "€ , Einlass: " . $event -> getTime(); ?></span>
						<hr>
						<a class="button" href="<?php echo BASEPATH . DS . $page . DS . $event -> getId(); ?>"><i class="fa fa-info-circle"></i> Details</a>
					</div>

				</li>
			<?php } ?>
		</ul>
		<hr>
		
		<ul class="pagination layout">
			<li>
				<?php if ($pagenum == 1) {
					echo '<span class="active"><i class="fa fa-step-backward"></i></span>';
				} else {
					echo '<a href="' . BASEPATH . DS . $page . DS . $period . DS . 'page' . DS . '1"><i class="fa fa-step-backward"></i></a>';
				}
				?>
			</li>
			<?php
						
			foreach ($pagination as $key => $value) {
				echo '<li>';
				if ($value == $pagenum) {
					echo '<span class="active">' . $value . '</span>';
				} else {
					echo '<a href="' . BASEPATH . DS . $page . DS . $period . DS . 'page' . DS . $value . '">' . $value . '</a>';
				}
				echo '</li>';
			}
			?>
			<li>
				<?php if ($pagenum == $pages) {
					echo '<span class="active"><i class="fa fa-step-forward"></i></span>';
				} else {
					echo '<a href="' . BASEPATH . DS . $page . DS . $period . DS . 'page' . DS . $pages . '"><i class="fa fa-step-forward"></i></a>';
				}
				?>
			</li>
		</ul>
		
		<select class="right" name="period" size="1" onChange="location.href=this.options[this.selectedIndex].value;">
		<option <?php if ($period == "upcomming") echo 'selected'; ?> value="<?php echo BASEPATH . DS . $page . DS ?>upcomming">kommende Events</option>
		<option <?php if ($period == "all")	echo 'selected'; ?> value="<?php echo BASEPATH . DS . $page . DS ?>all">alle Events</option>
		</select>
		<div class="clear"></div>
		<hr>
	</div>
	
	<?php require_once 'sidebar_regular.tpl.php';?>
	
</div>
