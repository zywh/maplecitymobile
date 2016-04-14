<?php

class EnjoyController extends XFrontBase
{
    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/enjoy.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/lanrenzhijia.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.roundabout.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/lanrenzhijia.js');

        $house_image_list = House::model()->findAll(array(
            'select'    => 'id, addr, image_list',
            'condition' => 'lp_dol>3000000',
            'order'     => 'id DESC',
            'limit'     => 1
        ));

        $city_houses = array();
        $subject_list = Subject::model()->findAll(array(
  
            'order'     => 'id DESC',
        ));

        foreach($subject_list as $obj){
            $criteria = new CDbCriteria();

            $criteria->addCondition('city_id='.$obj->city_id);
            $criteria->addCondition('lp_dol>3000000');
            $criteria->order = 'id DESC';
            $criteria->limit = 4;
            $house_list = House::model()->findAll($criteria);

            $city_houses[$obj->city_id] = $house_list;
        }

			$matches = Match::model()->findAll();
	
        $data = array(
            'house_image_list' => $house_image_list[0],
            'subject_list'     => $subject_list,
            'city_houses'      => $city_houses,
		    'matches'         => $matches
        );

        $this->render('index', $data);
    }

    public function actionMore(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/enjoy.css');
        $city_id = Yii::app()->request->getQuery('city', 0);
        $time_sort = Yii::app()->request->getQuery('time_sort', 'DESC');
        $price_sort = Yii::app()->request->getQuery('lp_dol');

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($city_id)){
            $criteria->addCondition('city_id='.$city_id);
        }
        if(!empty($time_sort)){
            $criteria->order = 'accessDate '.$time_sort;
        }
        if(!empty($price_sort)){
            $criteria->order = 'lp_dol '.$price_sort;
        }
        $criteria->addCondition('lp_dol>3000000');
        $count = House::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $house_list = House::model()->findAll($criteria);

        $subject_list = Subject::model()->findAll(array(
            'order'     => 'id DESC',
        ));

        $cur_city = City::model()->findByPk($city_id);

        $data = array(
            'house_list'   => $house_list,
            'subject_list' => $subject_list,
            'cur_city'     => $cur_city,
            'count'        => $count,
            'time_sort'    => $time_sort,
            'price_sort'   => $price_sort,
            'pages'        => $pager
        );

        $this->render('more', $data);
    }
}
?>