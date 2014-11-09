<?php 
	//This user   >settings
	//Other users >settings
	//add user
	$GLOBALS["extraPath"] = "../../../";
	include('../../../backend/functions.php');

	$u_username 	= $user[account][username];
	$u_firstName 	= $user[profile][firstName];
	$u_lastName 	= $user[profile][lastName];
	$u_gender 	= $user[profile][gender];
	$u_email 		= $user[profile][email];
?>
<div class="profile">
	<div class="userWallpaper"></div>
	<div class="profileIMG">
		<?php
			if(file_exists("../../../users/" . $u_username . "/profile.jpg")) {
				echo '<img src="/users/'.$u_username.'/profile.jpg">';
			} else {
				echo '<img src="/themes/system/img/profile-'.$u_gender.'.jpg">';
			}
		?>
		<span class="editIMG"><i class="fa fa-pencil"></i> <?w("Edit")?></span>
	</div>
	<h1><?=$u_firstName?> <?=$u_lastName?> <span class="edit name"><i class="fa fa-pencil"></i></span></h1>
	<div class="currentUser">
		
		<p>
			<span><?w("Username")?>:</span>
			<?=$u_username?>
			<span class="edit username"><i class="fa fa-pencil"></i></span>
			
		</p>
		<p>
			<span><?w("Password")?>:</span>
			********
			<span class="edit password"><i class="fa fa-pencil"></i></span>
		</p>
		<p>
			<span><?w("Email")?>:</span>
			<?=$u_email?>
			<span class="edit email"><i class="fa fa-pencil"></i></span>
		</p>
		
	</div>
</div>