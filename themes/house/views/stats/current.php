 <script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>
  <script src="/static/js/plotly/plotly-latest.min.js"></script>
   <script src="/static/js/DataTables-1.10.11/media/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="/static/js/DataTables-1.10.11/media/css/jquery.dataTables.min.css">





<div class="ui-field-contain" class="chart-select" >
	<select name="chartname"  id="chartname" data-corners="false" data-native-menu="false" data-iconpos="left" data-mini="true">
		<option >选择图表</option>
		<option value="city">城市分布图</option>
		<option value="province">省分布图</option>
		<option value="type">房屋类型分布图</option>
		<option value="price">房价分布图</option>
		<option value="house">房屋面积分布图</option>
		<option value="land">土地面积分布图</option>

	</select>
 </div>
  
  	<div class="chartbox" id="citychart" >  
		<p style="text-align:center"> <font color="#ff4e00"><?php echo date("Y-m-d", time() - 60 * 60 * 24); ?> </font> 实时统计  </p>
		<p id="chart_graph"> </p>
		<p class="datatabletop"> </p>
		<table id="tablecity" class="display" width="100%"></table>
	</div>

 

	
<script type="text/javascript">


function getFieldValues() {
   
    $('select').each(function() {
        options[this.id] = this.value; //push value into options object
		//console.log (this.id + ":" + options[this.id]);
    });
	

    
}	


options = {};

$(document).on("pagebeforecreate","#page_main",function(){			
$.ajax({
		url: '<?php echo Yii::app()->createUrl('stats/getHouseStats'); ?>',
		dataType: "json",
		success: function(result) {		


			var price_count= [];
			var price_label= [];
			
			$.each(result.price, function (key, value) {
				
					price_count.push(Number(value[1]));
					price_label.push(value[0]);
				
			});
			data_price = [{
				y: price_count,
				x: price_label,
				type: 'bar'
			}];
			layout_price = {
			  //title: ' 房源价格分布图',
			  xaxis: {title: '价格（万）'},
			  yaxis: {title: '房源数量（套）'},
			};
			
			
			//Chart2 Start: Property Type Stats
			
			var property_type_count= [];
			var property_type_label= [];
			//console.log(result.property_type);
			
			$.each(result.property_type, function (key, value) {
			property_type_count.push(Number(value[0]));
			property_type_label.push(value[1]);
			});
			data_type = [{
				values: property_type_count,
				labels: property_type_label,
				type: 'pie'
			}];
			layout_type = {
			 // title: ' 房源类型分布图',

			};
			
			
			
			//Chart3 Start:House number by city Bar chart			
			var city_count= [];
			var city_label= [];
			
			$.each(result.city, function (key, value) {
				if ( Number(value[1]) > 500 ) {
					city_count.push(Number(value[1]));
					city_label.push(value[0]);
				}
			});
			data_city = [{
				y: city_count,
				x: city_label,
				type: 'bar'
			}];
			layout_city = {
			  //title: ' 房源城市分布图',
			  //xaxis: {title: '城市'},
			  yaxis: {title: '房源数量（套）'},
			};
			
			
			//Start Table3
		    $('#tablecity').DataTable( {
				"language":{
					"sProcessing":   "处理中...",
					"sLengthMenu":   "_MENU_",
					"sZeroRecords":  "没有匹配结果",
					"sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
					"sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
					"sInfoFiltered": "(由 _MAX_ 项结果过滤)",
					"sInfoPostFix":  "",
					"sSearch":       "",
					"sUrl":          "",
					"sEmptyTable":     "表中数据为空",
					"sLoadingRecords": "载入中...",
					"sInfoThousands":  ",",
					"oPaginate": {
						"sFirst":    "首页",
						"sPrevious": "上页",
						"sNext":     "下页",
						"sLast":     "末页"
					},
					"oAria": {
						"sSortAscending":  ": 以升序排列此列",
						"sSortDescending": ": 以降序排列此列"
					}
				},
				//"info":     false,
				//"paging":   false,
			    "bLengthChange": false,
				"columnDefs": [{ "width": "40%", "targets": 0 }],
				data: result.city,
				columns: [
					{ title: "城市" },
					{ title: "数量" },
					{ title: "平均价" }
				],
				"order": [[ 2, "desc" ]],
				"pageLength": 25

			
			} );			
			//Chart Province Start:House number by Province Bar chart			
			var province_count= [];
			var province_label= [];
			
			$.each(result.province, function (key, value) {
				
					province_count.push(Number(value[2])); // n2,n4,i1,i2
					province_label.push(value[0]);
				
			});
			data_province = [{
				y: province_count,
				x: province_label,
				type: 'bar'
			}];
			layout_province = {
			  //title: ' 房源城市分布图',
			  //xaxis: {title: '城'},
			  yaxis: {title: '房源数量（套）'},
			};
			//Plotly.newPlot('chart_province', data_province, layout_province);
			
			//Start Table3
		    $('#tableprovince').DataTable( {
				"language":{
					"sProcessing":   "处理中...",
					"sLengthMenu":   "显示 _MENU_ 项结果",
					"sZeroRecords":  "没有匹配结果",
					"sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
					"sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
					"sInfoFiltered": "(由 _MAX_ 项结果过滤)",
					"sInfoPostFix":  "",
					"sSearch":       "搜索(省 中/英文）:",
					"sUrl":          "",
					"sEmptyTable":     "表中数据为空",
					"sLoadingRecords": "载入中...",
					"sInfoThousands":  ",",
					"oPaginate": {
						"sFirst":    "首页",
						"sPrevious": "上页",
						"sNext":     "下页",
						"sLast":     "末页"
					},
					"oAria": {
						"sSortAscending":  ": 以升序排列此列",
						"sSortDescending": ": 以降序排列此列"
					}
				},
				data: result.province,
				"bFilter" : false,
				"paging":   false,
				//"info":     false,
				columns: [
					{ title: "省中文名" },
					{ title: "省英文名" },
					{ title: "房源数量" },
					{ title: "平均房价（万）" }
				]
				

			
			} );			
			
			//Start Chart4: House Area  Distribution
						
			var housearea_count= [];
			var housearea_label= [];
			$.each(result.housearea, function (key, value) {
			housearea_count.push(Number(value[0])); // 0 is count
			housearea_label.push(value[1]);  // 1 is label
			});
			data_house = [{
				y: housearea_count,
				x: housearea_label,
				type: 'bar'
			}];
			layout_house = {
			  //title: ' 房屋面积分布图',
			  xaxis: {title: '房屋面积（平方英尺）'},
			  yaxis: {title: '房源数量（套）'},
			};
			//Plotly.newPlot('chart_house', data_house, layout_house);			
			
			

			//Start Chart5: Land Area  Distribution
			
			var landarea_count= [];
			var landarea_label= [];
			
			$.each(result.landarea, function (key, value) {
			landarea_count.push(Number(value[0]));
			landarea_label.push(value[1]);
			});
			data_land = [{
				y: landarea_count,
				x: landarea_label,
				type: 'bar'
			}];
			layout_land = {
			 // title: ' 土地面积分布图',
			  xaxis: {title: '土地面积（平方英尺）'},
			  yaxis: {title: '房源数量（套）'},
			};
			//Plotly.newPlot('chart_land', data_land, layout_land);
			
			
		//success close	
		}
	//ajax close	
	});

	});
	
$(document).on("pageshow","#page_main",function(){	
	
	$("select").change(function () {
		getFieldValues(); //Get updated Select
		
		switch(options['chartname']) {
			case "price":
				Plotly.newPlot('chart_graph', data_price, layout_price);
				break;
			case "type":
				Plotly.newPlot('chart_graph', data_type, layout_type);
				break;
			case "city":
				Plotly.newPlot('chart_graph', data_city, layout_city);
				break;
			case "province":
				Plotly.newPlot('chart_graph', data_province, layout_province);
				break;				
			case "house":
				Plotly.newPlot('chart_graph', data_house, layout_house);
				break;
			case "land":
				Plotly.newPlot('chart_graph', data_land, layout_land);
				break;
			default:
				Plotly.newPlot('chart_graph', data_price, layout_price);
				
																					
		}
	});
	
});
		
</script>

