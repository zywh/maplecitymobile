<?php
/**
 * Created by PhpStorm.
 * User: ShengHui
 * Date: 2015/1/22
 * Time: 20:22
 */
class StudyabroadController extends XFrontBase
{
    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');

        $left_news = Post::model()->findAll(array(
            'select'    => 'id, title, image, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 3),
            'order'     => 'id DESC',
            'limit'     => 3
        ));
        $special_ids = array();
        foreach($left_news as $row){
            array_push($special_ids, $row->id);
        }

        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, summary';
        $criteria->order = 'id DESC';
        $criteria->addCondition('catalog_id = 3');
        $criteria->addNotInCondition('id', $special_ids);
        $criteria->limit = 1;
        $top_news = Post::model()->findAll($criteria);

        array_push($special_ids, $top_news[0]->id);

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->addCondition('catalog_id = 3');
        $criteria->addNotInCondition('id', $special_ids);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

        $data = array(
            'left_news' => $left_news,
            'top_news'  => $top_news[0],
            'more_news' => $more_news,
            'pages'     => $pager
        );
        $this->render('index', $data);
    }

    public function actionView(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $id = Yii::app()->request->getQuery('id');
        $post = Post::model()->findByPk($id);
        if($post->catalog->parent_id == 4){
            $this->redirect(array('news/canadaNewsView', 'id'=>$post->id));
        }elseif($post->catalog->parent_id == 5){
            $this->redirect(array('news/houseNewsView', 'id'=>$post->id));
        }
        $post->view_count += 1;
        $post->save();
        $catalog_id = $post->catalog_id;
        $prev_post = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id > :id AND catalog_id = :catalog_id',
            'params'    => array(':id' => $id, ':catalog_id' => $catalog_id),
            'order'     => 'id ASC',
            'limit'     => 1
        ));
        $next_post = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'id < :id AND catalog_id = :catalog_id',
            'params'    => array(':id' => $id, ':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $this->render('view', array(
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
    }
}