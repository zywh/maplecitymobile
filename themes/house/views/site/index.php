
<script>


$(document).on("pageshow","#page_main",function(){
	
	
	$("#menu_home").addClass('ui-btn-active'); //make it active

 
});

  
</script>

<?php
	$db = Yii::app()->db;
	$criteria = new CDbCriteria();
	$criteria->order = 'date DESC';
	$criteria->select = 'subdate(date, 1) as date,t_house as t_resi,u_house as u_resi ,round(avg_house/10000,2) as avg_price ';
	$stats = Stats::model()->find($criteria);

?>
<div data-role="main" class="ui-content">
	<h2 style='text-align:center;'>枫之都 - 加拿大房产</h2>
	<ul data-role="listview" data-inset="true" data-icon="false">
	  <li>
		<a href="index.php?r=mhouse/index&sr=Sale" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>房源搜索</h2>
		<p>搜索加拿大二手房</p>
		<span class="ui-li-count"><?php echo $stats["t_resi"]; ?>套</span>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>租房搜索</h2>
		<span class="ui-li-count">3456套</span>
		<p>搜索</p>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=map/index" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>地图搜索</h2>
		<p>搜索地图</p>
		<span class="ui-li-count">84134套</span>
		</a>
	  </li>

	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>房源数据统计</h2>
		<p>房源数据统计</p>
		<span class="ui-li-count">平均:<?php echo $stats["avg_price"]; ?></span>
		</a>
	  </li>	  
	  	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>学区房</h2>
		<p>学区房</p>
		</a>
	  </li>
	</ul>
</div>
