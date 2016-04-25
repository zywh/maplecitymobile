<?php

/**
 * Map控制器
 *
 * @author       yang jing
 *  201512 Add relation table for city name
 */

class MapController extends XFrontBase {

    /**
     * 首页
     */
    public function actionIndex() {
        $housetype = PropertyType::model()->findAll();
        $this->render('index', array('houseType' => $housetype));
    }

    public function actionIndexsb() {
        $housetype = PropertyType::model()->findAll();
        $this->render('indexsb', array('houseType' => $housetype));
    }



    public function actionGetMapHouse() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		
		
		$maxmarkers = 2000;  //City count if count(house) is over
		$maxhouse = 50; //Grid count if count(house) is over
		$maxcitymarkers = 20;
        $result = array();
		$result['Data']['AreaHouseCount'] = array();
		$result['Data']['MapHouseList'] = array();
		
        if (empty($_POST)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } else {
            $result['IsError'] = false;

            //根据条件查询地图
            $criteria = new CDbCriteria();
            $criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,depth,front_ft,br,addr,house_image,longitude,latitude,area,bath_tot';

			if ($_POST['sr'] == "Lease" )  {
				$criteria->addCondition('s_r = "Lease"');
			
			} elseif ($_POST['sr'] == "Sale"){
				$criteria->addCondition('s_r = "Sale"');
				
			} else {
				error_log("S_R is default");
			}
 

            //卫生间数量 1-5
            if (!empty($_POST['housebaths']) && intval($_POST['housebaths']) > 0) {
                $criteria->addCondition("t.bath_tot = :bath_tot");
                $criteria->params += array(':bath_tot' => intval($_POST['housebaths']));
				
            }

            //土地面积
            if (!empty($_POST['houseground'])) {
                $ground = explode(',', $_POST['houseground']);
                $minGround = intval($ground[0]);
                $maxGround = intval($ground[1]);
                if ($minGround != 0 || $maxGround != 0) {
                    if ($maxGround > $minGround) {
                        $criteria->addCondition("t.depth*t.front_ft <= :maxGround");
                        $criteria->params += array(':maxGround' => $maxGround);
                    }
                    $criteria->addCondition("t.depth*t.front_ft >= :minGround");
                    $criteria->params += array(':minGround' => $minGround);
                }
            }
			//House Area
			if (!empty($_POST['housearea'])) {
				$housearea = explode('-', $_POST['housearea']);
				$minArea = intval($housearea[0]) ;
				$maxArea = intval($housearea[1]) ;
				//error_log ("MinPrice:".$minPrice);
				if ($maxArea != 0 || $minArea != 0) {
					if ($maxArea > $minArea) {
						$criteria->addCondition('house_area <'.$maxArea);
					}
					$criteria->addCondition('house_area >='.$minArea);
				}
			}			
			//价格区间
			if (!empty($_POST['houseprice'])) {
				$price = explode('-', $_POST['houseprice']);
				$minPrice = intval($price[0]) *10000;
				$maxPrice = intval($price[1]) *10000;
				error_log ("MinPrice:".$minPrice);
				if ($maxPrice != 0 || $minPrice != 0) {
					if ($maxPrice > $minPrice) {
						$criteria->addCondition('lp_dol <'.$maxPrice);
					}
				
					$criteria->addCondition('lp_dol >='.$minPrice);
				}
			}

	 
			//Bedroom
			if (!empty($_POST['houseroom']) && intval($_POST['houseroom']) > 0) {
				$houseroom = intval($_POST['houseroom']);
				$criteria->addCondition("t.br > :br");
				$criteria->params += array(':br' => $houseroom);
			}

			//房屋类型
			if (!empty($_POST['housetype']) && intval($_POST['housetype']) > 0) {
				$criteria->addCondition("propertyType_id =".$_POST['housetype']);
				
			}

  
            //建造年份
           if (!empty($_POST['houseyear'])) {
                //$year = explode(',', $_POST['houseyear']);
				$year=$_POST['houseyear'];
                //$minYear = intval($year[0]);
               // $maxYear = intval($year[1]);
				$criteria->addCondition("t.yr_built = :year");
				$criteria->params += array(':year' => $year);
    
            }
			//lat and long selection
            if (!empty($_POST['bounds'])) {
                $latlon = explode(',', $_POST['bounds']);
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

			

			//End of Condition

			
			$count = House::model()->count($criteria);
			$result['Data']['Total'] = $count;
						
			//Generate Data for City Count Marker Start
			if ( $count >= $maxmarkers) {
				error_log("Generate City View Count");
				$result['Data']['Type'] = "city";
				$groupcriteria = $criteria;
				$groupcriteria->select = 't.municipality as municipality,count(id) as id';
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
						$result['Data']['AreaHouseCount'][$city]['GeocodeLat'] = $lat;
						$result['Data']['AreaHouseCount'][$city]['GeocodeLng'] = $lng;
					}
		
				}
			
			}
			
			
			//Generate Data for Grid Counter Marker Start
			if (( $count < $maxmarkers) && ($count >= $maxhouse) ){
				
				$result['Data']['Type'] = "grid";
				$gridx =  ( $_POST['gridx'])? ( $_POST['gridx']): 5;
				$gridy =  ( $_POST['gridy'])? ( $_POST['gridy']): 5;
				
				$gridcriteria = $criteria;
				$gridcriteria->select = 'longitude,latitude';
				$location = House::model()->findAll($criteria);
				$result['Message'] = '成功';
				//$tilex = (($maxLat - $minLat ) / $gridx) * 100000;
				//$tiley = (($maxLon - $minLon ) / $gridy) * 100000;
				$tilex = (($maxLat - $minLat ) / $gridx) ;
				$tiley = (($maxLon - $minLon ) / $gridy) ;
				//Generate grid center Lat/Lng
				for ( $x=1; $x <= $gridx ; $x++){
					for ( $y=1; $y <= $gridy ; $y++){
						$gridCenterlat = $minLat + ($tilex/2) + ($x -1)*$tilex ;
						$gridCenterlng = $minLon + ($tiley/2) + ($y -1)*$tiley ;
						$result['Data']['AreaHouseCount']["G".$x.$y]['GeocodeLat'] = $gridCenterlat;
						$result['Data']['AreaHouseCount']["G".$x.$y]['GeocodeLng'] = $gridCenterlng;
						
					}
				}
				//Get count of house in each tile
				foreach ($location as $val) {
					//$gridlat = ceil((($val->latitude - $minLat ) * 100000 / $tilex));
					//$gridlng = ceil((($val->longitude - $minLon) * 100000 / $tiley));
					$gridlat = ceil((($val->latitude - $minLat ) / $tilex));
					$gridlng = ceil((($val->longitude - $minLon) / $tiley));
					
					
					$result['Data']['AreaHouseCount']["G".$gridlat.$gridlng]['NameCn'] = "G".$gridlat.$gridlng;
					$result['Data']['AreaHouseCount']["G".$gridlat.$gridlng]['HouseCount']++; 
					
				}
				
				
			}
			
			
			
			//Generate Data for  House Marker Start
			if ($count < $maxhouse ){
				$result['Data']['Type'] = "house";
				$criteria->with = array('mname','propertyType','city');
				$criteria->order = "t.latitude,t.longitude";
				$house = House::model()->findAll($criteria);
				$result['Message'] = '成功';

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
                    $mapHouseList['Price'] = $val->lp_dol/10000;
                    //$mapHouseList['Id'] = $val->id;
                    $mapHouseList['HouseType'] = !empty($val->propertyType->name) ? $val->propertyType->name : '其他';
					$mapHouseList['MunicipalityName'] = !empty($val->mname->municipality_cname)? ($val->mname->municipality_cname):"其他";
                    $mapHouseList['CountryName'] = $val->municipality;
                    $mapHouseList['Zip'] = $val->zip;
                    $mapHouseList['MLS'] = $val->ml_num;
                    $mapHouseList['Country'] = $val->city_id;
                    $mapHouseList['ProvinceEname'] = $val->county;
                    $mapHouseList['ProvinceCname'] = $val->city->name;
                    //$mapHouseList['Area2Name'] = !empty($area2Name) ? $area2Name->name : '';
                    //Get image from county
					//error_log("Lat:".$val->latitude."Lng:".$val->longitude);
					
					$county = $val->county;
					$county = preg_replace('/\s+/', '', $county);
					$county = str_replace("&","",$county);
					$dir="mlspic/crea/".$county."/Photo".$val->ml_num."/";
					$dirtn="mlspic/crea/creatn/".$county."/Photo".$val->ml_num."/";
					$num_files = 0;

					if(is_dir($dir)){
                        $picfiles =  scandir($dir);
                        $num_files = count(scandir($dir))-2;
					}
					//error_log($county.":".$dir);

					if ( $num_files > 1)    {
						$mapHouseList['CoverImg'] = $dir.$picfiles[2];
						$mapHouseList['CoverImgtn'] = $dirtn.$picfiles[2];
						
					}else {
						$mapHouseList['CoverImg'] = 'static/images/zanwu.jpg';
						$mapHouseList['CoverImgtn'] = 'static/images/zanwu.jpg';
					}


					
                    //$mapHouseList['BuildYear'] = $val->yr_built;
                    $result['Data']['MapHouseList'][] = $mapHouseList;


                }
 
            
			}
			

		
		}
		
		echo json_encode($result);
    }
	public function actionGetCityLocation(){
		$db = Yii::app()->db;
		$city = $_POST['city'];
		//$city = "Toronto";
		$result = [];
		//$chinese = preg_match("/\p{Han}+/u", $term);

		$sql = "SELECT lat,lng	FROM h_mname  WHERE municipality = '".$city."';";			
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){

			$result['Lat'] = $row["lat"]; 
			$result['Lng'] = $row["lng"]; 
			
		}
		
		 echo json_encode($result);
    
	//Function END  
    }
	public function actionGetProvinceLocation(){
		$db = Yii::app()->db;
		$pid = $_POST['province'];
		//$city = "Toronto";
		$result = [];
	
		$sql = "SELECT lat,lnt	FROM h_city  WHERE id = '".$pid."';";			
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){

			$result['Lat'] = $row["lat"]; 
			$result['Lng'] = $row["lnt"]; 
			
		}
		
		 echo json_encode($result);
    
	//Function END  
    }
	
//END
}
