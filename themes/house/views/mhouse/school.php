<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=geometry,places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/maplemap.js"></script>
<style>


.school-listview .ui-btn {
    margin: -5px 0;
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

<?php

$db = Yii::app()->db;
function getRank($name,$city,$type){
	
	$schoolSearch = str_replace("Secondary School","",$name);
	$schoolSearch = str_replace("High School","",$schoolSearch);
	$schoolSearch = str_replace("Secondary School","",$schoolSearch);
	$schoolSearch = str_replace("Public School","",$schoolSearch);
	$schoolSearch = str_replace("Elementary School","",$schoolSearch);
	$schoolSearch = str_replace("'s","",$schoolSearch);
	
	if ( ( strpos($name, 'Secondary School') !== false ) || (strpos($name, 'High School') !== false )){
		$searchType = 2;
	} else {
		$searchType = 1;
	}
		
	$sql = "select rank from h_school_rank 
	where name ='". $schoolSearch."' 
	and city='".$city."' 
	and type='".$searchType."';";
	$resultsql = $db->createCommand($sql)->query();
	$rank = $resultsql->readColumn(0);
	$result = ($rank)? $rank : '无';
	echo $result;
}
?>
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
			var name = results[i].name;
			console.log(name);
		  //if ( results[i].name.indexOf("School") > -1){
			if ( name.match(/(Public School|High School|Secondary School|Elementary School)/)) {
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
			+ "<a href='tel:" + place.formatted_phone_number + "'class='ui-btn ui-icon-phone ui-btn-icon-left' > " + place.formatted_phone_number + "</a>"
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
