<?php

$events = new Events('single', $eventId);
$event = new Event($events -> getEvent());

?>

<div class="row">
	<div class="content100">
		<h2><?php echo $event -> getTitle(); ?></h2>
		<hr>
		<div class="box event">
			<a class="left" href="<?php echo BASEPATH . DS .  $page; ?>"><button class="back"><i class="fa fa-arrow-circle-left"></i> Zurück</button></a>
			<h3 class="glow left" style="line-height: 36px"><?php echo $event -> getDate(); ?></h3>
			<span class="dull right" style="line-height: 36px">Eintritt: <?php echo $event -> getPrice(); ?> €</span>
			<div class="clear"></div>
			<hr>
			<img class="right" src="<?php echo $event -> getThumb(); ?>">
			
			<p><?php echo $event -> getDescLong(); ?></p>
		</div>
	</div>
</div>