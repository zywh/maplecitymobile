          <script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>

       

<div class="cl"></div>

<div class="chartcontainer">
        <div class="chartbox" id="chart1">
        </div>
        <div class="chartbox" id="chart2" >
        </div>
		<div class="chartbox" id="chart3" >
        </div>
		<div class="chartbox" id="chart4" >
        </div>
		
</div>

<div class="cl"></div>
	
<script type="text/javascript">
	

		
		 $.ajax({
			url: '<?php echo Yii::app()->createUrl('stats/getMlsData'); ?>',
			dataType: "json",
			success: function(result) {		
			    
				
				var seriesOptions = [];
				
				//Chinese Name for Series
				cnnames = {	'all_avgprice':'所有房源：平均房价', 
							'condo_avgprice':'楼房：平均房价',
							'detach_avgprice':'独立房：平均房价' ,
							'all_moi':'所有房源：存量月份', 
							'condo_moi':'楼房：存量月份',
							'detach_moi':'独立房：存量月份' ,
							'all_avgsplp':'所有房源：成交价/挂盘价比', 
							'condo_avgsplp':'楼房：成交价/挂盘价比',
							'detach_avgsplp':'独立房：成交价/挂盘价比',
							'all_avgdom':'所有房源：平均售出日', 
							'condo_avgdom':'楼房：平均售出日',
							'detach_avgdom':'独立房：平均售出日' 
							
							};
				
			    $.each(result.mlsdata, function (type, value) {
					
					//loop through data field
					$.each(value, function (f, data) {
					
						var seriesname = type + "_" + f;  //all_avgprice
						var chartdata = [];
						
						//Loop through each day
						$(data).each(function(index) {
							var array = [ Number(this[0]) ,Number(this[1])];
							chartdata.push(array);
						});
						seriesOptions[seriesname] = {
							name: cnnames[seriesname],
							data: chartdata,
							tooltip: {
							valueDecimals: 2
							}
						};
					
					});
				});
            
	
				
			
					
				var c1options = {
					credits: { enabled: false },
					chart: { zoomType: 'x'},
					rangeSelector : {selected : 5},
					legend: {enabled: true },
					navigator : { enabled : false},

					title : {
						useHTML: true,
						text : '<div class="chart_title">大多地区房产-历史成交图表</div>'
					},
					subtitle : {
						useHTML: true,
						text : '<div class="chart_subtitle">成交金额/成交量</div>'
						
					},
					
					 yAxis: {
						opposite: false,
						title: {text: '平均价格'}
					},
					
                    
					
					series: [ seriesOptions.all_avgprice,
					 seriesOptions.detach_avgprice,
					 seriesOptions.condo_avgprice
					]
					

				};

				$('#chart1').highcharts('StockChart', c1options);
				//End of Chart1
				
				
				var c2options = {
					credits: { enabled: false },
					chart: { zoomType: 'x'},
					rangeSelector : {selected : 5},
					legend: {enabled: true },
					navigator : { enabled : false},
					title : {
						useHTML: true,
						text : '<div class="chart_title">大多地区库存月份图表</div>'
					},
					subtitle : {
						useHTML: true,
						text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
					},
					yAxis: {
						opposite: false,
						title: {text: '平均库存月份'}
					},
					series: [ seriesOptions.all_moi,
					 seriesOptions.detach_moi,
					 seriesOptions.condo_moi
					]
					
				}

				$('#chart2').highcharts('StockChart', c2options);
				//End of Chart2
					
				
				var c3options = {
					credits: { enabled: false },
					chart: { zoomType: 'x'},
					rangeSelector : {selected : 5},
					legend: {enabled: true },
					navigator : { enabled : false},
		
					title : {
						useHTML: true,
						text : '<div class="chart_title">大多地区房产-平均销售日期图表</div>'
					},
					subtitle : {
						useHTML: true,
						text : '<div class="chart_subtitle">上市到售出的平均时间</div>'
					},
					yAxis: {
						opposite: false,
						title: {text: '平均销售日期'}
					},
					series: [ seriesOptions.all_avgdom,
					 seriesOptions.detach_avgdom,
					 seriesOptions.condo_avgdom
					]
					
				}

				$('#chart3').highcharts('StockChart', c3options);
				//End of Chart2
				
				var c4options = {
					credits: { enabled: false },
					chart: { zoomType: 'x'},
					rangeSelector : {selected : 5},
					legend: {enabled: true },
		
					title : {
						useHTML: true,
						text : '<div class="chart_title">大多地区房产-成交价/挂盘价比图表</div>'
					},
					subtitle : {
						useHTML: true,
						text : '<div class="chart_subtitle">成交价/挂盘价百分比</div>'
					},
					yAxis: {
						opposite: false,
						title: {text: '成交价/挂盘价%'}
					},
					series: [ seriesOptions.all_avgsplp,
					 seriesOptions.detach_avgsplp,
					 seriesOptions.condo_avgsplp
					]
					
				}
				$('#chart4').highcharts('StockChart', c4options);	
			}
		});
		

		
</script>

