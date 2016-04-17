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


	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.icons.min.css" />
	
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.structure-1.4.5.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/mhouse.css" />
	
	<title> 加拿大房产_枫之都
	</title>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	
	

</head>
<body>
	<?php
		$db = Yii::app()->db;
	?>

<div data-role="page" id="page_main" data-theme="a" data-dom-cache="false" data-title="枫之都-加拿大地产置业">

	<!-- head开始 -->
		<div data-role="panel" id="main_menu" data-display="overlay" data-position-fixed="true">
			<a href="/" data-ajax="false" > <h3>首页</h3></a>
		    <ul data-role="listview" data-inset="true" >
				<li><a href="index.php?r=mhouse/index"  >房源查询</a></li>
			</ul>
   
		</div>
		
		<div data-role="header" data-position="fixed" id="main_header" >
			<div data-role="navbar" data-iconpos="left">
			  <ul>
				<li><a href="#main_menu" data-ajax="false" id="header_menu" >菜单</a> </li>
				<li><a href="/" data-ajax="false" id="header_home" >主页</a> </li>
				<li><a href="index.php?r=mhouse/index&sr=Sale" id= "header_sale" data-ajax="false">二手房</a></li>
				<li><a href="index.php?r=mhouse/index&sr=Lease" id="header_lease"  data-ajax="false" >出租</a></li>
				
			  </ul>
			</div>
		
		
			
		</div>
	<!-- head结束 -->

	<!-- body开始 -->
	
		<?php echo $content; ?>
	
	<!-- body结束 -->
	
	<div data-role="footer"  style="text-align:center;" id="main_footer">
   		 
		
		<a href="/" data-transition="pop"  class="ui-btn ui-corner-all ui-icon-home ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="index.php?r=mhouse/index" data-transition="pop"  class="ui-btn ui-corner-all ui-icon-search ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="/" data-transition="pop" data-rel="back"  class="ui-btn ui-corner-all ui-icon-arrow-l ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="/" data-transition="pop"  data-rel="back"  class="ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="tel:(1) 888-8888"  class="ui-btn ui-corner-all ui-icon-phone ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="mailto:info@maplecity.com.cn"  class="ui-btn ui-corner-all ui-icon-mail ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
		<a href="#info" data-transition="pop"  class="ui-btn ui-corner-all ui-icon-info ui-btn-icon-left ui-btn-icon-notext
		">Home</a>
			
		
		
	</div>
		
</div>		



</div> 

</body>
</html>
