$(document).ready(function(){
	addWindowHandler();
});

function addWindowHandler() {
	/*========================================
	====     _____                        ====
	====    |_   _|                       ====
	====      | |  ___ ___  _ __  ___     ====
	====      | | / __/ _ \| '_ \/ __|    ====
	====     _| || (_| (_) | | | \__ \    ====
	====    |_____\___\___/|_| |_|___/    ====
	====                                  ====
	========================================*/

	$(".file").not(".fixed").draggable({
		scroll: false,	//desktop scrolt niet mee
		handle: 'img, .square, p', //alleen aan de bovenkant draggable
		distance: 4,	//minimale afstand: 4px;

  		placeholder: "sortable-placeholder",
		stop: function(e, ui) {
			
			var gridOffset_x = 0;
		    var gridOffset_y = 50;
			var grid_x = 140;
			var grid_y = 140;
			var elem = $(this);
			var left = parseInt(elem.css('left'))-gridOffset_x;
			var top = parseInt(elem.css('top'))-gridOffset_y;
			var cx = (left % grid_x);
			var cy = (top % grid_y);

			var new_left = (Math.abs(cx)+0.5*grid_x >= grid_x) ? (left - cx + (left/Math.abs(left))*grid_x) : (left - cx);
			var new_top = (Math.abs(cy)+0.5*grid_y >= grid_y) ? (top - cy + (top/Math.abs(top))*grid_y) : (top - cy);

			ui.helper.stop(true).animate({
				left: new_left+gridOffset_x,
				top: new_top+gridOffset_y
			}, 200);

			if($('.file').filter(function() {return $(this).offset().top == new_top && $(this).offset().left == new_left;}).length != 0) {
				console.log("er staat al iets op deze positie");
			}

		}
	});

	$(".file").dblclick(function(event) {
		var fileType = $(this).attr("data-type");
		var fileLocation = $(this).attr("data-path");
		var fileName = $(this).attr("data-name");
		var openWith = $(this).attr("data-app");

		var path = fileLocation + "/" + fileName;
		if(openWith == "this") {
			$(currentWindow).find(".browser").load("/modules/filesystem/openDir.php?path=" + path);
	
		} else if(openWith == "unknown") {
			//Open bestand, maar weet niet waarmee
			alert("Don't know how to open " + fileType + ": " + fileLocation + "/" + fileName);


		} else {
			//bestand openen met een app
			alert("Opening " + fileType + ": " + fileLocation + "/" + fileName + " with: " + openWith);

		}
	});

	$("body > form, .window .droppable").droppable({
		accept: ".file",
		greedy: true,
      	drop: function( event, ui ) {

      		var extraOffset = 0;

			if($(this).parents('.window').length != 0) {
				extraOffset = 50;
			}


      		var fromWindow = 0;
        	var windowTop = $(this).offset().top;
        	var windowLeft = $(this).offset().left;
        	var dropTop = $(ui.draggable).offset().top+extraOffset;
        	var dropLeft = $(ui.draggable).offset().left;

        	$(ui.draggable).css("top", dropTop - windowTop);
        	$(ui.draggable).css("left", dropLeft - windowLeft);

        	$(ui.draggable).appendTo($(this));

        	//Trigger move event

			var fileToMove = $(".ui-draggable-dragging").attr("data-name");
			var moveFileFrom = $(".ui-draggable-dragging").attr("data-path");
			var moveFileTo = $(this).attr("data-path");
			var moveFileURL= ("/modules/filesystem/fileMove.php?file=" + fileToMove + "&source=" + moveFileFrom + "&target=" + moveFileTo);

			$.get(moveFileURL);

			

      	}
    });

	/*============================================================
	====    __          ___           _                       ====
	====    \ \        / (_)         | |                      ====
	====     \ \  /\  / / _ _ __   __| | _____      _____     ====
	====      \ \/  \/ / | | '_ \ / _` |/ _ \ \ /\ / / __|    ====
	====       \  /\  /  | | | | | (_| | (_) \ V  V /\__ \    ====
	====        \/  \/   |_|_| |_|\__,_|\___/ \_/\_/ |___/    ====
	====                                                      ====
	============================================================*/

	var addedWindow = $(".window").last();

	$(window).resize(function() {
		moveInViewport($(".window"));
	});

	centerWindow(addedWindow);
	moveInViewport($(".window"));

	//window slepen
	addedWindow.not(".fixed").draggable({
		scroll: false,	//desktop scrolt niet mee
		handle: '.toolbar', //alleen aan de bovenkant draggable
		distance: 4,	//minimale afstand: 4px;
		stop: function() {moveInViewport($(this));}
	}).resizable({
		minHeight: 150,
		minWidth: 200
    });


	/* TOOLBAR ACTIONS */

	//Close button
	$(addedWindow).find(".toolbar .close").click(function(event) {

		$(this).parents(".window").addClass('closing');

		setTimeout(function(){
			$(".window.closing").remove();
		},500);

	});

	//Minimize
	$(addedWindow).find(".toolbar .minimize").click(function(event) {
		$(this).parents(".window").addClass('minimized');
	});

	$('body').delegate(".window.minimized", "click", function(event) {
		if(!$( event.target ).hasClass('minimize')) {
			$(this).removeClass('minimized');
		}
	});
}

function moveInViewport(target) {
	var taskbarPos 		= $("#taskbar.top").length; //  0 = beneden  ||  1 = boven
	var taskbarHeight 	= parseInt($("#taskbar").outerHeight());
	var windowTop 		= parseInt($(target).css("top"));
	var toolbarHeight 	= parseInt($(target).find(".toolbar").outerHeight());
	var toolbarBottom 	= parseInt(windowTop + toolbarHeight);
	var documentHeight 	= parseInt($(document).outerHeight());

	//als de taskbar aan de bovenkant is en de window valt daar overheen
	if(taskbarPos == 1 && windowTop < taskbarHeight) {

		$(target).css("top", taskbarHeight+"px");

	} else if(taskbarPos == 1 && toolbarBottom > documentHeight) {

		$(target).css("top", documentHeight-toolbarHeight+"px");
	
	}

}

function centerWindow(targetWindow) {
	var offsetTop = ($(document).outerHeight()/2) - $(".window").height()/2;
	var offsetLeft = ($(document).outerWidth()/2) - $(".window").width()/2;

	$(targetWindow).css("top", offsetTop+"px");
	$(targetWindow).css("left", offsetLeft+"px");
}