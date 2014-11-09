$(function(){

	var win = $(currentWindow);

	// - - - - - - - - - - SIDEBAR - - - - - - - - - - \\
	$(win).find("li.folder").click(function(){

		$(this).parent().parent().find("li").removeClass('active');
		$(this).addClass('active');

		var path = $(this).attr("data-path");
		
		$(win).find(".browser").load("/modules/filesystem/openDir.php?path="+path, function(){
			var iconContainer = $(win).find(".browser > form");
			alignIcons(iconContainer);
		}).attr("data-path", path);
	});

	$(win).find("li#addFolder").click(function(){
		if(!$(this).hasClass('active')) {
			$(this).addClass('active');
			$('<li class="folder justAdded" data-path=""><form><i class="fa fa-folder"></i><input type="text" autofocus autocomplete="off" name="folderName"><input type="submit"></form></li>').insertBefore(this);
		}

		$(".justAdded form").submit(function(event) {

			var folderName 	= $(this).find("input:first").val();

			addFolder("", folderName);
			
			event.preventDefault();
		});
	});

	

	function addFolder(path, folderName) {

		var accepted = /^[0-9a-z A-Z]+$/;
		var inputVal = (folderName);
		var fullPath = ("/modules/filesystem/createDir.php?path="+path+"/&name=" + inputVal);

		if (inputVal.match(accepted)) {

			$(win).find("li#addFolder").removeClass('active');
			
			$(".justAdded").load(fullPath, function() {

				if ($(".justAdded").find("input").length != 0) {
					$(".justAdded").addClass('wrong');
				} else {
					$(".justAdded").removeClass('justAdded');
				}

			});

		} else {
			$(".justAdded").addClass('wrong');
		}
	}

});