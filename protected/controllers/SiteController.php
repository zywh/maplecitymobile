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
        
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');

        //Banner
        $criteria = new CDbCriteria();
        $criteria->select = 'title, url, image';
        $criteria->addCondition('status=1');
				$criteria->order = 'id ';
        $criteria->limit = 4;
        $banner = Banner::model()->findAll($criteria);
 
        //视频推荐
        $home_video = Video::model()->find('home=:home', array(':home'=>1));

        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, date';
        $criteria->addCondition('chosen=1');
        $criteria->addCondition('home!=1');
        $criteria->order = 'id DESC';
        $criteria->limit = 3;
        $video = Video::model()->findAll($criteria);

        //热点推荐
        $criteria = new CDbCriteria();
        // $criteria->limit = 4;
        $criteria->order = 'id ASC';
        $city_list = City::model()->findAll($criteria);
        $hot = array();
        foreach($city_list as $city){
            $criteria = new CDbCriteria();
            $criteria->select = 'id, name, prepay, house_image, city_id,ml_num,county';
            $criteria->addCondition('city_id='.$city->id);
            $criteria->addCondition('recommend=1');
            $criteria->order = 'id DESC';
            $criteria->limit = 1;
            $house = House::model()->findAll($criteria);
            if (!empty($house)) {
                if(count($hot) < 4){
                    array_push($hot, $house[0]);
                }else{
                    break;
                }
            }
        }
        //豪宅鉴赏
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, prepay, house_image, introduction';
        $criteria->addCondition('total_price>=300');
        $criteria->order = 'id DESC';
        $criteria->limit = 3;
        $enjoy = House::model()->findAll($criteria);

        //学区专栏
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, prepay, house_image';
        $criteria->addCondition('investType_id=1');
        $criteria->order = 'id DESC';
        $criteria->limit = 10;
        $column = House::model()->findAll($criteria);

        //加国即时新闻
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, image';
        $criteria->addInCondition('catalog_id', array(6,7,8,9));
        $criteria->addCondition('image<>""');
        $criteria->order = 'id DESC';
        $criteria->limit = 3;
        $instant = Post::model()->findAll($criteria);

        //加国新闻
        $canada_news = Post::model()->findAll(array(
            'select'    => 'id, title,create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 6),
            'order'     => 'id DESC',
            'limit'     => 10
        ));

        //加国概况
        $summary = Post::model()->findAll(array(
            'select'    => 'id, title,create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 7),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //加国生活/经济
        $life = Post::model()->findAll(array(
            'select'    => 'id, title,create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 8),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //加国旅游
        $travel = Post::model()->findAll(array(
            'select'    => 'id, title,create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 9),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //房展会
        $exhibition = Post::model()->findAll(array(
            'select'    => 'id, title, image,create_time,last_update_time',
            'condition' => 'catalog_id=:catalog_id AND image<>""',
            'params'    => array(':catalog_id' => 10),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //学区房新闻
        $school_distrcit_house_news = Post::model()->findAll(array(
            'select'    => 'id, title,create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 11),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //房产热点新闻
        $house_hotspots = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 12),
            'order'     => 'id DESC',
            'limit'     => 8
        ));

        $house_property_special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 13),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $house_property_special_id = $house_property_special_news[0]->id;
        //房产置业宝典
        $house_property = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 13, ':id' => $house_property_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));

        //最新学区房
        $school_distrcit_house = House::model()->findAll(array(
            'select'    => 'id, name, house_image',
            'condition' => 'investType_id = :investType_id',
            'params'    => array(':investType_id' => 1),
            'order'     => 'id DESC',
            'limit'     => 3
        ));

        $studyabroad = Post::model()->findAll(array(
            'select'    => 'id, title, image, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 3),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				
				//留学资讯 加拿大留学
        $news_lx_special_news[0] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 17),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_lx_special_id = $news_lx_special_news[0][0]->id;
				$news_lx[0] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 17, ':id' => $news_lx_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				
				$news_lx[1] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id ',
            'params'     => array(':catalog_id' => 18),
            'order'     => 'id DESC',
            'limit'     => 8
        ));
				
				
				$news_lx_special_news[1] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 23),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_lx_special_id = $news_lx_special_news[1][0]->id;
				$news_lx[2] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 23, ':id' => $news_lx_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				
				//移民资讯 加拿大移民
        $news_ym_special_news[0] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 19),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_ym_special_id = $news_ym_special_news[0][0]->id;
				$news_ym[0] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 19, ':id' => $news_ym_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				$news_ym[1] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id ',
            'params'     => array(':catalog_id' => 20),
            'order'     => 'id DESC',
            'limit'     => 8
        ));
				$news_ym_special_news[1] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 24),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_ym_special_id = $news_ym_special_news[1][0]->id;
				$news_ym[2] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 24, ':id' => $news_ym_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				
				
				//旅游资讯 加拿大旅游
        $news_ly_special_news[0] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 21),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_ly_special_id = $news_ly_special_news[0][0]->id;
				$news_ly[0] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 21, ':id' => $news_ly_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
				$news_ly[1] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id ',
            'params'     => array(':catalog_id' => 22),
            'order'     => 'id DESC',
            'limit'     => 8
        ));
				$news_ly_special_news[1] = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => 25),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
				$news_ly_special_id = $news_ly_special_news[1][0]->id;
				$news_ly[2] = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id AND id != :id',
            'params'     => array(':catalog_id' => 25, ':id' => $news_ly_special_id),
            'order'     => 'id DESC',
            'limit'     => 10
        ));
        

        $data = array(
            'banner'                      => $banner,
            'home_video'                  => $home_video,
            'video'                       => $video,
            'hot'                         => $hot,
            'enjoy'                       => $enjoy,
            'column'                      => $column,
            'instant'                     => $instant,
            'canada_news'                 => $canada_news,
            'summary'                     => $summary,
            'life'                        => $life,
            'travel'                      => $travel,
            'exhibition'                  => $exhibition,
            'school_distrcit_house_news'  => $school_distrcit_house_news,
            'house_hotspots'              => $house_hotspots,
            'house_property_special_news' => $house_property_special_news[0],
            'house_property'              => $house_property,
            'school_distrcit_house'       => $school_distrcit_house,
            'studyabroad'                 => $studyabroad,
						'news_lx_special_news'        => $news_lx_special_news,
						'news_lx'                     => $news_lx,
						'news_ym_special_news'        => $news_ym_special_news,
						'news_ym'                     => $news_ym,
						'news_ly_special_news'        => $news_ly_special_news,
						'news_ly'                     => $news_ly
						
        );
        $this->render('index', $data);
    }

    public function actionGlobalSearch(){
        $msl = Yii::app()->request->getPost('msl');
        if(empty($msl) || trim($msl) == '请输入房源MSL号'){
            echo CJSON::encode(array('success' => false, 'msg' => '请输入房源MSL号'));
        }else{
            $house = House::model()->find('ml_num=:ml_num', array(':ml_num' => $msl));
            if(!empty($house)){
                $url = Yii::app()->createUrl('house/view', array('id' => $house->id));
                echo CJSON::encode(array('success' => true, 'msg' => $url));
            }else{
                echo CJSON::encode(array('success' => false, 'msg' => '抱歉！没有找到相应的房源'));
            }
        }
    }

    public function actionViewVideo(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/flowplayer-3.2.11.min.js');
        $id = Yii::app()->request->getQuery('id');
        $video = Video::model()->findByPk($id);
        $this->render('video_view', array('video' => $video));
    }

    /**
     * 会员登录
     */
    public function actionLogin ()
    {
        $this->layout = " ";
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-1.9.1.js');
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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-1.9.1.js');
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
            Yii::app()->mailer->Host = 'smtp.exmail.qq.com';                                           // 邮箱服务地址
            Yii::app()->mailer->port = 465;                                                            // 端口
            Yii::app()->mailer->IsSMTP();                                                              // 使用 SMTP
            Yii::app()->mailer->SMTPAuth = true;                                                       // SMTP 验证
            Yii::app()->mailer->SMTPDebug = false;                                                     // 显示 Debug 信息
            Yii::app()->mailer->Username = '1969378190@qq.com';                                         // 邮箱帐号
            Yii::app()->mailer->Password = 'breadtalk2015';                                             // 邮箱密码
            Yii::app()->mailer->From = '1969378190@qq.com';                                             // 发件人邮箱
            Yii::app()->mailer->FromName = '枫之都房产置业平台';                                       // 发件人姓名
            Yii::app()->mailer->AddReplyTo('1969378190@qq.com');                                        // 回复邮箱
            Yii::app()->mailer->AddAddress("2831463902@qq.com");                                                    // 收件人邮箱
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
