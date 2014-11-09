<?php 

	$name = $_GET[name];
	$userFolder = $_COOKIE["user"];

	if(ctype_alpha($name)) {
		
	}


	if (preg_match('/\^[0-9a-z A-Z]+\$/', $name, $matches)) {

		echo("Name not possible.");

	} else {

		$path = "../../users/$userFolder/filesystem/$name";
		if(!file_exists($path)) {


			if (mkdir($path, 0777, true)) {

				//Als de map is gemaakt, geef weer
			    echo('<i class="fa fa-folder"></i> '.$name);

			} else {

				//als er iets mis ging: 
				echo('<div><i class="fa fa-folder"></i><input type="text" autofocus autocomplete="off" name="folderName"></div>');

			}
		} else {
			echo('<div><i class="fa fa-folder"></i><input type="text" autofocus autocomplete="off" name="folderName"></div>');
		}
	}
?>