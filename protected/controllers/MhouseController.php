<?php
/**
 * 房源控制器
 *
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */
 
class MhouseController extends XFrontBase
{
  
    public function actionIndex() {
 		 $this->render('index');
    }

	public function actionSchool() {
		ini_set("log_errors", 1);
        ini_set("error_log", "/tmp/php-error.log");

        
 		$this->render('school');
		 
    }	
	
    /**
     * 房源详情
     */
	
    public function actionSearchHouse() {
		
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$result = array();
		//error_log($_POST['sr'].$_POST['housetype'].$_POST['pageindex']."br:".$_POST['houseroom']);
		error_log("Price:".$_POST['houseprice']."City:".$_POST['city']);
		

		//根据条件查询地图
		$criteria = new CDbCriteria();
		$criteria->select = 'ml_num,zip,county,s_r,municipality,lp_dol,num_kit,construction_year,depth,front_ft,br,addr,house_image,longitude,latitude,area,bath_tot';


		//Search By Lease or Sale
		
		if ($_POST['sr'] == "Lease" )  {
			$criteria->addCondition('s_r = "Lease"');
			$ss = " AND s_r = 'Lease' ";
		} else{
			$criteria->addCondition('s_r = "Sale"');
			$ss = " AND s_r = 'Sale' ";
		}
		/* 排序
		 * <span data-value="1">价格：从高到低</span>
		  <span data-value="2">价格：从低到高</span>
		  <span data-value="3">日期：从后到前</span>
		  <span data-value="4">日期：从前到后</span>
		 */
		$criteria->order = 'pix_updt DESC,city_id ASC,lp_dol DESC';




		//卫生间数量 1-5
		if (!empty($_POST['housebaths']) && intval($_POST['housebaths']) > 0) {
			$criteria->addCondition("t.bath_tot > :bath_tot");
			$criteria->params += array(':bath_tot' => intval($_POST['housebaths']));
			$ss = $ss." AND bath_tot = ".$_POST['housebaths'];
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

		//房屋类型
		if (!empty($_POST['city']) ) {
			$criteria->addCondition("t.municipality ='".$_POST['city']."'");
		
		}
		#$criteria->order = 'id DESC';
        $criteria->order = 'pix_updt DESC,city_id ASC,lp_dol DESC';
        

		$criteria->with = array('mname','propertyType','city');
		$count = House::model()->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = 10;
		if (!empty($_POST['pageindex'])) {
			$pager->currentPage = $_POST['pageindex'];
		}
		
		$pager->applyLimit($criteria);
		//End of Criteria
		
		//Start assembe house data
		$result['Data']['AreaHouseCount'] = array();
		$result['Data']['MapHouseList'] = array();


		$house = House::model()->findAll($criteria);
		$totalcount = $count;
		$result['Data']['Total'] = $totalcount;
		$result['Message'] = '成功';

		foreach ($house as $val) {
			$mapHouseList = array();
			$mapHouseList['Beds'] = $val->br;
			$mapHouseList['Baths'] = $val->bath_tot;
			$mapHouseList['Kitchen'] = $val->num_kit;
			$mapHouseList['GeocodeLat'] = $val->latitude;
			$mapHouseList['GeocodeLng'] = $val->longitude;
			$mapHouseList['CityLat'] = $val->mname->lat;
			$mapHouseList['CityLng'] = $val->mname->lng;
			$mapHouseList['Address'] = $val->addr; 
			$mapHouseList['sqft'] = $val->sqft;
			$mapHouseList['Price'] = $val->lp_dol/10000;
			$mapHouseList['Id'] = $val->id;
			$mapHouseList['HouseType'] = !empty($val->propertyType->name) ? $val->propertyType->name : '其他';
			$mapHouseList['MunicipalityName'] = !empty($val->mname->municipality_cname)? ($val->mname->municipality_cname):"其他";
			$mapHouseList['CountryName'] = $val->municipality;
			$mapHouseList['Zip'] = $val->zip;
			$mapHouseList['Sr'] = $val->s_r;
			$mapHouseList['Country'] = $val->city_id;
			$mapHouseList['MlsNumber'] = $val->ml_num;
			$mapHouseList['ProvinceEname'] = $val->county;
			$mapHouseList['ProvinceCname'] = $val->city->name;
			
			
			//Get image from county
			
			$county = $val->county;
			$county = preg_replace('/\s+/', '', $county);
			$county = str_replace("&","",$county);
			$dir="mlspic/crea/creamid/".$county."/Photo".$val->ml_num."/";
			
			$num_files = 0;

			if(is_dir($dir)){
				$picfiles =  scandir($dir);
				$num_files = count(scandir($dir))-2;
			}
			

			if ( $num_files > 0)    {
				$mapHouseList['CoverImg'] = $dir.$picfiles[2];
			}else {
				$mapHouseList['CoverImg'] = 'static/images/zanwu.jpg';
			}


			$mapHouseList['BuildYear'] = $val->yr_built;
			$result['Data']['MapHouseList'][] = $mapHouseList;

		}
		//error_log(json_encode($result))	;
		echo json_encode($result);
    }
	 
    public function actionView($id){
      	ini_set("log_errors", 1);
        ini_set("error_log", "/tmp/php-error.log");



        $cookies = Yii::app()->request->getCookies();
 
		$criteria = new CDbCriteria();
		//$criteria->addCondition('t.id="'.$id.'"');
		$criteria->addCondition('t.ml_num="'.$id.'"');
		$criteria->with = array('mname','propertyType');
		
        //$house = House::model()->find('id=:id',array(':id'=>$id));
		$house = House::model()->find($criteria);
 		//error_log($house->pool);

        $layouts = Layout::model()->findAll('house_id=:house_id',array(':house_id'=>$id));
        $matches = Match::model()->findAll();
		
		//Generate cookie for viewed house
	    if(!empty($cookies['fzd_house'])){
            $house_ids = explode(',', $cookies['fzd_house']->value);
            array_push($house_ids, $house->ml_num);
            $house_ids = array_unique($house_ids);
			$arr = array_slice($house_ids, -10); //chop to last 10 items
            $cookie_str = implode(',', $arr);
			
            $cookie = new CHttpCookie('fzd_house',$cookie_str);
            $cookie->expire = time() + 60 * 60 * 24 * 30;  //有限期30天
            Yii::app()->request->cookies['fzd_house'] = $cookie;
        }else{
            $cookie = new CHttpCookie('fzd_house',$house->ml_num);
            $cookie->expire = time() + 60 * 60 * 24 * 30;  //有限期30天
            Yii::app()->request->cookies['fzd_house'] = $cookie;
        }

        $collection_list = array();
        if($this->_account['userId']){
            $collect_model = Collect::model()->find('user_id=:user_id', array(':user_id'=>$this->_account['userId']));
            if(!empty($collect_model)){
                $collection_list = explode(',', $collect_model->collection);
            }
        }

//附件房源
        $criteria=new CDbCriteria;
        $criteria->select='id,addr,lp_dol,house_image';
        $criteria->condition='zip=:zip AND id<>:id';
        $criteria->params=array(':zip'=>$house->zip, ':id'=>$id);
        $criteria->order='id DESC';
        $nearby_houses=House::model()->findAll($criteria);

//浏览记录
        $cookies = Yii::app()->request->getCookies();
        $house_ids = explode(',', $cookies['addr']->value);
        $criteria=new CDbCriteria;
        $criteria->select='id,addr,lp_dol,house_image';
        $criteria->addInCondition('id', $house_ids);
        $view_history=House::model()->findAll($criteria);

        $exchangeRate = 0;
        $exchangeRateList = ExchangeRate::model()->findAll();
        if(!empty($exchangeRateList)){
            $exchangeRate = $exchangeRateList[0]->rate;
        }

        $data = array(
            'house'           => $house,
            'layouts'         => $layouts,
            'matches'         => $matches,
            'collection_list' => $collection_list,
            'nearby_houses'   => $nearby_houses,
            'view_history'    => $view_history,
            'exchangeRate'    => $exchangeRate
        );
        $this->render('view', $data);
    }

	public function actionGetCityList(){
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$db = Yii::app()->db;
		//$result = array();
		$term = trim($_GET['term']);
		$city_id='0';
		$limit = 10;
		$chinese = preg_match("/\p{Han}+/u", $term);
		//error_log("Search:".$term);
		//
		
		if ( is_numeric($term) || preg_match("/^[a-zA-Z]\d+/",$term) ) {
			//MLS search
			$sql = "
			SELECT ml_num FROM h_house 
			WHERE  ml_num like '".$term."%' 
			ORDER by city_id
			limit " .$limit;
			$resultsql = $db->createCommand($sql)->query();
			foreach($resultsql as $row){

				$result['id'] = $row["ml_num"]; 
				$result['value'] = $row["ml_num"]; 
				$results[] = $result;
				
			}
			
		} else{
		//Generate Count by municipality
			if ( $city_id == '0' ) {
				
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
				
			} else{  //if province is NOT 0
				
				if ($chinese) { //if province = 0 and chinese search			
				
					$sql = "
					SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
					FROM h_mname m, h_city c 
					WHERE m.province = c.englishname 
					AND  c.id=".$city_id." 
					AND m.municipality_cname like '".$term."%'  
					AND  m.count > 1 order by count desc limit ". $limit;
					
				} else {
					
					$sql = "
					SELECT m.lat lat,m.lng lng,m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
					FROM h_mname m, h_city c 
					WHERE m.province = c.englishname 
					AND  c.id=".$city_id." 
					AND m.municipality like '".$term."%' 
					AND  m.count > 1 order by count desc ". $limit;
					
				}
				
				
							
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
				SELECT ml_num,addr,municipality,county,latitude,longitude FROM h_house  
				WHERE  addr like '%".$term."%' order by city_id
				limit " .$limit;
				$resultsql = $db->createCommand($sql)->query();
				
				foreach($resultsql as $row){

					$result['id'] = $row["ml_num"]; 
					$result['value'] = $row["addr"].", ".$row["municipality"].", ".$row["county"]; 
					$results[] = $result;
				}
			}
		}
		

		 echo json_encode($results);
    
	//Function END  
    }
	
	
	public function actionGetSchoolList(){
		ini_set("log_errors", 1);
        ini_set("error_log", "/tmp/php-error.log");
	
		$schoolList = array();
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$url = 'https://www.app.edu.gov.on.ca/eng/sift/searchElementaryXLS.asp';
		// header
		$userAgent = array(
		'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0', // FF 22
		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36', // Chrome 27
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)', // IE 9
		'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // IE 8
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // IE 7
		'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Maxthon/4.1.0.4000 Chrome/26.0.1410.43 Safari/537.1', // Maxthon 4
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E)', // 2345 2
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; QQBrowser/7.3.11251.400)', // QQ 7
		'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; .NET4.0C; .NET4.0E; SE 2.X MetaSr 1.0)', // Sougo 4
		'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0) LBBROWSER', //  liebao 4
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0");
		curl_setopt($ch, CURLOPT_REFERER, "https://www.app.edu.gov.on.ca/eng/sift/PCsearchSec.asp");
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent[rand(0, count($userAgent) - 1)]);
		// 伪造IP头
		$ip = rand(27, 64) . "." . rand(100, 200) . "." . rand(2, 200) . "." . rand(2, 200);
		$headerIp = array("X-FORWARDED-FOR:{$ip}", "CLIENT-IP:{$ip}","Host:www.app.edu.gov.on.ca");
		//$lat = '43.5596118';
		//$lng = '-79.72719280000001';
		//$lng = '-79.40317140000002';
		//$lat = '43.6363265';
		error_log("School Lat:".$lat."Lng:".$lng);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headerIp);
		$fields = array(
			'chosenLevel' => urlencode("Secondary"),
			'compareLat' => urlencode($lat),
			'compareLong' => urlencode($lng),
			'refineDistance' => urlencode("NN"),
		);


		$fields_string='';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		// 读取数据
		$res = curl_exec($ch);
		curl_close($ch);
		//$xml = simplexml_load_string($res) or die("Error: Cannot create object");
		header('Content-type: application/xml');
		echo $res;

		//echo json_encode($xml);

	}

	public function actionGetSchoolRank(){
		$db = Yii::app()->db;
		//$result = array();
		$place_id = trim($_GET['place_id']);
		$lat = round(trim($_GET['lat']),6);
		$lng = round(trim($_GET['lng']),6);
			
		$sql = "select paiming from h_school 
		where lat ='". $lat."' 
		and lng='".$lng."';"; 
		
		$resultsql = $db->createCommand($sql)->query();
		//error_log($sql);
		
		$rank = $resultsql->readColumn(0);
		$result["place_id"] = $place_id;
		$result["rank"] = ($rank)? $rank : '无';
		
		//$results[] = $result;
		
		echo json_encode($result);
}	

}
