<?php
$period = $url -> getPeriod($page);

$events = new Events($period);

?>

<select name="period" size="1" onChange="location.href=this.options[this.selectedIndex].value;">
	<option <?php if ($period == "all")	echo 'selected'; ?> value="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?>all">alle Events</option>
	<option <?php if ($period == "upcomming") echo 'selected'; ?> value="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?>upcomming">kommende Events</option>
</select>
<hr>

<ul class="adm-events layout">
	<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?>new">
		<li class="box">
			<h3 class="glow"><i class="fa fa-plus-circle"></i> Neue Veranstaltung erstellen</h3>
		</li>
	</a>

<?php

for ($i = $events->getTotalEvents() - 1 ; $i >= 0; $i--) {
	//create an event instance for every iteration
	$event = new Event($events -> getEvent($i));

	?>
	<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?><?php echo $event -> getId(); ?>">
		<li class="box">
			<h3 class="glow"><?php echo $event -> getDate('readable'); ?></h3>
			<p class="dull">Eintritt: <?php echo $event -> getPrice(); ?> | Einlass: <?php echo $event -> getTime(); ?> | Gäste: <?php echo $event -> getGuests(); ?> | ID:  <?php echo $event -> getId(); ?></p>
			<hr>
			<h4><?php echo $event -> getTitle(); ?></h4>
		</li>
	</a>
<?php } ?>
