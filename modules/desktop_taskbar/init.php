<?php 
	$timezone = $GLOBALS["user"][settings][timezone];
	date_default_timezone_set($timezone);
?>

<div id="taskbar" class="<?php echo($GLOBALS["user"][settings][taskbarlocation]); ?>">

	<div class="left">
	
		<div class="taskbar-item">
			<img src="/themes/system/img/bean.svg" class="bean">
			<ul class="apps">
				<li class="title"><h1>Apps</h1></li>

				<?php 
					$dir	= 'apps';
					$remove	= array(".", "..");
					$files	= scandir($dir);
					$files	= array_diff($files, $remove);

					foreach($files as $file) {

						$ini = 'apps/' . $file . '/app.ini';

						//check of de app een app.ini file heeft
						if(file_exists($ini)) {

							$settings = parse_ini_file($ini, 1);
							$name = $settings[general][name];
							echo('<li class="launchApp" id="'.$file.'"><img src="/apps/'.$file.'/icon.png"><p>'.$name.'</p></li>');
						
						}
						
					}
				?>
			</ul>
		</div>
	
	</div>
	<div class="right">

		<div class="taskbar-item">
			<i class="fa fa-user fa-fw"></i> <?php echo $GLOBALS["user"][profile][firstName] ; ?> <?php echo $GLOBALS["user"][profile][lastName] ; ?>
		</div>

		<div class="taskbar-item">
			<span class="clock"><?php echo date('H:i'); php?></span>
		</div>

		<div class="taskbar-item">
			<i class="fa fa-search fa-fw"></i>
		</div>

		<div class="taskbar-item">
			<i class="fa fa-bars fa-fw"></i>
			<ul>
				<li><a href="#" class="settings"><i class="fa fa-cog"></i> <?w("settings")?></a></li>
				<li><a href="#" class="fullscreen"><i class="fa fa-arrows-alt"></i> <?w("Full screen")?></a></li>
				<li><a href="?logout"><i class="fa fa-sign-out"></i> <?w("Log out")?></a></li>
			</ul>
		</div>

	</div>

</div>