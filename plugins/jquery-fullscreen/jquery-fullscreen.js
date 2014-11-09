$(document).ready(function(){
	
	var docElement, request;

	docElement = document.documentElement;
	request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;

	if(typeof request!="undefined" && request){
		request.call(docElement);
	}

	$(".fullscreen").on('click', function() {

		//check of de browser op full screen modus staat
		if (screen.width == window.innerWidth && screen.height == window.innerHeight) {
			//als dat zo is > exit full screen
			exitFullScreen();
			
		} else {
			//als dat niet zo is > ga naar full screen
			fullScreen();
		}
	});
});

function fullScreen() {
	var docElement, request;

	docElement = document.documentElement;
	request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;

	if(typeof request!="undefined" && request){
		request.call(docElement);
	}
}

function exitFullScreen() {
	var docElement, request;

	docElement = document;
	request = docElement.cancelFullScreen|| docElement.webkitCancelFullScreen || docElement.mozCancelFullScreen || docElement.msCancelFullScreen || docElement.exitFullscreen;
	if(typeof request!="undefined" && request){
		request.call(docElement);
	}
}