<?php
	/**
		GET THE USER INFO
	**/

	if(isset($GLOBALS["extraPath"])) {
		$user = parse_ini_file("{$GLOBALS["extraPath"]}/users/{$_COOKIE[user]}/profile.ini", 1);
	}



	/**
		GENERAL
	**/

	function loadModule($name) {
		include("modules/$name/init.php");
	}


	function is_dir_empty($dir) {
	if (!is_readable($dir)) return null; 
		$handle = opendir($dir);
		while (false !== ($entry = readdir($handle))) {
			if ($entry !== '.' && $entry !== '..') {
				return false;
			}
		}
		closedir($handle);
		return true;
	}



	/**
	 LOGIN
	**/

	function login($username, $password, $fullscreen) {

		$password = encrypt($password, $username);
		$dir = "users/{$username}/";
		$usernameOK = file_exists ($dir);

		if($username != "" && file_exists ($dir)) {
			//gebruikersnaam klopt

			$GLOBALS["userCheck"] = parse_ini_file("users/{$username}/profile.ini", 1);
			$goodPassword = $GLOBALS["userCheck"][account][password];

			if($password == $goodPassword) {

				$cookieDuration = 3600 * 24 * 7 * 52;
				//wachtwoord klopt
				setcookie("user", $username, time()+$cookieDuration);
				return "ok";

			} else {

				//wachtwoord fout
				return "password";
			}

			$GLOBALS["userCheck"] = null;

		} else {

			//gebruikersnaam fout
			return "username";

		}

	}


	function cookieLogin() {
		//create cookie
		setcookie("user", $_POST["username"], time()+3600);
		showLoadPage($_SERVER['PHP_SELF']);
	}

	function cookieLogout() {
		//destroy cookie
		setcookie("user", "", time()-3600);
		showLoadPageLogout($_SERVER['PHP_SELF'] . "#logout");
	}


	function showLoadPage($page = "") {
		//refresh after 1 second and navigate to $page
		header("Refresh: 1; url=$page");
		loadModule("login_header");
		echo('<div class="circle"></div><div class="circle"></div>');
		loadModule("login_footer");
	}
	function showLoadPageLogout($page = "") {
		//refresh after 1 second and navigate to $page
		header("Refresh: 2; url=$page");
		loadModule("login_header");
		echo('<div class="circle"></div><div class="circle"></div>');
		echo('<audio autoplay class="hidden">');
		echo('	<source src="/themes/system/sound/logout.mp3" type="audio/mpeg">');
		echo('	<source src="/themes/system/sound/logout.wav" type="audio/wav">');
		echo('	<source src="/themes/system/sound/logout.ogg" type="audio/ogg">');
		echo('</audio>');
		loadModule("login_footer");
	}

	function checkLogin($extraPath = "") {
		//check of de gebruiker is ingelogd
		if(isset($_COOKIE["user"])) {
			$username = $_COOKIE["user"];
			$GLOBALS["user"] = parse_ini_file($extraPath."users/{$username}/profile.ini", 1);
			return true;
		} else { 
			return false;
		}
	}

		/**
			CREATE ACCOUNT
		**/
	function createAccount($userInfo) {
		/*
			TO DO:

			- check if user exists
			- check if username is only letters, - or _
			- create user folders
		*/
		

		$password = encrypt($userInfo['password'], $userInfo['username']);
		$role = 1;

		$profile = ("users/". $userInfo['username'] . "/profile.ini");

		mkdir("users/". $userInfo['username']);
		mkdir("users/". $userInfo['username'] . "/filesystem");
		mkdir("users/". $userInfo['username'] . "/filesystem/system");
		mkdir("users/". $userInfo['username'] . "/filesystem/system/desktop");
		touch($profile);


		$userINI = "
; THIS IS THE USER-SETTINGS FILE

[account]
username			= " . $userInfo['username'] . "
password			= " . $password . "
role				= " . $role . "

[profile]
firstName			= " . $userInfo['firstname'] . "
lastName			= " . $userInfo['lastname'] . "
email				= " . $userInfo['email'] . "

[settings]
taskbarlocation		= top
theme				= default
wallpaper			= def/1.jpg
highlight			= 449257";

		file_put_contents($profile, $userINI);
	}

	/**
		ROUTER
	**/
	function checkRoute() {
		//check what to do
		if($_GET) {

			foreach($_GET as $key => $value)
			{
				return($key);
			}

		} else if(is_dir_empty("users")) {//There are no users
			return("install");

		} else if(checkLogin()) { //kijk of de gebruiker is ingelogd
			return("desktop");

		} else { //There is at least one user, show login form
			return("login");

		}
	}




	/**
		LANGUAGE RELATED FUNCTIONS
	**/

	function t($textName) {
		if($GLOBALS["extraPath"]) {
			$extraPath = $GLOBALS["extraPath"];
		} else {
			$extraPath = "";
		}
		$language = getLanguage();
		$debugMode = $GLOBALS["config"][settings][debugmode];

		$fileSlug = strtolower(str_replace(" ","-",$textName));

		$folderURL 	= ($extraPath."lang/" . $language);
		$fileName 	= ($fileSlug . ".html");
		$fileURL 	= ($folderURL . "/" . $fileName);
		
		//check if the default language is set
		if(!is_null($language)) { 
			//if not, change it to en-US
			$language = "en-US";
		}

		//check if the language folder exists
		if(!file_exists($folderURL)) {
			echo("<div id='fullPageError'>The language you selected is available. Please choose another language, or place the language folder in the 'lang' directory on your server.</div>");
		}

		if(@$htmlTxt = include($fileURL)) {
			echo($htmlTxt[0]);
		} else if($debugMode == 1) {
			echo("Text error: '" . $textName . "' not found in your language");
		} else {
			echo($textName);
		}

	}
	


	function w($textName) {
		if($GLOBALS["extraPath"] ) {
			$extraPath = $GLOBALS["extraPath"];
		} else {
			$extraPath = "";
		}

		$language = getLanguage($extraPath);
		$debugMode = getDebugMode($extraPath);
		
		//replace " " for "-"
		$fileSlug = strtolower(str_replace(" ","-",$textName));

		$folderURL 	= ($extraPath."lang/" . $language . "/phrases/");
		$fileName 	= ($fileSlug);
		$fileURL 	= ($folderURL . "/" . $fileName);

		//check if the default language is set
		if(!is_null($language)) { 
			//if not, change it to en-US
			$language = "en-US";
		}

		//check if the language folder exists
		if(file_exists($folderURL) && @$htmlTxt = include($fileURL)) {
			echo(htmlspecialchars($htmlTxt[0]));
		} else if($debugMode == 1) {
			echo('<span class="langError">Lang error: "' . htmlspecialchars($textName) . '"</span>');
		} else {
			echo(htmlspecialchars($textName));
		}

	}


	function getLanguage($extraPath = "") {
		if(checkLogin($extraPath)) {
			return $GLOBALS["user"][settings][language];
		} else {
			return $GLOBALS["config"][settings][defLang];
		}
	}

	/**
		DEBUGMODE
	**/

	function getDebugMode($extraPath = "") {
		if(!isset($GLOBALS["config"])){
			$GLOBALS["config"] = parse_ini_file($extraPath."config.ini", 1);
		}
		return $GLOBALS["config"][settings][debugmode];		
	}

	/**
		PASSWORD ENCRYPTION ON ENCRYPT.ROASTOS.ORG
	**/

	function encrypt($string, $string2) {
		$str1 = hash( 'sha256', $string);
		$str2 = hash( 'sha256', $string2);
		$megaHash = file_get_contents("http://encrypt.roastos.org?v1=$str1&v2=$str2");

		return $megaHash;
	}

	/**
		RANDOM ID GENERATOR
	**/
	function rndID($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = 'win-';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

?>