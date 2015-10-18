<?php

if ($picId == 'new') {
	$picInsert = new PicInsert();
	$pic = new Pic();
} else {
	$picUpdate = new PicUpdate($picId);
	$pics = new Pics($picId);
	$pic = new Pic($pics -> getPic());
}

$picDelete = new PicDelete($pic);
?>

<form enctype="multipart/form-data" class="box pics" method="post" action="<?php echo BASEPATH . DS . $page . DS . $tab . DS . $picId; ?>" name="picform">
	<ul class="layout">
		<li>
			<label for="pic_name">Name: </label>
			<input id="pic_name" class="pic_input" type="text" value="<?php echo $pic -> getName(); ?>" name="name" autocomplete="off" required />
		</li>
		<li>
			<label for="pic_image">Image: </label><br>
			<img src="<?php echo $pic -> getFilename(); ?>">
			<input id="pic_image" class="pic_input file_input" type="file" name="image" />
		</li>
		<li>
			<button class="left" type="submit" name="action">
				<i class="fa fa-check-circle"></i> <?php if ($picId == 'new') echo 'Einfügen'; else echo 'Aktualisieren'?>
			</button>
			<?php if ($picId != 'new') { ?>
			<button class="right" type="submit" name="delete">
				<i class="fa fa-minus-circle"></i> Löschen
			</button>
			<?php } ?>
		</li>
	</ul>
</form>