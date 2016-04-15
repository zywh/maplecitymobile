
<script>



$(document).on("pagecreate","#main",function(){
	
	var srSwitch = '<select id="sr" data-role="flipswitch">	<option value="Lease">租</option>	<option value="Sale" selected="selected" >售</option></select>';
	
	//$("#topright").replaceWith(srSwitch);
	var arr = $('select').map(function(){
		  return this.value ;
	  }).get().join(",")
	$("#pricetext").text(arr);  
	  
	//Start Select Change Event  
	$("select").change(function () {

	arr = $('select').map(function(){
		  return this.value ;
	  }).get().join(",")
	 

	  $("#pricetext").text(arr);
	});

	//Start Select Change Event        
	
  
});

  

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


<!-- 房源搜索列表开始 -->
<div id="search_area"  class="ui-corner-all ui-mini">

<!-- search province/city start -->
<div class="ui-grid-b">
	
	<!-- select1 -->
	<div class="ui-block-a" >	
	<select id="sr" data-role="flipswitch">
		<option value="Lease">租</option>
		<option value="Sale" selected="selected" >售</option>
		
	</select>
	</div>
	
	<!-- select -->
	<div class="ui-block-b" >
		<select name="province" id="province" data-native-menu="false" >
			<option >省份</option>
			<option value="3" selected="selected">安省</option>
			<option value="4">BC省</option>
			<option value="5">阿尔伯塔</option>
			<option value="6">新不伦瑞克</option>
			<option value="7">新斯科舍省</option>
			<option value="8">爱德华王子岛省</option>
			<option value="9">纽芬兰及拉布拉多</option>
		</select>
	</div>
	<div class="ui-block-b">
		<ul id="citysearch" class="ui-shadow" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="输入城市 中/英文" data-filter-theme="a"  ></ul>
	</div>
</div>
<!-- search province/city end  -->



<!-- search row1 start -->
<div class="ui-grid-b" >
    <div class="ui-block-a">
		<select name="type" id="type" data-native-menu="false" >
			<option >房型</option>
			<option value="1" selected="selected">独栋别墅</option>
			<option value="2">联排别墅</option>
			<option value="3">豪华公寓</option>
			<option value="4">双拼别墅</option>
			<option value="5">度假屋</option>
			<option value="6">农场</option>
			<option value="7">空地</option>
			<option value="8">其他</option>
		</select>
	</div>
	
	<div class="ui-block-b">
		<select name="price" id="price" data-native-menu="false" >
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
	
	<div class="ui-block-c">
		<select name="date" id="date" data-native-menu="false" >
			<option > 挂牌时间 </option>
			<option value="1" selected="selected">昨日挂牌</option>
			<option value="2">一周</option>
			<option value="3">一个月</option>
			<option value="4">三个月</option>
		
		</select>	
	</div>
</div>
<!-- search row1 end  -->

<!-- search row2 start -->
<div class="ui-grid-b">
    <div class="ui-block-a">
		<select name="bedroom" id="bedroom" data-native-menu="false" >
			<option >卧室</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			<option value="5"> &gt5 </option>
			
			
		</select>
	</div>
    <div class="ui-block-b">
		<select name="washroom" id="washroom" data-native-menu="false" >
			<option > 洗手间</option>
			<option value="1"> &gt1 </option>
			<option value="2"> &gt2 </option>
			<option value="3"> &gt3 </option>
			<option value="4"> &gt4 </option>
			
			
			
		</select>
	</div>	
	<div class="ui-block-c">		
	  		<select name="year" id="year" data-native-menu="false" >
			<option >建造年份</option>
			<option value="1" >0-5年</option>
			<option value="2">5-15年</option>
			<option value="3">15-30年</option>
			<option value="4">30年以上</option>
			
		
		</select>	
	</div>

</div>
<!-- search row2 end  -->

<!-- search row3 start  -->
<div class="ui-grid-b">
 
 	<div class="ui-block-a">
		<select name="housearea" id="housearea" multiple="multiple" data-native-menu="false" >
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
	<div class="ui-block-b">
		<select name="landarea" id="landarea" multiple="multiple" data-native-menu="false" >
			<option >土地尺寸</option>
			<option value="0-2000" >2000平方尺以下</option>
			<option value="2000-4000">2000-4000平方尺</option>
			<option value="4000-6000">4000-6000平方尺</option>
			<option value="6000-12000">6000-12000平方尺</option>
			<option value="12000-435600">12000-1英亩</option>
			<option value="435600-0">1英亩以上</option>
		
		</select>	
	</div>
	<div class="ui-block-c">	
		
        <label for="features" class="ui-hidden-accessible">物业特点</label>
        <select name="features" id="features" multiple="multiple" data-native-menu="false">
          <option >物业特点</option>
          <option value="1">临树</option>
          <option value="2">临水</option>
          <option value="3">学校</option>
 
        </select>
	</div>
		
</div>		
<!-- search row3 end -->



</div>
<!-- 房源搜索列表结束 -->



<!-- 地图开始 --> 
<!-- 地图结束 -->

<!-- 房源列表开始 --> 

<div id="house_list" data-role="main" class="ui-content">
	Options:<span id="pricetext"></span>

</div>

<!-- 房源列表结束 -->



