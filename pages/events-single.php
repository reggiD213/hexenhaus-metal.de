<?php

$events = new Events('single', $eventId);
$event = new Event($events -> getEvent());

?>

<div class="row">
	<div class="content100">
		<h2><?php echo $event -> getTitle(); ?></h2>
		<hr>
		<div class="box event">
			<a class="left back button" href="<?php echo BASEPATH . DS .  $page; ?>"><i class="fa fa-arrow-circle-left"></i> Zurück</a>
			<h3 class="glow left" style="line-height: 36px"><?php echo $event -> getDate('readable'); ?></h3>
			<span class="dull right" style="line-height: 36px">Eintritt: <?php echo $event -> getPrice(). " , Einlass: " . $event -> getTime(); ?></span>
			<div class="clear"></div>
			<hr>
			<img class="right" src="<?php echo $event -> getImage(); ?>" alt="<?php echo $event -> getTitle(); ?>">
			<p><?php echo $event -> getDescLong(); ?></p>
		</div>
	</div>
</div>