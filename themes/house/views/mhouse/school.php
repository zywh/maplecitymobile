<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=geometry,places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/maplemap.js"></script>
<style>


.school-listview .ui-btn {
    margin: -5px 0;
	padding: 6px 0px 6px 34px;
	width: 246px;
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
 
	
	function getSchool(lat,lng) {
			console.log("Lat:" + lat + " Lng:" + lng);
	$.ajax({
		url: '/index.php?r=mhouse/getSchoolList',
		type: 'POST', 
		dataType: 'xml', 
		data: { 
			lat : lat, 
			lng : lng
		},

		//Success Start
		success: function(xml) {
			$(xml).find('marker').each(function(){
				
				var schoolLanguage = "英文";
				if ($(this).attr('SCH_LANGUAGE_DESC') == "French" ) {
					schoolLanguage = "法文";
				}
				var schoolType = "公立  ";
				if ($(this).attr('SCH_TYPE_DESC') == "Catholic") {
					schoolType = "天主教";
				}
				var html = "  <li><a data-ajax='false' href='https://www.app.edu.gov.on.ca/eng/sift/schoolProfileSec.asp?SCH_NUMBER=" + $(this).attr('SCH_NO') + "'> "
				+ "<div id='school_name'>" + $(this).attr('SCH_NAME') + "</a></div>"
				+ "<div id='school_text'> " + schoolType + " "
				+ schoolLanguage + " " +  "<a data-ajax='false' href='index.php?r=map/index&lat=" + $(this).attr('lat')  + "&lng=" + $(this).attr('lng') + "&zoom=15&maptype=school'>" 
				+ $(this).attr('SCH_STREET') + "</a>"
				+ " </div> "
				+ "<span class='ui-li-count'>25</span> "
				+ "</li>"
				$("#school_list").append(html);
			});
			
		}
		//Success End
	});
	//Ajax End
	}

	
	function initMap(lat,lng) {
		var point = {lat: Number(lat), lng: Number(lng)};

		map = new google.maps.Map(document.getElementById('googlemap'), {
		center: point,
		zoom: 13
		});
		
		var iconurl = iconbase + "m2.jpg";
		var marker = new google.maps.Marker({
			map: map,
			icon: iconurl,
			position: point
		});

		infowindow = new google.maps.InfoWindow();
		var service = new google.maps.places.PlacesService(map);
		service.nearbySearch({
			location: point,
			radius: 3000,
			type: ['school']
		}, callback);
	}
	function callback(results, status) {
	  if (status === google.maps.places.PlacesServiceStatus.OK) {
		var service = new google.maps.places.PlacesService(map);
		for (var i = 0; i < results.length; i++) {
		  if ( results[i].name.indexOf("School") > -1){
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
			+ "<a data-ajax='false' class='ui-btn ui-icon-home ui-btn-icon-left' href='" + place.website + "'>" 
			+  place.name + "</a>"
			+ "<a href='#'class='ui-btn ui-icon-phone ui-btn-icon-left' > " + place.formatted_phone_number + "</a>"
			+ "<a class='ui-btn ui-icon-location ui-btn-icon-left' data-ajax='false' href='index.php?r=map/index&lat=" + place.geometry.location.lat()  + "&lng=" + place.geometry.location.lng() + "&zoom=15&maptype=school'>" 
			+ place.vicinity + "</a>"
			+ "</div>"
			+ "<span class='ui-li-count'>" + rating + "</span> "
			+ "</li>"
			$("#school_list").append(html);	
		 }	 
	}
	function createMarker(place) {
	  var placeLoc = place.geometry.location;
	  var iconurl = iconbase + "m1.jpg";
	  var marker = new google.maps.Marker({
		map: map,
		//icon: iconurl,
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
