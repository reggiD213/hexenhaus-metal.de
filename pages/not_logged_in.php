<div class="row">
	<div class="content67">
		<h2>Member's Only</h2>
		<hr>
		
			
			<?php
			// show potential errors / feedback (from login object)
			if (isset($login)) {
			    if ($login->errors) {
			        foreach ($login->errors as $error) {
			            echo $error;
			        }
			    }
			    if ($login->messages) {
			        foreach ($login->messages as $message) {
			            echo $message;
			        }
			    }
			}
			?>
		
	</div>
	
	<div class="content33">
		<h2>Member Login</h2>
		<hr>
		<form class="login box firstv last" method="post" action="<?php echo BASEPATH . DS . $page ?>" name="loginform">
			<ul class="layout">
				<li class="firstv">
					<label for="login_input_username">Username: </label>
	    			<input id="login_input_username" class="login_input" type="text" name="user_name" required />
				</li>
				<li>
					<label for="login_input_password">Password: </label>
	    			<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
				</li>
				<li>
					<button type="submit" name="login"><i class="fa fa-check-circle"></i> Anmelden</button>
				</li>
			</ul>
		</form>
	</div>
</div>