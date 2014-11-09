	<div id="logo"></div>

	<?php // PLAY STARTUP SOUND ?>
	<audio autoplay class="hidden">
		<source src="/themes/system/sound/startup.mp3" type="audio/mpeg">
		<source src="/themes/system/sound/startup.wav" type="audio/wav">
		<source src="/themes/system/sound/startup.ogg" type="audio/ogg">
	</audio>

	<?php // SHOW LOGIN FORM ?>
	<form method="POST">
		<span><i class="fa fa-user"></i></span><input type="text" name="username" placeholder="<?w("Username")?>">
		<span><i class="fa fa-lock"></i></span><input type="password" name="password" placeholder="<?w("Password")?>">
		<input type="submit" value="<?w("Log in")?>">
	</form>