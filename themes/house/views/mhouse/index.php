

<script>

function update_houselist(options) {
	
	//Ajax Start
	$.ajax({
		url: '/index.php?r=mhouse/SearchHouse',
		type: 'POST', 
		dataType: 'json', 
		data: { 
			sr : 	options['sr'],
			page: options['page']
			//housetype: options['type'],
			//houseprice: options['price'],
			//houseroom: options['bedroom'],
			//housebaths: options['washroom'],
			//househousearea: options['housearea'],
			//houselandarea: options['landarea'],
			//orderby: options['orderby'],
			//city: options['city'],
			
			
		},
		//Success Start
		success: function(result) {
			forIndex++;
			//Result Loop Start
			var houseCount = result.Data.Total;
			$(result.Data.MapHouseList).each(function(index) {
				//console.log("Build House list HTML");
					
				var hprice = ( sr == 'Lease' )? Math.round(this.Price*10000) +'  加元/月' : Math.round(this.Price) +'  万加元';
				
				var li = "<li data-icon='false'> " 
				+ " <a data-ajax='false' href='<?php echo Yii::app()->createUrl('mhouse/view'); ?>&id=" + this.Id + "'>" 
				+ "<img src=' " + this.CoverImg + "'>" 
				+ "<h3>" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</h3>" 
				+ "<p>" + this.Address + "," + this.MunicipalityName + "</p>" 
				+ "<p>" + hprice + "</p> " 
				+ "</a>"
				//+ "<a href='mailto:info@maplecity.com.cn?subject=查询房源-" + this.MlsNumber + "'>"
				//+ "</a>"
				
				+ "</li>";
				
					
	
				HouseArray[Arrayindex] = li;
				Arrayindex++;
			});
			//Result Loop End
			
			
			//Display HouseList Start

			$("#house_count").text(houseCount + ":" + page);
	
            total_groups = houseCount/pageSize; //page size
			//$(".house_count").text(houseCount);
								
			var tableHtml = "";
			$.each(HouseArray, function(index) {
				if (index < 10) {
					if (HouseArray[index]) {
						tableHtml = tableHtml + HouseArray[index];
					}
				}
			});
			
			if ( options["page"] = 0){
				$("#house_list").html(tableHtml).listview('refresh');
			} else {
				$("#house_list").append(tableHtml).listview('refresh');
			}
			
			
		}
		//Success End
	});
	//Ajax End
			
}

function getFieldValues() {
   
    $('select').each(function() {
        options[this.id] = this.value; //push value into options object
    });
    
}

var options = {};
var pageSize = 10;
var forIndex = 0;
var Arrayindex = 0;
var HouseArray = [];
var lenght = 1;
var sr = '<?php echo $_GET['sr'];?>';
var page = 0; //total loaded page zero for first page
var loading  = false; //to prevents multipal ajax loads
var total_groups = 1 ;

options['sr'] = sr;
options['page'] = page;

$(document).on("pageshow","#page_main",function(){
	
	
  	if ( sr == "Sale"){
		$("#header_sale").addClass('ui-btn-active'); //make Sales Header active
	} else if ( sr == "Lease") {
		$("#header_lease").addClass('ui-btn-active'); //make Lease Header active
	}
		
	getFieldValues();
	//$("#pricetext").text(options["sr"] + ":" +  options['type']);  
	update_houselist(options);
	//$('ul').listview('refresh');
	
	//Start Select Change Event  
	$("select").change(function () {
		getFieldValues(); //Get updated Select
		//$("#pricetext").text(options["sr"] + ":" +  options['type']); 
			console.log("Change Detected");
		update_houselist(options);
		//$('ul').listview('refresh');
	  
	});
	 

	//Detect scroll to bottom
	$(window).scroll(function(){
		if($(document).height() > $(window).height()) {
			if($(window).scrollTop() == $(document).height() - $(window).height()){
			  //alert("The Bottom");
			  loading = true; //prevent further ajax loading
              $('.animation_image').show(); //show loading image
			  ++page;
			  options["[page]"] = page;
			  update_houselist(options);
			  
			  $('.animation_image').show(); //show loading image
			  loading = false; //prevent further ajax loading
		 
		   }
		}
	});
 
});

  
</script>


<div data-role="panel" id="panel-city" data-display="overlay" data-position-fixed="true">
	
	<ul id="citysearch" class="ui-shadow ui-mini" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="输入城市 中/英文" data-filter-theme="a"  ></ul>
	<select name="province" id="province" data-native-menu="false" data-iconpos="noicon">
		<option >省份</option>
		<option value="3">安省</option>
		<option value="4">BC省</option>
		<option value="5">阿尔伯塔</option>
		<option value="6">新不伦瑞克</option>
		<option value="7">新斯科舍省</option>
		<option value="8">爱德华王子岛省</option>
		<option value="9">纽芬兰及拉布拉多</option>
	</select>	

</div>

<!-- 房源搜索列表开始 -->
<p></p>
<div id="house-search"  class="search-area " >


<!-- search row1 start -->
<div class="ui-grid-c" >
	<div class="ui-block-a">
		<a href="#panel-city" class="ui-select ui-btn">地区</a>
	</div>
    <div class="ui-block-b">
		<select name="type" id="type" data-corners="false" data-native-menu="false" data-iconpos="noicon" style=>
			<option >房型</option>
			<option value="1" >独栋别墅</option>
			<option value="2">联排别墅</option>
			<option value="3">豪华公寓</option>
			<option value="4">双拼别墅</option>
			<option value="5">度假屋</option>
			<option value="6">农场</option>
			<option value="7">空地</option>
			<option value="8">其他</option>
		</select>
	</div>
	<div class="ui-block-c">	
		<select name="price" id="price" data-corners="false" data-native-menu="false" data-iconpos="noicon">
			<option >价格</option>
			<option value="0-30" >30万以下</option>
			<option value="30-50" >30-50万</option>
			<option value="50-100" >50-100万</option>
			<option value="100-150" >100-150万</option>
			<option value="150-300" >150-300万</option>
			<option value="300-400" >300-450万</option>
			<option value="450-500" >450-600万</option>
			<option value="600-0" >600以上</option>
		</select>
	</div>

	<div class="ui-block-d">		
		<select name="bedroom" id="bedroom" data-corners="false" data-native-menu="false"  data-iconpos="noicon">
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
		</select>
	</div>
	<div class="ui-block-a">	

		<select name="washroom" id="washroom"  data-corners="false" data-native-menu="false" data-iconpos="noicon" >
			<option > 洗手间</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
		</select>

	</div>

	<div class="ui-block-b">	
		<select name="housearea" id="housearea"  data-corners="false"  multiple="multiple" data-native-menu="false"  data-iconpos="noicon">
			<option >房屋尺寸</option>
			<option value="0-700" >700平方尺以下</option>
			<option value="700-1100">700-1100平方尺</option>
			<option value="1100-1500">1100-1500平方尺</option>
			<option value="1500-2000">1500-2000平方尺</option>
			<option value="2000-2500">2000-2500平方尺</option>
			<option value="2500-3000">2500-3000平方尺</option>
			<option value="3000-3500">3000-3500平方尺</option>
			<option value="3500-4000">3500-4000平方尺</option>
			<option value="4000-0">4000以上</option>
		</select>
	</div>
	<div class="ui-block-c">	
		<select name="landarea" id="landarea" multiple="multiple"  data-corners="false" data-native-menu="false" data-iconpos="noicon">
			<option >土地尺寸</option>
			<option value="0-2000" >2000平方尺以下</option>
			<option value="2000-4000">2000-4000平方尺</option>
			<option value="4000-6000">4000-6000平方尺</option>
			<option value="6000-12000">6000-12000平方尺</option>
			<option value="12000-435600">12000-1英亩</option>
			<option value="435600-0">1英亩以上</option>
		
		</select>	
	</div>
	<div class="ui-block-d">
		<a href="/" class="ui-select ui-btn">更多</a>
	</div>	
</div>		
<!-- search row2 end -->



</div>
<!-- 房源搜索列表结束 -->



<!-- 地图开始 --> 
<!-- 地图结束 -->

<!-- 房源列表开始 --> 
<div data-role="main" class="house_preview ui-content">
    <h3>房源数目：<span id="house_count"> </span> </h3>
    <ul data-role="listview" data-inset="true" id="house_list" >

    </ul>
</div>
<!-- 房源列表结束 -->

<!-- 下一页装载进程图标开始 --> 

<div class="animation_image" style="display:none" align="center">
	<img src="static/images/ajax-loader2.gif">
<div>

</div>
<!-- 下一页装载进程图标结束 --> 
