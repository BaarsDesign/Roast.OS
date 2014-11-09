<script type="text/javascript">
	$(document).ready(function(){

		var URL = "/modules/filesystem/openDir.php?path=system/desktop";
		
		$.get(URL, function(data){
			$("body").append(data);
			var iconContainer = $("body > form");
			alignIcons(iconContainer);
		});

	});
</script>