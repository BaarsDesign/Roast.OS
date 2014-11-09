<?php
	$GLOBALS["dekstop"] = parse_ini_file("modules/desktop/config.ini", 1);
?>


<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($GLOBALS["config"][general][title]); ?></title>
		
		<meta name='keywords' content=''>
		<meta name='description' content='' />
		<meta name='robots' content='index, follow' />
		<meta name='language' content='dutch, nl'>
		<meta name='content-language' content='dutch, nl'>
		<meta name='distribution' content='global' />

		<link rel="shortcut icon" type="image/png" href="/themes/system/img/favicon.png"/>
		<link rel="stylesheet" type="text/css" href="/themes/<?php echo $GLOBALS["user"][settings][theme]; ?>/style.css">
		<link rel="stylesheet" type="text/css" href="/plugins/fontawesome/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="/plugins/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="/modules/userStyle/userStyle.php">

		<script type="text/javascript" src="/plugins/jquery/jquery.js"></script>
		<script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.js"></script>

		<script type="text/javascript" src="/plugins/jquery-ui/jquery-ui-init.js"></script>
		<script type="text/javascript" src="/plugins/jquery-contextmenu/jquery-contextmenu.js"></script>
		<script type="text/javascript" src="/plugins/jquery-contextmenu/jquery-contextmenu-init.js"></script>
		<script type="text/javascript" src="/plugins/jquery-launchApp/jquery-launchApp.js"></script>
		<script type="text/javascript" src="/plugins/jquery-clock/jquery-clock.js"></script>
		<script type="text/javascript" src="/plugins/jquery-fullscreen/jquery-fullscreen.js"></script>
		<script type="text/javascript" src="/plugins/jquery-dropzone/jquery-dropzone.js"></script>
		<script type="text/javascript" src="/plugins/jquery-iconAlign/jquery-iconAlign.js"></script>

		<script type="text/javascript" src="/themes/<?php echo $GLOBALS["user"][settings][theme]; ?>/taskbar.js"></script>

	</head>
	<body data-path="system/desktop">
	<audio autoplay class="hidden">
		<source src="/themes/system/sound/login.mp3" type="audio/mpeg">
		<source src="/themes/system/sound/login.wav" type="audio/wav">
		<source src="/themes/system/sound/login.ogg" type="audio/ogg">
	</audio>