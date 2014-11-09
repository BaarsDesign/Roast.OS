<?php 
	$GLOBALS["extraPath"] = "../../";
	include('../../backend/functions.php');
	$id = rndID(); ?>
<div class="window" id="<?=$id?>">
	<script type="text/javascript">
		var currentWindow = $("#<?=$id?>");
	</script>
	<script type="text/javascript" src="apps/roast-radar/app.js"></script>
	<div class="toolbar">
		<span class="close"></span>
		<span class="minimize"></span>
		<span class="maximize"></span>
		<span class="title">Radar</span>
	</div>
	<div class="content">
		<div class="sidebar">
			
			<h1><?w("Categories")?></h1>
			<ul>
				<li><i class="fa fa-picture-o fa-fw"></i> <?w("Images")?></li>
				<li><i class="fa fa-music fa-fw"></i> <?w("Music")?></li>
				<li><i class="fa fa-video-camera fa-fw"></i> <?w("Videos")?></li>
				<li><i class="fa fa-file-text fa-fw"></i> <?w("Documents")?></li>
			</ul>

			<h1><?w("Folders")?></h1>
			<ul>
				<?php folderList(); ?>
				<li id="addFolder"><i class="fa fa-plus-square fa-fw"></i> <?w("Add folder")?></li>
			</ul>

		</div>
		<div class="main">

			<div class="toolbar">
				<ul>
					<li class="upload" title="<?w("Upload")?>"><i class="fa fa-upload"></i></li>
				</ul>
			</div>
			<div class="browser droppable"></div>
		
		</div>
	</div>

</div>




<?php

	function folderList(){
		$user = $_COOKIE[user];
		$html = '';
		$dir  = '../../users/'.$user.'/filesystem';

		$remove	= array(".", "..");
		$files	= scandir($dir);
		$files	= array_diff($files, $remove);

		foreach($files as $file) {
			//zorg dat de system map niet wordt getoond
			if($file != "system") {
				$html .= ('<li class="folder" data-path="'.$file.'"><i class="fa fa-folder"></i> '.$file.'</li>');
			}
		}

		echo $html;
	}

?>