$(document).ready(function(){
	$("#taskbar li.launchApp").click(function(){
		var appID = $(this).attr("id");
		launchApp(appID);
	});

	$("body > div.launchApp").dblclick(function(){
		var appID = $(this).attr("id");
		launchApp(appID);
	});
});

function launchApp(appID){
	$.get("/apps/"+appID+"/app.php", doSomethingWithData);

	function doSomethingWithData(appData) {
		$("body").append(appData);
		addWindowHandler();
	}
}