<script>
	function respChartLine(selector, data, options){

		// Define default option for line chart
		var option = {
			scaleOverlay : false,
			scaleOverride : false,
			scaleSteps : null,
			scaleStepWidth : null,
			scaleStartValue : null,
			scaleLineColor : "rgba(0,0,0,.1)",
			scaleLineWidth : 1,
			scaleShowLabels : true,
			scaleLabel : "<%=value%>",
			scaleFontFamily : "'Arial'",
			scaleFontSize : 12,
			scaleFontStyle : "normal",
			scaleFontColor : "#666",	
			scaleShowGridLines : true,
			scaleGridLineColor : "rgba(0,0,0,.05)",
			scaleGridLineWidth : 1,	
			bezierCurve : true,
			pointDot : true,
			pointDotRadius : 3,
			pointDotStrokeWidth : 1,
			datasetStroke : true,
			datasetStrokeWidth : 2,
			datasetFill : true,
			animation : true,
			animationSteps : 60,
			animationEasing : "easeOutQuart",
			onAnimationComplete : null
		}

		// check if the option is override to exact options 
		// (bar, pie and other)
		if (options == false || options == null){
			options = option;
		} 

		// get selector by context
		var ctx = selector.get(0).getContext("2d");
		// pointing parent container to make chart js inherit its width
		var container = $(selector).parent();

		// enable resizing matter
		$(window).resize( generateChart );

		// this function produce the responsive Chart JS
		function generateChart(){
			// make chart width fit with its container
			var ww = selector.attr('width', $(container).width() );
			// Initiate new chart or Redraw
			new Chart(ctx).Line(data, options);
		};

		// run function - render chart at first load
		generateChart();

	}
	
	function respChartBar(selector, data, options){

		// Define default option for line chart
		var option = {
		
			//Boolean - If we show the scale above the chart data			
			scaleOverlay : false,

			
				//Boolean - If we want to override with a hard coded scale
				scaleOverride : false,
            	
				//** Required if scaleOverride is true **
				//Number - The number of steps in a hard coded scale
				scaleSteps : null,
				//Number - The value jump in the hard coded scale
				scaleStepWidth : null,
				//Number - The scale starting value
				scaleStartValue : null,


			//String - Colour of the scale line	
			scaleLineColor : "rgba(0,0,0,.1)",

			//Number - Pixel width of the scale line	
			scaleLineWidth : 1,

			//Boolean - Whether to show labels on the scale	
			scaleShowLabels : true,

			//Interpolated JS string - can access value
			scaleLabel : "<%=value%>",

			//String - Scale label font declaration for the scale label
			scaleFontFamily : "'Arial'",

			//Number - Scale label font size in pixels	
			scaleFontSize : 12,

			//String - Scale label font weight style	
			scaleFontStyle : "normal",

			//String - Scale label font colour	
			scaleFontColor : "#666",	

			///Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines : true,

			//String - Colour of the grid lines
			scaleGridLineColor : "rgba(0,0,0,.05)",

			//Number - Width of the grid lines
			scaleGridLineWidth : 1,	

			//Boolean - If there is a stroke on each bar	
			barShowStroke : true,

			//Number - Pixel width of the bar stroke	
			barStrokeWidth : 2,

			//Number - Spacing between each of the X value sets
			barValueSpacing : 5,

			//Number - Spacing between data sets within X values
			barDatasetSpacing : 1,

			//Boolean - Whether to animate the chart
			animation : true,

			//Number - Number of animation steps
			animationSteps : 60,

			//String - Animation easing effect
			animationEasing : "easeOutQuart",

			//Function - Fires when the animation is complete
			onAnimationComplete : null

		}

		// check if the option is override to exact options 
		// (bar, pie and other)
		if (options == false || options == null){
			options = option;
		} 

		// get selector by context
		var ctx = selector.get(0).getContext("2d");
		// pointing parent container to make chart js inherit its width
		var container = $(selector).parent();

		// enable resizing matter
		$(window).resize( generateChart );

		// this function produce the responsive Chart JS
		function generateChart(){
			// make chart width fit with its container
			var ww = selector.attr('width', $(container).width() );
			// Initiate new chart or Redraw
			new Chart(ctx).Bar(data, options);
		};

		// run function - render chart at first load
		generateChart();

	}
	
	respChartLine($("#hours"), hoursData);
	
</script>