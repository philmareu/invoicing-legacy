<script>
	
	var hoursData = {
		labels : {{ json_encode($hoursData['labels']) }},
		datasets : [
			{
				fillColor : "rgba(39, 174, 96,0.5)",
				strokeColor : "rgba(39, 174, 96,1)",
				pointColor : "rgba(39, 174, 96,1)",
				pointStrokeColor : "#fff",
				data : {{ json_encode($hoursData['billable']) }}
			},
			{
				fillColor : "rgba(192, 57, 43,0.5)",
				strokeColor : "rgba(192, 57, 43,1)",
				pointColor : "rgba(192, 57, 43,1)",
				pointStrokeColor : "#fff",
				data : {{ json_encode($hoursData['nonbillable']) }}
			}
		]
	};

</script>