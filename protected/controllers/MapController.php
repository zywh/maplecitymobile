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
		

        $result = array();
        if (empty($_POST)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } else {
            $result['IsError'] = false;

            //根据条件查询地图
            $criteria = new CDbCriteria();
            $criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,depth,front_ft,br,addr,house_image,longitude,latitude,area,bath_tot';

			//Search By Lease or Sale
            if ($_POST['type'] == "rent" )  {
				$criteria->addCondition('s_r = "Lease"');
				$ss = " AND s_r = 'Lease' ";
            }
			else{
				$criteria->addCondition('s_r = "Sale"');
				$ss = " AND s_r = 'Sale' ";
            }
            /* 排序
             * <span data-value="1">价格：从高到低</span>
              <span data-value="2">价格：从低到高</span>
              <span data-value="3">日期：从后到前</span>
              <span data-value="4">日期：从前到后</span>
             */

            if ($_POST['orderby'] == 1) {
                $criteria->order = 't.lp_dol desc';
            } else if ($_POST['orderby'] == 2) {
                $criteria->order = 't.lp_dol asc';
            } else if ($_POST['orderby'] == 3) {
                $criteria->order = 't.construction_year asc';
            } else if ($_POST['orderby'] == 4) {
                $criteria->order = 't.construction_year desc';
            } else {
                $criteria->order = 't.id desc';
            }

            //city_id - province
           //if (!empty($_POST['province']) && trim($_POST['country']) != 'undefined') {
			//
           //    $criteria->addCondition("t.city_id = :city_id");
           //    $criteria->params += array(':city_id' => intval($_POST['province']));
           //}
            
            //district_id
           // if (!empty($_POST['district']) && trim($_POST['district']) != 'undefined') {
           //     $criteria->addCondition("t.district_id = :district_id");
           //     $criteria->params += array(':district_id' => intval($_POST['district']));
           // }

            //卫生间数量 1-5
            if (!empty($_POST['housebaths']) && intval($_POST['housebaths']) > 0) {
                $criteria->addCondition("t.bath_tot = :bath_tot");
                $criteria->params += array(':bath_tot' => intval($_POST['housebaths']));
				$ss = $ss." AND bath_tot = ".$_POST['housebaths'];
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

            //价格区间
            if (!empty($_POST['houseprice'])) {
                $price = explode(',', $_POST['houseprice']);
                $minPrice = intval($price[0]) *10000;
                $maxPrice = intval($price[1]) *10000;
                if ($maxPrice != 0 || $minPrice != 0) {
                    if ($maxPrice > $minPrice) {
                        $criteria->addCondition("t.lp_dol <= :maxPrice");
                        $criteria->params += array(':maxPrice' => $maxPrice);
						$ss = $ss." AND lp_dol <= ".$maxPrice;
                    }
                    $criteria->addCondition("t.lp_dol >= :minPrice");
                    $criteria->params += array(':minPrice' => $minPrice);
					$ss = $ss." AND lp_dol >= ".$minPrice;
                }
            }

            //房型
            if (!empty($_POST['houseroom']) && intval($_POST['houseroom']) > 0) {
                $houseroom = intval($_POST['houseroom']);
                if ($houseroom == '6') {
                    $criteria->addCondition("t.br >= :br");
                } else if ($houseroom > 0) {
                    $criteria->addCondition("t.br = :br");
                }
                $criteria->params += array(':br' => $houseroom);
            }

            //房屋类型
            if (!empty($_POST['housetype']) && intval($_POST['housetype']) != 0) {
 				$criteria->addSearchCondition('propertyType_id',$_POST['housetype']);
				$ss = $ss." AND propertyType_id = ".$_POST['housetype'];
            }

            //根据地区名字搜索
           //if (!empty($_POST['city']) && trim($_POST['city']) != '州名/市名(中英)') {
           //    $city = trim($_POST['city']);
           //    $criteria->addCondition("t.addr like '%" . $city . "%' OR b.pinyin like '%" . $city . "%' OR b.englishName like '%" . $city . "%'");
           //}
           //
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

			$criteria->with = array('mname','propertyType','city');

			//End of Condition

			//Check number of house group by city
			

			$sql = "
			SELECT count(*) c, h.municipality m , municipality_cname cn,	m.lat lat,m.lng lng
			FROM h_house h,h_mname m
			WHERE latitude <=".$maxLat."
			AND latitude >=".$minLat."
			AND longitude <=".$maxLon."
			AND longitude >=".$minLon.$ss."
			
			AND h.municipality = m.municipality
			GROUP BY m
			ORDER BY c DESC	";
						
			$db = Yii::app()->db;
			$groupresult = $db->createCommand($sql)->query();
			$citytotal = 0;
			$citylimit = 20; //control how many city marker displayed
			$result['Data']['AreaHouseCount'] = array();
			$result['Data']['MapHouseList'] = array();
			
			if(count($groupresult) > 0){
			$cityint = 0;		
				foreach($groupresult as $citycount){
					$result['Message'] = '成功';
					$count = $citycount["c"];
					$city = $citycount["m"];
					$lat = $citycount["lat"];
					$lng = $citycount["lng"];
					++$cityint;
					$citytotal+=$count;
					
					if ( $lat > 20 && $cityint < $citylimit){
					
						//error_log($city.":".$count.":".$cityint);
						$result['Data']['AreaHouseCount'][$city]['Count'] ['NameCn'] = !empty($citycount["cn"])? ($citycount["cn"]):"其他";
						$result['Data']['AreaHouseCount'][$city]['Count'] ['HouseCount'] = $count;
						$result['Data']['AreaHouseCount'][$city]['Count'] ['GeocodeLat'] = $lat;
						$result['Data']['AreaHouseCount'][$city]['Count'] ['GeocodeLng'] = $lng;
						//$result['Data']['AreaHouseCount'][$val->municipality]['Count'] ['MaxZoom'] = 2;
						//$result['Data']['AreaHouseCount'][$val->municipality]['List'][] = $mapHouseList;
						
					}
					$result['Data']['Total'] = $citytotal;
				}
				//error_log("Total:".$citytotal);
			}
			//End of check
            
			$maxmarkers = 2000;
			if ($citytotal < $maxmarkers ){
				
				$house = House::model()->findAll($criteria);
				$totalcount = count($house);
				$result['Data']['Total'] = $totalcount;
			    $result['Message'] = '成功';

                foreach ($house as $val) {
                    $mapHouseList = array();
                    $mapHouseList['Beds'] = $val->br;
                    $mapHouseList['Baths'] = $val->bath_tot;
                    $mapHouseList['Kitchen'] = $val->num_kit;
                    $mapHouseList['GeocodeLat'] = $val->latitude;
                    $mapHouseList['GeocodeLng'] = $val->longitude;
                    $mapHouseList['Address'] = $val->addr; 
					$mapHouseList['SaleLease'] = $val->s_r; 
                    $mapHouseList['sqft'] = $val->sqft;
                    $mapHouseList['Price'] = $val->lp_dol/10000;
                    $mapHouseList['Id'] = $val->id;
                    $mapHouseList['HouseType'] = !empty($val->propertyType->name) ? $val->propertyType->name : '其他';
					$mapHouseList['MunicipalityName'] = !empty($val->mname->municipality_cname)? ($val->mname->municipality_cname):"其他";
                    $mapHouseList['CountryName'] = $val->municipality;
                    $mapHouseList['Zip'] = $val->zip;
                    $mapHouseList['Country'] = $val->city_id;
                    $mapHouseList['ProvinceEname'] = $val->county;
                    $mapHouseList['ProvinceCname'] = $val->city->name;
                    //$area2Name = District::model()->findByPk($val->district_id);
                    $mapHouseList['Area2Name'] = !empty($area2Name) ? $area2Name->name : '';
                    //Get image from county
					
					$county = $val->county;
					$county = preg_replace('/\s+/', '', $county);
					$county = str_replace("&","",$county);
					$dir="mlspic/crea/".$county."/Photo".$val->ml_num."/";
					$num_files = 0;

					if(is_dir($dir)){
                        $picfiles =  scandir($dir);
                        $num_files = count(scandir($dir))-2;
					}
					//error_log($county.":".$dir);

					if ( $num_files > 1)    {
						$mapHouseList['CoverImg'] = $dir.$picfiles[2];
					}else {
						$mapHouseList['CoverImg'] = 'uploads/201501/29cd77e5f187df554a1ff9facdc190e2.jpg';
					}


					//$mapHouseList['CoverImg'] = !empty($val->house_image) ? $val->house_image : 'uploads/201501/29cd77e5f187df554a1ff9facdc190e2.jpg';
                    $mapHouseList['BuildYear'] = $val->yr_built;
                    $result['Data']['MapHouseList'][] = $mapHouseList;


                }
 
            
			}


		
		}
		//error_log(json_encode($result))	;
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
