<script>

	var salesData = {
		labels : {{ json_encode($salesData['labels']) }},
		datasets : [
			{
				fillColor : "rgba(39, 174, 96,0.5)",
				strokeColor : "rgba(39, 174, 96,1)",
				pointColor : "rgba(39, 174, 96,1)",
				pointStrokeColor : "#fff",
				data : {{ json_encode($salesData['sales']) }}
			}
		]
	};

</script>