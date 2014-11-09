<?php
	$GLOBALS["config"] = parse_ini_file("config.ini", 1);
	require_once("backend/functions.php");
	
	switch (checkRoute()) {

		case "install":
			loadModule("login_header");
			loadModule("register");
			loadModule("login_footer");
		break;
	

		//there are accounds, so there can be logged in.
		case "login":
			loadModule("login");
		break;


		case "logout":
			cookieLogout();
		break;


		case "desktop": 
			loadModule("desktop_header");
			loadModule("desktop_taskbar");
			loadModule("desktop");
			loadModule("desktop_footer");
		break;


		default:
			//DO THIS IF NOTHING IS DONE
			loadModule("login_header");
			echo('<h1>Something went wrong...</h1>');
			loadModule("login_footer");
		break;
	}

?>