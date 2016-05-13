<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=geometry,places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<!--<script type="text/javascript" src="/static/map/js/maplemap.js"></script>-->
<script type="text/javascript" src="/static/map/js/schoolmap.js"></script>
<style>


.school-listview .ui-btn {
    margin: -3px 0;
	padding: 6px 0px 6px 34px;
	width: 240px;
	font-weight: normal;
	font-size: 90%;
	border: none;
	text-align: left;
}

.school-listview .ui-listview > li {
	margin-bottom: 13px;
}

#googlemap {
	height:300px;
}

a {text-decoration: none; }

</style>

<div data-role="popup" id="schoolviewpopup">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>	
	<div id="popuphtml"></div>
</div>

<div id="googlemap""></div>                 

<div data-role="header">
  <a href="#" class="ui-btn ui-btn-icon-left">学校</a>
  <h1></h1>
  <a href="#" class="ui-btn  ui-btn-icon-left">排名</a>
</div>

<div class="school-listview">
<ul data-role="listview" data-icon="false" id="school_list" data-mini="true" >


</ul>
</div>

<!-- GoogleMaps info --> 
 
 <script type="text/javascript"> 
	function initMap(lat,lng) {
		markerArray = []; //make it global
		var point = {lat: Number(lat), lng: Number(lng)};

		map = new google.maps.Map(document.getElementById('googlemap'), {
		center: point,
		zoom: 15
		});
		
		var iconurl = iconbase + "bighouse.png";
		var marker = new google.maps.Marker({
			map: map,
			icon: iconurl,
			position: point
		});
		google.maps.event.addListener(map, 'idle', function() {
			setSchoolList(map);
		});
		
	}
	
	function setSchoolList(map) {

		//debugger;
		var _sw = map.getBounds().getSouthWest();
		var _ne = map.getBounds().getNorthEast();
		var marker;
		//console.log(_sw);
		//console.log（_ne); 
		_bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
	   
		$.ajax({
			url: 'index.php?r=map/getSchoolList',
			type: 'POST',
			dataType: 'json',
			data: {
				bounds: _bounds
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
						
						$("#school_list").empty();
						data.SchoolList.sort(function(a, b) {
							var _a = (a.Paiming == "无")? 9999 : parseInt(a.Paiming);
							var _b = (b.Paiming == "无")? 9999 : parseInt(b.Paiming);
							return _a - _b;
						});
						$(data.SchoolList).each(function(index) {
						//console.log("Current:" + this.GeocodeLng + "Next:" + nextLng + "Total:" + totalhouse + "index:" + index + "Count:" + count);
						var school = this.School;
						var rank = this.Paiming;
						var rating = this.Pingfen;
						var tlat = parseFloat(this.Lat);
						var tlng = parseFloat(this.Lng);

						//Generate single house popup view
						var html = "<div class='school_info_popup'>"
						+ "<div class='title'><a href='index.php?r=map&lat=" + tlat + "&lng=" + tlng + "&maptype=school&zoom=15'" +" data-ajax='false'>名称：" + school + "</a></div>"
						+ "<div>年级：" + this.Grade + "</div>" 
						+ "<div>地址：" + this.Address + "</div>" 
						+ "<div>城市：" + this.City + " " + this.Province + " " + this.Zip + "</div>"
						+ "<div>排名：" + rank + " 评分：" + rating + "</div></div>";
						
						schoolmap.setContent(map,tlat, tlng, html,rating);
						
						var html = "<li><div class='school-area'>" 
			+ "<a data-ajax='false' class='ui-btn ui-icon-fa-graduation-cap ui-btn-icon-left' href='" + this.URL + "'>" 
			+  this.School + "</a>"
			+ "<a href='tel:" + this.Tel + "'class='ui-btn ui-icon-phone ui-btn-icon-left' > " + this.Tel + "</a>"
			+ "<a class='ui-btn ui-icon-location ui-btn-icon-left' data-ajax='false' href='index.php?r=map&lat=" + this.Lat  + "&lng=" + this.Lng + "&zoom=15&maptype=school'>" 
			+ this.Address + " " + this.Province + " " + this.Zip + "</a>"
			+ "</div>"
			+ "<span id='" + this.Schoolnumber + "' class='ui-li-count'>" + this.Paiming + "</span> "
			+ "</li>"
			$("#school_list").append(html);	
						});

					}
					
					//End of School Marker
				}

			//End Success
			}
		});
		}		
	
	$( document ).on( "pagecreate", "#page_main", function() {	
		var map;
		var infowindow;
		iconbase = "/static/map/images/";
		var lat = '<?php echo $_GET["lat"]; ?>';
		var lng = '<?php echo $_GET["lng"]; ?>';
		
		lat = (lat) ? lat: "43.5596118";
		lng= (lng) ? lng: "-79.72719280000001";
		//getSchool(lat,lng);
		initMap(lat,lng);
		
	});
   
</script>
