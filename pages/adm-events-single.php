<?php

if ($eventId == 'new') {
	$eventInsert = new EventInsert();
	$event = new Event();
} else {
	$eventUpdate = new EventUpdate($eventId);
	$events = new Events('single', $eventId);
	$event = new Event($events -> getEvent());
}

$eventDelete = new EventDelete($event);

$time = strftime("%Y-%m-%dT%H:%M:%S", $event -> getTimestamp());

?>

<form enctype="multipart/form-data" class="box events" method="post" action="<?php echo BASEPATH . DS . $page . DS . $tab . DS . $eventId; ?>" name="eventform">
	<ul class="layout">
		<li>
			<label for="event_date">Datum: </label>
			<input id="event_date" class="event_input" type="datetime-local" value="<?php echo $time; ?>" name="date" required />
		</li>
		<li>
			<label for="event_title">Titel: </label>
			<input id="event_title" class="event_input" type="text" value="<?php echo $event -> getTitle(); ?>" name="title" autocomplete="off" required />
		</li>
		<li>
			<label for="event_desc_short">Kurzbeschreibung: </label>
			<textarea id="event_desc_short" class="event_input" rows="5" name="desc_short" required /><?php echo $event -> getDescShort(); ?></textarea>
		</li>
		<li>
			<label for="event_desc_long">Langbeschreibung: </label>
			<textarea id="event_desc_long" class="event_input desc_long" rows="40" name="desc_long"  /><?php echo $event -> getDescLong(); ?></textarea>
		</li>
		<li>
			<label for="event_price">Preis [€]:</label>
			<input id="event_price" class="event_input" type="number" step="0,01" min="0,01" max="99" value="<?php echo $event -> getPrice('.'); ?>" name="price" autocomplete="off" required />
		</li>
		<li>
			<label for="event_guests">Gäste: </label>
			<input id="event_guests" class="event_input" type="number" step="1" min="0" max="500" value="<?php echo $event -> getGuests(); ?>" name="guests" autocomplete="off" />
		</li>
		<li>
			<label for="event_thumb">Thumbnail: </label><br>
			<img src="<?php echo $event -> getThumb(); ?>">
			
			<input id="event_thumb" class="event_input file_input" type="file" name="thumbnail" />
		</li>
		<li>
			<button class="left" type="submit" name="action">
				<i class="fa fa-check-circle"></i> <?php if ($eventId == 'new') echo 'Einfügen'; else echo 'Aktualisieren'?>
			</button>
			<?php if ($eventId != 'new') { ?>
			<button class="right" type="submit" name="delete">
				<i class="fa fa-minus-circle"></i> Löschen
			</button>
			<?php } ?>
		</li>
	</ul>
</form>