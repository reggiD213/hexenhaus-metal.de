<?php
$bands = new Bands();

if ($url -> getPagenum() != null) {
	$pagenum = $url -> getPagenum();
} else {
	$pagenum = 1;
}

$pages = ceil($bands -> getTotalBands()/PERPAGE);

$pagination = array();

for ($i = 0; $i < $pages; $i++) {
	$pagination[] = $i+1;
}

?>

<div class="row">
	<div class="content67">
		<h2>Bands bei uns im Hexenhaus</h2>
		<hr>
		<ul class="bands layout">
			<?php for($i = ($pagenum - 1) * PERPAGE; $i < $bands -> getTotalBands() && $i < ($pagenum * PERPAGE); $i++) {
				$band = new Band($bands -> getBand($i));
			?>
			<li class="box">

				<div class="leftdiv left">
					<a target="_blank" href="<?php echo $band -> getLink(); ?>">
						<img src="<?php echo $band -> getThumb(); ?>" alt="<?php echo $band -> getName(); ?>">
					</a>
				</div>
				
				<div class="vr left"></div>
				
				<div class="rightdiv left">
					<a target="_blank" href="<?php echo $band -> getLink(); ?>">
						<h3 class="glow"><?php echo $band -> getName(); ?></h3>
					</a>
					<hr>
					<p><?php echo $band -> getDesc(); ?></p>
					<a target="_blank" href="<?php echo $band -> getLink(); ?>"><span class="dull">zur Homepage</span></a>
					<?php if ($band -> getSoundcloud() != null) { ?>
					<iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/<?php echo $band -> getSoundcloud(); ?>"></iframe>
					<?php } ?>
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
					echo '<a href="' . BASEPATH . DS . $page . DS . 'page' . DS . '1"><i class="fa fa-step-backward"></i></a>';
				}
				?>
			</li>
			<?php
						
			foreach ($pagination as $key => $value) {
				echo '<li>';
				if ($value == $pagenum) {
					echo '<span class="active">' . $value . '</span>';
				} else {
					echo '<a href="' . BASEPATH . DS . $page . DS . 'page' . DS . $value . '">' . $value . '</a>';
				}
				echo '</li>';
			}
			?>
			<li>
				<?php if ($pagenum == $pages) {
					echo '<span class="active"><i class="fa fa-step-forward"></i></span>';
				} else {
					echo '<a href="' . BASEPATH . DS . $page . DS . 'page' . DS . $pages . '"><i class="fa fa-step-forward"></i></a>';
				}
				?>
			</li>
		</ul>
		<div class="clear"></div>
		<hr>
	</div>



	<?php require_once 'template/sidebar_regular.tpl.php';?>

</div>