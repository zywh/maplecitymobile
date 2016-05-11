<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/schoolmap.js"></script>



<!-- 房源搜索列表开始 -->
<p id='debug'></p>
<div id="school-search"  class="search-area" >

<div class="ui-grid-c " >


	<div class="ui-block-a">
		<select name="type" id="sel_type" data-corners="false"  data-iconpos="none" data-native-menu="false"  style=>
			<option >类型</option>
			<option value="e" >小学</option>
			<option value="s">中学</option>
			<option value="">不限</option>
		</select>
	</div>
	<div class="ui-block-b">	
		<select name="xingzhi" id="sel_xingzhi"  data-corners="false" data-iconpos="none"  data-native-menu="false"  >
			<option >性质</option>
			<option value="Public" >公立</option>
			<option value="Catholic">天主教</option>
			<option value="Private">私立</option>
			<option value="">不限</option>
		</select>
	</div>
	
	<div class="ui-block-c">	
		<select name="rank" id="sel_rank" data-corners="false" data-iconpos="none" data-native-menu="false" >
			<option >排名</option>
			<option value="10" > 前10</option>
			<option value="50" > 前50</option>
			<option value="100" > 前100</option>
			<option value="" > 不限</option>
		</select>
	</div>
	<div class="ui-block-d">		
		<select name="pingfen" id="sel_pingfen"   data-corners="false"  data-iconpos="none" data-native-menu="false"  >
			<option >评分</option>
			<option value="5"> &gt 5 </option>
			<option value="6"> &gt 6 </option>
			<option value="7"> &gt 7 </option>
			<option value="8"> &gt 8 </option>
			<option value="9"> &gt 9 </option>
			<option value="" > 不限</option>			
		</select>
	</div>
</div>		

</div>
<!-- 房源搜索列表结束 -->

<div data-role="popup" id="schoolviewpopup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>	
	<div id="popuphtml"></div>
</div>

<!-- map开始 -->
<div data-role="content" style="width:100%; height:100%; padding:0;" id="map_area">
	<div id="google_map" style="width:100%;height:100%"></div>                 
</div>
<!-- map结束 -->





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
	var lat = '<?php echo $_GET["lat"]; ?>';
	var lng = '<?php echo $_GET["lng"]; ?>';
	console.log("lat" + lat + "|" +lng);
	var mapZoom = '<?php echo $_GET["zoom"]; ?>';
		
	
	$( document ).on( "pagecreate", "#page_main", function() {
		//Hide Footer
		$("#main_footer").hide();
		//$("#map_footer").show();
		
		
		
		
		max_height();
		lat = (lat) ? lat: "43.6532";
		lng= (lng) ? lng: "-79.3832";
		mapZoom= (mapZoom) ? mapZoom: 13;
		mapZoom = Number(mapZoom);
		
		
		
		//Start Select Change Event  
		$(".search-area  select").change(function () {
			getFieldValues(); //Get updated Select
		
			schoolmap.changeMap(map);
			//console.log(options['Price']);
		});
		
			//$("#debug").text(navigator.geolocation);
		if ( navigator.geolocation ) {
	        function success(pos) {
				lat = pos.coords.latitude;
				lng = pos.coords.longitude;
				
			
				schoolmap.initMap("google_map",lat,lng,mapZoom);
				
			}
	        function fail(error) {
				
        		
			
				schoolmap.initMap("google_map",lat,lng,mapZoom);
				//setMapView(lat,lng,mapZoom);
								
	        }
	
			navigator.geolocation.getCurrentPosition(success, fail, {enableHighAccuracy:true});
    	} else {
			
			schoolmap.initMap("google_map",lat,lng,mapZoom);
   		}
	
		 
		


	});




	
</script>
