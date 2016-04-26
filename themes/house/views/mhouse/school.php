<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?key=AIzaSyA8e2Aha2ksuqOCP06qBBm2eP_WQGets0E&libraries=geometry,places&language=zh-cn"></script>

<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/static/map/js/maplemap.js"></script>




<!-- GoogleMaps info --> 
 
 <script type="text/javascript"> 
 
	function distanceCheck(inputAddress, locationType,newDistance,newLang,newType) {
		
		//define all refine properties
		var refineDistance ="NN";
		if(!(isNaN(parseInt(newDistance)))){
			refineDistance = parseInt(newDistance);
		}
		//alert(refineDistance);
		var refineLang ="NN";
		if(newLang=="EN"){
			refineLang = "French";
		}else if(newLang=="FR"){
			refineLang = "English";		
		}else{
			refineLang ="NN";		
		}
			//alert(refineLang);
			
		var refineType ="NN";
		if(newType=="PU"){
			refineType = "Catholic";
		}else if(newType=="CA"){
			refineType = "Public";		
		}else{
			refineType ="NN";		
		}
			//alert(refineType); 
			
		var withinRange = 0; 
		var start = 0;
		var end = 0;
		var pointsToAdd = new Array();
		var innerHTMLBody = new Array(); 
		var selectedMarkers = new Array(); 
		var surroundingMarkers = new Array();
		var closestPoints = new Array(); 
		selectedMarkers[0] = {lat:0, long:0, distanceFromPoint:0, bubble:'', html:'', htmlProximity:''};
		selectedMarkers[1] = {lat:0, long:0, distanceFromPoint:0, bubble:'', html:'', htmlProximity:''};  
		closestPoints[0] = 1000001;
		closestPoints[1] = 1000002; 
		var request = new XMLHttpRequest({mozSystem: true});
		//request.open("GET", "secondary.xml", true);
		
	    request.open("POST", "index.php", true);
        var content_type = 'application/x-www-form-urlencoded';
		request.setRequestHeader('Content-Type', content_type);
		var inputAddressToString = inputAddress+''
		var compareLat = inputAddressToString.slice(1,inputAddressToString.indexOf(",")); 
		var compareLong = inputAddressToString.slice(inputAddressToString.indexOf(",")+1,inputAddressToString.length-1);
		var stringToSend = "compareLat="+compareLat+"&compareLong="+compareLong+"&refineDistance="+refineDistance+"&chosenLevel=Secondary";
	
		var distanceMeasure;
		if(refineDistance=="NN"){				
				if (compareLat >= 45.5){ 
					distanceMeasure = "30km"; //30km radius - 60km diamter
				} else if (compareLat < 45.5 && compareLat >= 43.9) { 
					distanceMeasure = "20km"; //20km radius - 40km diameter -Toronto=0.248, North bay=0.260
				} else { 
					distanceMeasure = "10km"; //10.2km radius - 20.4km diameter
				} 
		}else {
				distanceMeasure = newDistance+"km"; //use whatever was refined
		}
		
		request.onreadystatechange = function() {
    	if(request.readyState==1 || request.readyState==2 || request.readyState==3){   
			document.getElementById("closestLocations2").innerHTML='<div align="center"><img src="loading.gif" align="middle" /></div>';
      	}
		if (request.readyState == 4) {
		  var xmlDoc = request.responseXML;
		  // obtain the array of markers and loop through it
		  var sif = xmlDoc.documentElement.getElementsByTagName("marker");
		  if (locationType == "full") {start = 0; end = sif.length;}
		  //alert(sif.length);
		  for (var i = start; i < end; i++) { 
		  
			if(!(sif[i].getAttribute("SCH_LANGUAGE_DESC")==refineLang)){ //only get the language requested 
			if(!(sif[i].getAttribute("SCH_TYPE_DESC")==refineType)){ //only get the type requested  
			
				  var lat = parseFloat(sif[i].getAttribute("lat"));
				  var long = parseFloat(sif[i].getAttribute("lng"));
				  var enteredAddress = new google.maps.LatLng(lat,long);
				  //var distance = inputAddress.distanceFrom(enteredAddress); 
				 var distance = google.maps.geometry.spherical.computeDistanceBetween(inputAddress, enteredAddress)
				  
 
									distance = distance.toFixed(5);  
									 
									var htmlProximity = displayDistance + ' km'; 
									var displayDistance = parseFloat(distance)/1000; 
									var displayDistance = displayDistance.toFixed(2);
									//alert((parseFloat(distanceMeasure) - displayDistance)+ sif[i].getAttribute("SCH_NO"));
									if((parseFloat(distanceMeasure) - displayDistance) >0){//a box is formed up top, this completes the circle
									
									
									//format postal code
									var postcode = ''; 
									postcode = postcode + sif[i].getAttribute("SCH_POSTALCODE");
									if (sif[i].getAttribute("SCH_POSTALCODE") != '00'){ 
										postcode = postcode.substr(0,3) + "&nbsp;" + postcode.substr(3); //+ "&nbsp;lat:" + parseFloat(sif[i].getAttribute("lat"))+ "&nbsp;long:" + parseFloat(sif[i].getAttribute("lng"));
									} 
																		
									//build address field
									var address = ''; 
									if (sif[i].getAttribute("SCH_BUILDINGSUTE") != '00'){
										address = address + sif[i].getAttribute("SCH_BUILDINGSUTE")+ ", ";
									}
									if (sif[i].getAttribute("SCH_POBOX") != '00'){
										address = address + sif[i].getAttribute("SCH_POBOX")+ ", ";
									} 
									if (sif[i].getAttribute("SCH_STREET") != '00'){
										address = address + sif[i].getAttribute("SCH_STREET")+ ", ";
									}  
									address = address +  sif[i].getAttribute("SCH_CITY") + ", ON, " + postcode;
									
									//build and format phone
									var telphone = '';
									var telphone = parseFloat(compareLat); 
									var html = '<strong><a style=" text-decoration:underline;" href="schoolProfileSec.asp?SCH_NUMBER=' + sif[i].getAttribute("SCH_NO") + '">' + sif[i].getAttribute("SCH_NAME")  + '</a></strong> ('+displayDistance + 'km away)<br />'+address+'<br /><br />';
									var bubble = '<div id=\'theBubble\'><strong><a style=" text-decoration:underline;" href="schoolProfileSec.asp?SCH_NUMBER=' + sif[i].getAttribute("SCH_NO") + '">' + sif[i].getAttribute("SCH_NAME")  + '</a></strong> ('+displayDistance + 'km away)<br />'+address+'</div>'; 
									selectedMarkers.push({lat:sif[i].getAttribute("lat"), long:sif[i].getAttribute("lng"), distanceFromPoint:parseInt(parseFloat(distance)), bubble:bubble, html:html, htmlProximity:htmlProximity}); 
				  					
									withinRange = 1; //change the value to 1 since at least 1 result was found
			  }//end if((parseFloat(distanceMeasure) - displayDistance) >0){			
			  }//end if(sif[i].getAttribute("SCH_LANGUAGE_DESC")==refineLang){
			  }//end if(!(sif[i].getAttribute("SCH_TYPE_DESC")==refineType)){
			 
				  
		  } //end of loop for (var i = start; i < end; i++)
		  if (withinRange == 0) {
		    //alert ("There are no locations within 25 km of the address that you entered.");
		  	document.getElementById("distance").innerHTML = "<div style=\"border-top: solid 1px #990000; border-bottom: solid 1px #990000; padding: 5px 0px 5px 0px; margin: 10px 0px 10px 0px; \">There are no schools within "+distanceMeasure +" of the address that you entered.</div>";
			//remove the loading icon if no locations are found
			document.getElementById("closestLocations2").innerHTML='<div align="center"> </div>';
		  } else {
			  document.getElementById("distance").innerHTML = ""
			} // end of if (withinRange == 0) {
				
				//alert("selected markers: "+selectedMarkers.length+" radius: "+ radiusSearch); 
				selectedMarkers.sort(sortByDistance); //sort the collected array by distance from nearest to furthest
				gMap.setCenter(new google.maps.LatLng(0,0),0); //extend the bonds of the map
				var bounds = new google.maps.LatLngBounds();
				var latlong;
				var selectedMarkersArraySize;
				if (selectedMarkers.length < 22) {
					selectedMarkersArraySize = selectedMarkers.length;
				} else {
					selectedMarkersArraySize = 22;
				}
				bounds.extend(new google.maps.LatLng(parseFloat(compareLat),parseFloat(compareLong))); 	//add in the original search point---red marker---so there are at least 2 present
				for (var k = 2; k < selectedMarkersArraySize; k++) { //create each marker in the populated array
					latlong = new google.maps.LatLng(parseFloat(selectedMarkers[k]["lat"]),parseFloat(selectedMarkers[k]["long"]));
					
					//surroundingMarkers[k] = createMarkerType(latlong,selectedMarkers[k]["long"],selectedMarkers[k]["bubble"],parseFloat(k)-1,0,'');
					
					///new
					createMarkerType(latlong,selectedMarkers[k]["long"],selectedMarkers[k]["bubble"],parseFloat(k)-1,0,''); 
 
 
					bounds.extend(latlong); 					
					document.getElementById("closestLocations"+k).innerHTML = '<a href="javascript:myclick(' + parseFloat(k-1) + ')"><img src="marker'+parseFloat(k-1)+'.gif" alt="Point '+parseFloat(k-1)+'" /><\/a>'+selectedMarkers[k]["html"]; 					
					//document.getElementById("closestLocations"+k).innerHTML =  '<img src="marker'+parseFloat(k-1)+'.gif"  />'+selectedMarkers[k]["html"]; 
					//gMap.addOverlay(surroundingMarkers[k]);
				}
				if(bounds.isEmpty()) {
					bounds.extend(new google.maps.LatLng(56.0, -90.0));
					bounds.extend(new google.maps.LatLng(44.0, -82.0));
        		} 
				gMap.fitBounds(bounds);
				
			   
		} //end of if (request.readyState == 4) {
		} //end of request.onreadystatechange = function() { 
		request.send(stringToSend); 
		//alert(stringToSend);
		
	} // end of function distanceCheck(inputAddress, locationType,newDistance,newLang,newType) {
	
	function showAddress() { 
		//gMap.removeOverlay(markerInput); 
		hideMarkers();
		clearDivs();
		//place the new searched address into the hidden refine field
		document.getElementById("RefinedAddress").value = document.getElementById("pac-input").value;
		//set refine back to default
		document.getElementById("KMdistance").value=10;
		document.getElementById("lang").value="NN";
		document.getElementById("schoolType").value="NN"; 
		
		var worldAddress = document.getElementById("pac-input").value;
		defaultAddr = document.getElementById("pac-input").value;
		address = worldAddress + ', Ontario, Canada'; 
		
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({ 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = createMarkerType(results[0].geometry.location,'Address',worldAddress,21,0,'');
				marker.setMap(gMap);
				searchPointMarkers.push(marker); //searched point array
				if (lastSelected == 0) {distanceCheck(results[0].geometry.location,"full");} 
			} else {
				alert("Unable to find address: " + status);
			} 
		}); 
	}
	
	function showAddress2(theaddress) { 
		hideMarkers();  
	   
		//clearDivs(); 
		var worldAddress = theaddress;
		defaultAddr = document.getElementById("pac-input").value;
		address = worldAddress + ', Ontario, Canada'; 
		
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = createMarkerType(results[0].geometry.location,'Address',worldAddress,21,0,'');
				marker.setMap(gMap);
				searchPointMarkers.push(marker); //searched point array
				if (lastSelected == 0) {distanceCheck(results[0].geometry.location,"full");} 
			} else {
				alert("Unable to find address: " + status);
			}
		});
		
		
		 
	}
	
	function showAddress3() { 
		//gMap.removeOverlay(markerInput);
		var geocoder = new google.maps.Geocoder();
		hideMarkers();
		clearDivs();
		var newDistance = document.getElementById("KMdistance").value;
		var newLang = document.getElementById("lang").value;
		var newType = document.getElementById("schoolType").value;
		var worldAddress = document.getElementById("RefinedAddress").value;
		defaultAddr = document.getElementById("RefinedAddress").value;
		address = worldAddress + ', Ontario, Canada';  
		 
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = createMarkerType(results[0].geometry.location,'Address',worldAddress,21,0,'');
				marker.setMap(gMap);
				searchPointMarkers.push(marker); //searched point array
				if (lastSelected == 0) {distanceCheck(results[0].geometry.location,"full",newDistance,newLang,newType);} 
			} else {
				alert("Unable to find address: " + status);
			}
		}); 
	}

  
	
	
	function sortByDistance(a, b) {
		var x = a.distanceFromPoint;
		var y = b.distanceFromPoint;
		return ((x < y) ? -1 : ((x > y) ? 1 : 0));
	}
	
	function clearDivs(){		
		for (var kcount = 2; kcount < 22; kcount++) { 
			document.getElementById("closestLocations"+kcount).innerHTML = '';
		}
		gmarkers.length = 0 //empty all the bubbles
	} 
	
	function hideMarkers(map, locations, markers) {
        /* Remove All Markers */
        while(gmarkers.length){
            gmarkers.pop().setMap(null);
        } 
        //console.log("Remove All Markers");
		while(searchPointMarkers.length){
            searchPointMarkers.pop().setMap(null);
        } 
        //console.log("Remove All Markers 222");
		
    }

   
</script>
