<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="resources/stylesheets/main.css" />
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="/resources/scripts/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

</head>
<body>
<div id = "main">
<div id = "boardGame">
<div id = "boardContainer">
	<table id = "board">
	</table>
</div>
</div>
<nav>
<button id="zoomIn">zoomIn</button>
<button id="zoomOut">zoomOut</button>
<button id="fitToScreen">fitToScreen</button>
</nav>
</div> <!-- #main -->

<!-- TIME FOR SCRIIIIIIIIIIPT -->
	<script type="text/javascript" charset="utf-8">

	//temp board creation
	for (var k=0; k < 100; k++)
	{
		$("<tr>").attr("id", "tr" + k).appendTo($("#board"));
		for (var i=0; i < 150; i++)
		{
			if (i == 75 && k == 50)
				$("<td>").css("background", "red").appendTo($("#tr" + k));
			else
				$("<td>").appendTo($("#tr" + k));
			
		}
	}

	// board resizing
	DEFAULT_W = $("table").css("width");
	DEFAULT_Y = $("table").css("height");
	STEP = 300;

	var i = 0;

	$("#zoomIn").click(function() {
		i++;
		$("table").draggable({containment: [-STEP * i / 2 - 5 * i, -STEP * i / 2 - 5 * i, STEP * i / 2 + 10 * i, STEP * i/ 2 + 10 * i]});
		$("table").css({ width: "+="+STEP, height: "+="+STEP, marginTop: "-="+STEP/2, marginLeft: "-="+STEP/2});
	});

	$("#zoomOut").click(function() {
		if (i != 0)
		{
			i--;
			$("table").css({ width: "-="+STEP, height: "-="+STEP, marginTop: "+="+STEP/2, marginLeft: "+="+STEP/2});
			$("table").draggable({containment: [-STEP * i / 2 - 5 * i, -STEP * i / 2 - 5 * i, STEP * i / 2 + 10 * i, STEP * i/ 2 + 10 * i]});
		}
	});

	$("#fitToScreen").click(function() {
		i = 0;
		$("table").css({ width: DEFAULT_W, height: DEFAULT_Y, top:0, left:0, marginTop:0, marginLeft:0});
		$("table").draggable("destroy");
	});
	</script>
</body>
</html>
