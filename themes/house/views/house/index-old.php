<!-- 地址开始 -->
<div class="cl"></div>
<div class="nytb_dz">
    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a> > <span>房源搜索</span>
</div>
<!-- 地址结束 -->
<!-- 房源搜索开始 -->
<div class="fyss">
    <div class="fyss_tab">
        <div class="fyss_tablist fyss_tablist_cur"><a href="javascript:void(0);">条件搜索</a></div>
        <div class="fyss_tablist"><a href="javascript:" onclick="mapSelect();" data-index="3">地图选房</a></div>
        <div class="cl"></div>
    </div>
    <div class="fyss_tj">
        <div class="fyss_tjlist" id="cd1">
            <div class="fyss_tjlistleft">城&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市:</div>
            <div class="fyss_tjlistcenter"><a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => 0, 'cd2' => 0, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" class="fyss_tj_cur" data-index="0">不限</a></div>
            <div class="fyss_tjlistright fyss_tjlistone"  style="position:relative; overflow:hidden; height:28px;">
              
               <?php foreach ($city_list as $city) { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $city['id'], 'cd2' => 0, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="<?php echo $city['id']; ?>">
                        <?php echo $city['name']; ?>
                    </a>
                <?php } ?>
                
             <div class="more_dd">更多</div>

                
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd2">
            <div class="fyss_tjlistleft">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区:</div>
            <div class="fyss_tjlistcenter"><a  class="fyss_tj_cur" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => 0, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="0">不限</a></div>

            <div class="fyss_tjlistright" style="position:relative; overflow:hidden; height:28px;">
                <?php foreach ($district_list as $district) { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $district['id'], 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></a>
                <?php } ?>
             <div class="more_dd">更多</div>
<script>
$(document).ready(function() {
    $(".more_dd").click(function(){
		var gdheight=$(this).parent().height();
		if(gdheight>32){
           $(this).parent().stop(true).animate({height:"28px"});
		   $(this).text("更多").removeClass("more_dd_active");
		}
		else{
		   $(this).parent().stop(true).animate({height:"56px"})
		   $(this).text("收起").addClass("more_dd_active");
			}	
    });
});
</script> 
             
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd3">
            <div class="fyss_tjlistleft">投资类型:</div>
            <div class="fyss_tjlistcenter"><a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => 0, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" class="fyss_tj_cur" data-index="0">不限</a></div>
            <div class="fyss_tjlistright fyss_tjlistone">
                <?php foreach ($investType_list as $investType) { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $investType['id'], 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="<?php echo $investType['id']; ?>"><?php echo $investType['name']; ?></a>
                <?php } ?>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd4">
            <div class="fyss_tjlistleft">物业类型:</div>
            <div class="fyss_tjlistcenter"><a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => 0, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" class="fyss_tj_cur" data-index="0">不限</a></div>
            <div class="fyss_tjlistright fyss_tjlistone">
                <?php foreach ($propertyType_list as $propertyType) { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $propertyType['id'], 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="<?php echo $propertyType['id']; ?>"><?php echo $propertyType['name']; ?></a>
                <?php } ?>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd5">
            <div class="fyss_tjlistleft">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价:</div>
            <div class="fyss_tjlistcenter"><a class="fyss_tj_cur" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 0, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="0" data-value="0,0">不限</a></div>
            <div class="fyss_tjlistright">
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 1, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="1" data-value="0,30">30万以下</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 2, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="2" data-value="30,50">30-50万</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 3, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="3" data-value="50,100">50-100万</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 4, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="4" data-value="100,150">100-150万</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="5" data-value="150,300">150-300万</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 6, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>" data-index="6" data-value="300,0">300万以上</a>
                <span class="syss_dw">加币</span>
                <div class="fyss_tjjg">
                    <div class="fyss_tjjgone"><input name="" type="text" id="num1"/></div>
                    <div class="fyss_tjjgtwo">-</div>
                    <div class="fyss_tjjgone"><input name="" type="text" id="num2"/></div>
                    <div class="fyss_tjjgthree">万加元</div>
                    <div class="fyss_tjjgfour"><a href="javascript:void(0);" id="confirm">确认</a></div>
                </div>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd6">
            <div class="fyss_tjlistleft">房屋面积:</div>
            <div class="fyss_tjlistcenter"><a class="fyss_tj_cur" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 0, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9)); ?>" data-index="0" data-value="0,0">不限</a></div>
            <div class="fyss_tjlistright">
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 1, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="1" data-value="0,1000">1000以下</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 2, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="2" data-value="1000,2000">1000-2000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 3, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="3" data-value="2000,3000">2000-3000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 4, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="4" data-value="3000,4000">3000-4000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 5, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="5" data-value="4000,0">4000以上</a>
                <span class="syss_dw">平方英尺</span>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist" id="cd7">
            <div class="fyss_tjlistleft">土地面积:</div>
            <div class="fyss_tjlistcenter"><a class="fyss_tj_cur" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 0, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="0" data-value="0,0">不限</a></div>
            <div class="fyss_tjlistright">
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 1, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="1" data-value="0,1000">1000以下</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 2, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="2" data-value="1000,2000">1000-2000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 3, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="3" data-value="2000,3000">2000-3000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 4, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="4" data-value="3000,4000">3000-4000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 5, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="5" data-value="4000,5000">4000-5000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 6, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="6" data-value="5000,6000">5000-6000</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="7" data-value="6000,0">6000以上</a>
                <span class="syss_dw">平方英尺</span>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist">
            <div class="fyss_tjlistleft">更多条件:</div>
            <div class="fyss_tjlistmore">
                <div class="syss_xltj" id="cd8">
                    <div class="syss_xltjup" id="cd8_selected" data-index="0">卧室数量</div>
                    <div class="syss_xltjdown">
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 0, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="0">不限</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 1, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="1">1室</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 2, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="2">2室</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 3, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="3">3室</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 4, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="4">4室</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 5, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="5">5室</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 6, 'cd9' => $cd9, 'cd10' => $cd10)); ?>" data-index="6">5室以上</a>
                    </div>
                </div>
                <div class="syss_xltj" id="cd9">
                    <div class="syss_xltjup" id="cd9_selected" data-value="0,0">建造年份</div>
                    <div class="syss_xltjdown">
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 0, 'cd10' => $cd10)); ?>" data-index="0">不限</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 1, 'cd10' => $cd10)); ?>" data-index="1">1970之前</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 2, 'cd10' => $cd10)); ?>" data-index="2">1971-1980</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 3, 'cd10' => $cd10)); ?>" data-index="3">1981-1990</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 4, 'cd10' => $cd10)); ?>" data-index="4">1991-2000</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 5, 'cd10' => $cd10)); ?>" data-index="5">2001-2005</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 6, 'cd10' => $cd10)); ?>" data-index="6">2006-2010</a>
                        <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 7, 'cd10' => $cd10)); ?>" data-index="7">2011之后</a>
                    </div>
                </div>
            </div>
            <div class="cl"></div>
        </div>
        <div class="fyss_tjlist">
            <div class="fyss_tjlistleft">搜索条件:</div>
            <div class="fyss_tjqr" id="selected"></div>
            <div class="fyss_tjsc" id="clear_selected"><a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => 0, 'cd2' => 0, 'cd3' => 0, 'cd4' => 0, 'cd5' => 0, 'cd6' => 0, 'cd7' => 0, 'cd8' => 0, 'cd9' => 0, 'cd10' => 0)); ?>">删除条件</a></div>
            <div class="cl"></div>
        </div>
    </div>
</div>

<div class="syss_picone"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/b_4.jpg" /></div>
<!-- 房源搜索结束 -->
<!-- 房源列表开始 -->
<a name="topwz"></a>
<div class="syss_jg">
    <div class="syss_jg_left">
        <div class="syss_px">
            <?php
            if (!empty($time_sort)) {
                if ($time_sort == 'DESC') {
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 'ASC')); ?>#topwz" class="pxfs1">时间</a>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 0, 'price_sort' => 'DESC')); ?>#topwz">总价</a>
    <?php } else { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 'DESC')); ?>#topwz" class="pxfs2">时间</a>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 0, 'price_sort' => 'DESC')); ?>#topwz">总价</a>
                <?php } ?>
            <?php
            } elseif (!empty($price_sort)) {
                if ($price_sort == 'DESC') {
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 'DESC')); ?>#topwz">时间</a>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 0, 'price_sort' => 'ASC')); ?>#topwz" class="pxfs1">总价</a>
                <?php } else { ?>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 'DESC')); ?>#topwz">时间</a>
                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 0, 'price_sort' => 'DESC')); ?>#topwz" class="pxfs2">总价</a>
    <?php } ?>
            <?php } else { ?>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 'DESC')); ?>#topwz">时间</a>
                <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10, 'time_sort' => 0, 'price_sort' => 'DESC')); ?>#topwz">总价</a>
<?php } ?>
            <div class="syss_pxtwo"></div>
            <div class="syss_pxthree">找到<?php echo $count; ?>个符合条件的楼盘</div>
            <div class="cl"></div>
        </div>
<?php foreach ($house_list as $house) { ?>
            <div class="syss_fclist">

                <div class="syss_fclist_left">                <a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $house->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $house->house_image; ?>" width="261" height="307" /></a></div>
                <div class="syss_fclist_right">
                    <div class="syss_zt"><?php if ($house->is_sell == 1) {
        echo '在售';
    } else {
        echo '<font color="#0000FF">停售</font>';
    } ?></div> 
                    <div class="syss_fcone"><a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $house->id)); ?>" target="_blank">MLS：<?php echo $house->mls_code; ?></a></div>
                    <div class="syss_fctwo"><a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $house->id)); ?>" target="_blank"><?php echo $house->name; ?></a></div>
                    <div class="syss_fcthree">
                        <?php
                        $image_list = unserialize($house->image_list);
                        $image_num = count($image_list) > 3 ? 3 : count($image_list);
                        for ($i = 0; $i < $image_num; $i++) {
                            ?>
                            <div class="syss_fcthree_pic"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $image_list[$i]['file']; ?>" width="92" height="73" /></div>
                            
    <?php } ?>
                        <div class="cl"></div>
                    </div>
                    <div class="syss_fcfour">
                        <div class="syss_fcfour_one" style="color:grey">房屋面积：<?php echo $house->house_area; ?>平方英尺</div>
                        <div class="syss_fcfour_one" style="color:grey">类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：<?php echo $house->propertyType->name; ?>&nbsp;/&nbsp;<?php echo $house->investType->name; ?></div>
                        <div class="syss_fcfour_one" style="color:grey">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：<?php echo $house->district->name; ?></div>
                        <div class="syss_fcfour_one" style="color:grey">总&nbsp;金&nbsp;额：<span><?php echo $house->total_price; ?>万加币</span></div>
                    </div>
                    
                    <div class="syss_fcfive">
                        <div class="syss_fcfiveone">
                            <span  class="syss_fc_fj"><?php echo $house->bedroom_num; ?></span>
                            <span  class="syss_fc_cs"><?php echo $house->toilet_num; ?></span>
                        </div>
                        <div class="syss_fcfivetwo">
                            <a href="javascript:void(0);" class="syss_fc_sc <?php if (in_array($house->id, $collection_list)) {
        echo 'collected';
    } ?>" data-id="<?php echo $house->id; ?>">收藏</a>
                            <a href="javascript:void(0);" class="syss_fc_db" id="<?php echo $house->id; ?>" data-img="<?php echo $house->house_image; ?>">对比</a>
                        </div>
                        <div class="syss_fcfivethree"><a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $house->id)); ?>#fydt" target="_blank">查看地图</a></div>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
            <?php } ?>
        <div class="cl"></div>
        <div class="page">
            <?php
            $this->widget('CLinkPager', array(
                'header' => '',
                'firstPageLabel' => '',
                'lastPageLabel' => '',
                'prevPageLabel' => '<<',
                'nextPageLabel' => '>>',
                'pages' => $pages,
                'maxButtonCount' => 6,
                'cssFile' => 'themes/house/css/pager.css'
            ));
            ?>
        </div>
    </div>

    <div class="syss_jg_right">
<?php $this->widget('application.widget.bagecms.EvaluateWidget'); ?>
    </div>
    <div class="cl"></div>
</div>
<!-- 房源列表结束 -->
<!-- 对比开始 -->
<div class="duibi">
    <div class="duibi_left"></div>
    <div class="duibi_right">
        <div class="duibi_right_up">
        </div>
        <div class="cl"></div>
        <div class="duibi_right_down">
            <a href="javascript:void(0);" id="compare">对比</a>
        </div>
    </div>
</div>
<!-- 对比结束 -->
<script type="text/javascript">
    //搜索条件下拉
    $(document).ready(function() {
        var compare = []; //对比

        var cd1 = <?php echo $cd1; ?>;
        var cd2 = <?php echo $cd2; ?>;
        var cd3 = <?php echo $cd3; ?>;
        var cd4 = <?php echo $cd4; ?>;
        var cd5 = <?php echo $cd5; ?>;
        var cd6 = <?php echo $cd6; ?>;
        var cd7 = <?php echo $cd7; ?>;
        var cd8 = <?php echo $cd8; ?>;
        var cd9 = <?php echo $cd9; ?>;
        var cd10 = '<?php echo $cd10; ?>';
        var diy_price = <?php echo $diy_price; ?>;

        if (cd1 == 0 && cd2 == 0 && cd3 == 0 && cd4 == 0 && cd5 == 0 && cd6 == 0 && cd7 == 0 && cd8 == 0 && cd9 == 0 && parseInt(cd10) == 0)
            $("#clear_selected").hide();

        var cd1_text = $("#cd1").find("[data-index=" + cd1 + "]").text();
        var cd2_text = $("#cd2").find("[data-index=" + cd2 + "]").text();
        var cd3_text = $("#cd3").find("[data-index=" + cd3 + "]").text();
        var cd4_text = $("#cd4").find("[data-index=" + cd4 + "]").text();
        var cd5_text = $("#cd5").find("[data-index=" + cd5 + "]").text();
        var cd6_text = $("#cd6").find("[data-index=" + cd6 + "]").text();
        var cd7_text = $("#cd7").find("[data-index=" + cd7 + "]").text();
        var cd8_text = $("#cd8").find("[data-index=" + cd8 + "]").text();
        var cd9_text = $("#cd9").find("[data-index=" + cd9 + "]").text();

        $("#cd1").find("a").removeClass('fyss_tj_cur');
        $("#cd1").find("[data-index=" + cd1 + "]").addClass('fyss_tj_cur');

        $("#cd2").find("a").removeClass('fyss_tj_cur');
        $("#cd2").find("[data-index=" + cd2 + "]").addClass('fyss_tj_cur');

        $("#cd3").find("a").removeClass('fyss_tj_cur');
        $("#cd3").find("[data-index=" + cd3 + "]").addClass('fyss_tj_cur');

        $("#cd4").find("a").removeClass('fyss_tj_cur');
        $("#cd4").find("[data-index=" + cd4 + "]").addClass('fyss_tj_cur');

        $("#cd5").find("a").removeClass('fyss_tj_cur');
        $("#cd5").find("[data-index=" + cd5 + "]").addClass('fyss_tj_cur');

        $("#cd6").find("a").removeClass('fyss_tj_cur');
        $("#cd6").find("[data-index=" + cd6 + "]").addClass('fyss_tj_cur');

        $("#cd7").find("a").removeClass('fyss_tj_cur');
        $("#cd7").find("[data-index=" + cd7 + "]").addClass('fyss_tj_cur');

        if (cd8)
            $("#cd8_selected").text(cd8_text);

        if (cd9)
            $("#cd9_selected").text(cd9_text);

        if (cd1)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => 0, 'cd2' => 0, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd1_text + '</a>');
        if (cd2)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => 0, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd2_text + '</a>');
        if (cd3)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => 0, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd3_text + '</a>');
        if (cd4)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => 0, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd4_text + '</a>');
        if (cd5)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 0, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>">' + cd5_text + '</a>');
        if (cd6)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => 0, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd6_text + '</a>');
        if (cd7)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => 0, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd7_text + '</a>');
        if (cd8)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => 0, 'cd9' => $cd9, 'cd10' => $cd10)); ?>">' + cd8_text + '</a>');
        if (cd9)
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => $cd5, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => 0, 'cd10' => $cd10)); ?>">' + cd9_text + '</a>');
        if (typeof diy_price == 'object') {
            if (!diy_price[0]) {
                cd10 = diy_price[1] + '以下';
            } else if (!diy_price[1]) {
                cd10 = diy_price[0] + '以上';
            } else {
                cd10 = cd10 + '万';
            }
            $("#selected").append('<a class="fyss_qrtj_list" href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $cd1, 'cd2' => $cd2, 'cd3' => $cd3, 'cd4' => $cd4, 'cd5' => 0, 'cd6' => $cd6, 'cd7' => $cd7, 'cd8' => $cd8, 'cd9' => $cd9, 'cd10' => 0)); ?>">' + cd10 + '</a>');
        }

        $("#confirm").click(function() {
            var num1 = $("#num1").val();
            var num2 = $("#num2").val();
            var cd10 = undefined;
            if (num1 || num2) {
                cd10 = num1 + '-' + num2;
            } else {
                cd10 = 0;
            }
            window.location.href = "<?php echo Yii::app()->createUrl('house/index'); ?>&cd1=<?php echo $cd1; ?>&cd2=<?php echo $cd2; ?>&cd3=<?php echo $cd3; ?>&cd4=<?php echo $cd4; ?>&cd5=0&cd6=<?php echo $cd6; ?>&cd7=<?php echo $cd7; ?>&cd8=<?php echo $cd8; ?>&cd9=<?php echo $cd9; ?>&cd10=" + cd10;
        });

        $(".syss_xltj").mouseover(function() {
            $(this).find(".syss_xltjdown").show();
        });
        $(".syss_xltj").mouseout(function() {
            $(this).find(".syss_xltjdown").hide();

        });

        //评估报告
        $(".grtzone").mouseover(function() {
            $(this).find(".grtzonedown").show()
        });
        $(".grtzone").mouseout(function() {
            $(this).find(".grtzonedown").hide()
        });

        $(".grtzonedown a").click(function() {
            var cs = $(this).text();
            $(this).parent().parent().prev().val(cs);
        });
        $(".grtzone").mouseout(function() {
            $(this).find(".grtzonedown").hide()
        });

        //加入收藏
        $(".syss_fc_sc").click(function() {
            var self = $(this);
            var id = self.attr('data-id');
            $.post('<?php echo Yii::app()->createUrl('house/collection'); ?>', {'id': id}, function(json) {
                if (json.status == 200) {
                    alert(json.msg);
                    self.addClass("collected");
                } else if (json.status == 404) {
                    alert(json.msg);
                    window.location.href = "<?php echo Yii::app()->createUrl('site/login', array('original' => Yii::app()->request->getUrl())); ?>";
                } else {
                    alert(json.msg);
                }
            }, 'json');

        });

        //弹出收回
        $(".duibi_left").click(function() {
            var right = $(this).parent().css("right");
            if (right < "0px") {
                $(this).addClass("duibi_left_two");
                $(".duibi").animate({right: "0px"});
            } else {
                $(this).removeClass("duibi_left_two");
                $(".duibi").animate({right: "-185px"});
            }
        });

        //对比添加
        $(".syss_fc_db").click(function() {
            var self = $(this);
            self.addClass("compared");
            var sz = self.parent().parent().parent().parent().index();
            $(".duibi").animate({right: "0px"});
            var lj = self.attr('data-img');
            var data_id = self.attr('id');
            var length = $(".duibi_list").size();
            if ($(this).hasClass("syss_fc_db_two")) {
                alert("已经添加过了");
            } else {
                if (length <= 3) {
                    $(".duibi_right_up").append("<div class='duibi_list'><img class='duibiimg' src='" + lj + "' /><span data-id='" + data_id + "'>" + sz + "</span></div>");
                    compare.push(data_id);
                    $(this).addClass("syss_fc_db_two");
                }
                else {
                    alert("一次最多只能对比4个房源");
                }
            }
        });

        //删除
        $(".duibi_right_up").on("mouseover", ".duibi_list", function() {
            $(this).find("span").show();
        });
        $(".duibi_right_up").on("mouseout", ".duibi_list", function() {
            $(this).find("span").hide();
        });
        $(".duibi_right_up").on("click", "span", function() {
            var self = $(this);
            var data_id = self.attr('data-id');
            var compare_btn = $('#' + data_id + '');
            var ele = self.parent();
            var compareCount = compare.length;
            for (var i = 0; i < compareCount; i++) {
                if (parseInt(compare[i]) == data_id) {
                    compare.splice(i, 1);
                    break;
                }
            }
            ele.remove();
            compare_btn.removeClass('compared');
            compare_btn.removeClass('syss_fc_db_two');
        });

        $("#compare").click(function() {
            var length = $(".duibi_list").size();
            if (length > 0) {
                window.open('<?php echo Yii::app()->createUrl('house/compare'); ?>&id=' + compare);
            } else {
                alert('您还没有选择对比房源');
            }
        });
    });
    
    //地图互通
    function mapSelect() {
        //city_id
        var cd1 = $('#cd1 .fyss_tj_cur').attr('data-index');
        //distirct_id
        var cd2 = $('#cd2 .fyss_tj_cur').attr('data-index');
        //房屋类型
        var cd4 = $('#cd4 .fyss_tj_cur').attr('data-index');
        //总价
        var cd5 = $('#cd5 .fyss_tj_cur').attr('data-value');
        var cd10 = '<?php echo !empty($cd10) ? str_replace('-', ',' ,$cd10) : 0; ?>';
        if(cd10 && cd10 != 0){
            cd5 = cd10;
        }
        //土地面积
        var cd7 = $('#cd7 .fyss_tj_cur').attr('data-value');
        //卧室数量
        var cd8 = <?php echo $cd8; ?>;
        //建造年份
        var cd9 = <?php echo $cd9; ?>;
        if(cd9 == 0){
            cd9 = '0,0';
        }else if(cd9 == 1){
            cd9 = '0,1970';
        }else if(cd9 == 2){
            cd9 = '1971,1980';
        }else if(cd9 == 3){
            cd9 = '1981,1990';
        }else if(cd9 == 4){
            cd9 = '1991,2000';
        }else if(cd9 == 5){
            cd9 = '2001,2005';
        }else if(cd9 == 6){
            cd9 = '2006,2010';
        }else if(cd9 == 7){
            cd9 = '2011,0';
        }
        var url = '<?php echo Yii::app()->createUrl("map/index"); ?>&cd1='+cd1+'&cd2='+cd2+'&cd4='+cd4+'&cd5='+cd5+'&cd7='+cd7+'&cd8='+cd8+'&cd9='+cd9;
        window.open(url);
    }
</script>