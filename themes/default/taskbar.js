$(document).ready(function(){

	$('#taskbar .taskbar-item ul').parent().click(function(){
		$('.dropdown').removeClass('dropdown');
		$(this).addClass('dropdown');
	});

	$('#taskbar').mouseleave(function(){
		$('.dropdown').removeClass('dropdown');
	});

});