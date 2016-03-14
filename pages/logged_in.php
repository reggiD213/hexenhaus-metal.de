<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}

$tab = $url -> getTab();

switch ($tab) {
	case 'adm-events':
		$eventId = $url -> getId();
		break;
	case 'adm-bands':
		$bandId = $url -> getId();
		break;
	case 'adm-pics':
		$picId = $url -> getId();
		break;
}

?>

<div class="row">
	<div class="content67">
		<h2>Hey, <?php echo $_SESSION['user_name']; ?>.</h2>
		<hr>
		<nav class="member_nav">
			<ul class="box layout">
				<?php
				$nav = array(
					'' => 'Events',
					'adm-bands' => 'Bands',
					'adm-pics' => 'Pics'
				);
				
				foreach ($nav as $fileName => $menuName) {
					echo '<li><a ';
					if ($tab == $fileName || ($tab == 'adm-events' && $fileName == '')) echo 'class="active" ';
					echo 'href="' . BASEPATH . DS . $page . DS . $fileName . '">' . $menuName . '</a></li>';
				}
				
				echo '<li class="right"><a href="' . BASEPATH . DS . $page . DS . 'logout' . '"><i class="fa fa-power-off"></i> Logout</a></li>';
				
				if (isset($eventId) || isset($bandId) || isset($picId)) {
					echo '<li class="right"><a href="' . BASEPATH . DS . $page . DS . $tab . '"><i class="fa fa-arrow-circle-o-left"></i> Zurück</a></li>';
				}
				
				

				?>

			</ul>
		</nav>
		
		<?php 
		if (file_exists('pages/' . $tab . '.php')) {
			require_once $tab . '.php';
		} else {
			require_once 'error.php';
		}	
		?>
	</div>
	<div class="content33">
		
		<?php if($login->loggedInUser() == "Puddy") { ?>
			
			<h2>Kalender</h2>
			<hr>
			
			<?php
			$calendar = new Calendar();
			
			$calendar -> showCalendar();
			?>
				
		
			
			<?php
			
			// create the registration object. when this object is created, it will do all registration stuff automatically
			// so this single line handles the entire registration process.
			$registration = new Registration();
			
			?>
			<h2>Registrierung</h2>
			<hr>
			<form class="register box" method="post" action="<?php echo BASEPATH . DS . $page ?>" name="registerform">
				<ul class="layout">
					<li class="">
						<!-- the user name input field uses a HTML5 pattern check -->
						<label for="login_input_username">Username: </label>
						<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
					</li>
					<li>
						<!-- the email input field uses a HTML5 email type check -->
		    			<label for="login_input_email">Email: </label>
		   				<input id="login_input_email" class="login_input" type="email" name="user_email" required />
					</li>
					<li>
					    <label for="login_input_password_new">Password: </label>
					    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
					</li>
					<li>
						<label for="login_input_password_repeat">Password: </label>
						<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
					</li>
					<li>
						<button type"submit" name="register"><i class="fa fa-check-circle"></i> Registrieren</button>
					</li>
				</ul>
			</form>
		<?php } ?>
	</div>
</div>