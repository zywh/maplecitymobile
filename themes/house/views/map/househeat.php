<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=places,visualization&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/househeat.js"></script>



<!-- 房源搜索列表开始 -->
<p id='debug'></p>


</div>
<!-- 房源搜索列表结束 -->


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
		
		
		

		
			//$("#debug").text(navigator.geolocation);
		if ( navigator.geolocation ) {
	        function success(pos) {
				lat = pos.coords.latitude;
				lng = pos.coords.longitude;
				
			
				househeat.initMap("google_map",lat,lng,mapZoom);
				
			}
	        function fail(error) {
				
        		
			
				househeat.initMap("google_map",lat,lng,mapZoom);
				//setMapView(lat,lng,mapZoom);
								
	        }
	
			navigator.geolocation.getCurrentPosition(success, fail, {enableHighAccuracy:true});
    	} else {
			
			househeat.initMap("google_map",lat,lng,mapZoom);
   		}
	
		 
		


	});




	
</script>
