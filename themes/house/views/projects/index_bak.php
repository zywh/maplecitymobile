    <div class="enjoy_hzjs_up">
        <div id="tour" class="zebra">
            <div class="wrap">
                <div class="switcher-wrap slider">
                    <a class="prev jQ_sliderPrev" href=""></a>
                    <a class="next jQ_sliderNext" href=""></a>
                    <ul id="img-slider" style="height:508px;">
                        <?php foreach($hot_house as $obj){ ?>
                            <li class="img"><a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $obj->id)); ?>" target="_blank" title="<?php echo $obj->name; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->house_image; ?>"/></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!-- 豪宅鉴赏结束 -->
<script type="text/javascript">
    //豪宅列表
    $(document).ready(function(){
//热门推荐头部
        $(".enjoydowncont .enjoy_xxym:eq(0)").show();
        $(".enjoydown_hzjs_tab span").click(function(){
            var k=$(this).index();
            $('.enjoydowncont .enjoy_xxym:eq('+k+')').show().siblings().hide();
            $(this).addClass("spanon").siblings().removeClass("spanon");
        });

        $(".enjoy_xxym_pic_down").find(".enjoy_js_list:eq(0)").show();
        $(".enjoy_xxym_pic_up a").mouseover(function(){
            var r=$(this).index();
            $(this).parent().next().find('.enjoy_js_list:eq('+r+')').show().siblings().hide();
            $(this).addClass("enjoy_xxym_pic_on").siblings().removeClass("enjoy_xxym_pic_on");
        });
    });
</script>