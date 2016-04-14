<?php
/**
 * 管理员
 *
 * @author        ShengHui
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */
class UserController extends XFrontBase
{
    /**
     * 用户列表
     *
     */
    public function actionIndex (){}

    /**
     * 新用户注册
     *
     */
    public function actionRegister(){
        $this->layout = " ";
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-1.9.1.js');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
        $username = Yii::app()->request->getQuery('username', null);
        $phone = Yii::app()->request->getQuery('phone', null);
        $email = Yii::app()->request->getQuery('email', null);
        $model = new User('create');
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if($model->validate()){
                $code_model = Temp::model()->findByPk(trim($model->phone));
                if(!empty($code_model)){
                    if(time() - $code_model->time <= 180){
                        if($model->sms_code == $code_model->code){
                            if ($model->save()) {
                                $userInfo = new UserInfo();
                                $userInfo->userId = $model->id;
                                $userInfo->username = $model->username;
                                $userInfo->phone = $model->phone;
                                $userInfo->save();
                                $this->redirect(array('registerSuccess'));
                            }
                        }else{
                            $model->addError('sms_code', '验证码不正确');
                        }
                    }else{
                        $model->addError('sms_code', '验证码已失效，请重新获取');
                    }
                }else{
                    $model->addError('sms_code', '验证失败，请重新获取');
                }
            }
        }
        if(!empty($username) && (trim($username) != '您的姓名')) $model->username = $username;
        if(!empty($phone) && (trim($phone) != '您的电话')) $model->phone = $phone;
        if(!empty($email) && (trim($email) != '您的邮箱')) $model->email = $email;

        $sms_list = Sms::model()->findAll();
        $link_list = Link::model()->findAll();

        $this->render('create', array ('model' => $model, 'sms_data' => $sms_list[0], 'link_list' => $link_list));
    }

    /**
     * 修改密码
     *
     * @param  $id
     */
    public function actionUpdate(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-1.9.1.js');
        $email = Yii::app()->request->getQuery('email');
        $email = base64_decode($email);
        $model = new User();
        $link_list = Link::model()->findAll();
        if (isset($_POST['User'])) {
            $email = $_POST['User']['email'];
            $password = $_POST['User']['password'];
            $password_repeat = $_POST['User']['password_repeat'];
            if(!empty($password)){
                if($password == $password_repeat){
                    $user = User::model()->find('email = :email', array(':email' => $email));
                    $user->password = md5($password);
                    if($user->save()){
                        $this->redirect(array('changeSuccess'));
                    }else{
                        $this->redirect(array('changeFailed'));
                    }
                }else{
                    $model->addError('password_repeat', '密码确认有误');
                }
            }else{
                $model->addError('password', '密码不可为空');
            }
        }
        $data = array(
            'model' => $model,
            'email' => $email,
            'link_list' => $link_list
        );
        $this->render('update', $data);
    }

    public function actionRegisterSuccess(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('register_success', array('link_list' => $link_list));
    }

    //审核
    public function actionAjaxCheck(){
        $phone = Yii::app()->request->getPost('sms_phone');
        if(!empty($phone)){
            $code_model = Temp::model()->findByPk(trim($phone));
            if(!empty($code_model)){
                if(time() - $code_model->time <= 180){
                    echo CJSON::encode(array('success'=>false, 'msg'=>'原验证码尚未失效，请勿重复获取'));
                }else{
                    $code_model->delete();
                    echo CJSON::encode(array('success'=>true, 'msg'=>'验证通过，可以获取验证码'));
                }
            }else{
                echo CJSON::encode(array('success'=>true, 'msg'=>'验证通过，可以获取验证码'));
            }
        }else{
            echo CJSON::encode(array('success'=>false, 'msg'=>'请先输入手机号'));
        }
    }

    //获取验证码
    public function actionAjaxGetCode(){
        $uid = Yii::app()->request->getPost('sms_uid');
        $psw = Yii::app()->request->getPost('sms_psw');
        $cid = Yii::app()->request->getPost('sms_cid');
        $phone = Yii::app()->request->getPost('sms_phone');
        $arr = explode(',', '0,1,2,3,4,5,6,7,8,9');
        $code = '';
        for($i=0; $i<6; $i++){
            $tag = mt_rand(0,9);
            $code .= $arr[$tag];
        }
        $temp_model = new Temp();
        $temp_model->phone = trim($phone);
        $temp_model->code = trim($code);
        $temp_model->time = time();
        if($temp_model->save()){
            $sms = new SMSComponent($uid, $psw, $cid);
            $res = $sms->sendMsg($code,$phone);
            $res = CJSON::decode($res);
            if($res['code'] == 0){
                echo CJSON::encode(array('success'=>true, 'msg'=>'短信已发送，请注意查收'));
            }else{
                echo CJSON::encode(array('success'=>false, 'msg'=>'短信发送失败，请稍后重试'));
            }
        }else{
            echo CJSON::encode(array('success'=>false, 'msg'=>'验证码获取失败，请稍后重试'));
        }
    }

    public function actionChangeSuccess(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('change_success', array('link_list' => $link_list));
    }

    public function actionChangeFailed(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('change_failed', array('link_list' => $link_list));
    }
}
