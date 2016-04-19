<script type="text/javascript" src="/themes/house/js/jquery-1.12.2.min.js"></script>




<!-- map开始 -->

<h4>Maps</h4>
    
<div role="main" class="ui-content" id="google_map">
        <!-- map loads here... -->
</div>

<!-- map结束 -->

<!-- List Start -->
<div id="house_list" class="house-list">
   <p>Total:</p> <span id="houst_count"></span>
</div>
<!-- List End -->



<script>
 
function setMapView(lat, lng, zoom) {
	map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
	map.setZoom(parseInt(zoom));
} 

function setContent(lat, lng, content, html, isShow, index) {
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
		//for (i = 0; i < infowindow.length; i++) {
		//    infowindow[i].close();
		//}
		info.open(map, marker);
		googleMap.setMapView(parseFloat(lat), parseFloat(lng), mapZoom);
		if (mapZoom > 8) {
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
 
}


function setContentCount(lat, lng, totalCount, city) {
	var content = "<i class='common_bg icon_map_mark'><span>" + totalCount + "</span></i>";
	var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
	//console.log(lat + ":" + lng +":" + totalCount +":" + city);


	var marker = new RichMarker({
		position: point,
		map: map,
		draggable: false,
		content: content,
		flat: true
	});
	markerArray.push(marker);
	var infocontent = '<p style="margin-bottom:0px;">' + city + ' 共有' + totalCount + '个楼盘</p>';
	var infowindow = new google.maps.InfoWindow({
		pixelOffset: new google.maps.Size(0, -24)
	});
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
	})(marker, content, infowindow));

	google.maps.event.addListener(marker, 'click', function() {
		map.setCenter(this.position);
		map.setZoom(12);
	});


};

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
} //清空所有信息内容
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

changeMap = function() {
        console.log("Change Map");

		clearAll(map);
        	
        
        var _sw = map.getBounds().getSouthWest();
        var _ne = map.getBounds().getNorthEast();
        var centerlat = (_ne.lat() + _sw.lat()) / 2;
        var centerlng = (_ne.lng() + _sw.lng()) / 2;


        var number1 = _sw.lat() + "," + _sw.lng() + "," + centerlat + "," + centerlng;
        var number2 = centerlat + "," + centerlng + "," + _ne.lat() + "," + _ne.lng();
        var number3 = centerlat + "," + _sw.lng() + "," + _ne.lat() + "," + centerlng;
        var number4 = _sw.lat() + "," + centerlng + "," + centerlat + "," + _ne.lng();
        var lenght = 1;

        
        HouseArray = [];
        var forIndex = 0;
        var Arrayindex = 0;
        var city = $.trim($('#city').val());

        _bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
        map_type = getUrlParam('cd4') ? getUrlParam('cd4') : map_type;
        map_price = getUrlParam('cd5') ? getUrlParam('cd5') : map_price;
        map_room = getUrlParam('cd8') ? getUrlParam('cd8') : map_room;
        map_year = getUrlParam('cd9') ? getUrlParam('cd9') : map_year;
        map_Ground = getUrlParam('cd7') ? getUrlParam('cd7') : map_Ground;
        province = getUrlParam('cd1') ? getUrlParam('cd1') : province;
        district = getUrlParam('cd2') ? getUrlParam('cd2') : district;
        type = getUrlParam('type') ? getUrlParam('type') : "sale";

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
                province: province,
                city: city,
                district: district,
                type: type
            },
            beforeSend: function() {
                $(".loadhouse").show();
            },
            complete: function() {
                $(".loadhouse").hide();
            },
            success: function(data) {
                forIndex++;
                if (!data.IsError) {


                    var maxMarkers = 2000;
                    var houseCount = data.Data.Total;

                    if (houseCount >= maxMarkers) {
                        for (var p in data.Data.AreaHouseCount) {
                            var areaHouse = data.Data.AreaHouseCount[p];
                            googleMap.setContentCount(areaHouse['Count'].GeocodeLat, areaHouse['Count'].GeocodeLng, areaHouse['Count'].HouseCount, areaHouse['Count'].NameCn);

                        }
                    }

                    //End of City Markers


                    //House Marker if house count is in limit
                    //if ( houseCount < maxMarkers && mapZoom >= provZoom) {
                    if (houseCount < maxMarkers) {
                        $(data.Data.MapHouseList).each(function(index) {

                            var imgurl = "/" + this.CoverImg;
                            var BuildYear = "";
                            if (this.BuildYear != null && this.BuildYear > 100) {
                                BuildYear = (new Date()).getFullYear() - this.BuildYear + "年";
                            } else {
                                BuildYear = "";
                            }

                            var hprice = (type == 'rent') ? this.Price * 10000 + '  加元/月' : Math.round(this.Price) + '  万加元';
                            //console.log(hprice);
                            var li = "<div class='fclist' onmouseover='openInfo(" + index + ", this)' " + "onclick = window.open('<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "')"

                            +" index='" + Arrayindex + "' type='" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "' Jd='" + this.Id + "'  lat='" + this.GeocodeLat + "' lng='" + this.GeocodeLng + "' Address='" + this.Address + "' imgurl='" + imgurl + "' Price='" + hprice + "' HouseType='" + this.HouseType + "' Id='" + this.Id + "' Country=" + this.Country + " Zip=" + this.Zip + " CountryName=" + this.CountryName + " ProvinceEname=" + this.ProvinceEname + " MunicipalityName=" + this.MunicipalityName + " ProvinceCname=" + this.ProvinceCname + " Money=" + this.Money + " ><a href='javascript:;'><div class='fclistleft'><div class='house_pic'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:151px;height:116px' alt='" + this.MunicipalityName + "房产_" + this.Area2Name + "房产_" + this.MunicipalityName + this.Area2Name + this.HouseType + "房产' /></div></div><div class='fclistright'><div class='house_con2'><p class='house_no1 fc_title'><i>" + (Arrayindex + 1) + "</i><span>" + hprice + "</span></p><p>类型：" + this.HouseType + "</p><p>城市：" + this.MunicipalityName + "</p><p>地址：" + this.Address + "</p><p>户型：" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "</p></div></div><div class='cl'></div></a></div>";

                            HouseArray[Arrayindex] = li;

                            tlat = parseFloat(this.GeocodeLat);
                            tlng = parseFloat(this.GeocodeLng);
                            var content = "<i class='common_bg icon_map_mark'><span>" + (Arrayindex + 1) + "</span></i>";
                            //var content = "<i class='common_bg icon_map_mark'></i>";


                            var html = "<div class='map_info_title'>" + this.Address + ", " + this.CountryName + ", " + this.ProvinceEname + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span> " + hprice + "</p> <p><a href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "' target='_blank'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>地 址：" + this.MunicipalityName + " " + this.ProvinceCname + "</p><p class='map_info_phone'><i class='common_bg'></i>类型：" + this.HouseType + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + this.Beds + "卧 " + this.Baths + "卫 " + this.Kitchen + "厨</p></div><div class='clear'></div></div>";
                            setContent(tlat, tlng, content, html, false, Arrayindex);
                            Arrayindex++;

                        });

                        //END of LOOP
                        if (houseCount > 100) {
                            markerClusterer = new MarkerClusterer(map, markerArray);
                        }
                    }
                    //End of House Marker
                }
                if (lenght == forIndex) {
                    //console.log("Build Left list");
                    //$(".Houses_count").text(HouseArray.length % 100 == 0 ? HouseArray.length + "+" : HouseArray.length);
                    //$(".house_count").text(HouseArray.length % 100 == 0 ? HouseArray.length + "+" : HouseArray.length);
                    $(".Houses_count").text(houseCount);
                    $(".house_count").text(houseCount);

                    var tableHtml = "";
                    $.each(HouseArray, function(index) {
                        if (index < 10) {
                            if (HouseArray[index]) {
                                tableHtml = tableHtml + HouseArray[index];
                            }
                        }
                    });
                    if (Math.ceil(HouseArray.length / 10.00) < 1) {
                        $('#house_next').hide();
                    }
                    $("#ul_house_list").html(tableHtml);
                    pageIndex = 1;
                    $("#pageIndex").text(pageIndex);
                }
            }
        });

    }

var openInfo = function(num, obj) {
        num = num + 1;
        var info = $(obj);
        var html = "<div class='map_info_title'>" + $(info).attr("Address") + ", " + $(info).attr("CountryName") + ", " + $(info).attr("ProvinceEname") + " " + $(info).attr("Zip") + "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + $(info).attr("imgurl") + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span>" + $(info).attr("Price") + "<br /></p><p><a class='preferential common_bg' target='blank'  href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" +
            $(info).attr("Id") + "'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>城 市：" + $(info).attr("MunicipalityName") + " " + $(info).attr("ProvinceCname") + "</p><p class='map_info_phone'><i class='common_bg'></i>类 型：" + $(info).attr("HouseType") + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" + $(info).attr("type") + "</p></div><div class='clear'></div></div>"; //打开房产信息
        googleMap.setContent($(info).attr("lat"), parseFloat($(info).attr("lng")), "<i class='common_bg icon_map_mark'><span>" + num + "</span></i>", html, true, $(info).attr("index"));

    }

  



    //获取url参数
var getUrlParam = function(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
	var r = window.location.search.substr(1).match(reg); //匹配目标参数
	if (r != null)
		return unescape(r[2]);
	return null; //返回参数值
}

//更改url参数
var changeURLArg = function(arg, arg_val) {
	var url = window.location.href;
	if (getUrlParam(arg)) {
		var pattern = arg + '=([^&]*)';
		var replaceText = arg + '=' + arg_val;
		if (url.match(pattern)) {
			var tmp = '/(' + arg + '=)([^&]*)/gi';
			tmp = url.replace(eval(tmp), replaceText);
			window.history.replaceState('{}', '', tmp);
			return tmp;
		} else {
			if (url.match('[\?]')) {
				window.history.replaceState('{}', '', url + '&' + replaceText);
				return url + '&' + replaceText;
			} else {
				window.history.replaceState('{}', '', url + '?' + replaceText);
				return url + '?' + replaceText;
			}
		}
		window.history.replaceState(url + '\n' + arg + '\n' + arg_val);
		return url + '\n' + arg + '\n' + arg_val;
	}
}


    //google map
    var cityname = 0;
	
    //var cd2 = '<?php echo $_GET["cd2"]; ?>';
    var mapInfo = null;
    var mapMark = null;
    var mapCenter;
    var mapZoom = 17; //Default MapZoom
    var infowindow = [];
    var markerArray = [];
    var markers = [];
    var HouseArray = [];
    var HouseAreaArray = [];
    var publicArray = [];
	var map;
    var mapisInit = true;
    var map_type = "";
    var map_price = "";
    var map_room = "";
    var map_year = "";
    var map_Ground = "";
    var map_Baths = "";
    var orderby = 0;
    var province = "";
    var city = '';
    var district = '';
    var local_type;
    var mapOptions;
    var pageIndex = 1;
    var markerClusterer = null;
	var mapOptions = {
			center: new google.maps.LatLng(43.6686333, -79.4450250),
			zoom: mapZoom, //keep zoom and minZoom different to trigger initial map search
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			minZoom: 4,
			overviewMapControl: true,
			overviewMapControlOptions: {
				opened: true
			}
		};
		

	
	$( document ).on( "pagecreate", "#page_main", function() {
		
		map = new google.maps.Map(document.getElementById("google_map"), mapOptions);
	
		google.maps.event.addListener(map, 'dragend', function() {
			changeMap();
		});
	
		
		if ( city == '') {
			//If city is NULL and User Location can be identified. Center to user location
			if ( navigator.geolocation ) {
		        function success(pos) {
					lat = pos.coords.latitude;
					lng = pos.coords.longitude;
					//mapCenter = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
					console.log("GeoLocation Mapcenter:" + pos.coords.latitude +"," + pos.coords.longitude);
					mapZoom = 17;
					setMapView(lat,lng,mapZoom);
					google.maps.event.addListener(map, "bounds_changed", function() {
						changeMap();
					});
					
					//changeMap();
				}
		        function fail(error) {
					lat="54.649739";
					lng="-93.045726";
	        		mapZoom="11"; //Default zoom level for city
					console.log("Fail to Get Geo Location Center to City:" + lat + ":" + lng);
					setMapView(lat,lng,mapZoom);
						
					google.maps.event.addListener(map, "bounds_changed", function() {
						changeMap();
					});
		        }
		        // Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
		        navigator.geolocation.getCurrentPosition(success, fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
	    	} else {
				
				//If location is allowed from browser
				lat="54.649739";
				lng="-93.045726";
        		mapZoom="11"; //Default zoom level for city
				console.log("Center to City:" + lat + ":" + lng);
				google.setMapView(lat,lng,mapZoom);
					
				google.maps.event.addListener(map, "bounds_changed", function() {
					changeMap();
				});
	   		}
		
		} else {
			//Get City Lat and Lng
			
			lat="54.649739";
			lng="-93.045726";
			mapZoom="11"; //Default zoom level for city
			console.log("Center to City:" + lat + ":" + lng);
			google.setMapView(lat,lng,mapZoom);
				
			google.maps.event.addListener(map, "bounds_changed", function() {
				changeMap();
			});
			//
		}
			

		
		

	});


	
</script>