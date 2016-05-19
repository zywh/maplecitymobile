<!-- 地址开始 -->

<!-- 地址结束 -->
<!-- Projects List 开始 -->
<div class="enjoy">

    <div class="enjoydown">
        <div class="enjoydownlabel">
            <div class="enjoydownlabel_left">项目推荐<span> Recommended Projects</span></div>
        </div>
		
        <div class="enjoydowncont">
          
            <div class="enjoydown_two">
                <?php foreach($subject_list as $project){ ?>
                <div class="enjoydown_list">
                    <div class="enjoydown_list_pic">
                       <a data-ajax="false" href="<?php echo Yii::app()->createUrl('projects/more',array('id'=>$project->id)); ?>" > <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $project->room_type_image; ?>" > </a>
                    </div>
                    <div class="enjoydown_list_info">
                         <span class="enjoy_dz">项目名称：<?php echo $project->name; ?></span>
                        <span class="enjoy_dz"> 开发商：<i><?php echo $project->developer_intro; ?></i></span>
						  <span class="enjoy_dz"> 城 市：<i><?php echo $project->cityname; ?></i></span>
                    </div>
      
                </div>
                <?php } ?>
              
                <div class="page">
                    <?php
                    $this->widget('CLinkPager',array(
                        'header'         =>'',
                        'firstPageLabel' => '',
                        'lastPageLabel'  => '',
                        'prevPageLabel'  => '<<',
                        'nextPageLabel'  => '>>',
                        'pages'          => $pages,
                        'maxButtonCount' => 4,
                        'cssFile'        => 'themes/house/css/pager.css'
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 豪宅鉴赏结束 -->
