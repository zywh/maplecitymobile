<?php

/**
 * Map控制器
 *
 * @author       yang jing
 *  201512 Add relation table for city name
 */

class MapController extends XFrontBase {
	
	
    //private $imgHost ="http://m.maplecity.com.cn/";
	private $imgHost ="http://ca.maplecity.com.cn/";
	
	private $TREB_IMG_HOST = "http://1546690846.rsc.cdn77.org/treb/";//CDN Treb Large Image URL
	private $TREB_TN_HOST = "http://1546690846.rsc.cdn77.org/trebtn/"; //CDN Treb Thumbnail
	private $TREB_MID_HOST = "http://1546690846.rsc.cdn77.org/trebmid/";//CDN Treb Medium Image URL
	private $CREA_IMG_HOST = "http://ca.maplecity.com.cn/mlspic/crea/";//CDN CREA Large Image URL
	private $CREA_TN_HOST = "http://ca.maplecity.com.cn/mlspic/crea/creamtn/";//CDN CREA Thumbnail
	private $CREA_MID_HOST = "http://ca.maplecity.com.cn/mlspic/crea/creamid/"; //CDN CREA Medium Image 
	
    private $MAPLEAPP_SPA_SECRET = "Wg1qczn2IKXHEfzOCtqFbFCwKhu-kkqiAKlBRx_7VotguYFnKOWZMJEuDVQMXVnG";
    private $MAPLEAPP_SPA_AUD = ['9fNpEj70wvf86dv5DeXPijTnkLVX5QZi'];
    private $PROFILE_FAVLIST_MAX = 20;
    private $PROFILE_CENTER_MAX = 10;
	private $STR_MEMBER_ONLY = '登录用户可见';
	private $IMG_ZANWU = 'static/images/zanwu.jpg';
	private $IMG_MEMBER = 'static/images/memberonly.jpg';
	

    /**
     * 首页
     */
    public function actionIndex() {
        $housetype = PropertyType::model()->findAll();
        $this->render('index', array('houseType' => $housetype));
    }
	
	public function actionSchool() {
        
        $this->render('school');
    }

	public function actionSchoolHeat() {
        
        $this->render('schoolheat');
    }
	public function actionHouseHeat() {
        
        $this->render('househeat');
    }	

	
    public function actionGetHouseheatmap() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		
		
		$maxmarkers = 4000;  //City count if count(house) is over
		$maxhouse = 4000; //Grid count if count(house) is over

        $result = array();
		$result['Data']['MapHouseList'] = array();
		
        if (empty($_POST)) {
            $result['IsError'] = true;
            $result['Message'] = '数据接收失败';
        } else {
            $result['IsError'] = false;

            //根据条件查询地图
            $criteria = new CDbCriteria();
			
			//VOW limits
			$criteria->addCondition('src != "VOW"');
			
			$criteria->addCondition('s_r = "Sale"');
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
			$result['Total'] = $count;
									
	
			//Generate Data for  House Marker Start

			//if ($count < $maxhouse ) {
				$result['Type'] = "house";
				//$criteria->select = 'log2(avg(lp_dol)) as lp_dol,round(longitude,3) as longitude,round(latitude,3) as latitude';
				$criteria->select = 'avg(lp_dol)/500000 as lp_dol,round(longitude,2) as longitude,round(latitude,2) as latitude';
				$criteria->group = '2,3';
				$house = House::model()->findAll($criteria);
				$result['Message'] = '成功';

                foreach ($house as $val) {
                    $mapHouseList = array();
                    $mapHouseList['Lat'] = $val->latitude;
                    $mapHouseList['Lng'] = $val->longitude;
                    $mapHouseList['Price'] = $val->lp_dol;
                    $result['MapHouseList'][] = $mapHouseList;


                }
 
            
			
			

		
		}
		
		echo json_encode($result);
    }
	
	
    public function actionIndexsb() {
        $housetype = PropertyType::model()->findAll();
        $this->render('indexsb', array('houseType' => $housetype));
    }

	
    public function actionGetSchoolList() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		
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
			
			if($_POST['type'] == 's' ) {
				$criteria->addCondition('type =1');
			} 
			
			if($_POST['type'] == 'e' ) {
				$criteria->addCondition('type =0');
			} 
			
			$chinese = preg_match("/\p{Han}+/u", $_POST['xingzhi']);
			//XingZhi
			if(!empty($_POST['xingzhi']) && !($chinese)) {
				$criteria->addCondition("xingzhi like '".$_POST['xingzhi']."%'");
			}
			
			//Pingfen
			if(!empty($_POST['pingfen']) && intval($_POST['pingfen']) > 0) {
				$criteria->addCondition("pingfen >='".$_POST['pingfen']."'");
			} 
			
			//Rank
			if(!empty($_POST['rank'])&& intval($_POST['rank']) > 0) {
				//$criteria->order = "paiming ASC";
				$criteria->addCondition("paiming <='".$_POST['rank']."'");
						
			} 		
			
			//lat and long selection
            if (!empty($_POST['bounds'])) {
                $latlon = explode(',', $_POST['bounds']);
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
				$gridx =  ( $_POST['gridx'])? ( $_POST['gridx']): 5;
				$gridy =  ( $_POST['gridy'])? ( $_POST['gridy']): 5;

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
	

    public function actionGetMapHouse() {
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		
		
		$maxmarkers = 2000;  //City count if count(house) is over
		$maxhouse = 40; //Grid count if count(house) is over
		$maxcitymarkers = 20;
		$minGrid = 5; //Display house if gridcount is lower than mindGrid
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
			//VOW limits
			$criteria->addCondition('src != "VOW"');
			//$gridcriteria = new CDbCriteria();
            

			if ($_POST['sr'] == "Lease" )  {
				$criteria->addCondition('s_r = "Lease"');
			
			//} elseif ($_POST['sr'] == "Sale"){
			} else{
					
				$criteria->addCondition('s_r = "Sale"');
			} 
			/*
			else {
				error_log("S_R is default");
			}*/
 

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

			error_log("minLon:".$minLon."maxLon:".$maxLon."minLat:".$minLat."maxLat:".$maxLat);

			//End of Condition

			
			$count = House::model()->count($criteria);
			$result['Data']['Total'] = $count;
						
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
				$gridx =  ( $_POST['gridx'])? ( $_POST['gridx']): 5;
				$gridy =  ( $_POST['gridy'])? ( $_POST['gridy']): 5;
				
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
			//if ($count < $maxhouse ) {
				error_log("Select House:".$count." GridCount:".$gridcount);	
				$result['Data']['Type'] = "house";
				$criteria->select = 'id,ml_num,zip,s_r,county,municipality,lp_dol,num_kit,construction_year,depth,front_ft,br,addr,house_image,longitude,latitude,area,bath_tot';
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
					//error_log("Lat:".$val->latitude."Lng:".$val->longitude."MLS".$val->ml_num);
					
					$county = $val->county;
			
			$pics = $this->getPicture($val->county,$val->ml_num,$val->src,0,$val->pic_num);
			$mapHouseList['CoverImg'] = $this->maskVOW($val->src,$pics['CoverImg'],$this->IMG_MEMBER);
			
			$mapHouseList['CoverImgtn'] = $this->maskVOW($val->src,$pics['CoverImgtn'],$this->IMG_MEMBER);
			$mapHouseList['CdnCoverImg'] = $pics['CdnCoverImg'];
			$mapHouseList['CdnCoverImgtn'] = $pics['CdnCoverImg'];
			$mapHouseList['MemberOnlyImg'] = $this->imgHost.$this->IMG_MEMBER;
		
	
					
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
	
	public function actionGetSchoolAutoComplete(){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$db = Yii::app()->db;
		$term = trim($_GET['term']);
		$city_id='0';
		$limit = 10;
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
			$idArray = array($row["citye"],$row["lat"],$row["lng"]);
			
			$result['id'] = implode("|",$idArray); 
			if ( $chinese ) {
				
				$result['value'] = $row["cityc"].", ".$row["provincec"]; 
				$results[] = $result;
				
			} else {
				$result['value'] = $row["citye"].", ". $row["provincee"]; 
				$results[] = $result;
			}
	
	
		}
			
		//Address Search and Return ML_NUM
		if ($citycount < $limit){
			//start address selection
			$limit = $limit - $citycount;
			$sql = "
			SELECT school,lat,lng,city,province FROM h_school 
			WHERE  school like '%".$term."%' order by paiming ASC
			limit " .$limit;
			$resultsql = $db->createCommand($sql)->query();
			
			foreach($resultsql as $row){
				$idArray = array($row["school"],$row["lat"],$row["lng"]);
			
				$result['id'] = implode("|",$idArray); 
				$result['value'] = $row["school"].", ".$row["city"].", ".$row["province"]; 
				$results[] = $result;
			}
		}
		
		

		 echo json_encode($results);
    
	//Function END  
    }
	
	
	
	
	
	
		function getPicture($county,$ml_num,$src,$fullList,$pic_num){
			
			$county = preg_replace('/\s+/', '', $county);
			$county = str_replace("&","",$county);
			$dir="mlspic/crea/creamid/".$county."/Photo".$ml_num."/";
			$dirtn="mlspic/crea/creatn/".$county."/Photo".$ml_num."/";
			$num_files = 0;
			
			//Return CDN and non-CDN thumbnail and medium picture
			if ( $fullList == 0){
				if (( $pic_num > 0)&&($src !="CREA" )) { //Treb picture meta data is updated after 2016/10/29
				
					$p1 = $this->TREB_MID_HOST."Photo".$ml_num."/"."Photo".$ml_num."-1.jpeg";
					$p2 = $this->CREA_MID_HOST.$county."/Photo".$ml_num."/".$ml_num."-1.jpg";
					$picList['CdnCoverImg'] = ($src != "CREA")? $p1: $p2;
					
					$p3 = $this->TREB_TN_HOST."Photo".$ml_num."/"."Photo".$ml_num."-1.jpeg";
					$p4 = $this->CREA_TN_HOST.$county."/Photo".$ml_num."/".$ml_num."-1.jpg";
					$picList['CdnCoverImgtn'] = ($src != "CREA")? $p3: $p4;
				
				} else {  //fall back to scan dir if num = 0
					if(is_dir($dir)){
						$picfiles =  scandir($dir);
						$num_files = count(scandir($dir))-2;
					}
				

					if ( $num_files > 0)    {
						$picList['CoverImg'] = $dir.$picfiles[2];
						$picList['CoverImgtn'] = $dirtn.$picfiles[2];
						//CDN FULL URL
						$p1 = $this->TREB_MID_HOST."Photo".$ml_num."/"."Photo".$ml_num."-1.jpeg";
						$p2 = $this->CREA_MID_HOST.$county."/Photo".$ml_num."/".$picfiles[2];
						$picList['CdnCoverImg'] = ($src != "CREA")? $p1: $p2;
						
						$p3 = $this->TREB_TN_HOST."Photo".$ml_num."/"."Photo".$ml_num."-1.jpeg";
						$p4 = $this->CREA_TN_HOST.$county."/Photo".$ml_num."/".$picfiles[2];
						$picList['CdnCoverImgtn'] = ($src != "CREA")? $p3: $p4;
					
						
					}else {
						
						//CDN FULL URL
						 $picList['CdnCoverImg'] = $this->imgHost.$this->IMG_ZANWU;
						 $picList['CdnCoverImgtn'] = $this->imgHost.$this->IMG_ZANWU;
					}
					/*
					$picList['CoverImg'] = $this->maskVOW($src,$picList['CoverImg'],$this->IMG_MEMBER);
					$picList['CoverImgtn'] = $this->maskVOW($src,$picList['CoverImgtn'],$this->IMG_MEMBER);
					$picList['CdnCoverImg'] = $this->maskVOW($src,$picList['CdnCoverImg'],$this->imgHost.$this->IMG_MEMBER);
					$picList['CdnCoverImgtn'] = $this->maskVOW($src,$picList['CdnCoverImgtn'],$this->imgHost.$this->IMG_MEMBER);
					*/
				}
			}
			
			//Return CDN and non-CDN full picture list
			if ( $fullList == 1){
				if (( $pic_num > 0)&&($src !="CREA" )) { //Treb picture meta data is updated after 2016/10/29
					for ($x = 1; $x <= $pic_num; $x++) {
						
						$p1 = $this->TREB_IMG_HOST."Photo".$ml_num."/"."Photo".$ml_num."-".$x.".jpeg";
						$p2 = $this->CREA_IMG_HOST.$county."/Photo".$ml_num."/"."Photo".$ml_num."-".$x.".jpg";
						$p3 = "Photo".$ml_num."/"."Photo".$ml_num."-".$x.".jpeg"; 
						$p4 = $county."/Photo".$ml_num."/"."Photo".$ml_num."-".$x.".jpg"; 
						$cdn_photos[] = ($src != "CREA")? $p1: $p2;
						$photos[] = ($src != "CREA")? $p3: $p4; //backward compatible with 0.0.6. No prefix host
					}
				} else {
					$rdir=$county."/Photo".$ml_num."/";
					$dir="mlspic/crea/".$rdir;
					$photos = array();
					$cdn_photos = array();
					if (is_dir($dir)){
						$picfiles =  scandir($dir);
						$num_files = count($picfiles)-2;
						if ( $num_files > 0)    {
							for ($x = 2; $x <= $num_files + 1; $x++) {
								$fileIndex = $x - 1;
								$p1 = $this->TREB_IMG_HOST."Photo".$ml_num."/"."Photo".$ml_num."-".$fileIndex.".jpeg";
								$p2 = $this->CREA_IMG_HOST.$county."/Photo".$ml_num."/".$picfiles[$x];
								$cdn_photos[] = ($src != "CREA")? $p1: $p2;
							
								$photos[] = $rdir.$picfiles[$x];
							}    
						}
					
					}
			
				} 

				if ( count($photos) == 0 ) {
					$photos = array($this->IMG_ZANWU);
					$cdn_photos = array($this->imgHost.$this->IMG_ZANWU);
				}
				
				$picList['photos'] = $photos;
				$picList['cdn_photos'] = $cdn_photos;
						
			}
			
		
			return $picList;
			

	}
	
	
	function maskVOW($src, $unmasked, $masked = ''){
		if ($src != 'VOW') {
			return $unmasked;
		} else if ($this->isValidIdToken()) {  
			return $unmasked;
		} else {
			return $masked;
		}
	}
	
	
//END
}
