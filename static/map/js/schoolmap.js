
var schoolmap = {
	
	getRating2Scale: function(rating){
		
		var color = {};
		var hueEnd = 130;
		var ratingStep = hueEnd/10; //Rating is 0-10
		var hue = Math.ceil(ratingStep*rating);
		color.bg = "hsl(" + hue +  ", 100%, 50%)";
		color.font="#000";
		if (rating == "无") {
			color.bg="#757575";
			color.font="#fff";
		};
				
		return color;
	},
	setMarkerCss: function(rating) {
		var bg = schoolmap.getRating2Scale(rating).bg;
		var font = schoolmap.getRating2Scale(rating).font;
		var markercontent = "<i class='common_bg icon_map_mark2' style='background-color:" + bg + ";'><span style='color:" + font + ";'>" + rating + "</span></i>";
		return markercontent;
		
	},
	
	initMap: function(mapId,lat,lng,zoomLevel) {
		markerArray = []; //make it global
		var initCenter = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var mapOptions = {
			center: initCenter,
			zoom: zoomLevel, //keep zoom and minZoom different to trigger initial map search
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			minZoom: 9,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true
			}
		};
		map = new google.maps.Map(document.getElementById(mapId), mapOptions); //make it global
		
		
		//google.maps.event.addListener(map, "bounds_changed", function() {
		google.maps.event.addListener(map, "idle", function() {
			
			schoolmap.changeMap(map,mapId);		
		});
	},	  

	setMapView: function(lat, lng, zoom) {
		map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
		map.setZoom(parseInt(zoom));
	}, 

	setContent: function(map,lat, lng, htmlinfo,rating) {
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var content = schoolmap.setMarkerCss(rating);
		var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});
		markerArray.push(marker);
		//marker.setZindex(rating*10);
		google.maps.event.addListener(marker, 'click', function(e) {
			
		
				$("#popuphtml").html(htmlinfo);
				$("#schoolviewpopup").popup( "open" );
			
		});
		
		//htmlArrayPosition++;
		
	 
	},

	setContentCount: function(map,lat, lng, totalCount, city,rating) {
		
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var content = schoolmap.setMarkerCss(rating); //default color
	    var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});

	
		markerArray.push(marker);
		google.maps.event.addListener(marker, 'click', function() {
			map.setCenter(this.position);
			var currentzoom = map.getZoom();
			map.setZoom(currentzoom + 2);
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
		
		schoolmap.clearAll(map);
		var gridSize = 60;	//60px
		//get element size to calcute number of grid
		var mapHeight = $("#" + mapId).height();
		var mapWidth = $("#" + mapId).width();
		var gridx = Math.ceil(mapWidth/gridSize);
		var gridy = Math.ceil(mapHeight/gridSize);
				
		var _sw = map.getBounds().getSouthWest();
		var _ne = map.getBounds().getNorthEast();
		var centerlat = (_ne.lat() + _sw.lat()) / 2;
		var centerlng = (_ne.lng() + _sw.lng()) / 2;
		var marker;
		_bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
	   
		
			$.ajax({
				url: 'index.php?r=map/getSchoolList',
				type: 'POST',
				dataType: 'json',
				data: {
					bounds: _bounds,
					pingfen: options['sel_pingfen'], 
					gridx : gridx,
					gridy : gridy,
					type: options['sel_type'], 
					xingzhi: options['sel_xingzhi'],
					rank: options['sel_rank'] 					
				},
				beforeSend: function() {
					//$(".loadhouse").show();
				},
				complete: function() {
					//$(".loadhouse").hide();
				},
				success: function(data) {
					
					if (!data.IsError) {
						var markerType = data.type;
						console.log("School List Type:" + markerType);
						if ( markerType == 'grid'){
							
							for (var p in data.gridList) {
							   
								var school = data.gridList[p];
								var schoolcount = school.SchoolCount;
								if (schoolcount > 0){
									var avgrating = Math.round(school.TotalRating *10 / schoolcount)/10;
									//console.log( "Name:" + school.GeocodeLat + "Lat:" + school.GeocodeLng + "Count:"+ school.SchoolCount + "TotalRating:" + school.TotalRating + "AvgRating:" + avgrating);
									schoolmap.setContentCount(map,school.GeocodeLat, school.GeocodeLng, school.SchoolCount, school.GridName, avgrating);
								};
							};
						}
						
						if ( markerType == 'school'){
							
							$(data.SchoolList).each(function(index) {
							//console.log("Current:" + this.GeocodeLng + "Next:" + nextLng + "Total:" + totalhouse + "index:" + index + "Count:" + count);
							var school = this.School;
							var rank = this.Paiming;
							var rating = this.Pingfen;
							var tlat = parseFloat(this.Lat);
							var tlng = parseFloat(this.Lng);

							//Generate single house popup view
							var html = "<div class='map_info_content'>"
							+ "<div><a href='index.php?r=map&lat=" + tlat + "&lng=" + tlng + "&maptype=school&zoom=15'" +" data-ajax='false'>名称：" + school + "</a></div>"
							+ "<div>年级：" + this.Grade + "</div>" 
							+ "<div>地址：" + this.Address + "</div>" 
							+ "<div>城市：" + this.City + " " + this.Province + " " + this.Zip + "</div>"
							+ "<div>排名：" + rank + " 评分：" + rating + "</div></div>";
							
							schoolmap.setContent(map,tlat, tlng, html,rating);
						
							
							});

						}
						
						//End of School Marker
					}
	  
				//End Success
				}
			});

	}
}		

