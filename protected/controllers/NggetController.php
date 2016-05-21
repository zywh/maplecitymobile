<?php

class NgGetController extends XFrontBase
{

   public function actionGetProjects(){
	
		$results = array();
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		//error_log("Parms:".$_POST['parms']['id']);
		$criteria = new CDbCriteria();
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		
		if (!empty($postParms['id'])){
			$criteria->addCondition('id="'.$_POST['parms']['id'].'"');
		}
		//$criteria->addCondition('recommend=1');
		$subject = Subject::model()->findAll($criteria);
		foreach($subject as $row){

			//$result['id'] = $row["id"]; 
			$result['name'] = $row["name"]; 
			$result['summary'] = $row["summary"]; 
			$results[] = $result;
		}
		header('Content-Type: application/json');
		echo json_encode($results);
    }	

 
}
