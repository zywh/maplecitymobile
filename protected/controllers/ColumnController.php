<?php
/**
 * Created by PhpStorm.
 * User: p-shenghui
 * Date: 2015/1/13
 * Time: 20:17
 */
class ColumnController extends XFrontBase
{
    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/column.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/template-native.js');

        $house_list = House::model()->findAll(array(
            'select'    => 'id, name, prepay, house_image',
            'condition' => 'investType_id = :investType_id',
            'params'     => array(':investType_id' => 1),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
        $city_list = City::model()->findAll();
        $district_list = District::model()->findAll();
        $propertyType_list = PropertyType::model()->findAll();

        $data = array(
            'house_list'        => $house_list,
            'city_list'         => $city_list,
            'district_list'     => $district_list,
            'propertyType_list' => $propertyType_list,
        );

        $this->render('index', $data);

    }
	
	
	


    public function actionSuccess(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('success', array('link_list' => $link_list));
    }
	
    public function actionSchool(){

        $this->render('school');

    }
	
	
	 public function actionMap(){

        $this->render('map');

    }

    public function actionAjaxGetDistricts(){
        $city_id = Yii::app()->request->getPost('city_id');
        $district_list = array();
        if(!empty($city_id)){
            $district_list = District::model()->findAll('city_id=:city_id', array(':city_id'=>$city_id));
        }else{
            $district_list = District::model()->findAll();
        }
        echo CJSON::encode(array('data' => $district_list));
    }

    public function actionAjaxRequirementCreate(){
        $city_id           = Yii::app()->request->getPost('city_id');
        $district_id       = Yii::app()->request->getPost('district_id');
        $investType_id     = Yii::app()->request->getPost('investType_id');
        $propertyType_id   = Yii::app()->request->getPost('propertyType_id');
        $total_price       = Yii::app()->request->getPost('total_price');
        $house_area        = Yii::app()->request->getPost('house_area');
        $land_area         = Yii::app()->request->getPost('land_area');
        $bedroom_num       = Yii::app()->request->getPost('bedroom_num');
        $construction_year = Yii::app()->request->getPost('construction_year');

        if(!empty($this->_account['userId'])){
            $user = User::model()->findByPk($this->_account['userId']);

            $model = new Requirement();
            $model->city_id           = $city_id;
            $model->district_id       = $district_id;
            $model->investType_id     = $investType_id;
            $model->propertyType_id   = $propertyType_id;
            $model->total_price       = $total_price;
            $model->house_area        = $house_area;
            $model->land_area         = $land_area;
            $model->bedroom_num       = $bedroom_num;
            $model->construction_year = $construction_year;
            $model->phone             = $user->phone;
            $model->email             = $user->email;

            if($model->save()){
                $url = Yii::app()->createUrl('column/success');
                echo CJSON::encode(array('status'=>'success', 'url'=>$url, 'msg'=>'提交成功'));
            }else{
                echo CJSON::encode(array('status'=>'failed', 'url'=>'', 'msg'=>'提交失败，请稍候重试'));
            }
        }else{
            echo CJSON::encode(array('status'=>'failed', 'url'=>'', 'msg'=>'您还未登录，请先登录'));
        }
    }
}