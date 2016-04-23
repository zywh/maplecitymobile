
<script>


$(document).on("pageshow","#page_main",function(){
	
	
	$("#menu_home").addClass('ui-btn-active'); //make it active

 
});

  
</script>


<div data-role="main" class="ui-content">
	<h2>枫之都 - 加拿大房产置业</h2>
	<ul data-role="listview" data-inset="true">
	  <li>
		<a href="index.php?r=mhouse/index&sr=Sale" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>房源搜索</h2>
		<p>搜索加拿大二手房</p>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>租房搜索</h2>
		<p>搜索</p>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=map/index" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>地图搜索</h2>
		<p>搜索地图</p>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>学区房</h2>
		<p>学区房</p>
		</a>
	  </li>
	  <li>
		<a href="index.php?r=mhouse/index&sr=Lease" data-ajax="false" >
		<img src="static/images/logo.png">
		<h2>房源数据统计</h2>
		<p>房源数据统计</p>
		</a>
	  </li>	  
	</ul>
</div>
