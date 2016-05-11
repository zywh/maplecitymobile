<script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>


<div class="ui-field-contain" class="chart-select" >
	<select name="chartname"  id="chartname" data-corners="false" data-native-menu="false" data-iconpos="left" data-mini="true">
		<option >选择图表</option>
		<option value="price">价格走势图</option>
		<option value="sale">月销售房源走势图</option>
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
		
		
		priceOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区房产-历史成交图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">成交金额/成交量</div>'
				
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
		hchart = $('#chart_graph').highcharts('StockChart', priceOptions);
		
		moiOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区库存月份图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
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
		
		snlrOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区库存月份图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
			},
			yAxis: {
				opposite: false,
				title: {text: '售出/新盘比%'}
			},
			series: [ seriesOptions.all_snlr,
			 seriesOptions.detach_snlr,
			 seriesOptions.condo_snlr
			]
			
		}

		salesOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区库存月份图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
			},
			yAxis: {
				opposite: false,
				title: {text: '月销售房源（套）'}
			},
			series: [ seriesOptions.all_sales,
			 seriesOptions.detach_sales,
			 seriesOptions.condo_sales
			]
			
		}

		newlistOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区库存月份图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
			},
			yAxis: {
				opposite: false,
				title: {text: '月销售房源（套）'}
			},
			series: [ seriesOptions.all_newlist,
			 seriesOptions.detach_newlist,
			 seriesOptions.condo_newlist
			]
			
		}

		activeOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区库存月份图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">大多地区房产-库存月份图表</div>'
			},
			yAxis: {
				opposite: false,
				title: {text: '在售房源（套）'}
			},
			series: [ seriesOptions.all_active,
			 seriesOptions.detach_active,
			 seriesOptions.condo_active
			]
			
		}
		
		domOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},

			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区房产-平均销售日期图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">上市到售出的平均时间</div>'
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

		splpOptions = {
			credits: { enabled: false },
			chart: { zoomType: 'x'},
			rangeSelector : {selected : 5},
			legend: {enabled: true },
			navigator : { enabled : false},
			
			title : {
				useHTML: true,
				//text : '<div class="chart_title">大多地区房产-成交价/挂盘价比图表</div>'
			},
			subtitle : {
				useHTML: true,
				//text : '<div class="chart_subtitle">成交价/挂盘价百分比</div>'
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
		
		
		
	}
});

});

	
$(document).on("pageshow","#page_main",function(){	
	
	
	$("select").change(function () {
		getFieldValues(); //Get updated Select
		console.log("Select:" + options['chartname']);
		
		
		
		switch(options['chartname']) {
			case "price":
				
				hchart = $('#chart_graph').highcharts('StockChart', priceOptions);
				hchart.redraw();
				
				break;
			case "moi":
				
				hchart =  $('#chart_graph').highcharts('StockChart', moiOptions);
				hchart.redraw();
				break;
				
			case "sales":
				
				hchart =  $('#chart_graph').highcharts('StockChart', salesOptions);
				hchart.redraw();
				break;
			case "snlr":
				
				hchart =  $('#chart_graph').highcharts('StockChart', snlrOptions);
				hchart.redraw();
				break;				
			case "dom":
				
				var hchart =  $('#chart_graph').highcharts('StockChart', domOptions);
				break;
			case "newlist":
			
				$('#chart_graph').highcharts('StockChart', newlistOptions);
				break;
			case "active":
				$('#chart_graph').highcharts('StockChart', activeOptions);
				break;				
			case "splp":
				$('#chart_graph').highcharts('StockChart', splpOptions);
				break;
			
			default:
				$('#chart_graph').highcharts('StockChart', priceOptions);
				
																					
		}
	});
	
});

		
</script>

