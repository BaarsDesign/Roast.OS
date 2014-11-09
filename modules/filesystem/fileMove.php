<?php
	
	include("../../backend/functions.php");
	$before = "../..";	

	if(checkLogin("../../")) {

		$user = $GLOBALS["user"][account][username];

		$file   = $_GET[file];
		$source = $_GET[source];
		$target = $_GET[target];

		$userdir= "../../users/$user/filesystem";

		$from = $userdir . "/" . $source . "/" . $file;
		$to   = $userdir . "/" . $target . "/" . $file;
		
		rename($from, $to);

	} else {
		echo("YOU ARE NOT LOGGED IN");
	}

?>