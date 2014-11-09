$(function(){

	var win = $(currentWindow);
	var sidebar = $(currentWindow).find(".sidebar");
	var browser = $(currentWindow).find(".browser");
	var moduleDir = "/apps/roast-settings/modules/";

	$(sidebar).find("> ul > li").click(function(){

		$(this).parent().parent().find("li").removeClass('active');
		$(this).addClass('active');

		var tab = $(this).attr("data-tab");
		if(tab != null) {
			$(browser).load(moduleDir + tab + ".php");
		}
	});

});