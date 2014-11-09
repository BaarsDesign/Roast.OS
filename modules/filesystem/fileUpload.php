<?php
	if(@include("backend/functions.php")) {
		$before = "";

	} else if(@include("../../backend/functions.php")) {
		$before = "../..";
	}

	//Store directory separator (DIRECTORY_SEPARATOR) to a simple variable. This is just a personal preference as we hate to type long variable name.
	$ds= DIRECTORY_SEPARATOR;
	if(isset($_POST["path"]) && checkLogin($before."/")) {



		$user = $GLOBALS["user"][account][username];
		$path = $_POST["path"];


		if($path == "Testmap") {
			header("HTTP/1.0 404 Not Found");
		}

		//Destination folder:
		$storeFolder = ("$before/users/$user/filesystem/$path/");

		//Check if file is sent to the page
		if (!empty($_FILES) && file_exists($storeFolder)) {

		    //Store the file object to a temporary variable.
		    $tempFile = $_FILES['file']['tmp_name'];         
		    
		    //Create the absolute path of the destination folder.
		    $targetPath = dirname( __FILE__ ) . $ds . $storeFolder . $ds;
		     
		    //Create the absolute path of the uploaded file destination.
		    $targetFile =  $targetPath. $_FILES['file']['name'];
		 
		 	//Move uploaded file to destination.
		    move_uploaded_file($tempFile,$targetFile);
		    
		}
	}
?>