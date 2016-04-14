<link href="<?php echo $this->_baseUrl ?>/static/map/css/map.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/themes/house/js/jquery-1.12.2.min.js"></script>
<script src="/static/js/jquery/jquery-ui.min.js"></script>

<div class="cl" style="height:15px"></div>
<div class="main">
    <!-- map开始 -->
	<input name="key" type="text" id="pac-input" class="mapcontrols" placeholder="城市/地址搜索">
    <div class="mapobx">
        <div class="mapleft">
  
            
			
			<div class="search_lp">
			
                <div class="search_lpleft">共有<span class="Houses_count">0</span>个楼盘</div>
                <div class="search_lpright">
                    <div class="searchbox">默认</div>
                    <div class="search_tc">
                        <div class="searchboxdown" style="display:none;">
                            <span>默认</span>
                            <span data-value="1">价格：从高到低</span>
                            <span data-value="2">价格：从低到高</span>
                            <span data-value="3">日期：从后到前</span>
                            <span data-value="4">日期：从前到后</span>
                        </div>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
            <div class="mapleftdown" id = "ul_house_list">
                <div class="fclistbox"></div>
            </div>
            <div class="mappage">
                <div class="mappageleft">第 <span id="pageIndex">1</span> 页 ，共 <span class="Houses_count">0</span> 套</div>
                <div class="mappageright">
                    <a href="javascript:;" id="house_prior" style="display: none;float:left">上一页</a>
                    <a href="javascript:;" id="house_next" style="float:right">下一页</a>
                    <div class="cl"></div>
                </div>
                <div class="cl"></div>
            </div>
        </div>
        <div class="mapright">
            <div class="maprightup">

			
			<div class="mapone">
                    <div class="map_lm">房屋类型：<span id="housetype_choose">不限</span></div>
                    <div class="map_downone" id="type_list" style="display:none;">
                        <a class="cur searchCondition" data-type="housetype" data-value='0' href="#">不限</a> 
                        <?php foreach ($houseType as $key => $val) { ?>
                            <a href="#" class="searchCondition" data-type="housetype" data-value='<?php echo $val->id ?>'><?php echo $val->name ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="mapone">
                    <div class="map_lm">价格区间：<span id="price_choose">不限</span></div>
                    <div class="map_downtwo" style="display:none;">
                        <div class="jgqj_up">
                            <div class="jqqj_one"><input name="" id="begin_price" type="text"  value="0"/></div>
                            <div class="jqqj_line">-</div>
                            <div class="jqqj_one"><input name="" id="end_price" type="text"  value="0"/></div>
                            <div class="qrbtn"><input name="" class="searchCondition" data-type="button_price" type="submit" value="确认" />
                            </div>
                        </div>
                        <div class="jgqj_down" id="price_list">
                            <a class="cur searchCondition" data-type="price" href="javascript:;" data-value="0,0">不限</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="0,100">100以下</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="100,300">100-300万</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="300,500">300-500万</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="500,700">500-700万</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="700,900">700-900万</a>  
                            <a href="javascript:;" class="searchCondition" data-type="price" data-value="900,0">900以上</a>
                        </div>
                    </div>
                </div>
                <div class="mapone">
                    <div class="map_lm">卧室：<span id="room_choose">不限</span></div>
                    <div id="room_list" class="map_downthree" style="display:none;">
                        <a href="javascript:;" class="cur searchCondition" data-type="room" data-value='0'>不限</a>
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='1'>一卧室</a>
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='2'>两卧室</a>
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='3'>三卧室</a>	
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='4'>四卧室</a>
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='5'>五卧室</a>	
                        <a href="javascript:;" class="searchCondition" data-type="room" data-value='6'>五卧室以上</a>
                    </div>
                </div>
                <div class="mapone">
                    <div class="map_lm">更多 (3)</div>
                    <div class="map_downfour" style="display:none;">
                        <div class="map_nf">
                            <div class="map_four_title">建造年份</div>
                            <div class="map_nf_cont" id="year_list" >
                                <a class="cur searchCondition" data-type="year" href="javascript:;" data-value=''>不限</a>
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='New'>新房</a>
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='0-5'>0-5</a>
 								<a href="javascript:;" class="searchCondition" data-type="year" data-value='6-15'>6-15</a>
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='16-30'>16-30</a>
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='31-50'>31-50</a>	
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='51-99'>51-99</a>   
                                <a href="javascript:;" class="searchCondition" data-type="year" data-value='100+'>100+</a>   
                                
								<div class="cl"></div>
                            </div>
                        </div>
                        <div class="map_mj">
                            <div class="map_four_title">土地面积<span>[平方英尺]</span></div>
                            <div class="map_nf_cont" id="ground_list">
                                <a class="cur searchCondition" data-type="Ground" href="javascript:;" data-value='0,0'>全部</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='0,100'>100以下</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='100,200'>100-200</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='200,300'>200-300</a>	
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='300,400'>300-400</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='400,500'>400-500</a>	
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='500,600'>500-600</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='600,700'>600-700</a>	
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='700,800'>700-800</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='800,900'>800-900</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='900,1000'>900-1000</a>
                                <a href="javascript:;" class="searchCondition" data-type="Ground" data-value='1000,0'>1000以上</a> 
                                <div class="cl"></div>
                            </div>
                        </div>
                        <div>
                            <div class="map_four_title">卫生间数量</div>
                            <div id="bath_list" class="map_nf_cont">
                                <a href="javascript:;" class="cur searchCondition" data-type="baths" data-value='0'>不限</a>
                                <a href="javascript:;" class="searchCondition" data-type="baths" data-value='1'>1</a>
                                <a href="javascript:;" class="searchCondition" data-type="baths" data-value='2'>2</a>
                                <a href="javascript:;" class="searchCondition" data-type="baths" data-value='3'>3</a>	
                                <a href="javascript:;" class="searchCondition" data-type="baths" data-value='4'>4</a>
                                <a href="javascript:;" class="searchCondition" data-type="baths" data-value='5'>5</a>	
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div class="mapone maptwo"><div class="map_lm map_lm_cur">鸟瞰地图</div></div>
                                <div class="mapone maptwo mapthree"><div class="map_lm">道路地图</div></div>-->
            </div>
            <div class="maprightdown">
				<div class="map_flash" id="google_map">	</div>
				<div class="fsbutton"> 	<a>全屏</a>		</div>
				
            </div>
            <div class="map_cp">
                <div class="map_cpone">周边设施</div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="school">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m1.jpg" /></div>
                        <div class="map_cplist_right">学校</div>
                    </a>
                </div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="restaurant">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m2.jpg" /></div>
                        <div class="map_cplist_right">餐饮</div>
                    </a>
                </div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="bus_station">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m3.jpg" /></div>
                        <div class="map_cplist_right">交通</div>
                    </a>
                </div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="grocery_or_supermarket">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m4.jpg" /></div>
                        <div class="map_cplist_right">购物</div>
                    </a>
                </div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="hospital">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m5.jpg" /></div>
                        <div class="map_cplist_right">医院</div>
                    </a>
                </div>
                <div class="map_cplist">
                    <a href="javascript:;" class="Search_local" data-value="bank">
                        <div class="map_cplist_left"><img src="<?php echo $this->_baseUrl ?>/static/map/images/m6.jpg" /></div>
                        <div class="map_cplist_right">银行</div>
                    </a>
                </div>
            </div>
    </div>
    
<div class="cl"></div>
</div>
	<!-- map结束 -->
	<div class="loadhouse">
    正在加载房源数据，请稍候...
	</div>

</div>



<script>
    //$(document).ready(function() {
		
	$(function(){	
		
		var p = $("#google_map").offset();
		//console.log( "left: " + p.left + ", top: " + p.top );
		$(".fsbutton").css({top: p.top + 15});
		//console.log(gd + ":" + flashgdtop);
		var clickcount = 0;
		$(".fsbutton").click(function(){
			
			//$(".mapleft").css('display','none');			
			$(".head").slideToggle();
			$(".topdl").slideToggle();
			$(".mapleft").slideToggle();
			

			
			$(".nav").slideToggle("slow", function(){
			var kd = $(window).width();
			var gd = $(window).height();
			var flashgdtop = $(".map_flash").offset().top;
			var flashgd = gd - flashgdtop;
			//console.log(gd + ":" + flashgdtop);
			//var flashgd = gd;
			p = $("#google_map").offset();
			$(".fsbutton").css({top: p.top + 15});
			
			$(".map_flash").css({height: flashgd - 39});
			//$(".mapleftdown").css({height: flashgd - 42});
			//$(".maprightdown").toggleClass('fullscreen'); 	
			changeMap();
			if ( clickcount%2 == 0) {
				$(".fsbutton").text('恢复');
			}
			else {
				$(".fsbutton").text('全屏');
			}
			
			clickcount++;
			
			
			});
			
			
		});
		
		
        $(".map_lm").mouseover(function() {
            $(this).next().show();
        });

        $(".mapone").mouseover(function() {
            $(this).find(".map_downone").show();
        });

        $(".mapone").mouseout(function() {
            $(this).find(".map_downone").hide();
        });

        $(".mapone").mouseover(function() {
            $(this).find(".map_downtwo").show();
        });

        $(".mapone").mouseout(function() {
            $(this).find(".map_downtwo").hide();
        });

        $(".mapone").mouseover(function() {
            $(this).find(".map_downthree").show();
        });

        $(".mapone").mouseout(function() {
            $(this).find(".map_downthree").hide();
        });

        $(".mapone").mouseover(function() {
            $(this).find(".map_downfour").show();
        });

        $(".mapone").mouseout(function() {
            $(this).find(".map_downfour").hide();
        });

        $(".map_wsj_center").mouseover(function() {
            $(".map_wsj_tc").show();
        });
        $(".map_wsj_center").mouseout(function() {
            $(".map_wsj_tc").hide();
        });
        $(".map_wsj_tc dd").click(function() {
            var val = $(this).text();
            $(".map_wsj_sl").text(val);
        });

        //控制高度达到全屏		
        var kd = $(window).width();
        var gd = $(window).height();
        var flashgdtop = $(".map_flash").offset().top;
        var flashgd = gd - flashgdtop;
		console.log("Initial:" + gd + ":" + flashgdtop);
        $(".map_flash").css({height: flashgd });
        $(".mapleftdown").css({height: flashgd - 42});

        window.onresize = function() {
            var kd = $(window).width();
            var gd = $(window).height();
            var flashgdtop = $(".map_flash").offset().top;
            var flashgd = gd - flashgdtop - 39;
            $(".map_flash").css({height: flashgd });
            $(".mapleftdown").css({height: flashgd - 42});
        }
    });

    //google map
	//var cd1 = '<?php echo $_GET["cd1"]; ?>';
	//var cd2 = '<?php echo $_GET["cd2"]; ?>';
	var map;
    var mapInfo = null;
    var mapMark = null;
    var mapCenter;
    var mapZoom = null;
    var infowindow = [];
    var markerArray = [];
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
    var province = "";
    var city = '';
    var district = '';
    var local_type;
    var mapOptions;
    var pageIndex = 1;
	var markerClusterer = null;
    mapOptions = {
        //center: new google.maps.LatLng(43.6686333, -79.4450250),
		center: new google.maps.LatLng(54.649739, -93.045726),
        zoom: 5, //keep zoom and minZoom differen to trigger initial map search
        zoomControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        minZoom: 4,
        overviewMapControl: true,
        overviewMapControlOptions: {opened: true}
    };
    map = new google.maps.Map(document.getElementById("google_map"), mapOptions);
	mapCenter = map.getCenter();
    mapZoom = map.getZoom();
	
	//START CITYZOOM
	var cd1 = '<?php echo $_GET["cd1"]; ?>';
	var cd2 = '<?php echo $_GET["cd2"]; ?>';
	if ( cd1 != 0 || cd2 != 0 ){
			
		var provinceZoom = 6;
		var cityZoom = 11;
		if ( cd2 != 0 ) { //Search City LAT/LON
			$.ajax({
			url: '<?php echo Yii::app()->createUrl('map/getCityLocation'); ?>',
			type: 'POST', dataType: 'json', data: { city: cd2},
			success: function(result) {
				var lat = result.Lat;
				var lng = result.Lng;
				//googleMap.setMapView(lat,lng,cityZoom);
				 map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
				 map.setZoom(parseInt(cityZoom));

		}
		});
				
		
			
		} else { //search Province LAT/LON
			$.ajax({
			url: '<?php echo Yii::app()->createUrl('map/getProvinceLocation'); ?>',
			type: 'POST', dataType: 'json', data: { province: cd1},
			success: function(result) {
				var lat = result.Lat;
				var lng = result.Lng;
				//googleMap.setMapView(lat,lng,provinceZoom);
				map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
				map.setZoom(parseInt(provinceZoom));

			
			}
			});
		//JSON Call GET CITY or Province LON/Lat
			
		}
		
	
	
	
	
	}
	
	//END OF CITYZOOM
	
	//Add google search box with autocomplete
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    //map.addListener('bounds_changed', function() {
	//	searchBox.setBounds(map.getBounds());
	//});
	
	var smarkers = [];
	// [START region_getplaces]
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
	
	changeMap();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    smarkers.forEach(function(marker) {
      marker.setMap(null);
    });
    smarkers = [];
	var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      smarkers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

	   if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
 	//End of google search box autocomplete

	
	
    google.maps.event.addListener(map, "bounds_changed", function() {
        if (mapZoom != map.getZoom()) {
            changeMap();
        }
    });
    google.maps.event.addListener(map, 'dragend', function() {
        changeMap();
    });
	
	
	/*
	google.maps.event.addListener(map, 'idle', function() {
		
		//console.log("Idle: Start");
		changeMap();
	}); */

    //汇率
    var getRate = function(code) {
        return '加元';
    }
	    
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
                //for (i = 0; i < infowindow.length; i++) {
                //    infowindow[i].close();
                //}
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
          // google.maps.event.addListener(marker, 'mouseover', function() {
          //     this.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
          // });
          // google.maps.event.addListener(marker, 'mouseout', function() {
          //     this.setZIndex(google.maps.Marker.MAX_ZINDEX - 2);
          // });
        }, //在地图添加房源数量信息
        setContentCount: function(lat, lng, totalCount,city) {
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
			var infocontent = '<p style="margin-bottom:0px;">' + city +' 共有' + totalCount + '个楼盘</p>';
			var infowindow = new google.maps.InfoWindow({
                pixelOffset: new google.maps.Size(0, -24)
            });
			google.maps.event.addListener(marker, 'mouseover', (function(marker,infocontent,infowindow) {
				return function() {
				infowindow.setContent(infocontent);					
				infowindow.open(map, marker);
				};
            })(marker,infocontent,infowindow));
			
			google.maps.event.addListener(marker, 'mouseout', (function(marker,infocontent,infowindow){ 
				return function() {
					infowindow.close();
				};
			})(marker,content,infowindow)); 
                                                
             google.maps.event.addListener(marker, 'click', function() {
				map.setCenter(this.position);
				map.setZoom(12);
            });


        }, ///本地信息
		
        createMarker: function(place) {
            var placeLoc = place.geometry.location;
            var html;
			var iconbase="/static/map/images/";
			var iconurl;

            if (local_type == "school") {
                html = "<i class='homelist icon_scool3'></i>";
				iconurl= iconbase + "m1.jpg";
            }
            else if (local_type == "restaurant") {
                html = "<i class='homelist icon_dining3'></i>";
				iconurl= iconbase + "m2.jpg";
            } else if (local_type == "bus_station") {
                html = "<i class='homelist icon_traffic3'></i>";
				iconurl= iconbase + "m3.jpg";
            } else if (local_type == "grocery_or_supermarket") {
                html = "<i class='homelist icon_shopping3'></i>";
				iconurl= iconbase + "m4.jpg";
            } else if (local_type == "hospital") {
                html = "<i class='homelist icon_hospital3'></i>";
				iconurl= iconbase + "m5.jpg";
            } else if (local_type == "bank") {
                html = "<i class='homelist icon_bank3'></i>";
				iconurl= iconbase + "m6.jpg";
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
        }, //清空所有信息内容
        clearAll: function(map) {
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
        }, ///设置地图位置大小
        setMapView: function(lat, lng, zoom) {
            map.setCenter(new google.maps.LatLng(parseFloat(lat), parseFloat(lng)));
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

    var changeMap = function() {
        googleMap.clearAll(map);
		    //google map

		$("#leftsead").hide();
		 //Resize after left panel is toggled
		google.maps.event.addListenerOnce(map, 'idle', function() {
				google.maps.event.trigger(map, 'resize');
		});
		
		//console.log("MapZoom:" + mapZoom);	
        mapCenter = map.getCenter();
		mapZoom = map.getZoom();
        var _sw = map.getBounds().getSouthWest();
        var _ne = map.getBounds().getNorthEast();
        var centerlat = (_ne.lat() + _sw.lat()) / 2;
        var centerlng = (_ne.lng() + _sw.lng()) / 2;

		
        var number1 = _sw.lat() + "," + _sw.lng() + "," + centerlat + "," + centerlng;
        var number2 = centerlat + "," + centerlng + "," + _ne.lat() + "," + _ne.lng();
        var number3 = centerlat + "," + _sw.lng() + "," + _ne.lat() + "," + centerlng;
        var number4 = _sw.lat() + "," + centerlng + "," + centerlat + "," + _ne.lng();
        var lenght = 1;
        if (city == '州名/市名(中英)') {
            city = '';
        }
		
        $(".Houses_count").text("0");
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

					if ( houseCount  >= maxMarkers ) {
						for (var p in data.Data.AreaHouseCount) {
							var areaHouse = data.Data.AreaHouseCount[p];
							googleMap.setContentCount(areaHouse['Count'].GeocodeLat, areaHouse['Count'].GeocodeLng, areaHouse['Count'].HouseCount,areaHouse['Count'].NameCn );
							
						}
					}
					
					//End of City Markers
					
					
					//House Marker if house count is in limit
					//if ( houseCount < maxMarkers && mapZoom >= provZoom) {
					if ( houseCount < maxMarkers ) {
						$(data.Data.MapHouseList).each(function(index) {
		
						var imgurl = "/" + this.CoverImg;
						var BuildYear = "";
						if (this.BuildYear != null && this.BuildYear > 100) {
							BuildYear = (new Date()).getFullYear() - this.BuildYear + "年";
						} else {
							BuildYear = "";
						}
						
						var hprice = ( type == 'rent' )? this.Price*10000 +'  加元/月' : Math.round(this.Price) +'  万加元';
						//console.log(hprice);
						var li = "<div class='fclist' onmouseover='openInfo(" 	
						+ index + ", this)' " 
						+ "onclick = window.open('<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + this.Id + "')"
	   
						+ " index='" + Arrayindex + "' type='" + (this.Beds > 0 ? this.Beds + "卧" : "") 
						+ (this.Baths > 0 ? this.Baths + "卫 " : "") 
						+ (this.Kitchen > 0 ? this.Kitchen + "厨" : "") 
						+ "' Jd='" + this.Id 
						+ "'  lat='" + this.GeocodeLat 
						+ "' lng='" + this.GeocodeLng 
						+ "' Address='" + this.Address 
						+ "' imgurl='" + imgurl 
						+ "' Price='" + hprice 
						+ "' HouseType='" + this.HouseType 
						+ "' Id='" + this.Id 
						+ "' Country=" + this.Country 
						+ " Zip=" + this.Zip 
						+ " CountryName=" + this.CountryName 
						+ " ProvinceEname=" + this.ProvinceEname 
						+ " MunicipalityName=" + this.MunicipalityName 
						+ " ProvinceCname=" + this.ProvinceCname 
						+ " Money=" + this.Money 
						+ " ><a href='javascript:;'><div class='fclistleft'><div class='house_pic'><img src='<?php echo Yii::app()->request->baseUrl; ?>" + imgurl + "' style='width:151px;height:116px' alt='" + this.MunicipalityName + "房产_" + this.Area2Name + "房产_" + this.MunicipalityName + this.Area2Name + this.HouseType + "房产' /></div></div><div class='fclistright'><div class='house_con2'><p class='house_no1 fc_title'><i>" + (Arrayindex + 1) + "</i><span>" + hprice + "</span></p><p>类型：" + this.HouseType + "</p><p>城市：" + this.MunicipalityName + "</p><p>地址：" + this.Address + "</p><p>户型：" + (this.Beds > 0 ? this.Beds + "卧" : "") + (this.Baths > 0 ? this.Baths + "卫 " : "") + (this.Kitchen > 0 ? this.Kitchen + "厨" : "") + "</p></div></div><div class='cl'></div></a></div>";

						HouseArray[Arrayindex] = li;

						tlat = parseFloat(this.GeocodeLat);
						tlng = parseFloat(this.GeocodeLng);
						var content = "<i class='common_bg icon_map_mark'><span>" + (Arrayindex + 1) + "</span></i>";
						//var content = "<i class='common_bg icon_map_mark'></i>";

						
						var html = "<div class='map_info_title'>" 
						+ this.Address + ", " + this.CountryName + ", " + this.ProvinceEname
						+ "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" 
						+ imgurl + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span> "
						+ hprice + "</p> <p><a href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" 
						+ this.Id + "' target='_blank'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>地 址：" 
						+ this.MunicipalityName + " " 
						+ this.ProvinceCname + "</p><p class='map_info_phone'><i class='common_bg'></i>类型：" 
						+ this.HouseType + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" 
						+ this.Beds + "卧 " 
						+ this.Baths + "卫 " 
						+ this.Kitchen + "厨</p></div><div class='clear'></div></div>";
						googleMap.setContent(tlat, tlng, content, html, false, Arrayindex);
						Arrayindex++;

					});
					
					//END of LOOP
						if ( houseCount > 100 ){
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
    var search_box = function() {
        if ($("#search_table").html() != "") {
            $(".dizhileft").attr("style", "overflow-y:hidden;overflow-x:hidden");
        } else {
            $(".dizhileft").attr("style", "height:27px;");
        }
    }

    var openInfo = function(num, obj) {
        num = num + 1;
        var info = $(obj);
        var html = "<div class='map_info_title'>" 
		+ $(info).attr("Address") + ", " + $(info).attr("CountryName") + ", " + $(info).attr("ProvinceEname") + " " + $(info).attr("Zip")
		+ "</div><div class='map_info_content'><div class='map_info_left'><img src='<?php echo Yii::app()->request->baseUrl; ?>" 
		+ $(info).attr("imgurl") + "' style='width:188px;height:148px'/></div><div class='map_info_right'><p class='orange map_info_price'><i class='common_bg'></i><span>价 格：</span>" 
		+ $(info).attr("Price") + "<br /></p><p><a class='preferential common_bg' target='blank'  href='<?php echo Yii::app()->createUrl('house/view'); ?>&id=" + 
		$(info).attr("Id") + "'>查看详情</a></p><p class='map_info_address'><i class='common_bg'></i>城 市：" 
		+ $(info).attr("MunicipalityName") + " " + $(info).attr("ProvinceCname")  + "</p><p class='map_info_phone'><i class='common_bg'></i>类 型：" 
		+ $(info).attr("HouseType") + "</p><p class='map_info_type'><i class='common_bg'></i>户 型：" 
		+ $(info).attr("type") + "</p></div><div class='clear'></div></div>";         //打开房产信息
        googleMap.setContent($(info).attr("lat"), parseFloat($(info).attr("lng")), "<i class='common_bg icon_map_mark'><span>" + num + "</span></i>", html, true, $(info).attr("index"));

    }

    $(function() {
        $('.loadhouse').css({
            left: ($(window).width()) / 2,
            top: ($(window).height()) / 2
        });

        //上一页
        $("#house_prior").click(function() {
            if (pageIndex > 1) {
                var tableHtml = "";
                pageIndex = pageIndex - 1;
                var pageNumber = Math.ceil(HouseArray.length / 10.00);
                $("#house_next").hide();
                if (pageIndex < 2) {
                    $("#house_prior").hide();
                }
                $("#house_next").show();
                $.each(HouseArray, function(index) {
                    if (index < 10 * pageIndex && (10 * (pageIndex - 1)) <= index) {
                        tableHtml = tableHtml + this;
                    }
                });
                $("#ul_house_list").html(tableHtml);
                $("#pageIndex").text(pageIndex);
            } else {
                $("#house_prior").hide();
            }
        });

        //下一页
        $("#house_next").click(function() {
            var pageNumber = Math.ceil(HouseArray.length / 10.00);
            if (pageNumber > pageIndex) {
                var tableHtml = "";
                pageIndex = pageIndex + 1;
                $("#house_prior").show();
                if (pageNumber == pageIndex) {
                    $("#house_next").hide();
                }
                $.each(HouseArray, function(index) {
                    if (index < 10 * pageIndex && (10 * (pageIndex - 1)) <= index) {
                        tableHtml = tableHtml + this;
                    }
                });
                $("#ul_house_list").html(tableHtml);
                $("#pageIndex").text(pageIndex);
            }
        });

        $(".Search_local").click(function() {
            local_type = $(this).attr("data-value");
            googleMap.localSearh(local_type);
        });

        //输入框变化
        $("#city").focus(function() {
            if ($(this).val() == "州名/市名(中英)") {
                changeURLArg('cd1', 0);
                changeURLArg('cd2', 0);
                $(this).val("");
                $(this).css('color', '#000');
            }
        });
        $("#city").click(function() {
            this.select();
        });
        $("#city").blur(function() {
            if ($(this).val() == "") {
                changeURLArg('cd1', 0);
                changeURLArg('cd2', 0);
                $(this).val("州名/市名(中英)");
                $(this).css('color', '#999');
                $("#search-button").click();
            }
            setTimeout('$("#search_table").html("");search_box();', 1000);
        });

        //点击搜索、按回车键、失去焦点执行搜索
        $('#search-button').click(function() {
            changeMap();
        })
        $("#city").keydown(function(event) {
            if (event.keyCode == 13) {
                $("#search-button").click();
                return false;
            }
        });
//        $("#city").blur(function(event) {
//            changeMap();
//        });

        $("#city").keyup(function() {
            var key = $(this).val().trim();
            if (key != "") {
                $.post("/index.php?r=map/getMapCity", {"cityName": key}, function(data) {
                    if (!data.IsError) {
                        var html1 = "";
                        var html2 = "";
                        if (key == $("#city").val()) {
                            $.each(data.Data, function(index, value) {
                                var text = this.NameCn;
                                var demo = text.substr(text.toUpperCase().indexOf(key.toUpperCase()), key.length);
                                html1 = "<tr><th>州/省</th><td><a href='JavaScript:void(0)' class='search_city' Id='" + this.CityId + "' ProvinceId='" + this.ProvinceId + "' lat='" + this.GeocodeLat + "' lng='" + this.GeocodeLng + "' zoom='" + (this.MinZoom + 1) + "'>" + text.replace(demo, "<lable style='color:red'>" + demo + "</lable>") + "</a></td></tr>";
                            });
                            
                            $("#search_table").html(html1 + html2);
                            search_box();
                            $(".search_city").on('click', function() {
                                var lat = $(this).attr("lat");
                                var lng = $(this).attr("lng");
                                var zoom = parseInt($(this).attr("zoom"));
                                if (zoom == 1) {
                                    zoom = 4;
                                }
                                province = $(this).attr("Country");
                                var text = $(this).text();
                                googleMap.setMapView(lat, lng, zoom);
                                $("#city").val(text);
                                $("#search_table").html("");
                                //改变url
                                changeURLArg('cd1', $(this).attr("Id"));
//                                changeURLArg('cd2', $(this).attr("Id"));
                                changeMap();
                            });
                        }
                    }
                }, "json");
            }
        });


        $(".searchCondition").click(function() {
            var type = $(this).attr("data-type");
            var value = $(this).attr("data-value");
            var content = $.trim($(this).html());
            if (type == "housetype") {
                map_type = value;
                $("#type_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
                $('#housetype_choose').html(content);
                changeURLArg('cd4', map_type);
            } else if (type == "price") {
                map_price = value;
                $("#price_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
                $('#price_choose').html(content);
                changeURLArg('cd5', map_price);
            } else if (type == "room") {
                map_room = value;
                $("#room_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
                $('#room_choose').html(content);
                changeURLArg('cd8', map_room);
            } else if (type == "year") {
                map_year = value;
                $("#year_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
                changeURLArg('cd9', map_year);
            } else if (type == "Ground") {
                map_Ground = value;
                $("#ground_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
                changeURLArg('cd7', map_Ground);
            } else if (type == "button_price") {
                var begin_price = $("#begin_price").val();
                var end_price = $("#end_price").val();
                if (parseInt(begin_price) > parseInt(end_price)) {
                    $("#begin_price").val(parseInt(end_price));
                    $("#end_price").val(parseInt(begin_price));
                    begin_price = $("#begin_price").val();
                    end_price = $("#end_price").val();
                }
                else {
                    $("#begin_price").val(parseInt(begin_price));
                    $("#end_price").val(parseInt(end_price));
                }
                map_price = begin_price + "," + end_price;
                $('#price_choose').html(begin_price + ' - ' + end_price + '万');
                changeURLArg('cd5', map_price);
            } else if (type = "baths") {
                map_Baths = value;
                $("#bath_list a").attr("class", "searchCondition");
                $(this).attr("class", "cur searchCondition");
            }
            changeMap();
			
			//
			
		});	
        

        $(".search_lpright").mouseover(function() {
            $(".searchboxdown").show();
            $(".searchbox").addClass("searchbox_two");
        });
        $(".search_lpright").mouseout(function() {
            $(".searchboxdown").hide();
            $(".searchbox").removeClass("searchbox_two");
        });
        $(".searchboxdown span").click(function() {
            var val = $(this).text();
            $(".searchbox").text(val);
            orderby = parseInt($(this).attr("data-value"));
            changeMap();
            $(".searchboxdown").hide();
            $(".searchbox").removeClass("searchbox_two");
        });
        map.setZoom(parseInt(3));

        //选择默认选择项
        //房屋类型 cd4
        var cd4 = getUrlParam('cd4');
        var cd4Obj = $('#type_list a[data-value="' + cd4 + '"]');
        $('#type_list a').removeClass('cur');
        cd4Obj.addClass('cur');
        $('#housetype_choose').html(cd4Obj.html());
        //价格区间 cd5
        var cd5 = getUrlParam('cd5') ? getUrlParam('cd5') : '0,0';
        if (cd5 != '0,0') {
            var cd5Arr = cd5.split(',');
            $('#begin_price').val(cd5Arr[0]); 
            $('#end_price').val(cd5Arr[1]);
            $('#price_list a').removeClass('cur');
            $('#price_choose').html(cd5Arr[0] + '-' + cd5Arr[1] + '万');
        }else{
            $('#price_choose').html('不限');
        }
        //卧室数量 cd8
        var cd8 = getUrlParam('cd8');
        var cd8Obj = $('#room_list a[data-value="' + cd8 + '"]');
        $('#room_list a').removeClass('cur');
        cd8Obj.addClass('cur');
        $('#room_choose').html(cd8Obj.html());
        //建造年份 cd9
        var cd9 = getUrlParam('cd9');
        var cd9Obj = $('#year_list a[data-value="' + cd9 + '"]');
        $('#year_list a').removeClass('cur');
        cd9Obj.addClass('cur');
        //土地面积 cd9
        var cd7 = getUrlParam('cd9');
        var cd7Obj = $('#ground_list a[data-value="' + cd7 + '"]');
        $('#ground_list a').removeClass('cur');
        cd7Obj.addClass('cur');
    });




    //获取url参数
    var getUrlParam = function(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
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
</script>
