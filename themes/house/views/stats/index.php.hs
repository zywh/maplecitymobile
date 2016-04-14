	    <script src="http://code.highcharts.com/stock/highstock.js"></script>
		<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>


		<div id="container" style="height: 500px; min-width: 500px"></div>
	
<script type="text/javascript">
	

		//$.getJSON('/test/high/csvparse.php?callback=?', function(data) {
				// Create the chart
		 $.ajax({
			url: '<?php echo Yii::app()->createUrl('stats/getData'); ?>',
			dataType: "json",
			success: function(result) {		
			
				var data = [];	
				$(result.YearData).each(function(index) {
				
				//mydate=this.Date.split("-");
				
				
				//JS month is 0-based. So -1 get right month in Highchart
				//array = [  Date.UTC(mydate[0],mydate[1]-1,mydate[2]) ,Number(this.AvgPrice)];
				array = [ Number(this.Date) ,Number(this.AvgPrice)];
				//console.log(this.Date);
				data.push(array);
			
				});
				
				console.log(data);
				$('#container').highcharts('StockChart', {
					
		
					rangeSelector : {
						selected : 1
					},
		
					title : {
						text : '房屋价格'
					},
					
					series : [{
						name : '价格',
						data : data,
						tooltip: {
							valueDecimals: 2
						}
					}]
				});
			}
		});
		

		
</script>

