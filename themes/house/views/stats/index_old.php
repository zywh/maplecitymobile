<div class="cl"></div>

<div class="stats">
	<div class="statsmonth">
	</div>
	<div id="statsyear" width="960" height="640">
	
	</div>

</div>
<script src="http://cdn.zingchart.com/zingchart.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
<script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.1.1/dygraph-combined.js"></script>

<script type="text/javascript">

 
   var chartData={
    "type":"bar",  // Specify your chart type here.
    "series":[  // Insert your series data here.
        { "values": [35, 42, 67, 89]},
        { "values": [28, 40, 39, 36]}
    ]
  };
  zingchart.render({ // Render Method[3]
    id:'statsyear',
    data:chartData,
    height:400,
    width:600
  });
 
  google.load('visualization', '1', {'packages':['timeline']});
  
  //  
  //// Set a callback to run when the Google Visualization API is loaded.
  
  
  
  google.setOnLoadCallback(drawChart);
	//
	
	
	
	function drawChart() {
		
    $.ajax({
        url: '<?php echo Yii::app()->createUrl('stats/getData'); ?>',
        dataType: "json",
        success: function(result) {
			
			var data = new google.visualization.DataTable();
			data.addColumn('datetime', 'Time');
			data.addColumn('number', 'Price');
			
			$(result.YearData).each(function(index) {
				//console.log(this.AvgPrice);
				var array = [ new Date(this.Date) ,Number(this.AvgPrice)];
				data.addRow(array);
			
			});
			
			//data.sort({column: 1, desc: true}); 
			var csv = google.visualization.dataTableToCsv(data);
			console.log(csv);
			//new Dygraph(document.getElementById("statsyear"),data );
		}
	});
 
	}

	
</script>