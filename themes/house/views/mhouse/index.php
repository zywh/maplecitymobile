

<script>


var sr = '<?php echo $_GET['sr'];?>';
var selectOptions;

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}
/*
$(document).on("pageshow","#page_search",function(event){
  $("#header_sale").addClass('ui-btn-active'); //make it active
  $("#header_sale").text("test");
}); 

$(document).on("pagecreate","#page_search",function(){
	
	
    	//sr = getURLParameter("sr"); 
	$("#srtext").text(sr);	
	
	selectOptions = $('select').map(function(){
		  return this.value ;
	}).get().join(",")
	
	$("#pricetext").text(selectOptions);  
	  
	//Start Select Change Event  
	$("select").change(function () {
	selectOptions = $('select').map(function(){
		  return this.value ;
	  }).get().join(",")
	 
	  $("#pricetext").text(selectOptions);
	  
	});
	//Start Select Change Event        
	
 
});
*/
  
</script>

<?php
    $db = Yii::app()->db;
    ini_set("log_errors", 1);
	ini_set("error_log", "/tmp/php-error.log");
	function get_firstimage($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		$dir="mlspic/crea/".$county."/Photo".$ml_num."/";
		#$dir="mlspic/crea/creamid/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			return $dir.$picfiles[2];
		}else { return 'static/images/zanwu.jpg';}
	}
	
	function get_tn_image($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		$dir="mlspic/crea/creatn/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			
			$s = implode(",",array_slice($picfiles,2,3)); //return 3 comma seperated list with offset 2 which is subdir . and ..
			$s = str_replace("Photo",$dir."Photo",$s); // Insert DIR in front
			return $s;
		} else { return 'static/images/zanwu.jpg';}
	}	
	
?> 

<div data-role="panel" id="panel-city" data-display="overlay" data-position-fixed="true">
	
	<ul id="citysearch" class="ui-shadow ui-mini" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="输入城市 中/英文" data-filter-theme="a"  ></ul>
	<select name="province" id="province" data-native-menu="false" data-iconpos="noicon">
		<option >省份</option>
		<option value="3">安省</option>
		<option value="4">BC省</option>
		<option value="5">阿尔伯塔</option>
		<option value="6">新不伦瑞克</option>
		<option value="7">新斯科舍省</option>
		<option value="8">爱德华王子岛省</option>
		<option value="9">纽芬兰及拉布拉多</option>
	</select>	

</div>

<!-- 房源搜索列表开始 -->
<p></p>
<div id="house-search"  class="search-area">


<!-- search row1 start -->
<div class="ui-grid-c" >
	<div class="ui-block-a">
		<a href="#panel-city" class="ui-select ui-btn">地区</a>
	</div>
    <div class="ui-block-b">
		<select name="type" id="type" data-native-menu="false" data-iconpos="noicon" style=>
			<option >房型</option>
			<option value="1" >独栋别墅</option>
			<option value="2">联排别墅</option>
			<option value="3">豪华公寓</option>
			<option value="4">双拼别墅</option>
			<option value="5">度假屋</option>
			<option value="6">农场</option>
			<option value="7">空地</option>
			<option value="8">其他</option>
		</select>
	</div>
	<div class="ui-block-c">	
		<select name="price" id="price"  data-native-menu="false" data-iconpos="noicon">
			<option >价格</option>
			<option value="0-30" >30万以下</option>
			<option value="30-50" >30-50万</option>
			<option value="50-100" >50-100万</option>
			<option value="100-150" >100-150万</option>
			<option value="150-300" >150-300万</option>
			<option value="300-400" >300-450万</option>
			<option value="450-500" >450-600万</option>
			<option value="600-0" >600以上</option>
		</select>
	</div>

	<div class="ui-block-d">		
		<select name="bedroom" id="bedroom" data-native-menu="false"  data-iconpos="noicon">
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
		</select>
	</div>
	<div class="ui-block-a">	

		<select name="washroom" id="washroom" data-native-menu="false" data-iconpos="noicon" >
			<option > 洗手间</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
		</select>

	</div>

	<div class="ui-block-b">	
		<select name="housearea" id="housearea" multiple="multiple" data-native-menu="false"  data-iconpos="noicon">
			<option >房屋尺寸</option>
			<option value="0-700" >700平方尺以下</option>
			<option value="700-1100">700-1100平方尺</option>
			<option value="1100-1500">1100-1500平方尺</option>
			<option value="1500-2000">1500-2000平方尺</option>
			<option value="2000-2500">2000-2500平方尺</option>
			<option value="2500-3000">2500-3000平方尺</option>
			<option value="3000-3500">3000-3500平方尺</option>
			<option value="3500-4000">3500-4000平方尺</option>
			<option value="4000-0">4000以上</option>
		</select>
	</div>
	<div class="ui-block-c">	
		<select name="landarea" id="landarea" multiple="multiple" data-native-menu="false" data-iconpos="noicon">
			<option >土地尺寸</option>
			<option value="0-2000" >2000平方尺以下</option>
			<option value="2000-4000">2000-4000平方尺</option>
			<option value="4000-6000">4000-6000平方尺</option>
			<option value="6000-12000">6000-12000平方尺</option>
			<option value="12000-435600">12000-1英亩</option>
			<option value="435600-0">1英亩以上</option>
		
		</select>	
	</div>
	<div class="ui-block-d">
		<a href="/" class="ui-select ui-btn">更多</a>
	</div>	
</div>		
<!-- search row2 end -->



</div>
<!-- 房源搜索列表结束 -->



<!-- 地图开始 --> 
<!-- 地图结束 -->

<!-- 房源列表开始 --> 

<div id="house_list" data-role="main" class="ui-content">
	Options:<p id="pricetext"></p>
	Sale or Lease:<p id="srtext"></p>
	

</div>
  <div data-role="panel" id="overlayPanel" data-display="overlay"> 
    <h2>Overlay Panel</h2>
    <p>You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
    <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Close panel</a>
  </div> 
  <div data-role="panel" id="revealPanel" data-display="reveal"> 
    <h2>Reveal Panel</h2>
    <p>You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
    <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Close panel</a>
  </div> 
   <div data-role="panel" id="pushPanel" data-display="push"> 
    <h2>Push Panel</h2>
    <p>You can close the panel by clicking outside the panel, pressing the Esc key, by swiping, or by clicking the button below:</p>
    <a href="#pageone" data-rel="close" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left">Close panel</a>
  </div> 

  
   <div data-role="main" class="ui-content">
    <p>Click on one of the the buttons to open the Panel with different display modes.</p>
    <a href="#overlayPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Overlay Panel</a>
     <a href="#revealPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Reveal Panel</a>
      <a href="#pushPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Push Panel</a>
  </div>

<!-- 房源列表结束 -->


