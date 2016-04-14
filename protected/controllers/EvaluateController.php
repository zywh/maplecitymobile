<?php
/**
 * Created by PhpStorm.
 * User: p-shenghui
 * Date: 2015/2/2
 * Time: 18:00
 */
class EvaluateController extends XFrontBase
{
    public function actionCreate(){
        $city   = Yii::app()->request->getPost('city');
        $type   = Yii::app()->request->getPost('type');
        $aim    = Yii::app()->request->getPost('aim');
        $prepay = Yii::app()->request->getPost('prepay');
        $name   = Yii::app()->request->getPost('name');
        $phone  = Yii::app()->request->getPost('phone');

        $model = new Evaluate();
        $phone_pattern = '/^\d{3,4}[-]?\d{7,8}$/';

        if(empty($name) || (trim($name) == '您的称谓')){
            echo CJSON::encode(array('success' => false, 'msg' => '请填写您的称谓后提交'));
            exit;
        }else{
            $model->name = $name;
        }
        if(empty($phone) || (trim($phone) == '联系方式')){
            echo CJSON::encode(array('success' => false, 'msg' => '请填写联系方式后提交'));
            exit;
        }elseif(!preg_match($phone_pattern, $phone)){
            echo CJSON::encode(array('success'=> false, 'msg'=>'不是有效的联系方式'));
            exit;
        }else{
            $model->phone = $phone;
        }
        if(!empty($city) && (trim($city) != '意向城市')){
            $model->city = $city;
        }
        if(!empty($type) && (trim($type) != '投资类型')){
            $model->type = $type;
        }
        if(!empty($aim) && (trim($aim) != '投资目的')){
            $model->aim = $aim;
        }
        if(!empty($prepay) && (trim($prepay) != '首付预算')){
            $model->prepay = $prepay;
        }

        if($model->save()){
            $url = Yii::app()->createUrl('evaluate/success');
            echo CJSON::encode(array('success' => true, 'msg' => $url));
        }else{
            echo CJSON::encode(array('success' => false, 'msg' => '提交失败，请稍后重试'));
        }
    }

    public function actionSuccess(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('success', array('link_list' => $link_list));
    }
}