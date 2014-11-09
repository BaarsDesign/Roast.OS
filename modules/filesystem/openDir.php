<?php 
	if(!@include("backend/functions.php")){
		include("../../backend/functions.php");
	}
	$username = $_COOKIE["user"];

	//Load INI file
	
	$ini ="users/{$username}/profile.ini";

	if(!file_exists($ini)) {
		$ini = "../../" . $ini;
	}
	$GLOBALS["user"] = parse_ini_file($ini, 1);
	

	//SET VARIABLES
	$theme   = $GLOBALS["user"][settings][theme];
	$path    = $_GET[path];
	$user    = $_COOKIE["user"];
	$html    = '';
	$rootdir = 'users/'.$user.'/filesystem/'.$path; //relative from root
	$htmldir = '/'.$rootdir; //absolute dir (CLIENT SIDE)
	$dir     = '../../'.$rootdir; //relative from module
	$rndID   = "dropZone" . rndID(); //ID voor dropzone


	//check which of the $dir variables we need to use
	if(!is_dir($dir)) {
		if(is_dir($path)) {
			$dir = $path;
		} else if(is_dir($htmldir)){
			$dir = $htmldir;
		} else if(is_dir($rootdir)){
			$dir = $rootdir;
		}
	}

	if(!file_exists($dir)) {

		$html .=("<h1>Oops!</h1><h2>This folder doesn't exist...</h2>");
		$html .=("<p>You tried to open <strong>$dir</strong> which doesn't seem to exist.</p>");
		
	} else {

		$remove	= array(".", "..");
		$files	= scandir($dir);
		$files	= array_diff($files, $remove);

		//get file type
		$settings = parse_ini_file('fileHandling.ini', 1);
		$openWith = $settings[typeApp];
		$settings = $settings[fileHandling];

		$fileNum  = 0;

		foreach($files as $file) {
			$fileNum++;
			
			if(is_dir("$dir/$file")) {
				//het bestand is een directory
				$fileType = "dir";

			} else {

				//get file extention
				$extention = explode(".", $file);
				$extention = $extention[count($extention) - 1];

				if(isset($settings[$extention])) {
					if($extention == "") {
						//geen extentie
						$fileType = "none";
					} else {
						//bekende extentie
						$fileType = $settings[$extention];

						$app = $openWith[$fileType];
					}
				} else {
					//onbekende extentie
					$fileType = "unknown";
				}
			}
			
			if(isset($app)){
				//File has an app linked to it
				$html .= '<div class="ui-draggable file file'.$fileNum.'" data-path="'.$path.'" data-name="'.$file.'" data-type="'.$fileType.'" data-app="'.$app.'">';
			} else if($fileType == "dir") {
				//file is a directory
				$html .= '<div class="ui-draggable file file'.$fileNum.'" data-path="'.$path.'" data-name="'.$file.'" data-type="'.$fileType.'" data-app="this">';
			} else {
				//filetype or app unknown
				$html .= '<div class="ui-draggable file file'.$fileNum.'" data-path="'.$path.'" data-name="'.$file.'" data-type="'.$fileType.'" data-app="unknown">';
			}


			switch($fileType) {
				case "image":
					$html .= '<div class="square" style="background-image: url(' . $htmldir . '/' . $file . ');"></div>';
				break;

				case "unknown":
					$html .= '<img src="/themes/'.$theme.'/icons/file_unknown.svg">';
				break;

				case "none":
					$html .= 'none';
				break;

				default:
					$html .= '<img src="/themes/'.$theme.'/icons/file_'.$fileType.'.svg">';
				break;
			}
			
			$html .= '<p>' . $file . '</p>';
			$html .= '</div>';
		}

		if($html == "") {

			//geen bestanden
			$html .=('<div class="empty"><p>No files yet.</p></div>');

		} else {
			$html .= '<script type="text/javascript">'.
		 				'addWindowHandler();'.
					 '</script>';
		}

	
		$html = '<form id="'.$rndID.'" data-path="'.$path.'" action="/modules/filesystem/fileUpload.php" method="POST" enctype="multipart/form-data" class="dropzone">'.
					'<input type="hidden" name="path" value="'.$path.'">'.
					'<div class="fallback">'.
						'<input name="file" type="file" multiple />'.
						'<input type="submit">'.
					'</div>'. 
					$html;
		$html .= 	
				'</form>'.
				 '<script type="text/javascript">'.
					'var fileUpload = new Dropzone("#'.$rndID.'", { url: "/modules/filesystem/fileUpload.php"});'.
				 '</script>';

		echo $html;
	}
?>