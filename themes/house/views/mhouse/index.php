

<script>

function update_houselist(options) {
	
	loading = true; //prevent further ajax loading
	//Ajax Start
	console.log("AJAX Parm:" + options['pageindex']);
	
	$.ajax({
		url: '/index.php?r=mhouse/SearchHouse',
		type: 'POST', 
		dataType: 'json', 
		data: { 
			sr : 	options['sel_sr'], 
			pageindex: options['pageindex'], 
			housetype: options['sel_type'], 
			houseprice: options['sel_price'],
			houseroom: options['sel_bedroom'],	
			housebaths: options['sel_washroom'],
			housearea: options['sel_housearea'],
			//houselandarea: options['landarea'],
			//orderby: options['orderby'],
			city: options['city']
			
			
		},

		//Success Start
		success: function(result) {
			
			//Result Loop Start
			var houseCount = result.Data.Total;
			var tableHtml = "";
			$(result.Data.MapHouseList).each(function(index) {
				
				sr = options['sr'];
				var hprice = ( sr == 'Lease' )? Math.round(this.Price*10000) +'  加元/月' : Math.round(this.Price) +'  万加元';
				
				//var li = "<li data-icon='false'> " 
				//+ " <a data-ajax='false' href='<?php echo Yii::app()->createUrl('mhouse/view'); ?>&id=" + this.MlsNumber + "'>" 
				//+ "<img src=' " + this.CoverImg + "'>" 
				//+ "<h3>" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</h3>" 
				//+ "<p>" + this.Address + "," + this.MunicipalityName + "</p>" 
				//+ "<p>价钱:"  + hprice + "</p> " 
				//+ "</a>"
				////+ "<a href='mailto:info@maplecity.com.cn?subject=查询房源-" + this.MlsNumber + "'>"
				////+ "</a>"
				//
				//+ "</li>";
				var li = "<li data-icon='false'>" 
				+ "<div class='houseview-area houseview-tn'><a data-ajax='false' href='<?php echo Yii::app()->createUrl('mhouse/view'); ?>&id=" + this.MlsNumber + "'>" 
				+ "<img src=' " + this.CoverImg + "'>" 
				+ "</a></div>"
				+ "<div class='houseview-area houseview-text'>"
				
				+ "<a class='pv-text' data-ajax='false' href='index.php?r=map/index&lat=" + this.GeocodeLat + "&lng=" + this.GeocodeLng + "&zoom=15&type=house'>"
				+ "<div class='pv-text'>地址:" + this.Address + "," + this.MunicipalityName + "</div>" 
				+ "</a>"
				//+ "<a data-ajax='false' href='index.php?r=map/index&lat=" + this.CityLat + "&lng=" + this.CityLng + "&zoom=13&type=city'>"
				//+ "<div>城市:" + this.MunicipalityName + " " + this.ProvinceCname +  "</div>" 
				//+ "</a>"
				+ "<div class='pv-text'>" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</div>" 
				+ "<div class='pv-text'>价钱:"  + hprice + "</div> " 
				
				//+ "<a href='mailto:info@maplecity.com.cn?subject=查询房源-" + this.MlsNumber + "'>"
				//+ "</a>"
				+ "</div>"
				+ "</li>";
				
				tableHtml = tableHtml + li;	
	
				//HouseArray[Arrayindex] = li;
				//Arrayindex++;
			});
			//Result Loop End
			
			
			//Display HouseList Start

			$("#house_count").text(houseCount);
			$("#page_count").text(page + 1);
			/*
            var tableHtml = "";
			$.each(HouseArray, function(index) {
				
				tableHtml = tableHtml + HouseArray[index];
			
			});
			
			*/
			console.log(pageclick);
			if (( page == "0" ) || ( pageclick == true )){
				console.log("Refresh Page index:" + page);
				//console.log(tableHtml);
				$("#house_list").html(tableHtml).promise().done(function () {
				  $("#house_list").listview().listview('refresh');
				});
				pageclick = false;

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
   
    $('.search-area select').each(function() {
        options[this.id] = this.value; //push value into options object
		//console.log (this.id + ":" + options[this.id]);
    });
	

    
}

function clearSelect(){
		//Search Clear
	
		$("select").val('').selectmenu('refresh');
		$('.province-panel .ui-btn').removeClass('ui-btn-active'); 
		$('#search_clear').hide(); 
		getFieldValues();
		options["city"] = '';
		update_houselist(options);
		
}

function processCityValue(selection){

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
var pageclick = false;

//options['sr'] = sr;
options['pageindex'] = page;
var currentCity= '';


$(document).on("pageshow","#page_main",function(){
	
	//$(".full-width-slider input").remove();
	
  	if ( sr == "Sale"){
		$("#menu_sale").addClass('ui-btn-active'); //make Sales Menu active
		$('#sr').val('Sale').selectmenu('refresh'); //Select Sale from SR select
	} else if ( sr == "Lease") {
		$("#menu_lease").addClass('ui-btn-active'); //make Lease Menu active
		$('#sr').val('Lease').selectmenu('refresh'); //Select Lease
	}
	
	getFieldValues();
	update_houselist(options);
	
	
	//Start Select Change Event  
	$(".search-area  select").change(function () {
		getFieldValues(); //Get updated Select
		$('#search_clear').show(); 
		update_houselist(options);
	});
	
	//
	
	$('#search_clear').click(function()	{ 
		clearSelect();
	});
	
	
	$('#page_previous').click(function()	{ 
		  pageclick = true;
		  options["pageindex"] = ( page > 0)? --page: 0;
		  update_houselist(options);
		  
	});
	$('#page_next').click(function()	{ 
	  ++page;
	  pageclick = true;
	  options["pageindex"] = page;
	  update_houselist(options);
	  
	});
	
	$(".province-panel select").change(function () {
		var id = "#" + this.id + "-button";
		$(id).addClass('ui-btn-active');
		console.log(this.value);
	
		$('.province-panel .ui-btn').removeClass('ui-btn-active');
		$(id).addClass('ui-btn-active');
		$('.province-panel select').not(this).val('').selectmenu("refresh");
		
		if ( currentCity != this.value) {
			console.log("City Changed from:" + currentCity + "To:" + options['city']);
			options["city"] = this.value;
			currentCity = this.value;
			$('#search_clear').show(); 
			update_houselist(options);
			
		}

	});
	


	//Detect scroll to bottom
	$(window).scroll(function(){
		if($(document).height() > $(window).height()) {
			if($(window).scrollTop() == $(document).height() - $(window).height()){
			  loading = true; //prevent further ajax loading
			  $('.animation_image').show(); //show loading image
			  ++page;
			  options["pageindex"] = page;
			  update_houselist(options);
			 		 
		   }
		}
	});
 
});

  
</script>

<!-- CITY Search Panel Start -->
<div data-role="panel" id="panel-city" class="province-panel" data-display="overlay" data-position-fixed="true">
	
	
	<fieldset class="city-area" data-role="controlgroup" data-mini="true">
		<select name="pro_on" id="prov_on" data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >安省</option>
			<option value="Toronto" >多伦多</option>
			<option value="Vaughan" >旺市</option>
			<option value="Markham" >万锦</option>
			<option value="Richmond Hill" >列治文山</option>
			<option value="Mississauga" >密西沙加</option>
			<option value="Brampton" >布兰普顿</option>
			<option value="Oakville" >奥克维尔</option>
			<option value="Burlington" >伯灵顿</option>
			<option value="Waterloo" >滑铁卢</option>
			<option value="Hamilton" >哈密尔顿</option>
			<option value="Kingston" >金斯敦</option>
			<option value="Windsor" >温莎</option>
			<option value="Kitchener" >基奇纳</option>
			<option value="Ottawa" >渥太华</option>
			<option value="London" >伦敦</option>
			<option value="Niagara Falls" >尼亚加拉瀑布</option>


		</select>	
		
		<select name="pro_bc" id="pro_bc"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >BC省</option>
			<option value="Surrey" >素里</option>
			<option value="Vancouver" >温哥华</option>
			<option value="Kelowna" >基洛拿</option>
			<option value="Kamloops" >坎卢普斯</option>
			<option value="Victoria" >维多利亚</option>
			<option value="NANAIMO" >纳奈莫</option>
			<option value="Richmond" >列治文</option>
			<option value="Abbotsford" >阿伯茨福德</option>
			<option value="Langley" >兰利</option>
			<option value="Vernon" >弗农</option>
			<option value="Burnaby" >本那比</option>

		
		</select>	
	    <select name="pro_alberta" id="pro_alberta"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >阿尔伯塔</option>
			<option value="Calgary" >卡尔加里</option>
			<option value="Edmonton" >埃德蒙顿</option>
			<option value="Grande Prairie" >大草原城</option>
			<option value="Fort McMurray" >麦克默里堡</option>
			<option value="Lethbridge" >莱斯布里奇</option>
			<option value="Red Deer" >红鹿</option>
			<option value="Rural Parkland County" >农村帕克兰县</option>
			<option value="Airdrie" >艾尔德里</option>
			<option value="Medicine Hat" >梅迪辛哈特</option>
			
		</select>
	    <select name="pro_newb" id="pro_newb"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >新不伦瑞克</option>	
			<option value="Moncton" >蒙克顿</option>
			<option value="SAINT JOHN" >圣约翰</option>
			<option value="Dieppe" >迪耶普</option>
			<option value="FREDERICTON" >弗雷德里克顿</option>
			<option value="Riverview" >江景</option>
			<option value="QUISPAMSIS" >QUISPAMSIS</option>
			<option value="MIRAMICHI" >米罗米奇</option>
			<option value="OROMOCTO" >奥罗莫克托</option>
			<option value="Shediac" >Shediac的</option>
			<option value="ROTHESAY" >罗斯西</option>
			<option value="HAMPTON" >HAMPTON</option>
			<option value="GRAND FALLS" >大瀑布</option>
			<option value="WOODSTOCK" >伍德司托克</option>
			<option value="EDMUNDSTON" >埃德门兹顿</option>
						
		</select>
	    <select name="pro_news" id="pro_news"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >新斯科舍省</option>
			<option value="Halifax" >哈利法克斯</option>
			<option value="Dartmouth" >达特茅斯</option>
			<option value="Bedford" >贝德福德</option>
			<option value="Hammonds Plains" >哈蒙兹平原</option>
			<option value="Middle Sackville" >中东萨克维尔</option>
			<option value="Bridgewater" >布里奇沃特</option>
			<option value="Lower Sackville" >下萨克维尔</option>
			<option value="Beaver Bank" >海狸银行</option>
			<option value="New Glasgow" >新格拉斯哥</option>
			<option value="Kingston" >金斯敦</option>
						
			
		</select>
	    <select name="pro_ed" id="pro_ed"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >爱德华王子岛省</option>	
			<option value="SUMMERSIDE" >萨默赛德</option>
			<option value="CHARLOTTETOWN" >夏洛特敦</option>
			<option value="STRATFORD" >斯特拉特福</option>
			<option value="CORNWALL" >康沃尔</option>
			
		</select>		
	    <select name="pro_newf" id="pro_newf"  data-icon="plus" data-corners="false" data-native-menu="false" data-iconpos="left">
			<option >纽芬兰及拉布拉多</option>	
			<option value="ST. JOHN'S" >圣约翰</option>
			<option value="CONCEPTION BAY SOUTH" >CONCEPTION BAY SOUTH</option>
			<option value="PARADISE" >天堂</option>
			<option value="MOUNT PEARL" >芒特波尔</option>
			<option value="CORNER BROOK" >科纳布鲁克</option>
			<option value="ST. PHILIPS" >圣菲力普</option>
			<option value="CARBONEAR" >CARBONEAR</option>
			<option value="GANDER" >甘德</option>

		</select>		    

	</fieldset>





</div>
<!-- CITY Search Panel End -->

<!-- 房源搜索列表开始 -->
<p></p>
<div id="house-search"  class="search-area " >

<!-- House Size Popup -->
<div data-role="popup" id="search_housesize" class="search-housesize ui-content">
 
		<div data-role="rangeslider" data-mini="true">
        <label for="housearea">房屋面积(平方尺):</label>
        <input type="range" name="housearea" id="housearea" min="0" max="6000" step="100" value="5000">
        <label for="landarea">土地面积(平方尺):</label>
        <input type="range" name="landarea" id="landarea" min="0" max="45600" step="500" value="50000">
		</div>
   
</div>
<!-- House Size Popup -->

<!-- search row1 start -->
<div class="ui-grid-c " >
	<div class="ui-block-a">
		<a href="#panel-city" class="ui-btn ">区域</a>
	</div>
	<div class="ui-block-b">
		<select name="sr" id="sel_sr"   data-corners="false" data-iconpos="none" data-native-menu="false"  >
			<option >状态</option>
			<option value="Sale" selected="selected">出售</option>
			<option value="Lease" >出租</option>
			
		</select>
	</div>	
	<div class="ui-block-c">
		<select name="type" id="sel_type" data-corners="false"  data-iconpos="none" data-native-menu="false"  style=>
			<option >房型</option>
			<option value="1" >独栋</option>
			<option value="2">联排</option>
			<option value="3">公寓</option>
			<option value="4">双拼</option>
			<option value="5">度假</option>
			<option value="6">农场</option>
			<option value="7">空地</option>
			<option value="8">其他</option>
		</select>
	</div>
	<div class="ui-block-d">	
		<select name="price" id="sel_price" data-corners="false" data-iconpos="none" data-native-menu="false" >
			<option >价格</option>
			<option value="0-30" > &lt 30</option>
			<option value="30-50" >30-50</option>
			<option value="50-100" >50-100</option>
			<option value="100-150" >100-150</option>
			<option value="150-300" >150-300</option>
			<option value="300-400" >300-450</option>
			<option value="450-500" >450-600</option>
			<option value="600-0" > &gt 600</option>
		</select>
	</div>
	
	<div class="ui-block-a">		
		<select name="bedroom" id="sel_bedroom"   data-corners="false"  data-iconpos="none" data-native-menu="false"  >
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
		</select>
	</div>
	<div class="ui-block-b">	

		<select name="washroom" id="sel_washroom"  data-corners="false" data-iconpos="none" data-native-menu="false"  >
			<option > 洗手间</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
		</select>

	</div>
	<div class="ui-block-c">	
		<select name="housearea" id="sel_housearea"  data-corners="false" data-iconpos="none"  data-native-menu="false"  >
			<option >尺寸</option>
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
	</div>

</div>		
<!-- search row2 end -->



</div>
<!-- 房源搜索列表结束 -->
    
    <div data-role="popup" id="myPopup" class="ui-content">
     
	 <h3 style="width:300px;">选择房屋和土地面积</h3>
		<form class="full-width-slider">
		    <div data-role="rangeslider" id="housearea" >
		        <label for="range-1a">房屋面积(平方尺):</label>
		        <input class="ui-hidden-accessible" type="range" name="range-1a" id="range-1a" min="0" max="100" value="40">
		        <label for="range-1b">房屋面积(平方尺):</label>
		        <input class="ui-hidden-accessible" type="range" name="range-1b" id="range-1b" min="0" max="100" value="80">
		    </div>
		</form>
	  
		<form class="full-width-slider">
	    <div data-role="rangeslider" id="housearea" >
	        <label for="range-1a">土地面积(平方尺):</label>
	        <input type="range" name="range-1a" id="range-1a" min="0" max="100" value="40">
	        <label for="range-1b">土地面积(平方尺):</label>
	        <input type="range" name="range-1b" id="range-1b" min="0" max="100" value="80">
	    </div>
		</form>
	
    </div>
  


<!-- 地图开始 --> 
<!-- 地图结束 -->

<!-- 房源列表开始 --> 
<div >

	
	<div id="house_list_header1" class="house-preview-total" data-role="controlgroup" data-type="horizontal" data-mini="true">
			<a href="#"  id="page_previous" data-role="button" data-icon="arrow-l" data-iconpos="notext">Left</a>
			<a href="#"  id= "page_next" data-role="button" data-icon="arrow-r" data-iconpos="notext">Right</a>
			 <a href="#" id="search_clear" data-role="button" data-icon="delete" data-iconpos="notext" style="display:none">清除选择</a>
		   <a href="#" data-role="button" >第<span id="page_count"></span>页: <span id="house_count"></span>套</a>
		   <div> </div>
	</div>


	
	<div class="house_preview"  >
		<ul data-role="listview"  data-inset="true" id="house_list" ></ul>
	<div>
</div>
<!-- 房源列表结束 -->

<!-- 下一页装载进程图标开始 --> 

<div class="animation_image" style="display:none" align="center">
	<img src="static/images/ajax-loader2.gif">
<div>

</div>
<!-- 下一页装载进程图标结束 --> 

