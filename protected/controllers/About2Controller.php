<?php
/**
 * Created by PhpStorm.
 * User: p-shenghui
 * Date: 2015/1/13
 * Time: 20:03
 */
class About2Controller extends XFrontBase
{
    public function actionIndex(){}
		
		public function actionAbout2(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
				Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/xinjia.css');
        $catalog_id = Yii::app()->request->getQuery('id');
				if ($catalog_id == '') $catalog_id = 32;
//				$post = Post::model()->findByPk($id);
//        $post->view_count += 1;
//        $post->save();
        //$catalog_id = $post->catalog_id;
//			nybanner_mls  nybanner_gflc  nybanner_gfht   nybanner_fcjj
				if ($catalog_id == 32) $banner_name="nybanner_mls";
				if ($catalog_id == 33) $banner_name="nybanner_gflc";
				if ($catalog_id == 34) $banner_name="nybanner_gfht";
				if ($catalog_id == 36) $banner_name="nybanner_fcjj";
				
				$prev_post = Post::model()->findAll(array(
            'select'    => 'id, title, content, view_count',
            'condition' => ' catalog_id = :catalog_id',
            'params'    => array(':catalog_id' => $catalog_id),
            'order'     => 'id ASC',
            'limit'     => 1
        ));

        $this->render('about_2', array(
						'banner_name' => $banner_name,
            'post'      => $post,
            'prev_post' => $prev_post[0]
        ));
		}
		
}