

<script>

function update_houselist(options) {
	
	loading = true; //prevent further ajax loading
	//Ajax Start
	$.ajax({
		url: '/index.php?r=mhouse/SearchHouse',
		type: 'POST', 
		dataType: 'json', 
		data: { 
			sr : 	options['sr'],
			pageindex: options['pageindex'],
			housetype: options['type'],
			//houseprice: options['price'],
			houseroom: options['bedroom'],
			housebaths: options['washroom']
			//househousearea: options['housearea'],
			//houselandarea: options['landarea'],
			//orderby: options['orderby'],
			//city: options['city'],
			
			
		},

		//Success Start
		success: function(result) {
			
			//Result Loop Start
			var houseCount = result.Data.Total;
			var tableHtml = "";
			$(result.Data.MapHouseList).each(function(index) {
				
					
				var hprice = ( sr == 'Lease' )? Math.round(this.Price*10000) +'  加元/月' : Math.round(this.Price) +'  万加元';
				
				var li = "<li data-icon='false'> " 
				+ " <a data-ajax='false' href='<?php echo Yii::app()->createUrl('mhouse/view'); ?>&id=" + this.Id + "'>" 
				+ "<img src=' " + this.CoverImg + "'>" 
				+ "<h3>" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</h3>" 
				+ "<p>" + this.Address + "," + this.MunicipalityName + "</p>" 
				+ "<p>价钱:"  + hprice + "</p> " 
				+ "</a>"
				//+ "<a href='mailto:info@maplecity.com.cn?subject=查询房源-" + this.MlsNumber + "'>"
				//+ "</a>"
				
				+ "</li>";
				
				tableHtml = tableHtml + li;	
	
				//HouseArray[Arrayindex] = li;
				//Arrayindex++;
			});
			//Result Loop End
			
			
			//Display HouseList Start

			$("#house_count").text(houseCount);
			/*
            var tableHtml = "";
			$.each(HouseArray, function(index) {
				
				tableHtml = tableHtml + HouseArray[index];
			
			});
			
			*/
			if ( page == "0" ){
				//console.log("Refresh Page index:" + page);
				//console.log(tableHtml);
				$("#house_list").html(tableHtml).promise().done(function () {
				  $("#house_list").listview().listview('refresh');
				});
				

			} else {
				console.log("Append Page index:" + page);
				$("#house_list").append(tableHtml).listview('refresh');
				$('.animation_image').hide(); //show loading image
				loading = false; 
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

//options['sr'] = sr;
options['pageindex'] = page;

$(document).on("pageshow","#page_main",function(){
	
	
	
  	if ( sr == "Sale"){
		$("#menu_sale").addClass('ui-btn-active'); //make Sales Header active
		$('#sr').val('Sale').selectmenu('refresh');
	} else if ( sr == "Lease") {
		$("#menu_lease").addClass('ui-btn-active'); //make Lease Header active
		$('#sr').val('Lease').selectmenu('refresh');
	}
	
	getFieldValues();
	update_houselist(options);
	
	
	//Start Select Change Event  
	$("select").change(function () {
		getFieldValues(); //Get updated Select
		$('#search_clear').show(); 
		update_houselist(options);
	});
	//Search Clear
	$('#search_clear').click(function()	{ 
		$("select").val([]);
		$("select").selectedIndex = -1;
		$("select").selectmenu('refresh');
		console.log("Clear Select");
		$('#search_clear').hide(); 
		getFieldValues();
		update_houselist(options);
		//return false; 
	});	

	//Detect scroll to bottom
	$(window).scroll(function(){
		if($(document).height() > $(window).height()) {
			if($(window).scrollTop() == $(document).height() - $(window).height()){
			  //alert("The Bottom");
			  loading = true; //prevent further ajax loading
			  $('.animation_image').show(); //show loading image
			  ++page;
			  console.log("Refresh Page:" + page);
			  options["pageindex"] = page;
			  update_houselist(options);
			 		 
		   }
		}
	});
 
});

  
</script>

<!-- CITY Search Panel Start -->
<div data-role="panel" id="panel-city" class="province-panel" data-display="overlay" data-position-fixed="true">
	
	<ul id="search_city_text" class="ui-shadow ui-mini" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="输入城市 中/英文" data-filter-theme="a"  ></ul>

	<fieldset data-role="controlgroup" data-mini="true">
		<select name="ontario" id="ontario" multiple="multiple" data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >安省</option>
			<option value="Toronto" >多伦多</option>
			<option value="Mississauga">Mississauga</option>
	
		
		</select>	
		<select name="ontario" id="ontario" multiple="multiple" data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >爱德华王子岛省</option>
			<option value="Toronto" >多伦多</option>
			<option value="Mississauga">Mississauga</option>
	
		
		</select>	
	    		
	    

	</fieldset>

		
		
	<div data-role="collapsibleset" id="search_city_list">
      <div data-role="collapsible">
        <h3>安省</h3>
          <button class="ui-btn">Button</button>
      </div>
      <div data-role="collapsible">
        <h3>BC省</h3>
        <p>I'm the expanded content.</p>
      </div>
      <div data-role="collapsible">
        <h3>阿尔伯塔</h3>
        <p>I'm the expanded content.</p>
      </div>
      <div data-role="collapsible">
        <h3>新不伦瑞克</h3>
        <p>I'm the expanded content.</p>
      </div>
	       <div data-role="collapsible">
        <h3>新斯科舍省</h3>
        <p>I'm the expanded content.</p>
      </div>
	       <div data-role="collapsible">
        <h3>爱德华王子岛省</h3>
        <p>I'm the expanded content.</p>
      </div>
	       <div data-role="collapsible">
        <h3>纽芬兰及拉布拉多</h3>
        <p>I'm the expanded content.</p>
      </div>
    </div>
	


</div>
<!-- CITY Search Panel End -->

<!-- 房源搜索列表开始 -->
<p></p>
<div id="house-search"  class="search-area " >


<!-- search row1 start -->
<div class="ui-grid-c" >
	<div class="ui-block-a">
		<a href="#panel-city" class="ui-select ui-btn">区域</a>
	</div>
	<div class="ui-block-b">
		<select name="sr" id="sr" data-corners="false" data-iconpos="noicon" data-native-menu="false"  style=>
			<option >状态</option>
			<option value="Sale" selected="selected">出售</option>
			<option value="Lease" >出租</option>
			
		</select>
	</div>	
	<div class="ui-block-c">
		<select name="type" id="type" data-corners="false" data-iconpos="noicon" data-native-menu="false"  style=>
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
	<div class="ui-block-d">	
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
	
	<div class="ui-block-a">		
		<select name="bedroom" id="bedroom" data-corners="false" data-native-menu="false"  data-iconpos="noicon">
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
		</select>
	</div>
	<div class="ui-block-b">	

		<select name="washroom" id="washroom"  data-corners="false" data-native-menu="false" data-iconpos="noicon" >
			<option > 洗手间</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
		</select>

	</div>
	<div class="ui-block-c">	
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
	<div class="ui-block-d">	
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

</div>		
<!-- search row2 end -->



</div>
<!-- 房源搜索列表结束 -->



<!-- 地图开始 --> 
<!-- 地图结束 -->

<!-- 房源列表开始 --> 
<div data-role="main" class="house_preview ui-content">

	<div id="house_list_header1" data-role="controlgroup" data-mini="true" data-type="horizontal">
	     
	    <a href="#" class="ui-btn ui-corner-all"> <span>房源:</span><span id="house_count"> </span> </a>
		<a href="#" id="search_clear" class="ui-btn ui-corner-all ui-icon-delete ui-btn-icon-left" style="display:none">清除选择</a>
	   
	</div>
	
	<!--
	<div id="house_list_header2" data-role="controlgroup" data-mini="true" data-type="horizontal" >
	     
	 
		<a href="#" class="ui-btn ui-corner-all ui-icon-arrow-l ui-btn-icon-notext ui-btn-icon-left"></a>
   		 <a href="#" class="ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-notext ui-btn-icon-right"></a>
	  
	   
	</div>
  
	--> 
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
