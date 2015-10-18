<?php
$pics = new Pics();
?>

<ul class="adm-pics layout">
	<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?>new">
		<li class="box">
			<h3 class="glow"><i class="fa fa-plus-circle"></i> Neues Bild hinzufügen</h3>
		</li>
	</a>
</ul>

<div class="pics box layout">
	<?php
	for($i = 0; $i < $pics -> getTotalPics(); $i++) {
		$pic = new Pic($pics -> getPic($i));
	?>
		<div class="table left">
			<div class="cell">
				<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?><?php echo $pic -> getId(); ?>">
					<img class="left" src="<?php echo $pic -> getFilename(); ?>" alt="<?php echo $pic -> getName(); ?>">
				</a>
			</div>
		</div>
	<?php } ?>
</div>