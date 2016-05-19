<script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>


<div class="ui-field-contain" class="chart-select" >
	<select name="chartname"  id="chartname" data-corners="false" data-native-menu="false" data-iconpos="left" data-mini="true">
		<option >选择图表</option>
		<option value="price">价格走势图</option>
		<option value="sales">月销售房源走势图</option>
		<option value="newlist">新房源走势图</option>
		<option value="snlr">SNLR走势图</option>
		<option value="active">在售房源走势图</option>
		<option value="moi">MOI走势图</option>
		<option value="dom">DOM走势图</option>
		<option value="splp">SP/LP走势图</option>

	</select>
 </div> 

<div class="chartbox" id="citychart" >  
	<div id="chart_graph"> </div>
</div>

	
<script type="text/javascript">


function getFieldValues() {
     $('select').each(function() {
        options[this.id] = this.value; //push value into options object
		//console.log (this.id + ":" + options[this.id]);
    });
}
	
options = {};
	
var highchartsOptions = Highcharts.setOptions({
    lang: {
        loading: '加载中...',
        months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月','8月', '9月', '10月', '11月', '12月'],
        shortMonths: ['1月', '2月', '3月', '4月', '5月', '6月', '7月','8月', '9月', '10月', '11月', '12月'],
        weekdays: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
        exportButtonTitle: '导出',
        printButtonTitle: '打印',
        rangeSelectorFrom: '从',
        rangeSelectorTo: '到',
        rangeSelectorZoom: "缩放",
        downloadPNG: '下载PNG格式',
        downloadJPEG: '下载JPEG格式',
        downloadPDF: '下载PDF格式',
        downloadSVG: '下载SVG格式'
    }
});

$(document).on("pagebeforecreate","#page_main",function(){	

 $.ajax({
	url: '<?php echo Yii::app()->createUrl('stats/getMlsData'); ?>',
	dataType: "json",
	success: function(result) {		
		
		
		seriesOptions = [];
		
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
					'detach_avgdom':'独立房：平均售出日' ,
					'all_active':'所有房源：在售房源', 
					'condo_active':'楼房：在售房源',
					'detach_active':'独立房：在售房源',
					'all_sales':'所有房源：月销售房源', 
					'condo_sales':'楼房：月销售房源',
					'detach_sales':'独立房：月销售房源',
					'all_newlist':'所有房源：月新增房源',
					'condo_newlist':'楼房：月新增房源',
					'detach_newlist':'独立房：月新增房源',							
					'all_snlr':'所有房源：售出/新盘比', 
					'condo_snlr':'楼房：售出/新盘比',
					'detach_snlr':'独立房：售出/新盘比'	
					
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
						valueDecimals: 0,
						dateTimeLabelFormats: {
							minute:"%A, %b %e, %Y",
							hour:"%Y/%b",
							day:"%Y/%b",
							
						}
					}
					
				};
			
			});
		});
		

		options = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			
			title : {
				
				text : '平均价格（万）'
			},
			/*
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">成交金额/成交量</div>'
				
			},
						
			 yAxis: {
				opposite: false,
				title: {text: '平均价格'}
			},*/
			
			
			
			series: [ seriesOptions.all_avgprice,
			 seriesOptions.detach_avgprice,
			 seriesOptions.condo_avgprice
			]
			

		};
		$('#chart_graph').highcharts('StockChart', options);

	}
});

});

	
$(document).on("pageshow","#page_main",function(){	
	
	
	$("select").change(function () {
		var chart = $('#chart_graph').highcharts();
		getFieldValues(); //Get updated Select
		console.log("Select:" + options['chartname']);
		
		
		
		switch(options['chartname']) {
			case "price":
				
				 chart.series[0].update(seriesOptions.all_avgprice);
				 chart.series[1].update(seriesOptions.detach_avgprice);
				 chart.series[2].update(seriesOptions.condo_avgprice);
				 chart.setTitle({text: "平均价格(万）"});
				 //chart.yAxis[0].axisTitle.attr({text: '平均价格' });
				 //chart.yAxis[0].hide();
				break;
				
			case "moi":
				 chart.series[0].update(seriesOptions.all_moi);
				 chart.series[1].update(seriesOptions.detach_moi);
				 chart.series[2].update(seriesOptions.condo_moi);
				  chart.setTitle({text: "平均库存月份"});
				
			
				
				break;
				
			case "sales":
				 chart.series[0].update(seriesOptions.all_sales);
				 chart.series[1].update(seriesOptions.detach_sales);
				 chart.series[2].update(seriesOptions.condo_sales);
				   chart.setTitle({text: "月销售房源（套）"});
				// chart.yAxis[0].axisTitle.attr({text: '月销售房源（套）' });
			
				break;
			case "snlr":
				 chart.series[0].update(seriesOptions.all_snlr);
				 chart.series[1].update(seriesOptions.detach_snlr);
				 chart.series[2].update(seriesOptions.condo_snlr);
				   chart.setTitle({text: "售出/新盘比%"});
				// chart.yAxis[0].axisTitle.attr({text: '售出/新盘比%' });
			
				break;				
			case "dom":
				 chart.series[0].update(seriesOptions.all_avgdom);
				 chart.series[1].update(seriesOptions.detach_avgdom);
				 chart.series[2].update(seriesOptions.condo_avgdom);
				   chart.setTitle({text: "平均销售日期"});
				
			
				break;
			case "newlist":
				 chart.series[0].update(seriesOptions.all_newlist);
				 chart.series[1].update(seriesOptions.detach_newlist);
				 chart.series[2].update(seriesOptions.condo_newlist);
				   chart.setTitle({text: "月销售房源（套）"});
				
			
				break;
			case "active":
				 chart.series[0].update(seriesOptions.all_active);
				 chart.series[1].update(seriesOptions.detach_active);
				 chart.series[2].update(seriesOptions.condo_active);
				   chart.setTitle({text: "在售房源（套）"});
				 
			
				break;				
			case "splp":
				 chart.series[0].update(seriesOptions.all_avgsplp);
				 chart.series[1].update(seriesOptions.detach_avgsplp);
				 chart.series[2].update(seriesOptions.condo_avgsplp);
				   chart.setTitle({text: "成交价/挂盘价%"});
				 
			
				break;
			
			default:
				$('#chart_graph').highcharts('StockChart', options);
				
																					
		}
	});
	
});

		
</script>

