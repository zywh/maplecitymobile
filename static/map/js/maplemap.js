
var maplemap = {


	initMap: function(mapId,lat,lng,zoomLevel) {
		markerArray = []; //make it global
		var initCenter = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var mapOptions = {
			center: initCenter,
			zoom: zoomLevel, //keep zoom and minZoom different to trigger initial map search
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			minZoom: 4,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true
			}
		};
		map = new google.maps.Map(document.getElementById(mapId), mapOptions); //make it global
		
		
		//google.maps.event.addListener(map, "bounds_changed", function() {
		google.maps.event.addListener(map, "idle", function() {
			
			maplemap.changeMap(map,mapId);		
		});
	},	  

	setMapView: function(lat, lng, zoom) {
		map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
		map.setZoom(parseInt(zoom));
	}, 

	setContent: function(map,lat, lng, count, htmlinfo) {
		
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		//console.log(lat + ":" + lng);
		var content = "<i class='common_bg icon_map_mark'><span>" + count + "</span></i>";
	   var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});
		//markerArray.push(marker);
		//htmlArray[htmlArrayPosition] = htmlinfo;
		
		
		/*
		var marker = new  google.maps.Marker({
			position: point,
			map: map,
			draggable: false,
			label: "1"
			
		});*/
		
	
		
		google.maps.event.addListener(marker, 'click', function(e) {
			
			
			if ( count >1) {
				$("#panelhtml").html(htmlinfo);
				//$("#panelhtml").html(htmlArray[htmlArrayPosition]);
				$("#houseviewpanel").panel( "open" );
				
			}else {
				$("#popuphtml").html(htmlinfo);
				$("#houseviewpopup").popup( "open" );
			}
			
			
			//info.open(map, marker);
			
			//setMapView(parseFloat(lat), parseFloat(lng), mapZoom);
		});
		
		//htmlArrayPosition++;
		
	 
	},
	
	addCenterMarker: function(map,lat,lng,maptype) {
		
		var iconbase = "/static/map/images/";
		var iconurl;

		if ( maptype == "school") {
			iconurl = iconbase + "university.png";
		} else if (maptype == "house") {
			iconurl = iconbase + "bighouse.png";
		} else if (maptype == "city") {
			iconurl = iconbase + "city.png";
		} else {
			iconurl = iconbase + "city.png";
		}
		
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var marker = new google.maps.Marker({
				map: map,
				position: point,
				icon: iconurl
		});
	},

	setContentCount: function(map,lat, lng, totalCount, city) {
		var content = "<i class='common_bg icon_map_mark'><span>" + totalCount + "</span></i>";
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		
	   var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});

		
		/*Regular Marker
		var marker = new google.maps.Marker({
			position: point,
			map: map,
			draggable: false,
			label: totalCount
		});
		*/
		
		markerArray.push(marker);
		google.maps.event.addListener(marker, 'click', function() {
			map.setCenter(this.position);
			var currentzoom = map.getZoom();
			map.setZoom(currentzoom + 2);
		});

		
	},

	createMarker: function(place) {
		var placeLoc = place.geometry.location;
		var html;
		var iconbase = "/static/map/images/";
		var iconurl;

		if (local_type == "school") {
			html = "<i class='homelist icon_scool3'></i>";
			iconurl = iconbase + "m1.jpg";
		} else if (local_type == "restaurant") {
			html = "<i class='homelist icon_dining3'></i>";
			iconurl = iconbase + "m2.jpg";
		} else if (local_type == "bus_station") {
			html = "<i class='homelist icon_traffic3'></i>";
			iconurl = iconbase + "m3.jpg";
		} else if (local_type == "grocery_or_supermarket") {
			html = "<i class='homelist icon_shopping3'></i>";
			iconurl = iconbase + "m4.jpg";
		} else if (local_type == "hospital") {
			html = "<i class='homelist icon_hospital3'></i>";
			iconurl = iconbase + "m5.jpg";
		} else if (local_type == "bank") {
			html = "<i class='homelist icon_bank3'></i>";
			iconurl = iconbase + "m6.jpg";
		} else {
			html = "<i class='common_bg icon_map_mark'></i>";
		}

		var infowindow = new google.maps.InfoWindow();
		var currentMark;
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location,
			icon: iconurl
		});
		google.maps.event.addListener(marker, 'mouseover', function() {
			infowindow.setContent(place.name);
			infowindow.open(map, this);
			currentMark = this;
		});
		google.maps.event.addListener(marker, 'mouseout', function() {
			currentMark.setMap(null);
			//infowindow.setContent(place.name);
			//infowindow.open(map, this);
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
		/*
		if (infowindow) {
			for (var i in infowindow) {
				infowindow[i] = null;
			}
			infowindow.length = 0;
		}
		*/
		
	},
			


	changeMap: function(map,mapId) {
		console.log("Change Map");
		
		maplemap.clearAll(map);
		
		var gridSize = 50;	//50px
		//get element size to calcute number of grid
		var mapHeight = $("#" + mapId).height();
		var mapWidth = $("#" + mapId).width();
		var gridx = Math.ceil(mapWidth/gridSize);
		var gridy = Math.ceil(mapHeight/gridSize);
				
		var _sw = map.getBounds().getSouthWest();
		var _ne = map.getBounds().getNorthEast();
		var centerlat = (_ne.lat() + _sw.lat()) / 2;
		var centerlng = (_ne.lng() + _sw.lng()) / 2;

			
		var HouseArray = [];	
		var marker;

		_bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
	   
		
			$.ajax({
				url: 'index.php?r=map/getMapHouse',
				type: 'POST',
				dataType: 'json',
				data: {
					bounds: _bounds,
					gridx : gridx,
					gridy : gridy,
					sr : 	options['sel_sr'], 
					housetype: options['sel_type'], 
					houseprice: options['sel_price'],
					houseroom: options['sel_bedroom'],	
					housearea: options['sel_housearea']
					
				},
				beforeSend: function() {
					//$(".loadhouse").show();
				},
				complete: function() {
					//$(".loadhouse").hide();
				},
				success: function(data) {
					
					if (!data.IsError) {
						var houseCount =  data.Data.Total;
						$("#house_count").text(houseCount);
						var markerType = data.Data.Type;
						//Start City Markers
						if ((markerType == 'city') || (markerType == 'grid')) {
							for (var p in data.Data.AreaHouseCount) {
							   
								var areaHouse = data.Data.AreaHouseCount[p];
								if (areaHouse.HouseCount > 0){
								//	console.log( "Name:" + areaHouse.NameCn + "Lat:" + areaHouse.GeocodeLat + "Count:"+ areaHouse.HouseCount );
								maplemap.setContentCount(map,areaHouse.GeocodeLat, areaHouse.GeocodeLng, areaHouse.HouseCount.toString(), areaHouse.NameCn);
								
								}
							}
						}
						//End of City Markers


									  
						if ( markerType == 'house'  ) {
							
							var count = 1;
							var panelhtml = '';
							var totalhouse = data.Data.MapHouseList.length;
							$(data.Data.MapHouseList).each(function(index) {
								
								if ( index < (totalhouse - 1) ) {
									var nextLat = data.Data.MapHouseList[index + 1].GeocodeLat;
									var nextLng = data.Data.MapHouseList[index + 1].GeocodeLng;
								
								}
								//console.log("Current:" + this.GeocodeLng + "Next:" + nextLng + "Total:" + totalhouse + "index:" + index + "Count:" + count);
								var imgurl = "/" + this.CoverImg;
								var imgurltn = "/" + this.CoverImgtn;
								var hprice = (this.SaleLease == 'Lease') ? Math.round(this.Price) * 10000 + '加元/月' : Math.round(this.Price) + '万加元';
								var markerprice = Math.round(this.Price) + '万';

								var tlat = parseFloat(this.GeocodeLat);
								var tlng = parseFloat(this.GeocodeLng);

								var li =  "<li class='panel_house_view' data-icon='false'>" 
								
									+ "<a data-ajax='false' href='index.php?r=mhouse/view&id=" + this.MLS + "'>" 
									+ "<img src=' " + imgurltn + "'>" 
									+ " <div class='panel_house_text'>"
									+ "<div>" + this.Address + "</div>" 
									+ "<div >" + this.MunicipalityName + " " + this.ProvinceCname + "</div>" 
									+ "<div >" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</div>" 
									+ "<div>价钱:"  + hprice + "</div> </div>" 
									+ "</a>"
									
									+ "</li>";
									
								if (( nextLng != this.GeocodeLng) || (nextLat != this.GeocodeLat)){
									
									if ( count == 1) {
									//Generate single house popup view
									var html = "<div class='map_info_content'><a href='index.php?r=mhouse/view&id=" + this.MLS + "' data-ajax='false'> <img src='" + imgurl + "'></a></div>"
									+ "<div class='map_info_text'><div><a href='index.php?r=mhouse/view&id=" + this.MLS + "' data-ajax='false'>MLS: " + this.MLS + "</a><div>"
									+ "<div >价格：" + hprice + "</div>"
									+ "<div>地址：" + this.Address + "</div>" 
									+ "<div>城市：" + this.MunicipalityName + " " + this.ProvinceCname + " " + this.Zip + "</div>"
									+ "<div >类型：" + this.HouseType + " " + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨</div></div>";
									 
									maplemap.setContent(map,tlat, tlng, markerprice, html);
									} else 
									{
									//generate panel list view
									//var li =  "<li class='panel_house_view' data-icon='false'>" 
								
									+ "<a data-ajax='false' href='index.php?r=mhouse/view&id=" + this.MLS + "'>" 
									+ "<img src=' " + imgurltn + "'>" 
									+ " <div class='panel_house_text'>"
									+ "<div>" + this.Address + "</div>" 
									+ "<div >" + this.MunicipalityName + " " + this.ProvinceCname + "</div>" 
									+ "<div >" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</div>" 
									+ "<div>价钱:"  + hprice + "</div> </div>" 
									+ "</a>"
									
									+ "</li>";
										var htmlp = panelhtml + li;
										maplemap.setContent(map,tlat, tlng, count, htmlp);
										count = 1;
										panelhtml = '';
									}
									
									
								} else { 
									++count;
							
									panelhtml = panelhtml + li;
																		
								}
								

							});

							//END of LOOP
							if (houseCount > 30) {
								//markerClusterer = new MarkerClusterer(map, markerArray);
							}
						}
						//End of House Marker
					}
	  
				//End Success
				}
			});

		}
}		

