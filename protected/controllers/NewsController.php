<?php
/**
 * Created by PhpStorm.
 * User: p-shenghui
 * Date: 2015/1/13
 * Time: 20:03
 */
class NewsController extends XFrontBase
{
    public function actionIndex(){}

    public function actionCanadaNews(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $catalog_id = Yii::app()->request->getQuery('catalog_id', 6);

        $special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $special_id = $special_news[0]->id;

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
        $criteria->addCondition('id!='.$special_id);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

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
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 6),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //加国概况
        $summary = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 7),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //加国生活/经济
        $life = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 8),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //加国旅游
        $travel = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 9),
            'order'     => 'id DESC',
            'limit'     => 5
        ));
        //移民讲座
        $jiangzuo = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 45),
            'order'     => 'id DESC',
            'limit'     => 5
        ));
		
       //旅游签证
        $qianzheng = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 46),
            'order'     => 'id DESC',
            'limit'     => 5
        ));
        //枫之都学子俱乐部
        $xuezijulebu = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 43),
            'order'     => 'id DESC',
            'limit'     => 5
        ));
        $data = array(
            'catalog_id'   => $catalog_id,
            'special_news' => $special_news[0],
            'more_news'    => $more_news,
            'instant'      => $instant,
            'canada_news'  => $canada_news,
            'summary'      => $summary,
			'qianzheng'      => $qianzheng,
			'xuezijulebu'      => $xuezijulebu,
            'life'         => $life,
            'travel'       => $travel,
            'pages'        => $pager
        );
        $this->render('canada_news', $data);
    }
		
		public function actionCanadaNews2(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $catalog_id = Yii::app()->request->getQuery('catalog_id', 17);

        $special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $special_id = $special_news[0]->id;

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
        $criteria->addCondition('id!='.$special_id);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

        //分类1
        $summary = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 17),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类2
        $life = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 18),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类3
        $travel = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 23),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        $data = array(
            'catalog_id'   => $catalog_id,
            'special_news' => $special_news[0],
            'more_news'    => $more_news,
            'instant'      => $instant,
            'canada_news'  => $canada_news,
            'summary'      => $summary,
            'life'         => $life,
            'travel'       => $travel,
            'pages'        => $pager
        );
        $this->render('canada_news2', $data);
    }


public function actionCanadaNews3(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $catalog_id = Yii::app()->request->getQuery('catalog_id', 19);

        $special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $special_id = $special_news[0]->id;

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
        $criteria->addCondition('id!='.$special_id);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

        //分类1
        $summary = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 19),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类2
        $life = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 20),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类3
        $travel = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 24),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        $data = array(
            'catalog_id'   => $catalog_id,
            'special_news' => $special_news[0],
            'more_news'    => $more_news,
            'instant'      => $instant,
            'canada_news'  => $canada_news,
            'summary'      => $summary,
            'life'         => $life,
            'travel'       => $travel,
            'pages'        => $pager
        );
        $this->render('canada_news3', $data);
    }
		
		
			public function actionCanadaNews4(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $catalog_id = Yii::app()->request->getQuery('catalog_id', 21);

        $special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $special_id = $special_news[0]->id;

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
        $criteria->addCondition('id!='.$special_id);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

        //分类1
        $summary = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 21),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类2
        $life = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 22),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        //分类3
        $travel = Post::model()->findAll(array(
            'select'    => 'id, title',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 25),
            'order'     => 'id DESC',
            'limit'     => 5
        ));

        $data = array(
            'catalog_id'   => $catalog_id,
            'special_news' => $special_news[0],
            'more_news'    => $more_news,
            'instant'      => $instant,
            'canada_news'  => $canada_news,
            'summary'      => $summary,
            'life'         => $life,
            'travel'       => $travel,
            'pages'        => $pager
        );
        $this->render('canada_news4', $data);
    }
		
		
    public function actionHouseNews(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $catalog_id = Yii::app()->request->getQuery('catalog_id', 11);
        $special_news = Post::model()->findAll(array(
            'select'    => 'id, title, summary',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => $catalog_id),
            'order'     => 'id DESC',
            'limit'     => 1
        ));
        $special_id = $special_news[0]->id;

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        if(!empty($catalog_id)){
            $criteria->addCondition('catalog_id='.$catalog_id);
        }
        $criteria->addCondition('id!='.$special_id);
        $count = Post::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 30;
        $pager->applyLimit($criteria);
        $more_news = Post::model()->findAll($criteria);

        //房展会
        $exhibition = Post::model()->findAll(array(
            'select'    => 'id, title, image',
            'condition' => 'catalog_id=:catalog_id AND image<>""',
            'params'    => array(':catalog_id' => 10),
            'order'     => 'id DESC',
            'limit'     => 5
        )); //房展会

        //学区房新闻
        $school_distrcit_house_news = Post::model()->findAll(array(
            'select'    => 'id, title',
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
            'limit'     => 5
        ));
		
		
		
	//房产资讯
        $house_zixun = Post::model()->findAll(array(
            'select'    => 'id, title, create_time,last_update_time',
            'condition' => 'catalog_id = :catalog_id',
            'params'     => array(':catalog_id' => 10),
            'order'     => 'id DESC',
            'limit'     => 5
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
            'limit'     => 5
        ));

        //最新学区房
        $school_distrcit_house = House::model()->findAll(array(
            'select'    => 'id, name, house_image',
            'condition' => 'investType_id = :investType_id',
            'params'    => array(':investType_id' => 1),
            'order'     => 'id DESC',
            'limit'     => 3
        ));

        $data = array(
            'catalog_id'                  => $catalog_id,
            'special_news'                => $special_news[0],
            'more_news'                   => $more_news,
            'exhibition'                  => $exhibition,
            'school_distrcit_house_news'  => $school_distrcit_house_news,
            'house_hotspots'              => $house_hotspots,
			'house_zixun'              => $house_zixun,
            'house_property_special_news' => $house_property_special_news[0],
            'house_property'              => $house_property,
            'school_distrcit_house'       => $school_distrcit_house,
            'pages'                       => $pager
        );
        $this->render('house_news', $data);

    }

    public function actionCanadaNewsView(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $id = Yii::app()->request->getQuery('id');
        $post = Post::model()->findByPk($id);
        if($post->catalog->parent_id == 0){
            $this->redirect(array('studyabroad/view', 'id'=>$post->id));
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
        $this->render('canada_news_view', array(
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
    }
		
		 public function actionCanadaNewsView2(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $id = Yii::app()->request->getQuery('id');
        $post = Post::model()->findByPk($id);
        if($post->catalog->parent_id == 0){
            $this->redirect(array('studyabroad/view', 'id'=>$post->id));
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
        $this->render('canada_news_view', array(
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
    }


public function actiontagNews(){
 $this->render('tagNews');
}


    public function actionHouseNewsView(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/post.css');
        $id = Yii::app()->request->getQuery('id');
        $post = Post::model()->findByPk($id);
        if($post->catalog->parent_id == 0){
            $this->redirect(array('studyabroad/view', 'id'=>$post->id));
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
        $this->render('house_news_view', array(
            'post'      => $post,
            'prev_post' => $prev_post[0],
            'next_post' => $next_post[0]
        ));
    }
}