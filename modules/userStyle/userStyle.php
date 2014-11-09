<?php
	header("Content-type: text/css");

	$username = $_COOKIE["user"];
	$GLOBALS["user"] = parse_ini_file("../../users/{$username}/profile.ini", 1);

	$settings = $GLOBALS["user"][settings];

	$wallpaper = explode("/", $settings[wallpaper]);
	$walltype = $wallpaper[0];
	$wallspec = $wallpaper[1];

	if($walltype == "def") {
		$backgroundStyle = "background-image: url(/themes/system/wallpapers/{$wallspec});";
	} else if($wallpaper[0] == "col") {
		$backgroundStyle = "background-color: #{$wallspec};";
	}
?>

body, .userWallpaper {
	<?php echo($backgroundStyle); ?>
}