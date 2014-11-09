<?php 
	//This user   >settings
	//Other users >settings
	//add user

	$GLOBALS["extraPath"] = "../../../";
	include('../../../backend/functions.php');

	$username = $user[account][username];
?>
<div class="users">
	<h1><?w("Users")?></h1>
	<?userList()?>
</div>


<?php 
	function userList(){
		$html = '<ul>';
		$dir  = '../../../users/';

		$remove	= array(".", "..");
		$users	= scandir($dir);
		$users	= array_diff($users, $remove);

		foreach($users as $user) {

			$userInfo = parse_ini_file($dir.$user."/profile.ini", 1);

			$c_username = $userInfo[account][username];
			$c_firstName = $userInfo[profile][firstName];
			$c_lastName = $userInfo[profile][lastName];
			$c_gender = $userInfo[profile][gender];

			$img = file_exists("../../../users/" . $c_username . "/profile.jpg"); 
			if($img) {
				$imgHTML = '<img src="/users/'.$c_username.'/profile.jpg">';
			} else {
				$imgHTML = '<img src="/themes/system/img/profile-'.$c_gender.'.jpg">';
			}

			$html .='<li>'.
					'	<div class="imageContainer">' .
					 		$imgHTML .
					'	</div>' .
					'	<span>'.$c_firstName." ".$c_lastName.'</span>'.
					  	$c_username .
					'</li>';

		}

		$html .= '</ul>';

		echo $html;
	}
?>