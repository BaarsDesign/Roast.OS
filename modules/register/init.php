<?php

	//check if the form is filled in
	if(empty($_POST)) {

		//nope, the form is empty
		include("registerForm.php");

	} else {
		//yup, the form has been used

		foreach ($_POST as $key => $value) {
			//check if the field is filled in
			if(empty($value)) {
				//if not, add the field to $wrong array
				$GLOBALS["wrong"][] = $key;
			}
		}

		//check of er lege velden zijn
		if(empty($GLOBALS["wrong"])) {
			//maak het account
			showLoadPage($_SERVER['PHP_SELF']);
			createAccount($_POST);

		} else {
			//er zijn fouten
			include("registerForm.php");
		}

		
	}

	function wrongClass($field) {
		//check if the current field is in the $wrong array
		if(!empty($_POST)) {
			if(in_array($field, $GLOBALS["wrong"])) {
				//if so, echo "wrong"
				echo('wrong');
			}
		}
	}

	//echo the original input the user typed before
	function userInput($field) {
		echo($_POST[$field]);
	}

?>