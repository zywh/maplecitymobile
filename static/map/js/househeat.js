
var househeat = {
	

	
	initMap: function(mapId,lat,lng,zoomLevel) {
		markerArray = []; //make it global
		var initCenter = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var mapOptions = {
			center: initCenter,
			zoom: zoomLevel, //keep zoom and minZoom different to trigger initial map search
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			minZoom: 10,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true
			}
		};
		map = new google.maps.Map(document.getElementById(mapId), mapOptions); //make it global
		
		
		//google.maps.event.addListener(map, "bounds_changed", function() {
		google.maps.event.addListener(map, "idle", function() {
			
			househeat.changeMap(map,mapId);		
		});
	},	  


	clearAll: function(map) {
		if (markerArray) {
			for (var i in markerArray) {
				markerArray[i].setMap(null);
			}
			markerArray.length = 0;
		}
		
		htmlArray = [];
		htmlArrayPosition = 0;

	},
	
	changeMap: function(map,mapId) {
		var zlevel = map.getZoom();
		console.log("Change Map Zoomlevel:" + zlevel);
		
		househeat.clearAll(map);

				
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
						var heatmapData = [];
						var markerType = data.Type;
						console.log("HouseHeatmap:" + data.Total);


						
						$(data.MapHouseList).each(function(index) {
						var tlat = parseFloat(this.Lat);
						var tlng = parseFloat(this.Lng);
						var wlocation = {};
						wlocation["location"] = new google.maps.LatLng(tlat, tlng);
						var weight = ( this.Price > 1) ? this.Price: 0;
						wlocation.wight = this.Price;
						heatmapData.push(wlocation);
						console.log(tlat + tlng + this.Price);
						
												
						});
						heatmap = new google.maps.visualization.HeatmapLayer({
							data: heatmapData,
							radius: 30,
							//opacity: 0.8,
							map: map
						});	
					
						
						
					}
	  
				//End Success
				}
			});

	}
}		

