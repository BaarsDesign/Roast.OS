$(document).bind("contextmenu",function(event){
	
	var mouseX = event.pageX;
	var mouseY = event.pageY;



	var clickedTag = $(event.target).context.tagName;
	var clickedTagParent = $(event.target).context.parentNode.tagName;

	console.log(clickedTag);

	var switchStr = clickedTagParent + "." + clickedTag;
	
	switch (switchStr) {
		case "BODY.FORM": drawContextMenu("wallpaperMenu"); break;
		case "DIV.IMG": drawContextMenu("fileMenu"); break;
	}





	function drawContextMenu(menuID) {
		var html = '<ul style="top: '+(mouseY-5)+'px; left: '+(mouseX-5)+'px;" class="contextMenu">';

		var menu = [];
		menu["fileMenu"] = 
				'<li><a href="#"><i class="fa fa-cog"></i> ' + w('Rename') + '</a>'+
				'<li><a href="#"><i class="fa fa-cog"></i> ' + w('Remove') + '</a>';

		menu["wallpaperMenu"] = 
				'<li><a href="#"><i class="fa fa-cog"></i> ' + w('Settings') + '</a>'+
				'<li><a href="#"><i class="fa fa-cog"></i> ' + w('Wallpaper') + '</a>'+
				'<li><a href="#"><i class="fa fa-cog"></i> ' + w('Settings') + '</a>';

		if(menu[menuID]) {
			html += menu[menuID];
		} else {
			html += '<li>ERROR: SUBMENU DOES NOT EXIST</li>'
		}

		html += '</ul>';
		
		$(".contextMenu").addClass("closing");
		$("body").append(html);

		$(".contextMenu").on( "mouseleave", function(event) {
			$(".contextMenu").addClass("closing");
			setTimeout(function(){
				$(".contextMenu").remove();
			},200);
		});

	}


	function w(phrase){

		$.get('../../modules/lang/getWord.php?w='+phrase, function (data) {
			return data;
		});

	}


		return false;
});