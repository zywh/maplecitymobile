<?php
/**
 * Created by PhpStorm.
 * User: p-shenghui
 * Date: 2015/1/13
 * Time: 20:03
 */
class AboutController extends XFrontBase
{
    public function actionIndex(){}
		
    //public function actionCanadaNewsView(){
		public function actionAbout1(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/xinjia.css');
        $catalog_id = Yii::app()->request->getQuery('id');
				if ($catalog_id == '') $catalog_id = 27;
//				$post = Post::model()->findByPk($id);
//        $post->view_count += 1;
//        $post->save();
        //$catalog_id = $post->catalog_id;
				//SUPERIORITY   CONTACT US  ÈË²ÅÕĞÄ¼JOIN US
				if ($catalog_id == 27) $cat_name_en="MAPLECITY PFOFILE";
				if ($catalog_id == 28) $cat_name_en="SUPERIORITY";
				if ($catalog_id == 30) $cat_name_en="CONTACT US";
				if ($catalog_id == 31) $cat_name_en="JOIN US";
				
				$prev_post = Post::model()->findAll(array(
            'select'    => 'id, title, content, view_count',
            'condition' => ' catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => $catalog_id),
            'order'     => 'id ASC',
            'limit'     => 1
        ));
				//$prev_post->view_count += 1;
        //$prev_post->save();
				
        $next_post = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id < :id AND catalog_id = :catalog_id',
            'params'    => array(':id' => $id, ':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $this->render('about', array(
						'cat_name_en' => $cat_name_en,
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
		}
		
		public function actionPartner(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/xinjia.css');
        $this->render('partner');
		}
		
		
		public function actionTridel(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/xinjia.css');
        $this->render('tridel');
		}
		
		public function actionWestbank(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/xinjia.css');
        $this->render('westbank');
		}
		
}