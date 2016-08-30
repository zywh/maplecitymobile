<?php
/**
 * Created by PhpStorm.
 * User: ShengHui
 * Date: 2015/1/24
 * Time: 22:33
 */
class ProjectsController extends XFrontBase
{
    public function actionMore($id){
	

		//$id = Yii::app()->request->getQuery('id', 10);
		$criteria = new CDbCriteria();
		$criteria->addCondition('id="'.$id.'"');
		$criteria->addCondition('recommend=1');
		$subject = Subject::model()->find($criteria);
		
        $data = array(
			'subject' => $subject
        );
        $this->render('more', $data);
    }
   public function actionGetProjects(){
	
		$results = array();
		$postParms = array();
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");
		$_POST = (array) json_decode(file_get_contents('php://input'), true);
		//error_log("Parms:".$_POST['parms']['id']);
		$postParms = (!empty($_POST['parms']))?  $_POST['parms'] : array();
		
		$criteria = new CDbCriteria();
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

    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/enjoy.css');
		$city_id = Yii::app()->request->getQuery('city', 0);
        //$time_sort = Yii::app()->request->getQuery('time_sort', 'DESC');
        
		$criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($city_id)){
            $criteria->addCondition('city_id='.$city_id);
        }
        if(!empty($time_sort)){
            $criteria->order = 'date '.$time_sort;
        }
 
        $criteria->addCondition('recommend=1');
        $count = Subject::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        //$house_list = House::model()->findAll($criteria);
		$subject_list = Subject::model()->findAll($criteria);



        $cur_city = City::model()->findByPk($city_id);

        $data = array(
            'subject_list' => $subject_list,
            'cur_city'     => $cur_city,
            'count'        => $count,
            'time_sort'    => $time_sort,
            'price_sort'   => $price_sort,
            'pages'        => $pager
        );

        $this->render('index', $data);
    }
}
