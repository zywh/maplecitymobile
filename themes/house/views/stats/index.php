<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>
<link rel="stylesheet" href="/themes/house/css/jquery-ui.css">
<link rel="stylesheet" href="/themes/house/css/stats.css">
 
       

<div class="cl"></div>
<div class="fyss">

<div id="tabs" class="chartcontainer_treb">

 <ul>
    <li><a href="#pricechart">价格走势图</a></li>
	<li><a href="#saleschart">月销售房源走势图</a></li>
    <li><a href="#newlistchart">新房源走势图</a></li>
    <li><a href="#snlrchart">SNLR走势图</a></li>
	<li><a href="#activechart">在售房源走势图</a></li>
	<li><a href="#moichart">MOI走势图</a></li>
	<li><a href="#domchart">DOM走势图</a></li>
	<li><a href="#splpchart">SP/LP走势图</a></li>
 </ul>


	<div class="chartbox_treb" id="pricechart">
		<p class="chartboxtitle1">大多地区 - 价格走势</p>
		<p class="chartboxtitle2"> </p>
		<span class="chart_area" id="chart_price"> </span>
		<p class="chart_beforetext"> </p>
		<p class="chart_text">多伦多地产经纪协会公布的数据显示，大多伦多地区2月房屋销售再次创下新高。2月大多地区总共卖出7621套房屋，相比1月的6294套增长21.1%。即使排除今年2月份比往年多一天的因素，2016年2月的房屋销量也处在近十年来最高水平。报告显示，目前大部分房屋销售位于多伦多市区以外，在七千多套房屋中，仅有三分之一来自多伦多市区。其他部分主要位于密西沙加等外部地区。除了房屋销售水平外，大多地区的房屋平均价格也较去年和上个月有很大增长。报告显示，多伦多MLS房屋均价在2016年2月达到68.5万加元。而1月为63.1万加元。去年2月数据则为59.6万加元。多伦多市区的房屋均价相比大多地区整个价格还要更高，达到了71.9万加元。
	</p>
		<p class="chart_aftertext"> </p>

		
	</div>
	<div class="chartbox_treb" id="saleschart" >
		<p class="chartboxtitle1">大多地区 - 月销售房源</p>
		<p class="chartboxtitle2"> </p>
		<p class="chart_area" id="chart_sales"> </p>
		<p class="chart_beforetext"> </p>	
		<p class="chart_text">多伦多地产经纪协会公布的数据显示，大多伦多地区2月房屋销售再次创下新高。2月大多地区总共卖出7621套房屋，相比1月的6294套增长21.1%。即使排除今年2月份比往年多一天的因素，2016年2月的房屋销量也处在近十年来最高水平。报告显示，目前大部分房屋销售位于多伦多市区以外，在七千多套房屋中，仅有三分之一来自多伦多市区。其他部分主要位于密西沙加等外部地区。除了房屋销售水平外，大多地区的房屋平均价格也较去年和上个月有很大增长。报告显示，多伦多MLS房屋均价在2016年2月达到68.5万加元。而1月为63.1万加元。去年2月数据则为59.6万加元。多伦多市区的房屋均价相比大多地区整个价格还要更高，达到了71.9万加元。
 </p>
		<p class="chart_aftertext"> </p>
		
	</div>
	<div class="chartbox_treb" id="newlistchart" >
		<p class="chartboxtitle1">大多地区 - 月新增房源 </p>
		<p class="chartboxtitle2"> </p>
		<p class="chart_area" id="chart_newlist"> </p>
		<p class="chart_beforetext"> </p>	
		<p class="chart_text">多伦多地产经纪协会公布的数据显示，大多伦多地区2月房屋销售再次创下新高。2月大多地区总共卖出7621套房屋，相比1月的6294套增长21.1%。即使排除今年2月份比往年多一天的因素，2016年2月的房屋销量也处在近十年来最高水平。报告显示，目前大部分房屋销售位于多伦多市区以外，在七千多套房屋中，仅有三分之一来自多伦多市区。其他部分主要位于密西沙加等外部地区。除了房屋销售水平外，大多地区的房屋平均价格也较去年和上个月有很大增长。报告显示，多伦多MLS房屋均价在2016年2月达到68.5万加元。而1月为63.1万加元。去年2月数据则为59.6万加元。多伦多市区的房屋均价相比大多地区整个价格还要更高，达到了71.9万加元。
 </p>
		<p class="chart_aftertext"> </p>
		
	</div>
	<div class="chartbox_treb" id="snlrchart" >
		<p class="chartboxtitle1">大多地区 - 销售/新盘比</p>
		<p class="chartboxtitle2"> </p>
		<p  class="chart_area" id="chart_snlr"> </p>
		<p class="chart_beforetext"> </p>	
		<p class="chart_text">本图的数据是大多地区年度月销售和新上市房源的比率（SNLR）。这个数据会出现的季节性趋势，此图表可以用来比较每个月/年变化。当SNLR移动走高，表示销售增长超过新的上市房源增长。一般表示趋向卖方市场。当SNLR移动走低，表示销售增长少于新的上市房源增长。一般表示趋向买方市场。大多市场近20年基本保持50% - 100%。表示销售量和新上市比例在1：1 到1：2。考虑到这是月报表，上市房平均在一个月到两个月会售出。请参考其他图标作为参考。
 </p>
		<p class="chart_aftertext"> </p>
	</div>	
	
	<div class="chartbox_treb" id="activechart" >
		 <p class="chartboxtitle1">大多地区 - 在售房源数目</p>
		 <p class="chartboxtitle2"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_area" id="chart_active"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_text">多伦多地产经纪协会公布的数据显示，大多伦多地区2月房屋销售再次创下新高。2月大多地区总共卖出7621套房屋，相比1月的6294套增长21.1%。即使排除今年2月份比往年多一天的因素，2016年2月的房屋销量也处在近十年来最高水平。报告显示，目前大部分房屋销售位于多伦多市区以外，在七千多套房屋中，仅有三分之一来自多伦多市区。其他部分主要位于密西沙加等外部地区。除了房屋销售水平外，大多地区的房屋平均价格也较去年和上个月有很大增长。报告显示，多伦多MLS房屋均价在2016年2月达到68.5万加元。而1月为63.1万加元。去年2月数据则为59.6万加元。多伦多市区的房屋均价相比大多地区整个价格还要更高，达到了71.9万加元。
		</p>
		 <p class="chart_aftertext"> </p>
	</div>
	
	<div class="chartbox_treb" id="moichart" >
		 <p class="chartboxtitle1">大多地区 - 存量月份</p>
		 <p class="chartboxtitle2"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_area" id="chart_moi"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_text">本指标是如果没有新增房源的情况下，需要卖掉所有库存房源所需的月份（Months of Inventory）。这个数据会出现的季节性趋势，此图表可以用来比较每个月/年变化。当
MOI移动走低时，表示库存减少。一般表示趋向卖方市场。当MOI移动走高，表示库存增加。一般表示趋向买方市场。房地产业内一般同意，0-4月表示卖方市场，5-7月表示中性市场，8-12月表示买方市场。 近20年大多地区的MOI基本保持在2-4月。请参考其他图标作为参考。
		</p>
		 <p class="chart_aftertext"> </p>		 
	</div>
	<div class="chartbox_treb" id="domchart" >
		 <p class="chartboxtitle1">大多地区 - 平均售出日</p>
		 <p class="chartboxtitle2"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_area" id="chart_dom"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_text">本图的数据是大多地区房源的平均销售日期(Days on Market)。这个数据会出现的季节性趋势，此图表可以用来比较每个月/年变化。当DOM移动走低时，表示销售日期减少。一般价格会增加，市场趋向卖方市场。当DOM移动走高，表示销售日期增加。一般表示趋向买方市场。大多市场的这个指标近20年一直在走低，表示卖方市场的趋势一直在增加。2012以后这个平均指标低于30。 表示平均挂盘时间少于30天。三月份降到16天，强劲的卖方市场。请参考其他图标作为参考。
		</p>
		 <p class="chart_aftertext"> </p>
	</div>
	<div class="chartbox_treb" id="splpchart" >
		 <p class="chartboxtitle1">大多地区 - 成交价/挂盘价比</p>
		 <p class="chartboxtitle2"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_area" id="chart_splp"> </p>
		 <p class="chart_beforetext"> </p>
		 <p class="chart_text">本图的数据是大多地区年月成交价格和挂盘价格的比率（Sale Price / Listing Price）。这个数据会出现的季节性趋势，此图表可以用来比较每个月/年变化。当SPLP移动走高s时，表示成交价格增长超过挂盘价格增长。一般表示趋向卖方市场。当SPLP移动走低，表示成交价格增长少于挂盘价格变化。一般表示趋向买方市场。大多市场的这个指标近20年一直在增长，表示卖方市场的趋势一直在增加。三月份这个平均指标超过100%。 表示想在市场上用挂盘价格买到房子的机会已经不多了。请参考其他图标作为参考。
		</p>
		 <p class="chart_aftertext"> </p>
	</div>		
</div>

<div class="cl"></div>
	
<script type="text/javascript">



$(function() {
	$( "#tabs" ).tabs();
	$(".chart_beforetext").text('枫之都专业分析：');
	$(".chart_aftertext").html('希望得到大多地区房屋销售更多资讯，可邮件<a href="mailto:info_Canada@maplecity.com.cn?Subject=希望得到大多地区房屋销售更多资讯" target="_top">info_Canada@maplecity.com.cn</a>');
});
	
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
					'all_activelist':'所有房源：在售房源', 
					'condo_activelist':'楼房：在售房源',
					'detach_activelist':'独立房：在售房源',
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
		//console.log(seriesOptions.all_snlr);

			
		var priceOptions = {
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


		
		$('#chart_price').highcharts('StockChart', priceOptions);
		//End of  Price Chart
		
		
		var moiOptions = {
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

		$('#chart_moi').highcharts('StockChart', moiOptions);
		//End of MOI Chart

		var snlrOptions = {
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

		$('#chart_snlr').highcharts('StockChart', snlrOptions);
		//End of SNLR Chart
		
		var salesOptions = {
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
		
		$('#chart_sales').highcharts('StockChart', salesOptions);
		//End of SALES Chart

		var newlistOptions = {
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
		
		$('#chart_newlist').highcharts('StockChart', newlistOptions);
		//End of NEWLIST Chart

		var activeOptions = {
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
		$('#chart_active').highcharts('StockChart', activeOptions);
		//End of active Chart		
				
		var domOptions = {
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

		$('#chart_dom').highcharts('StockChart', domOptions);
		//End of DOM Chart
		
		var splpOptions = {
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
		
		$('#chart_splp').highcharts('StockChart', splpOptions);	
		//End of SPLP Chart
	}
});


		
</script>

