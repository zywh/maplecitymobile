<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/maplemap.js"></script>



<!-- 房源搜索列表开始 -->

<p id='mapsearchpage'></p>  <!--Filler and identifier for autocomplete widget -->
<div id="house-search"  class="search-area " >

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
<div data-role="panel" id="houseviewpanel" data-display="overlay"> 
	<ul data-role="listview" data-inset="true" id="panelhtml">
	
	</ul>
</div> 
<div data-role="popup" id="houseviewpopup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>	
	<div id="popuphtml"></div>
</div>

<!-- map开始 -->
<div data-role="content" style="width:100%; height:100%; padding:0;" id="map_area">
	<div id="google_map" style="width:100%;height:100%"></div>                 
</div>
<!-- map结束 -->



<!-- List Start -->
<div id="house_list" class="house-list">
   <p>找到房源:<span id="house_count"></span></p> 
</div>
<!-- List End -->

<!-- Map Footer Start -->	
<div data-role="footer" data-position="fixed" data-fullscreen="true" style="text-align:center;" id="map_footer">
	 

	<a href="/" data-ajax="false" class="ui-btn ui-corner-all ui-icon-home ui-btn-icon-left ui-btn-icon-notext
	">Home</a>
	<a id="footer-location" class="ui-btn ui-corner-all ui-icon-location ui-btn-icon-left ui-btn-icon-notext
	">location</a>
	<a id="footer-list"  class="ui-btn ui-corner-all ui-icon-fa-navicon ui-btn-icon-left ui-btn-icon-notext
	">List</a>
	<a data-value="school" class="Search_local ui-btn ui-corner-all ui-icon-fa-graduation-cap ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	<a data-value="bus_station" class="Search_local ui-btn ui-corner-all ui-icon-fa-cab ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	<a data-value="bank" class="Search_local ui-btn ui-corner-all ui-icon-fa-money ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	<a data-value="restaurant" class="Search_local ui-btn ui-corner-all ui-icon-fa-cutlery ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	<a data-value="grocery_or_supermarket" class="Search_local ui-btn ui-corner-all ui-icon-fa-shopping-cart ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	<a data-value="hospital" class="Search_local ui-btn ui-corner-all ui-icon-fa-h-square ui-btn-icon-left ui-btn-icon-notext
	">More</a>
	
	

		
	
	
</div>
<!-- Map Footer -->		


<script>

function schoolMarker(results, status) {
	if (status === google.maps.places.PlacesServiceStatus.OK) {
		var service = new google.maps.places.PlacesService(map);
		for (var i = 0; i < results.length; i++) {
			var name = results[i].name;
			if ( name.match(/(Middle School|Public School|High School|Secondary School|Elementary School)/)) {
			   maplemap.createMarker(results[i]);
			}
		}
	}
}

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
	console.log("lat" + lat + "|" +lng);
	var maptype = '<?php echo $_GET["maptype"]; ?>'; //city or house or school
    var mapZoom = '<?php echo $_GET["zoom"]; ?>';
	var listAllHtml = ''; //hold house list
	
	
	
	$( document ).on( "pagecreate", "#page_main", function() {
		//Hide Footer
		$("#main_footer").hide();
		$("#map_footer").show();
		
		
		max_height();
		lat = (lat) ? lat: "43.6532";
		lng= (lng) ? lng: "-79.3832";
		
		maptype = (maptype) ? maptype: "default";
		sr = (sr) ? sr: "Sale";
		mapZoom= (mapZoom) ? mapZoom: 16;
		mapZoom = Number(mapZoom);
		
		
		
		//Start Select Change Event  
		$(".search-area  select").change(function () {
			getFieldValues(); //Get updated Select
		
			maplemap.changeMap(map);
			//console.log(options['Price']);
		});
		if ( maptype == 'default' ) {
			//$("#debug").text(navigator.geolocation);
			if ( navigator.geolocation ) {
		        function success(pos) {
					lat = pos.coords.latitude;
					lng = pos.coords.longitude;
					
				
					maplemap.initMap("google_map",lat,lng,mapZoom);
					
				}
		        function fail(error) {
					
	        		//mapZoom=10; //Default zoom level for city
				
					maplemap.initMap("google_map",lat,lng,mapZoom);
					//setMapView(lat,lng,mapZoom);
									
		        }
		
				navigator.geolocation.getCurrentPosition(success, fail, {enableHighAccuracy:true});
	    	} else {
				
				maplemap.initMap("google_map",lat,lng,mapZoom);
	   		}
		
		} 
		
		if ( maptype == 'city' ) {
			maplemap.initMap("google_map",lat,lng,mapZoom);
			maplemap.addCenterMarker(map,lat,lng,'city');
		}
		
		if ( maptype == 'school' ) {
			maplemap.initMap("google_map",lat,lng,mapZoom);
			maplemap.addCenterMarker(map,lat,lng,'school');
			
		}
		
		if ( maptype == 'house' ) {
			maplemap.initMap("google_map",lat,lng,mapZoom);
			maplemap.addCenterMarker(map,lat,lng,'house');
		}
	});

	$("#footer-location").click(function () {
		if ( navigator.geolocation ) {
	        function success(pos) {
				lat = pos.coords.latitude;
				lng = pos.coords.longitude;
				maplemap.setMapView(lat,lng,13);
			}
	        function fail(error) {
												
	        }
	
			navigator.geolocation.getCurrentPosition(success, fail, {enableHighAccuracy:true});
    	} 
	
	});
	
	$("#footer-list").click(function () {
		
		if ( markerType == 'house'  ) {
			$("#panelhtml").html(listAllHtml);
			$("#houseviewpanel").panel( "open" );
	
		} else {
			$("#popuphtml").html("找到房源太多，请在地图上点击缩小范围后在点击房源列表");
			$("#houseviewpopup").popup( "open" );
		}
	
	});
	
	$(".Search_local").click(function() {
		local_type = $(this).attr("data-value");
		maplemap.localSearch(local_type);
	});
	
	/*
	$("#footer-school").click(function () {
		local_type = "school";
		var center = map.getCenter();
		var service = new google.maps.places.PlacesService(map);
		
		service.nearbySearch({
			location: center,
			radius: 3000,
			type: ['school']
		}, schoolMarker);
	
	});*/
	
</script>
