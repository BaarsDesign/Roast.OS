	<div id="logo" class="register"></div>

	<form method="POST" class="register">
		<p>
			<?t("register-intro")?>
		</p>
		<span><i class="fa fa-user fa-fw"></i></span><input class="<?wrongClass("firstname")?>" type="text" name="firstname" placeholder="<?w("First name")?>" autocomplete="off" value="<?userInput("firstname");?>">
		<span><i class="fa fa-user fa-fw"></i></span><input class="<?wrongClass("lastname")?>" type="text" name="lastname" placeholder="<?w("Last name")?>" autocomplete="off" value="<?userInput("lastname");?>">

		<span><i class="fa fa-envelope fa-fw"></i></span><input class="<?wrongClass("email")?>" type="text" name="email" placeholder="<?w("Email")?>" autocomplete="off" value="<?userInput("email");?>">

		<span><i class="fa fa-quote-left fa-fw"></i></span><input class="<?wrongClass("username")?>" type="text" name="username" placeholder="<?w("Username")?>" autocomplete="off" value="<?userInput("username");?>">

		<span><i class="fa fa-lock fa-fw"></i></span><input class="<?wrongClass("password")?>" type="password" name="password" placeholder="<?w("Password")?>" autocomplete="off" value="<?userInput("password");?>">
		<span><i class="fa fa-lock fa-fw"></i></span><input class="<?wrongClass("passwordRepeat")?>" type="password" name="passwordRepeat" placeholder="<?w("Password")?> (<?w("again")?>)" autocomplete="off" value="<?userInput("passwordRepeat");?>">
		<input type="submit" value="<?w("Log in")?>">
	</form>