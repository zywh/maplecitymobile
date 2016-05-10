<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <!-- viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit">
        <meta name="screen-orientation" content="portrait">
        <meta name="full-screen" content="yes">
        <meta name="x5-orientation" content="portrait">
        <meta name="x5-fullscreen" content="true">

	<!--
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jqm-fa-img/jqm-font-awesome-isvg-ipng.min.css" />
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		-->
	 <link type="text/css" rel="stylesheet" href="/googlefont/material-icons.css" />


	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jqm-fa-img/jqm-font-awesome-maple.css" />
		
		
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.icons.min.css" />
	
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.structure-1.4.5.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/mhouse.css" />
	
	<title> 加拿大房产_枫之都
	</title>

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="/static/js/jquery/jquery-ui.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	<!--
	<script type="text/javascript" src="/static/map/js/markerclusterer_packed.js"></script>
	 -->



</script>	

</head>


<body>

	

<div data-role="page" id="page_main" data-theme="a" data-dom-cache="false" data-title="枫之都-加拿大地产置业">

	<!-- head开始 -->
	<div data-role="panel" id="main_menu" class="main-menu" data-display="overlay" data-position-fixed="true">
			<ul data-role="listview"  data-inset="true">
				<li data-icon="home"><a href="/" data-ajax="false" data-icon="home" id="menu_home">首页</a></li>
				<li data-icon="fa-thumbs-o-up"><a href="index.php?r=projects" data-ajax="false" id="menu_sale">项目推荐</a></li>
				<li data-icon="search"><a href="index.php?r=mhouse/index&sr=Sale" data-ajax="false" id="menu_sale">房源查询</a></li>
				<li data-icon="fa-map"><a href="index.php?r=map/index" data-ajax="false" id="menu_new">地图搜索</a></li>
				<li data-icon="fa-graduation-cap"><a href="index.php?r=map/school" data-ajax="false"  id="menu_school">学区房</a></li>
				<li data-icon="fa-bar-chart"><a href="index.php?r=stats/current" data-ajax="false" id="menu_homestats">房源统计</a></li>
				<li data-icon="fa-line-chart"><a href="index.php?r=stats" data-ajax="false" id="menu_homehist">历史统计</a></li>
				<li data-icon="info"><a href="index.php?r=about/about1&id=27" data-ajax="false" id="menu_about">关于我们</a></li>
			</ul>
		</div>
		
		<div data-role="header" data-position="Fullscreen"  class="main-header " id="main_header" data-theme="b" >
			<a href="#main_menu" data-transition="pop" class="ui-btn ui-icon-fa-navicon ui-btn-icon-left ui-btn-icon-notext"></a>
			<ul  data-inset="true" data-filter="true" data-filter-placeholder="城市(中英)/ 地址/ MLS#" data-filter-theme="a"></ul>
			<a href="index.php?r=map/index" data-ajax="false"   class="ui-btn ui-corner-all ui-shadow ui-icon-location ui-btn-icon-left ui-btn-icon-notext">Search</a>
		</div>
<script>

function default_ac(){

	
	var cache = {};
	$(".main-header input").autocomplete({
	 
		source: function(request, response) {
		var term = request.term; //cache result if term is typed in past
		if ( term in cache ) {
			response( cache[ term ] );
			return;
		}

		$.getJSON(
		"/index.php?r=mhouse/getCityList", 
		{ term: term  },  
		//response
		function( data, status, xhr ) {
			cache[ term ] = data;
			response( data );
			}
		);
			
		},
		minLength: 1,
		autoFocus: true,
		select: function( event, ui ) {

			var city = ui.item.id;
			//var matches = city.match(/\d+/g);
			var matches = city.match(/\|/g);
			if ( matches != null) {
		
				var citys = city.split("|");
				//console.log("CityLat" + citys[0] + citys[1] + citys[2]);
				if (( $("#mapsearchpage").length ) || ($("#school-search").length ) ) {
					//console.log("This is mapsearch page. SetmapCenter");
					map.setCenter(new google.maps.LatLng(parseFloat(citys[1]), parseFloat(citys[2])));
					
				}else{
					var url = 'index.php?r=map/index&lat=' + citys[1] + "&lng=" + citys[2] + "&zoom=10&maptype=city"; 
					location.href = url;
				}
				
			} else {
				
				var url = 'index.php?r=mhouse/view&id=' + city;
				location.href = url;
					
			}
		}
	});


}
	 
$(document).on( "pageinit", "#page_main", function() {
	

	if ( $("#school-search").length ) {
		console.log("This is schoolmap page");
	}

	default_ac();


});

 
  
</script>
			
			
		
	<!-- head结束 -->

	<!-- body开始 -->
	
		<?php echo $content; ?>
	
	<!-- body结束 -->
	
	<div data-role="footer" data-position="fixed" data-fullscreen="true" style="text-align:center;" id="main_footer">
   		 

		<a href="/" data-ajax="false" class="ui-btn ui-corner-all ui-icon-home ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="index.php?r=mhouse/index" data-ajax="false"  class=" ui-btn ui-corner-all ui-icon-search ui-btn-icon-left ui-btn-icon-notext
		">Search</a>
		<a href="index.php?r=map/index" data-ajax="false"  class="ui-btn ui-corner-all ui-icon-fa-map ui-btn-icon-left ui-btn-icon-notext
		">Map</a>
		<a href="index.php?r=map/school" data-ajax="false"  class="ui-btn ui-corner-all ui-icon-fa-graduation-cap ui-btn-icon-left ui-btn-icon-notext
		">School</a>
		<a href="index.php?r=stats/index" data-ajax="false"  class="ui-btn ui-corner-all ui-icon-fa-line-chart ui-btn-icon-left ui-btn-icon-notext
		">Stats</a>
	
		<a href="tel:400-870-1029"  class="ui-btn ui-corner-all ui-icon-phone ui-btn-icon-left ui-btn-icon-notext
		">Phone</a>
		<a href="mailto:info@maplecity.com.cn"  class="ui-btn ui-corner-all ui-icon-mail ui-btn-icon-left ui-btn-icon-notext
		">Email</a>
		<a href="index.php?r=about/about1&id=27" data-ajax="false"  class="ui-btn ui-corner-all ui-icon-info ui-btn-icon-left ui-btn-icon-notext
		">Info</a>
			
		
		
	</div>
		
</div>		



  
</div> 


</div> 

</body>
</html>
