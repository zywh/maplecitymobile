<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/maplcity-mobile.min.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.icons.min.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/jquery.mobile.structure-1.4.5.min.css" />
	<title> 加拿大房产_枫之都
	</title>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	

</head>
<body>
	<?php
		$db = Yii::app()->db;
	?>

<div data-role="page" id="main" data-theme="a" data-dom-cache="false" data-title="枫之都-加拿大地产置业">
	<!-- head开始 -->
		<div data-role="panel" id="main_menu" data-display="overlay" data-position-fixed="true">
			<a href="/"  > <h3>首页</h3></a>
		    <ul data-role="listview" data-inset="true" >
				<li><a href="index.php?r=mhouse/index" data-prefetch >房源查询</a></li>
				<li><a href="index.php?r=mhouse/index"  >地图查询</a></li>
				<li><a href="index.php?r=mhouse/index" >新房查询</a></li>
			</ul>


    
		</div> 
		<div data-role="header" data-position="fixed" >
			<div data-role="navbar" data-iconpos="left">
			  <ul>
				<li><a href="/" data-prefetch  >首页</a></li>
				<li><a href="index.php?r=mhouse/index&sr=Sale"  >二手房</a></li>
				<li><a href="index.php?r=mhouse/index&sr=Lease" >出租</a></li>
				<li><a href="#main_menu" >更多</a></li>
			  </ul>
			</div>
		</div>
	<!-- head结束 -->

	<!-- body开始 -->
		<div data-role="main" >
		<?php echo $content; ?>
		</div>
	<!-- body结束 -->
		

	<!-- foot开始 -->
  <div data-role="footer" data-position="fixed" data-fullscreen="true" style="text-align:center;">
   		 
		
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


	<!-- foot结束 -->

</div> 

</body>
</html>
