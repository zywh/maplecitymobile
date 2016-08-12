<?php

class NgGetController extends XFrontBase
{
	
	//REST to return either single project detail or list of projects if no parm ID is provided
   public function actionGetProjects(){
		$imghost = "http://m.maplecity.com.cn/";
		$results = array();
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		//error_log("Parms:".$_POST['parms']['id']);
		$criteria = new CDbCriteria();
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		
		if (!empty($postParms['id'])){
			//return single record for detail page
			$criteria->addCondition('id="'.$_POST['parms']['id'].'"');
			//$subject = Subject::model()->find($criteria);
			$row = Subject::model()->find($criteria);
			
			//foreach($subject as $row){

			$result['id'] = $row["id"]; 
			$result['name'] = $row["name"]; 
			$result['summary'] = $row["summary"]; 
			$result['image_list'] = unserialize($row["image_list"]); 
			$result['layout_list'] = unserialize($row["layout_list"]); 
			$result['amenities'] = $row["amenities"]; 
			$result['point'] = $row["point"]; 
			$result['room_type_image'] = $row["room_type_image"]; 
			$result['developer_intro'] = $row["developer_intro"];
			$result['cityname'] = $row["cityname"]; 			
			$result['replaceurl'] = $imghost."tn_uploads";
			
			//$results[] = $result;
			//Return single Array object
			echo json_encode($result);
			//}
		} else {
			//Return all recommended project
			
			$criteria->addCondition('recommend=1');
			$subject = Subject::model()->findAll($criteria);
			foreach($subject as $row){

				$result['id'] = $row["id"]; 
				$result['name'] = $row["name"]; 
				$result['cityname'] = $row["cityname"]; 
				$result['room_type_image'] = str_replace("uploads","tn_uploads",$imghost.$row["room_type_image"]);
				$results[] = $result;
			}
			//return object array with multiple elements. 
			echo json_encode($results);
		}
		
			
		
		
		

		
    }	

	//REST to return either list of GRID and HOUSEes for map search page
    public function actionGetMapHouse() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		
		
		$maxmarkers = 2000;  //City count if count(house) is over
		$maxhouse = 40; //Grid count if count(house) is over
		$maxcitymarkers = 20;
		$minGrid = 5; //Display house if gridcount is lower than mindGrid
        // $result = array();
		$result['Data']['AreaHouseCount'] = array();
		$result['Data']['MapHouseList'] = array();
		$count= 0;
		
        if (empty($postParms)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } else {
            //$result['IsError'] = false;

            //根据条件查询地图
            $criteria = new CDbCriteria();
			$criteria = $this->houseOption($postParms);
	
			 
			$latlon = explode(',', $postParms['bounds']);
			$minLat = floatval($latlon[0]);
			$maxLat = floatval($latlon[2]);
			$minLon = floatval($latlon[1]);
			$maxLon = floatval($latlon[3]);
			
			

			//error_log("minLon:".$minLon."maxLon:".$maxLon."minLat:".$minLat."maxLat:".$maxLat);

			//End of Condition
			
			//Add condition for homepage nearby and recommendation
			if (!empty($postParms['type'])) {
				 $criteria->limit = 10;
				error_log("type".$postParms['type']);
				 //Recommendation
				 if ($postParms['type']  == 'recommend') {
					error_log("type2 is selected");
					$criteria->addCondition("propertyType_id = 1"); 
					$criteria->addCondition("br >= 3");
					$criteria->addCondition('lp_dol >= 800000');
					$criteria->addCondition('lp_dol <= 1800000');
				 }
			 }
			if (empty($postParms['type'])) {	
				$count = House::model()->count($criteria);
				$result['Data']['Total'] = $count;
			}
						
			//Generate Data for City Count Marker Start
			if ( $count >= $maxmarkers) {
				error_log("Generate City View Count");
				$result['Data']['Type'] = "city";
				$groupcriteria = $criteria;
				$groupcriteria->select = 't.municipality as municipality,count(id) as id,sum(lp_dol)/10000 as lp_dol';
				//$groupcriteria->select = 't.municipality as municipality,count(id) as id,"100" as lp_dol';
				$groupcriteria->with = array('mname');
				$groupcriteria->group = "t.municipality";
				$groupcriteria->order = "id DESC";
				$groupcriteria->limit = $maxcitymarkers;
				
				$groupresult = House::model()->findAll($groupcriteria);
				$result['Message'] = '成功';
				//error_log(get_object_vars($groupcriteria));
				foreach ($groupresult as $val) {
					
					$city = $val->municipality;
					error_log("Generate City List".$city);
					$lat = $val->mname->lat;
					$lng = $val->mname->lng;
					$citycn = $val->mname->municipality_cname;
					
					if ( $lat > 20 ) {
						$result['Data']['AreaHouseCount'][$city]['NameCn'] = !empty($citycn)? ($citycn):"其他";
						$result['Data']['AreaHouseCount'][$city]['HouseCount'] = $val->id;
						$result['Data']['AreaHouseCount'][$city]['TotalPrice'] = $val->lp_dol;
						$result['Data']['AreaHouseCount'][$city]['GeocodeLat'] = $lat;
						$result['Data']['AreaHouseCount'][$city]['GeocodeLng'] = $lng;
					}
		
				}
			
			}
			
			$gridcount = 100;
			//Generate Data for Grid Counter Marker Start
			if (( $count < $maxmarkers) && ($count >= $maxhouse) ){
				//error_log("Count:".$count."Get Grid");
				$result['Data']['Type'] = "grid";
				$gridx =  ( $postParms['gridx'])? ( $postParms['gridx']): 5;
				$gridy =  ( $postParms['gridy'])? ( $postParms['gridy']): 5;
				
				$gridcriteria = $criteria;
				$gridcriteria->select = 'longitude,latitude,lp_dol';
				$location = House::model()->findAll($gridcriteria);
				$result['Message'] = '成功';
				//$tilex = (($maxLat - $minLat ) / $gridx) * 100000;
				//$tiley = (($maxLon - $minLon ) / $gridy) * 100000;
				$tiley = (($maxLat - $minLat ) / $gridy) ;
				$tilex = (($maxLon - $minLon ) / $gridx) ;
				//Generate grid center Lat/Lng
				for ( $x=1; $x <= $gridx ; $x++){
					for ( $y=1; $y <= $gridy ; $y++){
						$gridCenterlat = $minLat + ($tiley/2) + ($y -1)*$tiley ;
						$gridCenterlng = $minLon + ($tilex/2) + ($x -1)*$tilex ;
						$result['Data']['AreaHouseCount']["G".$x.$y]['GeocodeLat'] = $gridCenterlat;
						$result['Data']['AreaHouseCount']["G".$x.$y]['GeocodeLng'] = $gridCenterlng;
						
						
					}
				}
				//Get count of house in each tile
				foreach ($location as $val) {
					//$gridlat = ceil((($val->latitude - $minLat ) * 100000 / $tilex));
					//$gridlng = ceil((($val->longitude - $minLon) * 100000 / $tiley));
					$gridlat = ceil((($val->latitude - $minLat ) / $tiley));
					$gridlng = ceil((($val->longitude - $minLon) / $tilex));
					$price = $val-> lp_dol/10000;
					
					
					$result['Data']['AreaHouseCount']["G".$gridlng.$gridlat]['NameCn'] = "G".$gridlng.$gridlat;
					$result['Data']['AreaHouseCount']["G".$gridlng.$gridlat]['HouseCount']++; 
					$result['Data']['AreaHouseCount']["G".$gridlng.$gridlat]['TotalPrice'] += $price; 
					//error_log("G".$gridlng.$gridlat."Count:".$result['Data']['AreaHouseCount']["G".$gridlng.$gridlat]['HouseCount']);
				}
				
				
				
				function moreThanOne($var)
				{
				return($var['HouseCount'] > 0);
				}
				$filteredResult = array_filter($result['Data']['AreaHouseCount'],"moreThanOne");
				$gridcount = count($filteredResult);
				error_log("#Grid:".$gridcount);
				
				
				$result['Data']['Type'] = "grid";
				
				
			}
			
			
			
			//Generate Data for  House Marker Start
			if (($count < $maxhouse ) || ( $gridcount <= $minGrid)){
			
				$result['Data']['Type'] = "house";
				$result['Data']['imgHost'] = "http://m.maplecity.com.cn/";
				$criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,br,addr,longitude,latitude,area,bath_tot';
				$criteria->with = array('mname','propertyType','city');
				$criteria->order = "t.latitude,t.longitude";
				$house = House::model()->findAll($criteria);
				$result = $this->house2Array($house,$count,'house');
            
			}
			

		
		}
		
		echo json_encode($result);
    }
	
	
	//REST to return either list of GRID and HOUSEes for map search page
    public function actionGetHouseList() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
	    
		
        if (empty($postParms)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } else {
           
      
			$criteria = $this->houseOption($postParms);
			$count = House::model()->count($criteria);
			$pager = new CPagination($count);
			$pager->pageSize = 8;
			if (!empty($postParms['pageindex'])) {
				$pager->currentPage = $postParms['pageindex'];
			}
			$pager->applyLimit($criteria);
			$criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,br,addr,longitude,latitude,area,bath_tot';
			$criteria->with = array('mname','propertyType','city');
			$house = House::model()->findAll($criteria);
			

			$result = $this->house2Array($house,$count,'house');
       		
		} 
		
		
		echo json_encode($result);
    }
	
	
	/*
	REST for autocomplete page. 
	return either city -> map will re-center based on selection
	or MLS# -> map will redirect it to house detail page and pass MLS# as parm
	or House Address -> map will redirect it to house detail page and pass MLS# as parm
	*/
	public function actionGetCityList(){
		
		
		$limit = 8;
		$db = Yii::app()->db;
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$term = trim($postParms['term']);
		
		//$term = "11";
		error_log("Autocomplete Parms Term:".$term);
		$chinese = preg_match("/\p{Han}+/u", $term);
		
		
		if ( is_numeric($term) || preg_match("/^[a-zA-Z]\d+/",$term) ) {
			//MLS search
			$sql = "
			SELECT ml_num,municipality,if(s_r = 'Sale',concat(round(lp_dol/10000),'万'),concat(lp_dol,'/月')) as price,latitude,longitude FROM h_house 
			WHERE  ml_num like '".$term."%' 
			ORDER by city_id
			limit " .$limit;
			$resultsql = $db->createCommand($sql)->query();
			foreach($resultsql as $row){
				//Type MLS ARRAY
				$result['id'] = $row["ml_num"]; 
				$result['value'] = $row["ml_num"]; 
				$result['city'] = $row["municipality"];
				$result['lat'] = $row["latitude"]; 
				$result['lng'] = $row["longitude"]; 
				$result['price'] = $row['price'];	
				$results['MLS'][] = $result;
			}
			
		} else{
		//Generate Count by municipality
			
			
			if ($chinese) { //if province = 0 and chinese search
			
				$sql = "
				SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE  m.province = c.englishname 
				AND  m.municipality_cname like '".$term."%' 
				AND  m.count > 1 order by count desc limit " .$limit;
							
			
			} else { //if province = 0  and english search
			
				$sql = "
				SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE  m.province = c.englishname 
				AND  municipality like '".$term."%' 
				AND  m.count > 1 order by count desc limit ". $limit;
				
			}
						
			$resultsql = $db->createCommand($sql)->query();
			$citycount = count($resultsql);
			
			foreach($resultsql as $row){
				$idArray = array($row["citye"],$row["lat"],$row["lng"]);
				
				//Type CITY ARRAY
				$result['id'] = $row["citye"]; 
				$result['type'] = "CITY"; 
				$result['lat'] = $row["lat"]; 
				$result['lng'] = $row["lng"]; 
				
				if ( $chinese ) {
					
					$result['value'] = $row["cityc"].", ".$row["provincec"]; 
					$results['CITY'][] = $result;
					
				} else {
					$result['value'] = $row["citye"].", ". $row["provincee"]; 
					$results['CITY'][] = $result;
				}
		
		
			}
			
			//Address Search and Return ML_NUM
			if ($citycount < $limit){
				//start address selection
				$limit = $limit - $citycount;
				$sql = "
				SELECT ml_num,addr,if(s_r = 'Sale',concat(round(lp_dol/10000),'万'),concat(lp_dol,'/月'))  as price,municipality,county,latitude,longitude FROM h_house  
				WHERE  addr like '%".$term."%' order by city_id
				limit " .$limit;
				$resultsql = $db->createCommand($sql)->query();
				
				foreach($resultsql as $row){
					//Type ADDRESS ARRAY
					$result['id'] = $row["ml_num"]; 
					$result['value'] = $row["addr"];
					$result['city'] = $row["municipality"];
					$result['lat'] = $row["latitude"]; 
					$result['lng'] = $row["longitude"]; 
					$result['price'] = $row['price'];	
					$result['province'] = $row["county"];
					$results['ADDRESS'][] = $result;
				}
			}
			
			
		}
		echo json_encode($results);

		
    
	//Function END  
    }
	
	/*
	REST for About Page content POST Model
	*/
	public function actionGetAbout(){
		$postParms = array();
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$catalog_id = $postParms['id'];
		if ($catalog_id == '') $catalog_id = 27;
		if ($catalog_id == 27) $cat_name_en="MAPLECITY PFOFILE";
		if ($catalog_id == 28) $cat_name_en="SUPERIORITY";
		if ($catalog_id == 30) $cat_name_en="CONTACT US";
		if ($catalog_id == 31) $cat_name_en="JOIN US";
				
		$row = Post::model()->find(array(
			'select'    => 'id, title, content',
			'condition' => ' catalog_id = :catalog_id',
			'params'    => array(':catalog_id' => $catalog_id),
			'order'     => 'id ASC',
			'limit'     => 1
		));
		//$imghost = "http://m.maplecity.com.cn/";
		$result['id'] = $row['id'];
		$result['title'] = $row['title'];
		$result['content'] = $row['content'];
		$result['catname'] = $cat_name_en;
		$result['imgHost'] = "http://m.maplecity.com.cn/";
		echo json_encode($result);
	}
	

	/* News Info POST Model*/
    public function actionGetPost(){
		$results = array();
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		//error_log("Parms:".$_POST['parms']['id']);
		$id = (!empty($postParms['id']))? $postParms['id']: 32;
		//$id = (!empty($id))? id: 10;
		$criteria = new CDbCriteria();
        
        $post = Post::model()->findByPk($id);
  
        $post->view_count += 1;
        $post->save();
        $catalog_id = $post->catalog_id;
        $next_post = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id > :id AND catalog_id = :catalog_id',
            'params'    => array(':id' => $id, ':catalog_id' => $catalog_id),
            'order'     => 'id ASC',
            'limit'     => 1
        ));
        $prev_post = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id < :id AND catalog_id = :catalog_id',
            'params'    => array(':id' => $id, ':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
		$result['current']['title'] = $post['title'];
		$result['current']['content'] = $post['content'];
		$result['current']['image'] = $post['image'];
		
		//$result['pre'] = array_map(create_function('$m','return $m->getAttributes(array(\'id\',\'title\'));'),$prev_post);
		$result['pre']['id'] = $prev_post[0]['id'];
		//$result['next'] = array_map(create_function('$m','return $m->getAttributes(array(\'id\',\'title\'));'),$next_post);
		$result['next']['id'] = $next_post[0]['id'];
        echo json_encode($result);
    }
	
	/* News Info List POST Model*/	
    public function actionGetPostList(){
        //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        //$catalog_id = Yii::app()->request->getQuery('catalog_id', 11);
		$postParms = array();
		$db = Yii::app()->db;
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$catalog_id = $postParms['id'];
		//$catalog_id = 12;
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
      

 
        //房产热点新闻
        $posts = Post::model()->findAll(array(
            'select'    => 't.id as id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
			'with' => array('catalog'),
            'order'     => 't.id DESC',
            'limit'     => 5
        ));
		
	

		$result['posts'] =  array_map(create_function('$m','return $m->getAttributes(array(\'id\',\'title\'));'),$posts);
		
		echo json_encode($result);
        

    }
	
	/*MLS Data Stat for stats page*/
    public function actionGetMlsData(){

        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = 'unix_timestamp(date)*1000 as date,
				sales,dollar/1000000 as dallor,avg_price,
				new_list,snlr*100 as snlr,active_list,
				moi,avg_dom,avg_splp*100 as avg_splp,type';
	

        $data = MlsHist::model()->findAll($criteria);
        foreach ($data as $val) {


                $result['mlsdata'][$val->type]['avgprice'][] = array($val->date,$val->avg_price); //good
                $result['mlsdata'][$val->type]['avgdom'][] = array($val->date,$val->avg_dom); //good
                $result['mlsdata'][$val->type]['avgsplp'][] = array($val->date,$val->avg_splp); //good
				$result['mlsdata'][$val->type]['sales'][] = array($val->date,$val->sales); //good
                $result['mlsdata'][$val->type]['newlist'][] = array($val->date,$val->new_list); //good
                $result['mlsdata'][$val->type]['moi'][] = array($val->date,$val->moi); //good
				$result['mlsdata'][$val->type]['active'][] = array($val->date,$val->active_list); //good
				$result['mlsdata'][$val->type]['snlr'][] = array($val->date,$val->snlr); //bad
        }


        echo json_encode($result);

     

    }

	/*Current House Stats data for stats page*/
	public function actionGetHouseStats(){
		$db = Yii::app()->db;
		$result = array();
		//
		
		$sql = " select * from h_stats_chart order by i1 desc;";
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){
			if ( $row["chartname"] == 'city')	{
				//City
				//$result["city"][] = array($row["n1"],$row["n3"],$row["n2"],$row["n4"],$row["i1"],$row["i2"]); 
				$s["name"] = $row["n1"];
				$s["y"] =(int)$row["i1"];
				$result["city"][] = $s;
				
			}
		   if ( $row["chartname"] == 'province')       {
					
				$s["name"] = $row["n2"];
				$s["y"] =(int)$row["i1"];	
				$result["province"][] = $s;
			}

		  
			if ( $row["chartname"] == 'price')	{
				//房价分布图
				$s["name"] = $row["n1"];
				$s["y"] =(int)$row["i1"];
				$result["price"][] = $s; //n1 is bin and i1 is count
			}
			
			if ( $row["chartname"] == 'house')	{
				//房屋面积分布图
				$s["name"] = $row["n1"];
				$s["y"] =(int)$row["i1"];
				$result["housearea"][] = $s; //n1 is bin and i1 is count
			}
			
			if ( $row["chartname"] == 'land')	{
				//土地面积分布图
				//$result["landarea"][] = array($row["i1"],$row["n1"]); //n1 is bin and i1 is count
				$s["name"] = $row["n1"];
				$s["y"] =(int)$row["i1"];
				$result["landarea"][] = $s;
			}
			if ( $row["chartname"] == 'type')	{
				//类型分布图
				//$result["property_type"][] = array($row["i1"],$row["n1"]); //n1 is bin and i1 is count
				$s["name"] = $row["n1"];
				$s["y"] =(int)$row["i1"];
				$result["property_type"][] = $s; //n1 is bin and i1 is count
			}
						
		}
		

       	//End of count
		
       echo json_encode($result);

      
    }

	public function statsLevel($characteristic) {
		return strlen($characteristic) - strlen(ltrim($characteristic));
	}

	/*Current House Stats data for stats page*/
	public function actionGetCityStats(){
		$db = Yii::app()->db;
		$results = [];
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$city = $postParms['city'];
		//$city='Mississauga';
		//
		$sql = "select replace(topic_chinese,' ','_') as t,Characteristic_chinese as c,Total from h_stats_city where CSD_Name='".$city."';";
		$resultsql = $db->createCommand($sql)->query();
		
		// add columns level and parent to a series
		// $topics[$topic] - a array of all topics with all of its series
		$parent = ["topic" => "1st"];
		$parents = [];
		$parents_list = [];
		$parents_stack = ["toplevel"];
		$topics = [];
		
		foreach($resultsql as $row){
			$topic = $row['t'];
			// new topic
			if ($topic != $parent["topic"]) {
				$parents_stack = ["toplevel"];
				if ($parent["topic"] != "1st") $parents_list[$parent["topic"]] = $parents;
				$parents = [];
			}

			$level = $this->statsLevel($row['c']);
			$s["level"] = $level;
			//error_log("topic=".$topic."parent.level".$parent["level"]."level=".$level);
			
			switch(TRUE) {	
				case ($level > $parent["level"]):
					array_push($parents_stack, $parent["name"]);
					$parents[] = $parent["name"];
					break;
				case ($level < $parent["level"]):
					array_pop($parents_stack);
					break;
				case ($level == $parent["level"]):
				default:
					break;
			}
			$s["parent"] = end($parents_stack);
			
			$s["topic"] = $topic;
			$s["name"] = trim($row['c']);
			$s["y"] = (int)$row["Total"];
			$parent = $s;
			$topics[$topic][] = $s;
		}
		// $parents_list - all level names
		//error_log(print_r($topics,1));
		//error_log(print_r($parents_list,1));

		foreach($topics as $topic_name => $a_topic){
			$data = [];
			foreach ($a_topic as $a_series) {
				// if the parent has children, add the drilldown
				$level_name = $a_series["parent"];
				if (in_array($a_series["name"], $parents_list[$topic_name]))
					$data[$level_name][] = ["name" => $a_series["name"], "y" => $a_series["y"], "drilldown" => $a_series["name"]];
				else 
					//$data[$level_name][] = ["name" => $a_series["name"], "y" => $a_series["y"]];
					$data[$level_name][] = [$a_series["name"], $a_series["y"]];
				
			}
			
			foreach ($data as $level_name => $a_data) {
				if ($level_name == "toplevel")
					$results[$topic_name]["series"][] = ["name" => $topic_name, "data" => $a_data];
				else
					//$results[$topic_name]["drilldown"]["series"][] = ["id" => $level_name, "name" => $level_name, "data" => $a_data]; 
					$results[$topic_name]["drilldown"]["series"][] = ["id" => $level_name, "name" => "上级", "data" => $a_data]; 
			}
			$results[$topic_name]["rawseries"] = $a_topic;
			$results[$topic_name]["levels"] = $parents_list[$topic_name];
		}
       	//End of topic

       echo json_encode($results);
    }

	/*Current House Stats data for stats page*/
	public function actionGetHpiStats(){
		$db = Yii::app()->db;
		$result = array();
		//
		
		$sql = " select unix_timestamp(date)*1000 as date,hpi,sales,location from h_stats_hpinew";
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){
			$location = $row["location"];
			$s["date"] = $row["date"];
			$s["hpi"] = $row["hpi"];
			$s["sales"] = $row["sales"];
			$result[$location][] = $s;
						
		}
		

       	//End of count
		
       echo json_encode($result);

      
    }

	/*School List for School Map Page*/	
    public function actionGetSchoolMap() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		
		
		$maxmarkers = 200;  
        $result = array();
		$result['SchoolList'] = array();
			
        if (empty($_POST)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } 
		else 
		{
            $result['IsError'] = false;

            //type
            $criteria = new CDbCriteria();
			
			
			if($postParms['type'] == TRUE ) { //secondary school
				$criteria->addCondition('type =1');
			} 
			/* 
			if($postParms['type'] ==  FALSE ) {  //elementary school
				$criteria->addCondition('type =0');
			}  */
			
			$chinese = preg_match("/\p{Han}+/u", $postParms['xingzhi']);
			//XingZhi
			if(!empty($postParms['xingzhi']) && !($chinese)) {
				$criteria->addCondition("xingzhi like '".$postParms['xingzhi']."%'");
			}
			
			//Pingfen
			if(!empty($postParms['pingfen']) && intval($postParms['pingfen']) > 0) {
				$criteria->addCondition("pingfen >='".$postParms['pingfen']."'");
			} 
			
			//Rank
			if(!empty($postParms['rank'])&& intval($postParms['rank']) > 0) {
				//$criteria->order = "paiming ASC";
				$criteria->addCondition("paiming <='".$postParms['rank']."'");
						
			} 		
			
			//lat and long selection
            if (!empty($postParms['bounds'])) {
                $latlon = explode(',', $postParms['bounds']);
                $minLat = floatval($latlon[0]);
                $maxLat = floatval($latlon[2]);
                $minLon = floatval($latlon[1]);
                $maxLon = floatval($latlon[3]);
                $criteria->addCondition("lat <= :maxLat");
                $criteria->params += array(':maxLat' => $maxLat);
                $criteria->addCondition("lat >= :minLat");
                $criteria->params += array(':minLat' => $minLat);
                $criteria->addCondition("lng <= :maxLon");
                $criteria->params += array(':maxLon' => $maxLon);
                $criteria->addCondition("lng >= :minLon");
                $criteria->params += array(':minLon' => $minLon);
		


            }

			//Filter Invalid Lat
			$criteria->addCondition("lat > 20");
			
			//End of Condition
			
			$count = School::model()->count($criteria);
			
						
			//Display grid list if # of maxmarker is large
			if ( $count >= $maxmarkers) {
				$result['type'] = "grid";
				$criteria->addCondition("pingfen >0");
				error_log("Count:".$count."Grid Mode");
				$criteria->limit = 2000;
				$school = School::model()->findAll($criteria);
				$result['Message'] = '成功';
				$gridx =  ( $postParms['gridx'])? ( $postParms['gridx']): 5;
				$gridy =  ( $postParms['gridy'])? ( $postParms['gridy']): 5;

				$tiley = (($maxLat - $minLat ) / $gridy) ;
				$tilex = (($maxLon - $minLon ) / $gridx) ;
				//Generate grid center Lat/Lng
				for ( $x=1; $x <= $gridx ; $x++){
					for ( $y=1; $y <= $gridy ; $y++){
						$gridCenterlat = $minLat + ($tiley/2) + ($y -1)*$tiley ;
						$gridCenterlng = $minLon + ($tilex/2) + ($x -1)*$tilex ;
						$result['gridList']["G".$x.$y]['GeocodeLat'] = $gridCenterlat;
						$result['gridList']["G".$x.$y]['GeocodeLng'] = $gridCenterlng;
									
					}
				}
				//Get count of school in each tile
				foreach ($school as $val) {
				
					$gridlat = ceil((($val->lat - $minLat ) / $tiley));
					$gridlng = ceil((($val->lng - $minLon) / $tilex));
					$rating = $val-> pingfen;
					$result['gridList']["G".$gridlng.$gridlat]['GridName'] = "G".$gridlng.$gridlat;
					$result['gridList']["G".$gridlng.$gridlat]['SchoolCount']++; 
					$result['gridList']["G".$gridlng.$gridlat]['TotalRating'] += $rating; 
					
				}
       		}
			
			//Display school list if maxmarker is less
			if ( $count < $maxmarkers) {
				$result['type'] = "school";
				$criteria->order = "paiming";
				$school = School::model()->findAll($criteria);
				$result['Message'] = '成功';
				foreach ($school as $val) {
					$schoolList = array();
					$schoolList['School'] = $val->school;
					$schoolList['Paiming'] = !empty( $val->paiming)?  $val->paiming :'无';
					$schoolList['Pingfen'] = !empty( $val->pingfen)?  $val->pingfen :'无';
					$schoolList['Grade'] = $val->grade;
					$schoolList['City'] = $val->city;
					$schoolList['Zip'] = $val->zip;
					$schoolList['Province'] = $val->province;
					$schoolList['Tel'] = $val->tel;
					$schoolList['Address'] = $val->address;
					$schoolList['Lat'] = $val->lat;
					$schoolList['Lng'] = $val->lng;
					$schoolList['URL'] = $val->url;
					$schoolList['Schoolnumber'] = $val->schoolnumber;
					$result['SchoolList'][] = $schoolList;


				}
 
       		}
		}
		
		echo json_encode($result);
    }
	
	/*School Map Auto Complete*/
	
	public function actionGetSchoolAutoComplete(){
		
			
		$limit = 8;
		$city_id='0';
		$db = Yii::app()->db;
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$term = trim($postParms['term']);
		//$term = 'john';
		
		$chinese = preg_match("/\p{Han}+/u", $term);
		
		
		
		if ($chinese) { //if province = 0 and chinese search
		
			$sql = "
			SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
			FROM h_mname m, h_city c 
			WHERE  m.province = c.englishname 
			AND  m.municipality_cname like '".$term."%' 
			AND  m.count > 1 order by count desc limit " .$limit;
						
		
		} else { //if province = 0  and english search
		
			$sql = "
			SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
			FROM h_mname m, h_city c 
			WHERE  m.province = c.englishname 
			AND  municipality like '".$term."%' 
			AND  m.count > 1 order by count desc limit ". $limit;
			
		}
				
		
	
	
			
		
		$resultsql = $db->createCommand($sql)->query();
		$citycount = count($resultsql);
		
		foreach($resultsql as $row){
			
			//Type CITY ARRAY
			$result['id'] = $row["citye"]; 
			$result['type'] = "CITY"; 
			$result['lat'] = $row["lat"]; 
			$result['lng'] = $row["lng"]; 
			
			if ( $chinese ) {
				
				$result['value'] = $row["cityc"].", ".$row["provincec"]; 
				$results['CITY'][] = $result;
				
			} else {
				$result['value'] = $row["citye"].", ". $row["provincee"]; 
				$results['CITY'][] = $result;
			}
		
	
		}
			
		//Address Search and Return ML_NUM
		if ($citycount < $limit){
			//start address selection
			$result= [];
			$limit = $limit - $citycount;
			$sql = "
			SELECT school,lat,lng,city,province,if(paiming >0,paiming,'无') as  p FROM h_school 
			WHERE  school like '%".$term."%' order by p ASC
			limit " .$limit;
			$resultsql = $db->createCommand($sql)->query();
			
			foreach($resultsql as $row){
				
				//Type ADDRESS ARRAY
				$result['paiming'] = $row["p"]; 
				$result['school'] = $row["school"];
				$result['lat'] = $row["lat"];
				$result['lng'] = $row["lng"];
				$results['SCHOOL'][] = $result;
								
			}
		}
		
		

		 echo json_encode($results);
    
	//Function END  
    }

	//REST to return the house detail by its MLS#
    public function actionGetHouseDetail() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$id = $postParms['id'];
		$username = $postParms['username'];
		//error_log("id=".$id);
        
		$criteria = new CDbCriteria();
		//$criteria->addCondition('t.id="'.$id.'"');
		$criteria->addCondition('t.ml_num="'.$id.'"');
		$criteria->with = array('mname','propertyType');
		
        //$house = House::model()->find('id=:id',array(':id'=>$id));
		$house = House::model()->find($criteria);
 		//$house = House::model()->find($criteria)->asArray()->all();
		//error_log(print_r($house));

        $exchangeRate = 0;
        $exchangeRateList = ExchangeRate::model()->findAll();
        if(!empty($exchangeRateList)){
            $exchangeRate = $exchangeRateList[0]->rate;
        }

 //照片
        $county = $house->county;
        $county = preg_replace('/\s+/', '', $county);
        $county = str_replace("&","",$county);

		//$dir="mlspic/crea/creamid/".$county."/Photo".$house->ml_num."/";
        $rdir=$county."/Photo".$house->ml_num."/";
        $dir="mlspic/crea/".$rdir;
        $num_files = 0;
		

        if(is_dir($dir)){
            $picfiles =  scandir($dir);
            $num_files = count(scandir($dir))-2;
        }

        if ( $num_files > 0)    {
            for ($x = 2; $x <= $num_files + 1; $x++) {
                $photos[] = $rdir.$picfiles[$x];
            }    
        }
		if ($username != 'NO'){
			$isFav = $this->checkfav($username,$id);
		} else { $isFav = 0;}
		

        $data = array(
			'house'           => $house->getAttributes(),
			'house_mname'     => $house->mname->getAttributes(),
			'house_propertyType' => $house->propertyType->getAttributes(),
			'exchangeRate'    => $exchangeRate,
			'photos'          => $photos,
			'isFav'			=> $isFav
        );

		echo json_encode($data);
    }	

	/*Get user data */
	public function actionGetUserData(){
		
		$data = [];
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		$username = $postParms['username'];
		$type = $postParms['type'];
		//$postParms['type'] = 'houseSearch';
		//$username ="zhengying@yahoo.com";
		//$username = "zhengy@rogers.com";
		if ( !empty($type)){

			if ( $type == 'houseSearch'){
				$data = $this->getoption($username,'houseSearch');
			} else {  // houseFav,routeFav,recentView
				$data = $this->favlist($username,$type);
			}
		}
	
		/* switch($postParms['type']) {
			case "houseFav":
				$data = $this->favlist($username,'houseFav');
				break;
			case "routeFav":
				$data = $this->favlist($username,'routeFav');
				break;
			case "recentView":
				$data = $this->favlist($username,'recentView');
				break;
			case "houseSearch":
				//$data = 'test';
				$data = $this->getoption($username,'houseSearch');
				break;

			default:
				break;			
		}
		} */

		echo json_encode($data);
		
    }
    public function actioncheckFavData(){
		//$data = 0;
                ini_set("log_errors", 1);
                ini_set("error_log", "/tmp/php-error.log");
                $_POST = (array) json_decode(file_get_contents('php://input'), true);
                $postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
                //$postParms['mls'] = '30533489';
                //$username ="zhengying@yahoo.com";
                if ( !empty($postParms['mls'])){

                $username = $postParms['username'];

                        $data = $this->checkfav($username,$postParms['mls']);

                }

                echo json_encode($data);

    }   


	/*Add user data */
	/* public function actionAddUserData(){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();

		switch($postParms['type']) {
		case "Favorite":
			
			break;
		case "Search":
			break;
		default:
			break;			
		}

    } */

	/*Delete user data */
	public function actionUpdateUserData(){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$db = Yii::app()->db;
	
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		//$postParms['mls'] = 'W3534467';
		//$postParms['mls'] = 'W111';
		//$postParms['action'] = 'r';
		$username = $postParms['username'];
		$action =	$postParms['action'];
		$type =	$postParms['type'];
		$mls = $postParms['mls'];
		if ( $action != 'r'){  // action = r is for favlist reorder. comma list is pass for update
									
			
			//debug
			//$type = 'routeFav';
			//$action =   "c";
			//$username = 'zhengying@yahoo.com';
			//$mls = 'W133';

			
			$sql ='select houseFav,routeFav from h_user_data where username="'.$username.'"';
			$resultsql = $db->createCommand($sql)->queryRow();
			if (!empty($resultsql)){
				$r = $this->favupdate($username,$type,$resultsql[$type],$mls,$action);
			} else {
				$resultsql[$type] = '';
				$r = $this->favupdate($username,$type,$resultsql[$type],$mls,$action);
			}
			
			
		} else { //no mls ,action = r. fav reorder
				
				//$r = $this->favupdate($username,$type,'',$mls,$action);
				$r = $this->updateUserTable($username,$type,$mls);
		}
		echo json_encode($r);
    }
	
	public function actionSaveOptions(){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$db = Yii::app()->db;
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		//$postParms['mls'] = 'W3534467';
		//$postParms['mls'] = 'W111';
		//$postParms['action'] = 'r';
		$username = $postParms['username'];
		$type =	$postParms['type'];
		$data = $postParms['data'];
		$r = $this->updateUserTable($username,$type,$data);
		
		echo json_encode($r);
    }
	
	
	function getoption($username,$type){
		$db = Yii::app()->db;
		$sql ='select '.$type.' from h_user_data where username="'.$username.'"';
		$resultsql = $db->createCommand($sql)->queryRow();
		$r['Data'] = $resultsql[$type];
		return $r;
	}
	
	function favupdate($username,$type,$current,$mls,$action){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		
		$c = (!empty($current))? explode(',',$current): [];
		$pos = array_search($mls, $c);

		if (($action == 'c') && !is_numeric($pos) ){array_push($c,$mls);}
		if ( ($action == 'd') && is_numeric($pos)){ unset($c[$pos]); }//remove MLS
		
		//default for action r. no change to $current 
		$data = implode(",",$c); //convert to comma separated string

		$r = $this->updateUserTable($username,$type,$data);
		return $r;
		
		
	}
	 function updateUserTable($username,$type,$data){
		$db = Yii::app()->db;
		 //update if exist and insert if row doesn't exist
		$sql = 'INSERT IGNORE INTO h_user_data('.$type.',username) values(\''.$data.'\',"'.$username.'") on duplicate KEY UPDATE '.$type.'=\''.$data.'\'';
		$r = $db->createCommand($sql)->execute();
		return $r;
		

	 }
	
	function favlist($username,$type){
		$db = Yii::app()->db;
		$criteria = new CDbCriteria();
		//get list of fav			
		$sql ='select '.$type.' from h_user_data where username="'.$username.'"';
		$resultsql = $db->createCommand($sql)->queryRow();
		$list = explode(',',$resultsql[$type]);
		//get list of house
		$criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,br,addr,longitude,latitude,area,bath_tot';
		$criteria->addInCondition('ml_num', $list);
		$criteria->with = array('mname','propertyType','city');
		$house = House::model()->findAll($criteria);
		return $this->house2Array($house,0,'house');
					
		
	}
	

     function checkfav($username,$mls){
		$db = Yii::app()->db;
		$sql ='select houseFav from h_user_data where username="'.$username.'" and houseFav like "%'.$mls.'%"';
		$resultsql = $db->createCommand($sql)->queryRow();
		if (!empty($resultsql)){ $result['houseFav']=1; }else {  $result['houseFav']=0;}
		$sql ='select routeFav from h_user_data where username="'.$username.'" and routeFav like "%'.$mls.'%"';
		$resultsql = $db->createCommand($sql)->queryRow();
		if (!empty($resultsql)){ $result['routeFav']=1; }else {  $result['routeFav']=0;};
		
		
		//Insert into recentView
		$sql ='select recentView from h_user_data where username="'.$username.'"';
		$resultsql = $db->createCommand($sql)->queryRow();
		$c = (!empty($resultsql['recentView']))? explode(',',$resultsql['recentView']): [];
		$pos = array_search($mls, $c);
		if (!is_numeric($pos) ){array_push($c,$mls);}
		$data = implode(",",$c); //convert to comma separated string
		$r = $this->updateUserTable($username,'recentView',$data); 
		
		return $result;


        }

	
	function house2Array($house,$count,$type){  //this is used for map and fav list 
		$result['Data']['imgHost'] = "http://m.maplecity.com.cn/";
		$result['Data']['Total'] = $count;
		$result['Data']['Type'] = $type;
		
		foreach ($house as $val) {
			$mapHouseList = array();
			$mapHouseList['Beds'] = $val->br;
			$mapHouseList['Baths'] = $val->bath_tot;
			$mapHouseList['Kitchen'] = $val->num_kit;
			$mapHouseList['GeocodeLat'] = $val->latitude;
			$mapHouseList['GeocodeLng'] = $val->longitude;
			$mapHouseList['Address'] = !empty($val->addr)?$val->addr : "不详";
			$mapHouseList['SaleLease'] = $val->s_r; 
			//$mapHouseList['sqft'] = $val->sqft;
			$mapHouseList['Price'] = $val->lp_dol;
			//$mapHouseList['Id'] = $val->id;
			$mapHouseList['HouseType'] = !empty($val->propertyType->name) ? $val->propertyType->name : '其他';
			$mapHouseList['MunicipalityName'] = !empty($val->mname->municipality_cname)? ($val->mname->municipality_cname):"其他";
			$mapHouseList['CountryName'] = $val->municipality;
			$mapHouseList['Zip'] = $val->zip;
			$mapHouseList['MLS'] = $val->ml_num;
			$mapHouseList['Country'] = $val->city_id;
			$mapHouseList['ProvinceEname'] = $val->county;
			$mapHouseList['ProvinceCname'] = $val->city->name;
			$county = $val->county;
			$county = preg_replace('/\s+/', '', $county);
			$county = str_replace("&","",$county);
			$dir="mlspic/crea/creamid/".$county."/Photo".$val->ml_num."/";
			$dirtn="mlspic/crea/creatn/".$county."/Photo".$val->ml_num."/";
			$num_files = 0;

			if(is_dir($dir)){
				$picfiles =  scandir($dir);
				$num_files = count(scandir($dir))-2;
			}
			//error_log($county.":".$dir);

			if ( $num_files > 0)    {
				$mapHouseList['CoverImg'] = $dir.$picfiles[2];
				$mapHouseList['CoverImgtn'] = $dirtn.$picfiles[2];
				
			}else {
				$mapHouseList['CoverImg'] = 'static/images/zanwu.jpg';
				$mapHouseList['CoverImgtn'] = 'static/images/zanwu.jpg';
			}


			$result['Data']['HouseList'][] = $mapHouseList;


		}
		return $result;
	}
	
	function houseOption($postParms){
		  //根据条件查询地图
            $criteria = new CDbCriteria();
			
			if ($postParms['sr'] == "Lease" )  {
				$criteria->addCondition('s_r = "Lease"');
			} else{
					
				$criteria->addCondition('s_r = "Sale"');
			} 
	

            //卫生间数量 1-5
            if (!empty($postParms['housebaths']) && intval($postParms['housebaths']) > 0) {
                $criteria->addCondition("t.bath_tot >= :bath_tot");
                $criteria->params += array(':bath_tot' => intval($postParms['housebaths']));
				
            }

            //土地面积 Multiple Selection Array
            if (!empty($postParms['houseground'])) {
  				
				
				$minArea = intval($postParms['houseground']['lower']) ;
				$maxArea = intval($postParms['houseground']['upper']) ;
				if ($minArea >0) {
					$criteria->addCondition('land_area >='.$minArea);
				}
				if ( $maxArea < 43560){
					$criteria->addCondition('land_area <='.$maxArea);
				}
				
            }
			
			//挂牌时间

			if($postParms['housedate'] > 0 ){
				$criteria->addCondition('DATE_SUB(CURDATE(), INTERVAL '.$postParms['housedate'].' DAY) <= date(pix_updt)');
			}
		
			//House Area - Multiple Selection Array
			if (!empty($postParms['housearea'])) {
					
				$minArea = intval($postParms['housearea']['lower']) ;
				$maxArea = intval($postParms['housearea']['upper']) ;
				if ($minArea >0) {
					$criteria->addCondition('house_area >='.$minArea);
				}
				if ( $maxArea < 4000){
					$criteria->addCondition('house_area <='.$maxArea);
				}
			}
			
			//价格区间 -  Multiple Selection . Array is returned
			if (!empty($postParms['houseprice'])) {
				
		
				$minPrice = intval($postParms['houseprice']['lower'])*10000 ;
				$maxPrice = intval($postParms['houseprice']['upper'])*10000 ;
				if ($minPrice >0) {
					$criteria->addCondition('lp_dol >='.$minPrice);
				}
				if ( $maxPrice < 6000000){
					$criteria->addCondition('lp_dol <='.$maxPrice);
				}
			}

	 
			//Bedroom
			if (!empty($postParms['houseroom']) && intval($postParms['houseroom']) > 0) {
				$houseroom = intval($postParms['houseroom']);
				$criteria->addCondition("t.br >= :br");
				$criteria->params += array(':br' => $houseroom);
			}

			//房屋类型
			//if (!empty($postParms['housetype']) && intval($postParms['housetype']) > 0) {
			if (!empty($postParms['housetype'])) {
				$typeInString = implode(",", $postParms['housetype']);
				
				//$criteria->addCondition("propertyType_id =".$postParms['housetype']);
				$criteria->addCondition("propertyType_id in (".$typeInString.")");
				
			}

  
            //建造年份
           if (!empty($postParms['houseyear'])) {
                //$year = explode(',', $postParms['houseyear']);
				$year=$postParms['houseyear'];
                //$minYear = intval($year[0]);
               // $maxYear = intval($year[1]);
				$criteria->addCondition("t.yr_built = :year");
				$criteria->params += array(':year' => $year);
    
            }
		
			//房屋类型
			if (!empty($postParms['city']) ) {
				$criteria->addCondition("t.municipality ='".$_POST['city']."'");
			
			}
	

			if (!empty($postParms['bounds'])) {
                $latlon = explode(',', $postParms['bounds']);
                $minLat = floatval($latlon[0]);
                $maxLat = floatval($latlon[2]);
                $minLon = floatval($latlon[1]);
                $maxLon = floatval($latlon[3]);
                $criteria->addCondition("t.latitude <= :maxLat");
                $criteria->params += array(':maxLat' => $maxLat);
                $criteria->addCondition("t.latitude >= :minLat");
                $criteria->params += array(':minLat' => $minLat);
                $criteria->addCondition("t.longitude <= :maxLon");
                $criteria->params += array(':maxLon' => $maxLon);
                $criteria->addCondition("t.longitude >= :minLon");
                $criteria->params += array(':minLon' => $minLon);
		


            } 
					
			
			//$criteria->order = 'pix_updt DESC,city_id ASC,lp_dol DESC';
			return $criteria;
        
	}
}

