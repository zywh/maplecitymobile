
var maplemap = {
	
	getPrice2Scale: function(price){
		
		var wanPrice = Math.log2(price);
		var hue = 0;
		var hueStart = 0;
		var hueEnd = 100;
		
		var maxPrice = Math.log2(800); // In 10,000
		var minPrice = 0;
		var PriceStep = (hueEnd - hueStart)/(maxPrice - minPrice);
		
		if (wanPrice >= maxPrice) {
			hue = 0;
		}else {
			hue = hueEnd - PriceStep*wanPrice;
		}
		console.log("Price:" + price +" Hue:" + hue + "PriceStep:" + PriceStep);
		
		return Math.floor(hue);
	},
	setMarkerCss: function(countn,price) {
		var markercontent = '';
		//var color = "#ff4103";
		//var color = ;
		color = "hsl(" + maplemap.getPrice2Scale(price) +  ", 100%, 45%)";
		if (countn < 10){
		// markercontent = "<i class='common_bg icon_map_mark16' style='background-color:" + color + ";'><span>" + countn + "</span></i>";
			markercontent = "<i class='common_bg icon_map_mark1' style='background-color:" + color + ";'><span>" + countn + "</span></i>";
		}
		if ((countn >= 10) && (countn<100)){
			markercontent = "<i class='common_bg icon_map_mark2' style='background-color:" + color + ";'><span>" + countn + "</span></i>";
		}
		if ((countn >= 100) && (countn<1000)){
			markercontent = "<i class='common_bg icon_map_mark3' style='background-color:" + color + ";'><span>" + countn + "</span></i>";
		}
		if (countn >= 1000) {
			markercontent = "<i class='common_bg icon_map_mark4' style='background-color:" + color + ";'><span>" + countn + "</span></i>";
		}
		
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

	setContent: function(map,lat, lng, count, htmlinfo,price) {
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var content = maplemap.setMarkerCss(count,price);
	   var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});
		markerArray.push(marker);
		//maplemap.setMarkerCss(count);
	
		
		google.maps.event.addListener(marker, 'click', function(e) {
			
			
			if ( count >1) {
				$("#panelhtml").html(htmlinfo);
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
		//var content = "<i class='icon_map_mark'><span>" + totalCount + "</span></i>";
		var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		var content = maplemap.setMarkerCss(totalCount,400); //default color
	   var marker = new RichMarker({
			position: point,
			map: map,
			draggable: false,
			content: content,
			flat: true
		});

		//maplemap.setMarkerCss(totalCount);
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
	localSearch: function(searchName) {
		var mapCenter = map.getCenter();
		//console.log("SearchType:" + local_type);
		request = {
			location: mapCenter,
			radius: '3000',
			types: [local_type]
		};
		service = new google.maps.places.PlacesService(map);
		service.search(request, function(results, status) {
			
			maplemap.clearAll();
			if (status == google.maps.places.PlacesServiceStatus.OK) {
				for (var i = 0; i < results.length; i++) {
					maplemap.createMarker(results[i]);
				}
			}
		});
	},
	
	createMarker: function(place) {
		var placeLoc = place.geometry.location;
		var html;
		var markercontent;
		
		

		if (local_type == "school") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-graduation-cap'></span>";
		} else if (local_type == "restaurant") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-cutlery'></span>";
		} else if (local_type == "bus_station") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-cab'></span>";
		} else if (local_type == "grocery_or_supermarket") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-shopping-cart'></span>";
		} else if (local_type == "hospital") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-h-square'></span>";
		} else if (local_type == "bank") {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-money'></span>";
		} else {
			markercontent = "<span class='ui-btn-icon-notext ui-icon-fa-cab'></span>";
		}

		//var infowindow = new google.maps.InfoWindow();
		//var currentMark;
		/*
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location,
			icon: iconurl
		});*/
		
		var marker = new RichMarker({
			position: place.geometry.location,
			map: map,
			draggable: false,
			content: markercontent,
			flat: true
		});
		markerArray.push(marker);
		google.maps.event.addListener(marker, 'click', function() {
			//infowindow.setContent(place.name);
			//infowindow.open(map, this);
			//currentMark = this;
			$("#popuphtml").html("<div class='school_popup'><h3>名称：</h3><p>" + place.name + "</p></div>");
			$("#houseviewpopup").popup( "open" );
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
		listAllHtml ='';
		
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
						markerType = data.Data.Type;
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
							var totalprice = 0;
							
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
								var markerprice = Math.round(this.Price);

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
								listAllHtml = listAllHtml + li;	
								
								
									
								if (( nextLng != this.GeocodeLng) || (nextLat != this.GeocodeLat)){
									
									if ( count == 1) {
									//Generate single house popup view
									var html = "<div class='map_info_content'><a href='index.php?r=mhouse/view&id=" + this.MLS + "' data-ajax='false'> <img src='" + imgurl + "'></a></div>"
									+ "<div class='map_info_text'><div><a href='index.php?r=mhouse/view&id=" + this.MLS + "' data-ajax='false'>MLS: " + this.MLS + "</a><div>"
									+ "<div >价格：" + hprice + "</div>"
									+ "<div>地址：" + this.Address + "</div>" 
									+ "<div>城市：" + this.MunicipalityName + " " + this.ProvinceCname + " " + this.Zip + "</div>"
									+ "<div >类型：" + this.HouseType + " " + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨</div></div>";
									 
									
									
									maplemap.setContent(map,tlat, tlng, 1, html,markerprice);
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
										var price = (totalprice + markerprice)/count;
										maplemap.setContent(map,tlat, tlng, count, htmlp,price);
										count = 1;
										totalprice = 0;
										panelhtml = '';
									}
									
									
								} else { 
									++count;
									totalprice = totalprice + markerprice;
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

