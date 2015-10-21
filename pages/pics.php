<?php
$pics = new Pics();
?>

<div class="row">
	<div class="content67">
		<h2>Bildergalerie</h2>
		<hr>
		<div class="pics box layout">
			<?php
			for($i = 0; $i < $pics -> getTotalPics(); $i++) {
				$pic = new Pic($pics -> getPic($i));
			?>
				<div class="table left">
					<div class="cell">
						<a href="<?php echo $pic -> getFilename(); ?>" data-lightbox="Bildergalerie" data-title="<?php echo $pic -> getName(); ?>">
							<img src="<?php echo $pic -> getFilename(); ?>" alt="<?php echo $pic -> getName(); ?>" alt="<?php echo $pic -> getName(); ?>">
						</a>
					</div>
				</div>
			<?php } ?>
			
		</div>
	</div>

	<?php require_once 'sidebar_regular.tpl.php';?>

</div>