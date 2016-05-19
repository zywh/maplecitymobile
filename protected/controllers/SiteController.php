<?php
/**
 * 首页控制器
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class SiteController extends XFrontBase
{
    /**
     * 首页
     */
    public function actionIndex ()
    {
        
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/homepage.css');
 
        //Banner
        $criteria = new CDbCriteria();
        $criteria->select = 'title, url, image';
        $criteria->addCondition('status=1');
				$criteria->order = 'id ';
        $criteria->limit = 4;
        $banner = Banner::model()->findAll($criteria);
         
		$criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->order = 'date DESC';
        $criteria->addCondition('homepage=1');
        $count = Subject::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 6;
        $pager->applyLimit($criteria);
      	$subject_list = Subject::model()->findAll($criteria);


        $data = array(
            'banner'                      => $banner,
			'subject_list' => $subject_list 
						
        );
        $this->render('index', $data);
    }

 

    /**
     * 会员登录
     */
    public function actionLogin ()
    {
        $this->layout = " ";
      
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
        $original = Yii::app()->request->getQuery('original');
        $model = new User('login');
        if (XUtils::method() == 'POST') {
            $model->attributes = $_POST['User'];
            $data = $model->find('username=:username OR email=:email', array (':username' => $model->username, ':email' => $model->username));
            if ($data === null) {
                $model->addError('username', '用户不存在');
            } elseif (! $model->validatePassword($data->password)) {
                $model->addError('password', '密码不正确');
            } else {
                $userInfo = UserInfo::model()->find('userId=:userId', array(':userId'=>$data->id));
                parent::_stateWrite(
                    array(
                        'userId'=>$data->id,
                        'userName'=>$data->username,
                        'nickname'=>$userInfo->nickname,
                    ),array('prefix'=>'_account')
                );

                $data->last_login_ip = XUtils::getClientIP();
                $data->last_login_time = time();
                $data->login_count = $data->login_count+1;
                $data->save();
	
			if($_REQUEST["houseid"]==""){//判断登陆是否从预约看房那边进来的
                if(!empty($original)){
                    $this->redirect($original);
                }else{
                    $this->redirect(array('site/index'));
                }
			}
			else{
			$this->redirect(array('house/view&id='.$_REQUEST[houseid].''));
			}
			
            }
        }
        $this->render('login', array ('model' => $model ));
    }

    /**
     * 退出登录
     */
    public function actionLogout ()
    {
        parent::_sessionRemove('_account');
        $this->redirect(array ('login'));
    }

    /**
     * 忘记密码
     */
    public function actionForgetPassword(){
        $this->layout = " ";
    
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
        $this->render('forget_password');
    }

    /**
     * 发送邮件
     */
    public function actionSendEmail(){
        $email = Yii::app()->request->getQuery('email');
		if($email==""){
		echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
		echo "<script charset='utf-8'>alert('请输入邮箱');history.go(-1)</script>";
		exit;
		}
        $user = User::model()->find('email = :email', array(':email' => $email));
        if(!empty($user)){
            Yii::app()->mailer->Host = 'smtp.163.com';                                           // 邮箱服务地址
            Yii::app()->mailer->port = 465;                                                            // 端口
            Yii::app()->mailer->IsSMTP();                                                              // 使用 SMTP
            Yii::app()->mailer->SMTPAuth = true;                                                       // SMTP 验证
            Yii::app()->mailer->SMTPDebug = false;                                                     // 显示 Debug 信息
            Yii::app()->mailer->Username = '15366617321@163.com';                                         // 邮箱帐号
            Yii::app()->mailer->Password = 'fengzhidu123asds';                                // 邮箱密码  登陆密码：fengzhidu123asd
            Yii::app()->mailer->From = '15366617321@163.com';                                             // 发件人邮箱
            Yii::app()->mailer->FromName = '枫之都房产置业平台';                                       // 发件人姓名
            Yii::app()->mailer->AddReplyTo('15366617321@163.com');                                        // 回复邮箱
            Yii::app()->mailer->AddAddress($email);                                                    // 收件人邮箱
            Yii::app()->mailer->CharSet = 'UTF-8';                                                     // 字符编码
            Yii::app()->mailer->ContentType = 'text/html';                                             // 内容类型
            Yii::app()->mailer->getView('email_tpl', array('name'=>$user->username, 'email'=>$email)); // 使用邮件模板作为内容
            Yii::app()->mailer->Subject = '枫之都房产置业平台-密码修改';                               // 标题
            Yii::app()->mailer->Send();                                                                // 发送
            $this->redirect(array('sendSuccess'));
        }else{
            $this->redirect(array('emailError'));
        }
    }

    public function actionSendSuccess(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('success', array('link_list' => $link_list));
    }

    public function actionSendFailed(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('failed', array('link_list' => $link_list));
    }

    public function actionEmailError(){
        $this->layout = ' ';
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/success.css');
        $link_list = Link::model()->findAll();
        $this->render('email_error', array('link_list' => $link_list));
    }
}