<?php
/**
 * Created by PhpStorm.
 * User: ShengHui
 * Date: 2015/3/4
 * Time: 22:59
 */
class ClubController extends XFrontBase
{
    public function actionUCenter(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/city_list.js');
        if(!empty($this->_account['userId'])){
            $model = UserInfo::model()->find('userId=:userId', array(':userId'=>$this->_account['userId']));
            $this->render('u_center', array('model'=>$model));
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("无权访问！");';
            echo 'window.history.back();';
            echo '</script>';
        }
    }

    public function actionChangePassword(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        if(!empty($this->_account['userId'])){
            $this->render('password_change');
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("无权访问！");';
            echo 'window.history.back();';
            echo '</script>';
        }
    }

    public function actionUpdatePassword(){
        $old_password = Yii::app()->request->getPost('old_password');
        $new_password = Yii::app()->request->getPost('new_password');
        $user = User::model()->findByPk($this->_account['userId']);
        if(md5($old_password) == $user->password){
            $user->password = md5($new_password);
            if($user->save()){
                echo CJSON::encode(array('status' => 200, 'msg' => '密码修改成功'));
            }else{
                echo CJSON::encode(array('status' => 500, 'msg' => '密码修改失败'));
            }
        }else{
            echo CJSON::encode(array('status' => 500, 'msg' => '旧密码有误，请重新输入'));
        }
    }

    public function actionMyCollection(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        if(!empty($this->_account['userId'])){
            $myCollection = Collect::model()->find('user_id=:user_id', array(':user_id'=>$this->_account['userId']));
            $collection_list = explode(',', $myCollection->collection);
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $collection_list);
            $count = House::model()->count($criteria);
            $pager = new CPagination($count);
            $pager->pageSize = 2;
            $pager->applyLimit($criteria);
            $house_list = House::model()->findAll($criteria);

            $data = array(
                'count' => $count,
                'pages' => $pager,
                'house_list' => $house_list
            );

            $this->render('myCollection', $data);
        }else{
            echo '<script type="text/javascript">';
            echo 'alert("无权访问！");';
            echo 'window.history.back();';
            echo '</script>';
        }
    }

    public function actionDelCollection(){
        $id = Yii::app()->request->getPost('id');
        if(!empty($this->_account['userId'])){
            $myCollection = Collect::model()->find('user_id=:user_id', array(':user_id'=>$this->_account['userId']));
            $collection_list = explode(',', $myCollection->collection);
            if(count($collection_list) == 1){
                if($myCollection->delete()){
                    echo CJSON::encode(array('status' => 200, 'msg' => '删除成功'));
                }else{
                    echo CJSON::encode(array('status' => 500, 'msg' => '删除失败'));
                }
            }else{
                $key = 0;
                foreach ($collection_list as $k => $val) {
                    if($val == $id){
                        $key = $k;
                        break;
                    }
                }
                unset($collection_list[$key]);
                $collection = implode(',', $collection_list);
                $myCollection->collection = $collection;
                if($myCollection->save()){
                    echo CJSON::encode(array('status' => 200, 'msg' => '删除成功'));
                }else{
                    echo CJSON::encode(array('status' => 500, 'msg' => '删除失败'));
                }
            }
        }else{
            echo CJSON::encode(array('status' => 404, 'msg' => '无权访问！'));
        }
    }

    public function actionDelAllCollection(){
        if(!empty($this->_account['userId'])){
            $myCollection = Collect::model()->find('user_id=:user_id', array(':user_id'=>$this->_account['userId']));
            if($myCollection->delete()){
                echo CJSON::encode(array('status' => 200, 'msg' => '删除成功'));
            }else{
                echo CJSON::encode(array('status' => 500, 'msg' => '删除失败'));
            }
        }else{
            echo CJSON::encode(array('status' => 404, 'msg' => '无权访问！'));
        }
    }

    public function actionViewHistory(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        $cookies = Yii::app()->request->getCookies();
        $house_ids = explode(',', $cookies['fzd_house']->value);
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $house_ids);
        $count = House::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 2;
        $pager->applyLimit($criteria);
        $house_list = House::model()->findAll($criteria);

        $data = array(
            'count' => $count,
            'pages' => $pager,
            'house_list' => $house_list
        );

        $this->render('viewHistory', $data);
    }

    public function actionDelHistory(){
        $id = Yii::app()->request->getPost('id');
        $cookies = Yii::app()->request->getCookies();
        $house_ids = explode(',', $cookies['fzd_house']->value);
        $key = 0;
        foreach ($house_ids as $k => $val) {
            if($val == $id){
                $key = $k;
                break;
            }
        }
        unset($house_ids[$key]);
        $cookie_str = implode(',', $house_ids);
        $cookie = new CHttpCookie('fzd_house',$cookie_str);
        $cookie->expire = time() + 60 * 60 * 24 * 30;  //有限期30天
        Yii::app()->request->cookies['fzd_house'] = $cookie;
    }

    public function actionDelAllHistory(){
        $cookies = Yii::app()->request->getCookies();
        unset($cookies['fzd_house']);
    }

    public function actionService(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        $service = Service::model()->findAll();
        $this->render('service', array('service'=>$service));
    }
	

    public function actionFiles(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/club.css');
        $recommend_files = File::model()->findAll('recommend = :recommend', array(':recommend'=>1));
        $files = File::model()->findAll('recommend = :recommend', array(':recommend'=>0));
        $data = array(
            'recommend_files' => $recommend_files,
            'files' => $files
            );
        $this->render('files', $data);
    }

    public function actionView(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $id = Yii::app()->request->getQuery('id');
        $post = Service::model()->findByPk($id);
        $prev_post = Service::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id < :id',
            'params'    => array(':id' => $id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $next_post = Service::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id > :id',
            'params'    => array(':id' => $id),
            'order'     => 'id ASC',
            'limit'     => 1
        ));
        $this->render('view', array(
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
    }

    public function actionDownload(){
        $id = Yii::app()->request->getQuery('id');
        $file = File::model()->findByPk($id);
        $name = '';
        $path = '';
        if(!empty($file)){
            $name = $file->name;
            $path = $file->path;
        }
        //将网页变为下载框，原本是：header("content-type:text/html;charset=utf-8");
        header("content-type:application/x-msdownload");
        //设置下载框上的文件信息
        header("content-disposition:attachment;filename={$name}");
        //readfile("文件路径");从服务器读取文件，该函数才真正实现下载功能，其它的是固定死的
        readfile('./'.$path);
    }

    public function actionUpdateInfo(){
        $nickname    = Yii::app()->request->getPost('nickname');
        $gender      = Yii::app()->request->getPost('gender');
        $province    = Yii::app()->request->getPost('province');
        $city        = Yii::app()->request->getPost('city');
        $inform_type = Yii::app()->request->getPost('inform_type');
        $aim_city    = Yii::app()->request->getPost('aim_city');
        $purpose     = Yii::app()->request->getPost('purpose');
        $instruction = Yii::app()->request->getPost('instruction');

        $model = UserInfo::model()->find('userId=:userId', array(':userId'=>$this->_account['userId']));
        $model->nickname    = trim($nickname);
        $model->gender      = $gender;
        $model->province    = $province;
        $model->city        = $city;
        $model->inform_type = $inform_type;
        $model->aim_city    = $aim_city;
        $model->purpose     = $purpose;
        $model->instruction = $instruction;
        if($model->save()){
            echo CJSON::encode(array('msg' => '保存成功'));
        }else{
            echo CJSON::encode(array('msg' => '保存失败，请稍候再试'));
        }
    }
}