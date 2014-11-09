<?php
	if(isset($_GET["w"])) {

		$GLOBALS["extraPath"] = "../../";
		include("../../backend/functions.php");

		w($_GET["w"]);
		
	} else {
		echo("<h1>Nothing to see here...</h1> <p>Move along!</p>");
	}
?>