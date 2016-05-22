<?php

class NgGetController extends XFrontBase
{
	
	//public $imghost = "http://m.maplecity.com.cn/";
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
			$result['developer_intro'] = $row["developer_intro"];
			$result['cityname'] = $row["cityname"]; 			
			$result['replaceurl'] = $imghost."tn_uploads";
			
			//$results[] = $result;
			echo json_encode($result);
			//}
		} else {
			//Return all recommended project
			
			$criteria->addCondition('recommend=1');
			$subject = Subject::model()->findAll($criteria);
			foreach($subject as $row){

				$result['id'] = $row["id"]; 
				$result['name'] = $row["name"]; 
				$result['city_id'] = $row["city_id"]; 
				
				$result['room_type_image'] = str_replace("uploads","tn_uploads",$imghost.$row["room_type_image"]);
				$results[] = $result;
			}
			echo json_encode($results);
		}
		
			
		
		
		

		
    }	

 
}
