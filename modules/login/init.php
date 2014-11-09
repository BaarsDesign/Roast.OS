<?php

	if( isset($_POST["username"]) && isset($_POST["password"]) ) {

		//check if the form is filled in correctly
		$login = login($_POST["username"], $_POST["password"], $_POST["fullscreen"]);

		if($login == "ok") {

			//Account information is correct > Log in
			cookieLogin();

		} else if($login == "username") {

			//Username does not exist
			loadModule("login_header");
			echo("Gebruikersnaam fout");
			include("modules/login/loginForm.php");
			loadModule("login_footer");

		} else if($login == "password") {

			//The password is wrong
			loadModule("login_header");
			echo("Wachtwoord fout");
			include("modules/login/loginForm.php");
			loadModule("login_footer");
			
		} 

	} else {
		//No information is filled in, show login form

		loadModule("login_header");
		include("modules/login/loginForm.php");
		loadModule("login_footer");
	}



?>
