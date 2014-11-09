<?php 
	$GLOBALS["extraPath"] = "../../";
	include('../../backend/functions.php');
	$id = rndID();
?>

<div class="window settings" id="<?=$id?>">

	<script type="text/javascript">
		var currentWindow = $("#<?=$id?>");
	</script>
	<script type="text/javascript" src="apps/roast-settings/app.js"></script>
	<link rel="stylesheet" type="text/css" href="apps/roast-settings/app.css">

	<div class="toolbar">
		<span class="close"></span>
		<span class="minimize"></span>
		<span class="maximize"></span>
		<span class="title">Settings</span>
	</div>
	<div class="content">
		<div class="sidebar">
			<h1><?w("Personal")?></h1>
			<ul>
				<li data-tab="view"><i class="fa fa-desktop fa-fw"></i> <?w("View")?></li>
				<li data-tab="language"><i class="fa fa-globe fa-fw"></i> <?w("Language")?></li>
				<li data-tab="profile"><i class="fa fa-user fa-fw"></i> <?w("Profile")?></li>

			</ul>

			<h1><?w("General")?></h1>
			<ul>
				<li data-tab="users"><i class="fa fa-users fa-fw"></i> <?w("Users")?></li>
			</ul>

		</div>
		<div class="main">

			<div class="browser"></div>
		
		</div>
	</div>

</div>