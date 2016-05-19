
var househeat = {
	

	
	initMap: function(mapId,lat,lng,zoomLevel) {
		markerArray = []; //make it global
		heatmapData = [];
		
			
		var initCenter = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var mapOptions = {
			center: initCenter,
			zoom: 11, //keep zoom and minZoom different to trigger initial map search
			//zoomControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			//minZoom: 10,
			maxZoom: 13,
			zoomControl: false,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true
			}
		};
		map = new google.maps.Map(document.getElementById(mapId), mapOptions); //make it global
		heatmap = new google.maps.visualization.HeatmapLayer({
							map: map
		});
		
		//google.maps.event.addListener(map, "bounds_changed", function() {
		google.maps.event.addListener(map, "idle", function() {
			
			househeat.changeMap(map,mapId);		
		});
	},	  


	clearAll: function(map) {
		
		if (heatmapData) {
			
			heatmap.setMap(null);
			heatmap.getData().j = [];
			console.log("clear heatmap");
		}
		heatmapData = [];		
	},
	
	changeMap: function(map,mapId) {
		var zlevel = map.getZoom();
		console.log("Change Map Zoomlevel:" + zlevel);
		
		
		househeat.clearAll();
				
		var _sw = map.getBounds().getSouthWest();
		var _ne = map.getBounds().getNorthEast();
		var centerlat = (_ne.lat() + _sw.lat()) / 2;
		var centerlng = (_ne.lng() + _sw.lng()) / 2;
		var marker;
		_bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
	   
		
			$.ajax({
				url: 'index.php?r=map/getHouseheatmap',
				type: 'POST',
				dataType: 'json',
				data: {
					bounds: _bounds,
							
				},
				beforeSend: function() {
					//$(".loadhouse").show();
				},
				complete: function() {
					//$(".loadhouse").hide();
				},
				success: function(data) {
					
					if (!data.IsError) {
						
						var markerType = data.Type;
						console.log("HouseHeatmap:" + data.Total);


						
						$(data.MapHouseList).each(function(index) {
						var tlat = parseFloat(this.Lat);
						var tlng = parseFloat(this.Lng);
						var wlocation = {};
						wlocation["location"] = new google.maps.LatLng(tlat, tlng);
						//var weight = ( Number(this.Price) > 8) ? this.Price: 10;
						wlocation.wight = Number(this.Price);
						heatmapData.push(wlocation);
						console.log(tlat +" LNG:" + tlng + "Price:" + this.Price);
						
												
						});
						heatmap = new google.maps.visualization.HeatmapLayer({
							data: heatmapData,
							radius: 20,
							opacity: 0.3,
							maxIntensity: 2,
							map: map
						});	
					
						
						
					}
	  
				//End Success
				}
			});

	}
}		

