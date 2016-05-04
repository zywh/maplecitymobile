<!-- 地址开始 -->
<div class="cl"></div>
<div class="nytb_dz">
    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a> > <a href="<?php echo Yii::app()->createUrl('hotrecommend/index'); ?>">热点推荐</a> > <span>更多-<?php echo $cur_city->name; ?></span>
</div>
<!-- 地址结束 -->
<!-- 豪宅鉴赏开始 -->
<div class="enjoy">
    <div class="enjoyup">
        <div class="enjoyup_tab">
            <div class="enjoyup_tabup">
                <?php $num = count($subject_list);
                foreach($subject_list as $k => $obj){
                    if($k == 0){
                        ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$obj->city_id)); ?>" data-index="<?php echo $obj->city_id; ?>"><?php echo $obj->city->name; ?></a>|
                    <?php }elseif(($k + 1) == $num){ ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$obj->city_id)); ?>" data-index="<?php echo $obj->city_id; ?>"><?php echo $obj->city->name; ?></a>
                    <?php }else{ ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$obj->city_id)); ?>" data-index="<?php echo $obj->city_id; ?>"><?php echo $obj->city->name; ?></a>|
                    <?php }} ?>
            </div>
            <div class="enjoyup_tabdown">
                <div class="enjoy_tabcont"><?php echo $cur_city->describe; ?></div>
                <div class="cl"></div>
            </div>
        </div>
    </div>
    <div class="enjoydown">
        <div class="enjoydownlabel">
            <div class="enjoydownlabel_left">热点推荐<span> Hot Recommend</span></div>
            <div class="enjoydownlabel_right">
                <span>排序方式</span>
                <?php if(!empty($time_sort)){
                        if($time_sort == 'DESC'){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort'=>'ASC')); ?>" class="pxfs1">时间</a>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort' => 0, 'price_sort'=>'DESC')); ?>">总价</a>
                    <?php }else{ ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort'=>'DESC')); ?>" class="pxfs2">时间</a>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort' => 0, 'price_sort'=>'DESC')); ?>">总价</a>
                    <?php } ?>
                <?php }elseif(!empty($price_sort)){
                    if($price_sort == 'DESC'){
                        ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort'=>'DESC')); ?>">时间</a>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort' => 0, 'price_sort'=>'ASC')); ?>" class="pxfs1">总价</a>
                    <?php }else{ ?>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort'=>'DESC')); ?>">时间</a>
                        <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort' => 0, 'price_sort'=>'DESC')); ?>" class="pxfs2">总价</a>
                    <?php } ?>
                <?php }else{ ?>
                    <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort'=>'DESC')); ?>">时间</a>
                    <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$cur_city->id, 'time_sort' => 0, 'price_sort'=>'DESC')); ?>">总价</a>
                <?php } ?>
            </div>
        </div>
        <div class="enjoydowncont">
            <div class="enjoydown_one">共有<?php echo $count; ?>套房产</div>
            <div class="enjoydown_two">
                <?php foreach($house_list as $house){ ?>
                <div class="enjoydown_list">
                    <div class="enjoydown_list_pic">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $house->house_image; ?>" width="485" height="355"/>
                    </div>
                    <div class="enjoydown_list_info" style="display:block;">
                        <span class="enjoy_dz">地址：<?php echo $house->location; ?></span>
                        <span class="enjoy_zj">总价：<i><?php echo $house->total_price; ?></i>万加币</span>
                    </div>
                    <div class="enjoydown_list_xx" style="display:none;">
                        <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$house->id)); ?>" target="_blank">
                            <span class="titlespan">MSL:<?php echo $house->mls_code; ?></span>
                            <span style="height: 120px; overflow: hidden;">
                                简介<br /><?php echo strip_tags($house->introduction); ?>
                            </span>
                            <span>
                                 地址<br /><?php echo $house->location; ?>
                            </span>
                            <span>
                                 总价<br /><i><?php echo $house->total_price; ?></i>万加币
                            </span>
                        </a>
                    </div>
                </div>
                <?php } ?>
                <div class="cl"></div>
                <div class="page">
                    <?php
                    $this->widget('CLinkPager',array(
                        'header'         =>'',
                        'firstPageLabel' => '',
                        'lastPageLabel'  => '',
                        'prevPageLabel'  => '<<',
                        'nextPageLabel'  => '>>',
                        'pages'          => $pages,
                        'maxButtonCount' => 6,
                        'cssFile'        => 'themes/house/css/pager.css'
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 豪宅鉴赏结束 -->
<script type="text/javascript">
    //豪宅列表
    $(document).ready(function(){
        $(".enjoyup_tabup").find('[data-index="<?php echo $cur_city->id; ?>"]').addClass('spanon');
        
        $(".enjoydown_list").mouseover(function(){
            $(this).find('.enjoydown_list_info').hide();
            $(this).find('.enjoydown_list_xx').show();
        });
        $(".enjoydown_list").mouseout(function(){
            $(this).find('.enjoydown_list_info').show();
            $(this).find('.enjoydown_list_xx').hide();
        });

    });
</script>