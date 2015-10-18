<?php

if ($bandId == 'new') {
	$bandInsert = new BandInsert();
	$band = new Band();
} else {
	$bandUpdate = new BandUpdate($bandId);
	$bands = new Bands($bandId);
	$band = new Band($bands -> getBand());
}

$bandDelete = new BandDelete($band);
?>

<form enctype="multipart/form-data" class="box bands" method="post" action="<?php echo BASEPATH . DS . $page . DS . $tab . DS . $bandId; ?>" name="bandform">
	<ul class="layout">
		<li>
			<label for="band_name">Name: </label>
			<input id="band_name" class="band_input" type="text" value="<?php echo $band -> getName(); ?>" name="name" autocomplete="off" placeholder="Bandname eingeben" required />
		</li>
		<li>
			<label for="band_desc">Beschreibung: </label>
			<textarea id="band_desc" class="band_input" rows="5" name="desc" placeholder="kurze Bandbeschreibung eintippen" required /><?php echo $band -> getDesc(); ?></textarea>
		</li>
		<li>
			<label for="band_link">Link:</label>
			<input id="band_link" class="band_input" type="url" value="<?php echo $band -> getLink(); ?>" name="link" autocomplete="off" placeholder="Url mit 'http://' eingeben"  required />
		</li>
		<li>
			<label for="band_soundcloud">Soundcloud:</label>
			<input id="band_soundcloud" class="band_input" type="text" value="<?php echo $band -> getSoundcloud(); ?>" name="soundcloud" autocomplete="off" placeholder="Soundcloud-Embed-Link oder 8-stellige Zahl eingeben" />
		</li>
		<li>
			<label for="band_thumb">Thumbnail: </label><br>
			<img src="<?php echo $band -> getThumb(); ?>">
			<input id="band_thumb" class="band_input file_input" type="file" name="thumbnail" />
		</li>
		<li>
			<button class="left" type="submit" name="action">
				<i class="fa fa-check-circle"></i> <?php if ($bandId == 'new') echo 'Einfügen'; else echo 'Aktualisieren'?>
			</button>
			<?php if ($bandId != 'new') { ?>
			<button class="right" type="submit" name="delete">
				<i class="fa fa-minus-circle"></i> Löschen
			</button>
			<?php } ?>
		</li>
	</ul>
</form>