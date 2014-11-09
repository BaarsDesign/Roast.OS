function alignIcons(element) {
	// Settings
	var hSpacing	= 140;
	var vSpacing 	= 140;
	var marginTop 	= 50;
	var marginLeft	= 0;
	var direction	= "v"; //"h" = horizontal  || "v" = vertical
	
	// Other variables (do not change)
	var colWidth 	= $(element).width();
	var rowHeight 	= $(element).height();
	var totalRows	= 0;
	var totalCols	= 0;
	var files = $(element).find("> .file");
	
	getGrid();
	arrangeIcons();

	//arrange icons
	function arrangeIcons() {
		var curIconCounter = 1;
		var curRow = 1;
		var curCol = 1;

		console.log($(element).parent().get(0).tagName);

		if(direction == "v") {
			//Arrange icons vertically
			files.each(function() {
				if (curRow > totalRows) {
					curCol++;
					curRow = 1;
				}

				$(element).find(".file"+curIconCounter).css("left", marginLeft + (hSpacing*(curCol-1)));
				$(element).find(".file"+curIconCounter).css("top", marginTop   + (vSpacing*(curRow-1)));

				console.log("row: "+curRow+"/"+totalRows+" - col: "+curCol+"/"+totalCols);

				curRow++;
				curIconCounter++;
			});

		} else if(direction == "h") {
			//Arrange icons horizontally
			files.each(function() {


				curIconCounter++;
			});

		}
	}



	function getGrid() {
		var rowFiles = 0;
		var curWidth = marginLeft;

		var colFiles = 0;
		var curHeight = marginTop;

		while (curWidth < rowHeight) {
			curWidth = curWidth + hSpacing;
			rowFiles++;
		}

		while (curHeight < colWidth) {
			curHeight = curHeight + vSpacing;
			colFiles++;
		}
		totalRows = rowFiles;
		totalCols = colFiles;
	}

}
