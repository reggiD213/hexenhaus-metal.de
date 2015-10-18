<?php
$bands = new Bands();
?>

<ul class="adm-bands layout">
	<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?>new">
		<li class="box">
			<h3 class="glow"><i class="fa fa-plus-circle"></i> Neue Band erstellen</h3>
		</li>
	</a>

<?php


for ($i = 0; $i < $bands -> getTotalBands(); $i++) {
	//create an band instance for every iteration
	$band = new Band($bands -> getBand($i));

	?>
	<a href="<?php echo BASEPATH . DS . $page . DS . $tab . DS ?><?php echo $band -> getId(); ?>">
		<li class="box">
			<h3 class="glow"><?php echo $band -> getName(); ?></h3>
		</li>
	</a>
<?php } ?>
