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


<div id='googlemap'></div>

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
		var point = {lat: Number(lat), lng: Number(lng)};

		map = new google.maps.Map(document.getElementById('googlemap'), {
		center: point,
		zoom: 13
		});
		
		var iconurl = iconbase + "bighouse.png";
		var marker = new google.maps.Marker({
			map: map,
			icon: iconurl,
			position: point
		});

		setSchoolList();
	}
	
	function setSchoolList() {

		debugger;
		var _sw = map.getBounds().getSouthWest();
		var _ne = map.getBounds().getNorthEast();
		var marker;
		//console.log(_sw);
		//console.log（_ne); 
		_bounds = _sw.lat() + "," + _sw.lng() + "," + _ne.lat() + "," + _ne.lng();
	   
/*		
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
			+  this.school + "</a>"
			+ "<a href='tel:" + this.tel + "'class='ui-btn ui-icon-phone ui-btn-icon-left' > " + this.tel + "</a>"
			+ "<a class='ui-btn ui-icon-location ui-btn-icon-left' data-ajax='false' href='index.php?r=map/index&lat=" + this.lat  + "&lng=" + this.lng + "&zoom=15&maptype=school'>" 
			+ this.address + "</a>"
			+ "</div>"
			+ "<span id='" + this.schoolnumber + "' class='ui-li-count'>" + this.paiming + "</span> "
			+ "</li>"
			$("#school_list").append(html);	
						});

					}
					
					//End of School Marker
				}

			//End Success
			}
		});
*/
	}		


	function callback(results, status) {
	  if (status === google.maps.places.PlacesServiceStatus.OK) {
		var service = new google.maps.places.PlacesService(map);
		for (var i = 0; i < results.length; i++) {
			var name = results[i].name;
			console.log(name);
		  //if ( results[i].name.indexOf("School") > -1){
			if ( name.match(/(Middle School|Public School|High School|Secondary School|Elementary School)/)) {
			  createMarker(results[i]);
			  //console.log(results[i].name + " " + results[i].place_id + " " +results[i].html_attributions);
			  //console.log(results[i].vicinity );
			  
			  service.getDetails({
					placeId: results[i].place_id
				},detailcallback) ;
		  }
		}
	  }
	}
	function detailcallback(place,status){
		 if (status === google.maps.places.PlacesServiceStatus.OK) {

			//console.log(JSON.stringify(place));
			var rating = (place.rating)? place.rating :'NA' ;
			var html = "<li><div class='school-area'>" 
			+ "<a data-ajax='false' class='ui-btn ui-icon-fa-graduation-cap ui-btn-icon-left' href='" + place.website + "'>" 
			+  place.name + "</a>"
			+ "<a href='tel:" + place.formatted_phone_number + "'class='ui-btn ui-icon-phone ui-btn-icon-left' > " + place.formatted_phone_number + "</a>"
			+ "<a class='ui-btn ui-icon-location ui-btn-icon-left' data-ajax='false' href='index.php?r=map/index&lat=" + place.geometry.location.lat()  + "&lng=" + place.geometry.location.lng() + "&zoom=15&maptype=school'>" 
			+ place.vicinity + "</a>"
			+ "</div>"
			+ "<span id='" + place.place_id + "' class='ui-li-count'>" + rating + "</span> "
			+ "</li>"
			$("#school_list").append(html);	

			$.getJSON("/index.php?r=mhouse/getSchoolRank", 	
			{ place_id: place.place_id , lat: place.geometry.location.lat(), lng: place.geometry.location.lng()},  
				//response
	function( data, status, xhr ) {
		//console.log(data);
		$("#"+data.place_id).text(data.rank);
		//console.log(data.place_id + data.rank);
		}
	);

			}	 
	}
	function createMarker(place) {
	  var placeLoc = place.geometry.location;
	  var iconurl = iconbase + "university.png";
	  var marker = new google.maps.Marker({
		map: map,
		icon: iconurl,
		position: placeLoc
	  });

	  google.maps.event.addListener(marker, 'click', function() {
		infowindow.setContent(place.name);
		infowindow.open(map, this);
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
