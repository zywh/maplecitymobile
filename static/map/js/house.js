    //google map
    var map;
	var mapInfo = null;
    var mapMark = null;
    var mapCenter;
    var mapZoom = 11;
    var infowindow = [];
    var markerArray = []; //marker array used by markercluster js
    var markers = [];
    var HouseArray = [];
    var HouseAreaArray = [];
    var publicArray = [];
    var mapisInit = true;

    var map_type = "";
    var map_price = "";
    var map_room = "";
    var map_year = "";
    var map_Ground = "";
    var map_Baths = "";
    var orderby = 0;
    var country = "";
    var city = '';
    var district = '';
    var local_type;
    var mapOptions;
    var pageIndex = 1;
    mapCenter = map.getCenter();
    mapZoom = map.getZoom();
    google.maps.event.addListener(map, "zoom_changed", function() {
            changeMap();
    });
    google.maps.event.addListener(map, "dragend", function() {
            changeMap();
    });

    var googleMap = {
        //向地图添加信息内容
        setContent: function(lat, lng, content, html, isShow, index) {
            var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
            var marker = new RichMarker({
                position: point,
                map: map,
                draggable: false,
                content: content,
                flat: true
            });
            markerArray.push(marker);
            var info = new google.maps.InfoWindow({
                content: html,
                size: new google.maps.Size(50, 50),
                pixelOffset: new google.maps.Size(0, -24)
            });
            infowindow.push(info);
            google.maps.event.addListener(marker, 'click', function(e) {
                for (i = 0; i < infowindow.length; i++) {
                    infowindow[i].close();
                }
                info.open(map, marker);
                googleMap.setMapView(parseFloat(lat), parseFloat(lng), mapZoom);
                if (mapZoom > 8)
                {
                    $("li.first_li").remove();
                    $(".fclistbox").html(HouseArray[index] + $(".fclistbox").html());
                }
            });
            if (isShow) {
                for (i = 0; i < infowindow.length; i++) {
                    infowindow[i].close();
                }
                info.open(map, marker);
                googleMap.setMapView(parseFloat(lat), parseFloat(lng), mapZoom);
            }
            //marker z-index
            google.maps.event.addListener(marker, 'mouseover', function() {
                this.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
            });
            google.maps.event.addListener(marker, 'mouseout', function() {
                this.setZIndex(google.maps.Marker.MAX_ZINDEX - 2);
            });
        }, 

        createMarker: function(place) {
            var placeLoc = place.geometry.location;
            var html;
            if (local_type == "school") {
                html = "<i class='homelist icon_scool3'></i>";
            }
            else if (local_type == "restaurant") {
                html = "<i class='homelist icon_dining3'></i>";
            } else if (local_type == "bus_station") {
                html = "<i class='homelist icon_traffic3'></i>";
            } else if (local_type == "grocery_or_supermarket") {
                html = "<i class='homelist icon_shopping3'></i>";
            } else if (local_type == "hospital") {
                html = "<i class='homelist icon_hospital3'></i>";
            } else if (local_type == "bank") {
                html = "<i class='homelist icon_bank3'></i>";
            } else {
                html = "<i class='common_bg icon_map_mark'></i>";
            }
            var marker = new RichMarker({
                position: place.geometry.location,
                map: map,
                draggable: false,
                flat: true,
                content: html
            });
            publicArray[publicArray.length] = marker;
        }, //清空所有信息内容
        clearAll: function() {
            if (markerArray) {
                for (var i in markerArray) {
                    markerArray[i].setMap(null);
                }
                markerArray.length = 0;
			}
		
			if (markerClusterer) {
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
        }, ///设置地图位置大小
        setMapView: function(lat, lng, zoom) {
//            map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
            map.setZoom(parseInt(zoom));
        },
        localSearh: function(searchName) {
            request = {
                location: mapCenter,
                radius: '10000',
                types: [local_type]
            };
            service = new google.maps.places.PlacesService(map);
            service.search(request, function(results, status) {
                if (publicArray) {
                    for (var i in publicArray) {
                        publicArray[i].setMap(null);
                    }
                    publicArray.length = 0;
                }
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        googleMap.createMarker(results[i]);
                    }
                }
            });
        }
    };

	function changeMap() {
        googleMap.clearAll();
        mapCenter = map.getCenter();
        mapZoom = map.getZoom();
        var _sw = map.getBounds().getSouthWest();
        var _ne = map.getBounds().getNorthEast();
        $(".Houses_count").text("0");
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
                    zoom: mapZoom,
                    housetype: map_type,
                    houseprice: map_price,
                    houseroom: map_room,
                    houseyear: map_year,
                    houseground: map_Ground,
                    housebaths: map_Baths,
                    orderby: orderby,
                    country: country,
                    city: city,
                    district: district
                },
                beforeSend: function() {
                    $(".loadhouse").show();
                },
                complete: function() {
                    $(".loadhouse").hide();
                },
                success: function(data) {
                    forIndex++;
	// DEBUG
		console.log(_bounds);
		console.log(mapZoom);
	//End Debug
			if (!data.IsError) {

				var count = 0;
				var tlat = 0.0000000;
				var tlng = 0.000000;

				$(data.Data.MapHouseList).each(function(index) {
					var imgurl = "/" + this.CoverImg;
					var BuildYear = "";
					if (this.BuildYear != null && this.BuildYear > 100) {
						BuildYear = (new Date()).getFullYear() - this.BuildYear + "年";
					} else {
						BuildYear = "";
					}
					var li = "<div class='fclist' onclick='openInfo(" + index + ", this)' index='" + Arrayindex + "' type='" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "' Jd='" + this.id + "'  lat='" + this.GeocodeLat + "' lng='" + this.GeocodeLng + "' Address='" + this.Address + "' imgurl='" + imgurl + "' Price='" + this.Price + "' HouseType='" + this.HouseType + "' Id='" + this.Id + "' Country=" + this.Country + " Money=" + this.Money + " ><a href='javascript:;'><div class='fclistleft'><div class='house_pic'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:151px;height:116px' alt='" + this.CountryName + "房产_" + this.Area2Name + "房产_" + this.CountryName + this.Area2Name + this.HouseType + "房产' /></div></div><div class='fclistright'><div class='house_con2'><p class='house_no1 fc_title'><i>" + (Arrayindex + 1) + "</i><span>" + this.Price + "万" + getRate(this.Money) + "</span></p><p>类型：" + this.HouseType + "&nbsp;&nbsp;&nbsp;城市：" + this.CountryName + "</p><p>地址：" + this.Address + "</p><p>户型：" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "</p></div></div><div class='cl'></div></a></div>";
					HouseArray[Arrayindex] = li;

					if (mapZoom >= 13) {
						//点标注
						var content = "<i class='common_bg icon_map_mark'><span>" + (Arrayindex + 1) + "</span></i>";
						var html = "<div class='map_info_title'>" + this.Address + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span><strong class='orange strong_width'>" + this.Price + "</strong><strong class='orange'>万" + getRate(this.Money) + "</strong><br /></p><p><a href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "' target='_blank'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>地 址：" + this.Address + "</p><p class='map_info_phone'><i class='common_bg'></i>类型：" + this.HouseType + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + this.Beds + "卧 " + this.Baths + "卫 " + this.Kitchen + "厨</p></div><div class='clear'></div></div>";
						googleMap.setContent(parseFloat(this.GeocodeLat), parseFloat(this.GeocodeLng), content, html, false, Arrayindex);
					}
					Arrayindex++;
				});
								
			}

				}
            });
 
	}

    var openInfo = function(num, obj) {
        num = num + 1;
        var info = $(obj);
        var html = "<div class='map_info_title'>" + $(info).attr("Address") + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + $(info).attr("imgurl") + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span><strong class='orange strong_width'>" + $(info).attr("Price") + "</strong><strong class='orange'>万" + getRate($(info).attr("Money")) + "</strong><br /></p><p><a class='preferential common_bg' target='blank'  href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + $(info).attr("Id") + "'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>地 址：" + $(info).attr("Address") + "</p><p class='map_info_phone'><i class='common_bg'></i>类型：" + $(info).attr("HouseType") + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + $(info).attr("type") + "</p></div><div class='clear'></div></div>";         //打开房产信息
        googleMap.setContent($(info).attr("lat"), parseFloat($(info).attr("lng")), "<i class='common_bg icon_map_mark'><span>" + num + "</span></i>", html, true, $(info).attr("index"));
    }


