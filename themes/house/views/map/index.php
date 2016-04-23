

<!-- 房源搜索列表开始 -->
<p></p>
<div id="house-search"  class="search-area " >


<!-- search row1 start -->
<div class="ui-grid-c " >
	<div class="ui-block-a">
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
	<div class="ui-block-b">	
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
	<div class="ui-block-c">		
		<select name="bedroom" id="sel_bedroom"   data-corners="false"  data-iconpos="none" data-native-menu="false"  >
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
		</select>
	</div>
	<div class="ui-block-d">	
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
</div>		

</div>
<!-- 房源搜索列表结束 -->

<!-- map开始 -->
<div data-role="content" style="width:100%; height:100%; padding:0;" id="map_area">
	<div data-role="popup" id="houseviewpopup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>	
	<div id="popuphtml"></div>
	</div>
	<div id="google_map" style="width:100%;height:100%"></div>                 
</div>
<!-- map结束 -->



<!-- List Start -->
<div id="house_list" class="house-list">
   <p>找到房源:<span id="house_count"></span></p> 
</div>




<script>
function max_height() {
  
    var viewport_height = $(window).height();
	var header_height = $("#main_header").height();
	var footer_height = $("#main_footer").height();
	var doc_height = $(document).height();
    //console.log("ViewH:" + viewport_height + "DocH:" + doc_height+ "HeaderH:" + header_height + "FooterH:" + footer_height);
  
   $('#map_area').css("height", $(document).height() - 21);
}

function getFieldValues() {
   
    $('.search-area select').each(function() {
        options[this.id] = this.value; //push value into options object
		console.log (this.id + ":" + options[this.id]);
    });
	

}
 
	var options = {};  
	var sr = '<?php echo $_GET['sr'];?>';	
	var lat = '<?php echo $_GET["lat"]; ?>';
	var lng = '<?php echo $_GET["lng"]; ?>';
	var type = '<?php echo $_GET["type"]; ?>'; //city or house or school
    var mapZoom = '<?php echo $_GET["zoom"]; ?>';

	
	
	$( document ).on( "pagecreate", "#page_main", function() {
		//Hide Footer
		//$("#main_footer").hide();
		
		//Default Center and zoom
		//$('#map_area').css("height", $(document).height());	
		max_height();
		lat = (lat) ? lat: "54.649739";
		lng= (lng) ? lng: "-93.045726";
		type = (type) ? type: "0";
		sr = (sr) ? sr: "Sale";
		mapZoom= (mapZoom) ? mapZoom: 14;
		
		
				//Start Select Change Event  
		$(".search-area  select").change(function () {
			getFieldValues(); //Get updated Select
			//$('#search_clear').show(); 
			//center = 
			//maplemap.initMap("google_map",lat,lng,mapZoom);
			maplemap.changeMap(map);
			//console.log(options['Price']);
		});
		
		if ( navigator.geolocation ) {
	        function success(pos) {
				lat = pos.coords.latitude;
				lng = pos.coords.longitude;
				//console.log("GeoLocation Mapcenter:" + pos.coords.latitude +"," + pos.coords.longitude);
				maplemap.initMap("google_map",lat,lng,mapZoom);
				
			}
	        function fail(error) {
				
        		mapZoom="10"; //Default zoom level for city
				//console.log("Fail to Get Geo Location Center to City:" + lat + ":" + lng);
				maplemap.initMap("google_map",lat,lng,mapZoom);
				//setMapView(lat,lng,mapZoom);
								
	        }
	
			navigator.geolocation.getCurrentPosition(success, fail, {enableHighAccuracy:true});
    	} else {
			
			maplemap.initMap("google_map",lat,lng,mapZoom);
   		}
		

	});


	
</script>
