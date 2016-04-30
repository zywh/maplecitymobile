<?php
/**
 * Created by PhpStorm.
 * User: ShengHui
 * Date: 2015/1/24
 * Time: 22:33
 */
class HotrecommendController extends XFrontBase
{
    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/enjoy.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/lanrenzhijia.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.roundabout.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/lanrenzhijia.js');

        $hot_house = House::model()->findAll(array(
            'select'    => 'id, name, house_image',
            'condition' => 'recommend=1 AND house_image<>""',
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        $subject_list = Subject::model()->findAll(array(
            'condition' => 'recommend=1',
            'order'     => 'id DESC',
        ));

        $data = array(
            'hot_house'    => $hot_house,
            'subject_list' => $subject_list
        );
        $this->render('index', $data);
    }

    public function actionMore(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/enjoy.css');
        $city_id = Yii::app()->request->getQuery('city', 0);
        $time_sort = Yii::app()->request->getQuery('time_sort', 'DESC');
        $price_sort = Yii::app()->request->getQuery('price_sort');

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($city_id)){
            $criteria->addCondition('city_id='.$city_id);
        }
        if(!empty($time_sort)){
            $criteria->order = 'accessDate '.$time_sort;
        }
        if(!empty($price_sort)){
            $criteria->order = 'total_price '.$price_sort;
        }
        $criteria->addCondition('recommend=1');
        $count = House::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $house_list = House::model()->findAll($criteria);

        $subject_list = Subject::model()->findAll(array(
            'condition' => 'recommend=1',
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