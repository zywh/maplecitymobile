<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=geometry,places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/maplemap.js"></script>
<style>

.school-listview .ui-listview ,
.school-listview .ui-listview > li  {
	margin: 0px 0px;
	
		
}

#school_name {
	white-space: nowrap;  overflow: hidden;
	font-size:80%;
	width: 262px;
	margin-top:2px;
	margin-left: -9px;
	text-overflow:ellipsis;
}
#school_text {
	width: 262px;
	white-space: nowrap;  overflow: hidden;
	font-size:80%;
	margin-top:3px;	
	margin-left: -9px;
	text-overflow:ellipsis;
}
#googlemap {
	height:300px;
}
</style>

<div id='googlemap'></div>

<div data-role="header">
  <a href="#" class="ui-btn ui-btn-icon-left">学校</a>
  <h1></h1>
  <a href="#" class="ui-btn  ui-btn-icon-left">排名</a>
</div>
<div class="school-listview">
<ul data-role="listview" data-icon="false" id="school_list">

	<?php 	foreach ($schools as $school) {	?> 
	<li> <div id='school_name'><a   data-ajax='false' href='https://www.app.edu.gov.on.ca/eng/sift/schoolProfileSec.asp?SCH_NUMBER=<?php  echo $school['no']; ?>'><?php  echo $school['name'];  ?></a></div>
	<div id='school_text'> <?php echo  $school['type']." ".$school['lang'] ?>
	<a data-ajax='false' href='index.php?r=map/index&lat= <?php echo $school['lat'] ;?>&lng=<?php echo $school['lng'] ?>&zoom=15&maptype=school'> <?php echo $school['addr'];?></a></div> 
	<div id='school_text'> <?php echo  $school['postcode']." ".$school['city']; ?></div>
	<span class='ui-li-count'> <?php echo $school[rank];?></span></li>
	
    <?php } ?>
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
		  createMarker(results[i]);
		  //console.log(results[i].name + " " + results[i].place_id + " " +results[i].html_attributions);
		  //console.log(results[i].vicinity );
		  service.getDetails({
				placeId: results[i].place_id
			},detailcallback) ;
		}
	  }
	}
	function detailcallback(place,status){
		 if (status === google.maps.places.PlacesServiceStatus.OK) {
			 //console.log("Detail:" + place.formatted_address + ":" + place.html_attributions + " " + place.formatted_phone_number + " " + place.website + " " );
				console.log(JSON.stringify(place));
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
