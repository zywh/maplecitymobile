<script type="text/javascript" src="/themes/house/js/jquery-1.12.2.min.js"></script>




<!-- map开始 -->


<div data-role="content" style="width:100%; height:100%; padding:0;" id="map_area">
	<div data-role="popup" id="houseviewpopup">
		
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
	var doc_height = $(document).height();
    
   // var content_height = viewport_height - header.outerHeight() - footer.outerHeight();
   
   $('#map_area').css("height", $(document).height());
}


function initMap(mapId,lat,lng,zoomLevel) {
	
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
	map = new google.maps.Map(document.getElementById(mapId), mapOptions);

	
	google.maps.event.addListener(map, "bounds_changed", function() {
		changeMap(mapId);		
	});
}	  
function setMapView(lat, lng, zoom) {
	map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
	map.setZoom(parseInt(zoom));
} 

function setContent(lat, lng, content, html, isShow) {
	var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
	//console.log(lat + ":" + lng);
	
   var marker = new RichMarker({
		position: point,
		map: map,
		draggable: false,
		content: content,
		flat: true
	});
	
	/*
	var marker = new  google.maps.Marker({
		position: point,
		map: map,
		draggable: false,
		label: "1"
		
	});*/
	
	
	markerArray.push(marker);
	var info = new google.maps.InfoWindow({
		content: html,
		size: new google.maps.Size(50, 50),
		pixelOffset: new google.maps.Size(0, -24)
	});
	infowindow.push(info);


	google.maps.event.addListener(marker, 'click', function(e) {
		
		$("#houseviewpopup").html(html);
		//info.open(map, marker);
		
		//setMapView(parseFloat(lat), parseFloat(lng), mapZoom);
	});
	
 
}


function setContentCount(lat, lng, totalCount, city) {
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
	
	var infocontent = '<p style="margin-bottom:0px;">' + city + ' 共有' + totalCount + '个楼盘</p>';
	var infowindow = new google.maps.InfoWindow({
		pixelOffset: new google.maps.Size(0, -24)
	});
	/*
	google.maps.event.addListener(marker, 'mouseover', (function(marker, infocontent, infowindow) {
		return function() {
			infowindow.setContent(infocontent);
			infowindow.open(map, marker);
		};
	})(marker, infocontent, infowindow));

	google.maps.event.addListener(marker, 'mouseout', (function(marker, infocontent, infowindow) {
		return function() {
			infowindow.close();
		};
	})(marker, infocontent, infowindow));
	*/

	google.maps.event.addListener(marker, 'click', function() {
		map.setCenter(this.position);
		map.setZoom(14);
	});


}

function createMarker(place) {
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

	publicArray[publicArray.length] = marker;
} 

function clearAll(map) {
	if (markerArray) {
		for (var i in markerArray) {
			markerArray[i].setMap(null);
		}
		markerArray.length = 0;
	}
	if (markerClusterer) {
		//console.log("Clear Cluster Markers");
		markerClusterer.clearMarkers();
	}


	if (infowindow) {
		for (var i in infowindow) {
			infowindow[i] = null;
		}
		infowindow.length = 0;
	}
	if (publicArray) {
		for (var i in publicArray) {
			publicArray[i].setMap(null);
		}
		publicArray.length = 0;
	}
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	}
} ///设置地图位置大小
        
//汇率
var getRate = function(code) {
	return '加元';
}

function changeMap(mapId) {
        console.log("Change Map");

		clearAll(map);
        var gridSize = 50;	//50px
        //get element size to calcute number of grid
		var mapHeight = $("#" + mapId).height();
		var mapWidth = $("#" + mapId).width();
		gridx = Math.ceil(mapWidth/gridSize);
		gridy = Math.ceil(mapHeight/gridSize);
		console.log("W:" + mapWidth + "H:" + mapHeight + "XY:" + gridx + "x" + gridy );
		
        var _sw = map.getBounds().getSouthWest();
        var _ne = map.getBounds().getNorthEast();
        var centerlat = (_ne.lat() + _sw.lat()) / 2;
        var centerlng = (_ne.lng() + _sw.lng()) / 2;

		/*
        var number1 = _sw.lat() + "," + _sw.lng() + "," + centerlat + "," + centerlng;
        var number2 = centerlat + "," + centerlng + "," + _ne.lat() + "," + _ne.lng();
        var number3 = centerlat + "," + _sw.lng() + "," + _ne.lat() + "," + centerlng;
        var number4 = _sw.lat() + "," + centerlng + "," + centerlat + "," + _ne.lng();
        var lenght = 1;
	    */
        
        HouseArray = [];
        var forIndex = 0;
        var Arrayindex = 0;
      

        _bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
   

        $.ajax({
            url: '<?php echo Yii::app()->createUrl('map/getMapHouse'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                bounds: _bounds,
				gridx : gridx,
				gridy : gridy,
                zoom: mapZoom
   
            },
            beforeSend: function() {
                //$(".loadhouse").show();
            },
            complete: function() {
                //$(".loadhouse").hide();
            },
            success: function(data) {
                
                if (!data.IsError) {
					houseCount =  data.Data.Total;
					$("#house_count").text(houseCount);
                    var markerType = data.Data.Type;
					//Start City Markers
                    if ((markerType == 'city') || (markerType == 'grid')) {
                        for (var p in data.Data.AreaHouseCount) {
                           
							var areaHouse = data.Data.AreaHouseCount[p];
							if (areaHouse.HouseCount > 0){
							//	console.log( "Name:" + areaHouse.NameCn + "Lat:" + areaHouse.GeocodeLat + "Count:"+ areaHouse.HouseCount );
                            setContentCount(areaHouse.GeocodeLat, areaHouse.GeocodeLng, areaHouse.HouseCount.toString(), areaHouse.NameCn);
							}
                        }
                    }
                    //End of City Markers


                                  
                    if ( markerType == 'house'  ) {
                        $(data.Data.MapHouseList).each(function(index) {

                            var imgurl = "/" + this.CoverImg;
                            var BuildYear = "";
                            if (this.BuildYear != null && this.BuildYear > 100) {
                                BuildYear = (new Date()).getFullYear() - this.BuildYear + "年";
                            } else {
                                BuildYear = "";
                            }

                            var hprice = (this.SaleLease == 'Lease') ? this.Price * 10000 + '  加元/月' : Math.round(this.Price) + '  万加元';
                            //console.log(hprice);
                            var li = "<div class='fclist' onmouseover='openInfo(" + index + ", this)' " + "onclick = window.open('<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "')"

                            +" index='" + Arrayindex + "' type='" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "' Jd='" + this.Id + "'  lat='" + this.GeocodeLat + "' lng='" + this.GeocodeLng + "' Address='" + this.Address + "' imgurl='" + imgurl + "' Price='" + hprice + "' HouseType='" + this.HouseType + "' Id='" + this.Id + "' Country=" + this.Country + " Zip=" + this.Zip + " CountryName=" + this.CountryName + " ProvinceEname=" + this.ProvinceEname + " MunicipalityName=" + this.MunicipalityName + " ProvinceCname=" + this.ProvinceCname + " Money=CAD ><a href='javascript:;'><div class='fclistleft'><div class='house_pic'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:151px;height:116px' alt='" + this.MunicipalityName + "房产_" + this.Area2Name + "房产_" + this.MunicipalityName + this.Area2Name + this.HouseType + "房产' /></div></div><div class='fclistright'><div class='house_con2'><p class='house_no1 fc_title'><i>" + (Arrayindex + 1) + "</i><span>" + hprice + "</span></p><p>类型：" + this.HouseType + "</p><p>城市：" + this.MunicipalityName + "</p><p>地址：" + this.Address + "</p><p>户型：" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "</p></div></div><div class='cl'></div></a></div>";

                            HouseArray[Arrayindex] = li;

                            tlat = parseFloat(this.GeocodeLat);
                            tlng = parseFloat(this.GeocodeLng);
                            //var content = "<i class='common_bg icon_map_mark'><span>" + (Arrayindex + 1) + "</span></i>";
							//var content = "<i class='common_bg icon_map_mark'><span>" + (Arrayindex + 1) + "</span></i>";
							
							var content = "<a href='#houseviewpopup' data-rel='popup' class='ui-btn ui-btn-inline ui-corner-all' data-position-to='window'>Open</a>";
                            //var content = "<i class='common_bg icon_map_mark'></i>";


                            var html = "<div class='map_info_title'>" + this.Address + ", " + this.CountryName + ", " + this.ProvinceEname + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span> " + hprice + "</p> <p><a href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "' target='_blank'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>地 址：" + this.MunicipalityName + " " + this.ProvinceCname + "</p><p class='map_info_phone'><i class='common_bg'></i>类型：" + this.HouseType + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + this.Beds + "卧 " + this.Baths + "卫 " + this.Kitchen + "厨</p></div><div class='clear'></div></div>";
                            setContent(tlat, tlng, content, html, false);
                            

                        });

                        //END of LOOP
                        if (houseCount > 30) {
                            markerClusterer = new MarkerClusterer(map, markerArray);
                        }
                    }
                    //End of House Marker
                }
  
            //End Success
			}
        });

    }

var openInfo = function(num, obj) {
        num = num + 1;
        var info = $(obj);
        var html = "<div class='map_info_title'>" + $(info).attr("Address") + ", " + $(info).attr("CountryName") + ", " + $(info).attr("ProvinceEname") + " " + $(info).attr("Zip") + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + $(info).attr("imgurl") + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span>" + $(info).attr("Price") + "<br /></p><p><a class='preferential common_bg' target='blank'  href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" +
            $(info).attr("Id") + "'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>城 市：" + $(info).attr("MunicipalityName") + " " + $(info).attr("ProvinceCname") + "</p><p class='map_info_phone'><i class='common_bg'></i>类 型：" + $(info).attr("HouseType") + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + $(info).attr("type") + "</p></div><div class='clear'></div></div>"; //打开房产信息
        setContent($(info).attr("lat"), parseFloat($(info).attr("lng")), "<i class='common_bg icon_map_mark'><span>" + num + "</span></i>", html, true, $(info).attr("index"));

    }

  





    //google map
    var city = 0;
	var lat = '<?php echo $_GET["lat"]; ?>';
	var lng = '<?php echo $_GET["lng"]; ?>';
    var mapInfo = null;
    var mapMark = null;
    var mapCenter;
    var mapZoom = '<?php echo $_GET["zoom"]; ?>';
    var infowindow = [];
    var markerArray = [];
    var markers = [];
    var HouseArray = [];
    var HouseAreaArray = [];
    var publicArray = [];
	var map;
    var markerClusterer = null;
	var gridx;
	var gridy;

		

	
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
				initMap("google_map",lat,lng,mapZoom);
				
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