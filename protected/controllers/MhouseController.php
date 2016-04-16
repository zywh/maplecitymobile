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

    /**
     * 房源详情
     */
    public function actionView($id){
      	ini_set("log_errors", 1);
        ini_set("error_log", "/tmp/php-error.log");



        $cookies = Yii::app()->request->getCookies();
 
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.id="'.$id.'"');
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
		$db = Yii::app()->db;
		//$result = array();
		$term = trim($_GET['term']);
		$city_id = trim($_GET['cd1']);
		$chinese = preg_match("/\p{Han}+/u", $term);
		//
		
		//Generate Count by municipality
		if ( $city_id == '0' ) {
			
			if ($chinese) { //if province = 0 and chinese search
			
				$sql = "
				SELECT m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE  m.province = c.englishname 
				AND  m.municipality_cname like '".$term."%' 
				AND  m.count > 10 order by count desc limit 10;
				";			
			
			} else { //if province = 0  and english search
			
				$sql = "
				SELECT m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE  m.province = c.englishname 
				AND  municipality like '".$term."%' 
				AND  m.count > 10 order by count desc limit 10;
				";
			}
			
		} else{  //if province is NOT 0
			
			if ($chinese) { //if province = 0 and chinese search			
			
				$sql = "
				SELECT m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE m.province = c.englishname 
				AND  c.id=".$city_id." 
				AND m.municipality_cname like '".$term."%'  
				AND  m.count > 10 order by count desc limit 10;
				";		
			} else {
				
				$sql = "
				SELECT m.municipality citye,m.municipality_cname cityc,m.province provincee,c.name provincec 
				FROM h_mname m, h_city c 
				WHERE m.province = c.englishname 
				AND  c.id=".$city_id." 
				AND m.municipality like '".$term."%' 
				AND  m.count > 10 order by count desc limit 10;
				";		
			}
			
		
		
		}
			
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){

			$result['id'] = $row["citye"]; 
			if ( $chinese ) {
			  	
				$result['value'] = $row["cityc"].", ".$row["provincec"]; 
				$results[] = $result;
				
			} else {
				$result['value'] = $row["citye"].", ". $row["provincee"]; 
				$results[] = $result;
			}
	
	
		}
		

		 echo json_encode($results);
    
	//Function END  
    }
	
}
