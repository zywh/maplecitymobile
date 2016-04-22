
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
	//$('#ID').css("height", $(document).height());
	var header_height = $("main_header").height();
	var footer_height = $("main_footer").height();
    
   // var content_height = viewport_height - header.outerHeight() - footer.outerHeight();
   
   $('#map_area').css("height", $(document).height() - footer_height - header_height);
}


    //google map
    var city = 0;
	var lat = '<?php echo $_GET["lat"]; ?>';
	var lng = '<?php echo $_GET["lng"]; ?>';
    var mapZoom = '<?php echo $_GET["zoom"]; ?>';
	var markerArray = [];
	//var map;
    
	
	
	$( document ).on( "pagecreate", "#page_main", function() {
		//Hide Footer
		//$("#main_footer").hide();
		
		//Default Center and zoom
		$('#map_area').css("height", $(document).height());	
		lat= (lat) ? lat: "54.649739";
		lng= (lng) ? lng: "-93.045726";
		mapZoom= (mapZoom) ? mapZoom: 10;
		console.log("Map Init" + lat + ":" + lng);
		
		if ( navigator.geolocation ) {
	        function success(pos) {
				lat = pos.coords.latitude;
				lng = pos.coords.longitude;
				console.log("GeoLocation Mapcenter:" + pos.coords.latitude +"," + pos.coords.longitude);
				maplemap.initMap("google_map",lat,lng,mapZoom);
				
			}
	        function fail(error) {
				
        		mapZoom="10"; //Default zoom level for city
				console.log("Fail to Get Geo Location Center to City:" + lat + ":" + lng);
				initMap("google_map",lat,lng,mapZoom);
				//setMapView(lat,lng,mapZoom);
								
	        }
	        // Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
	        navigator.geolocation.getCurrentPosition(success, fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
    	} else {
			
			//NO location is found
			console.log("Center to City:" + lat + ":" + lng);
			initMap("google_map",lat,lng,mapZoom);
							
   		}
		

	});


	
</script>
