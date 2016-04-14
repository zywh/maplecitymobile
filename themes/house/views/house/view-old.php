<!-- 地址开始 -->
<div class="cl"></div>
<div class="nytb_dz">
    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a> > <a href="<?php echo Yii::app()->createUrl('house/index'); ?>">房源搜索</a> > <span>详情页面</span>
</div>
<!-- 地址结束 -->
<!-- 房源详情页面开始 -->
<div class="fyxq">
    <div class="cl"></div>
    <div class="fyxqup">
        <div class="fyxqupleft">
            <div class="fyxq_tab">
                <a class="fyxq_tab_tp fyxq_tab_cur" href="#">图片</a>
                <a class="fyxq_tab_sp" href="#">视频</a>
                <a href="#fydt" onclick="streetmap(1);">街景</a>
                <a href="#fydt" onclick="daolumap();">地图</a>
                <div class="cl"></div>
            </div>
            <div class="fyxq_tab_cont">
                <div class="diflash">
                    <div class="diflashup">
                        <?php
                        $image_list = unserialize($house->image_list);
                        $image_num = count($image_list);
                        for ($i = 0; $i < $image_num; $i++) {
                            ?>
                            <?php if ($i == 0) { ?>
                                <span class="a_cur"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $image_list[$i]['file']; ?>" width="573" height="327" /></span>
                            <?php } else { ?>
                                <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $image_list[$i]['file']; ?>" width="573" height="327" /></span>
                            <?php }
                        } ?>
                    </div>
                    <div class="diflashdown">
                        <div class="diflashdown_gd">
                            <?php
                            $image_list = unserialize($house->image_list);
                            $image_num = count($image_list);
                            for ($i = 0; $i < $image_num; $i++) {
                                ?>
                                <?php if ($i == 0) { ?>
                                    <span class="span_cur"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $image_list[$i]['file']; ?>" width="123" height="73" /></span>
                                <?php } else { ?>
                                    <span><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $image_list[$i]['file']; ?>" width="123" height="73" /></span>
    <?php }
} ?>
                        </div>
                    </div>
                    <div class="dlflash_btn">
                        <div class="prev-btn"><</div>
                        <div class="next-btn">></div>
                    </div>
                </div>
                <div class="fyxq_tab_cont_sp">
                    <div class="videocont" id="video_wrap" style="width:573px; height:413px"></div>
                </div>
            </div>
        </div>
        <div class="fyxqupright">
            <div class="fyxqupright_titile">MLS：<?php echo $house->mls_code; ?></div>
            <div class="fyxqupright_btn">
                <a href="javascript:;" class="syss_fc_sc collection <?php if (in_array($house->id, $collection_list)) {
    echo 'collected';
} ?>" data-id="<?php echo $house->id; ?>">加入收藏</a>
            </div>
            <div class="cl"></div>
            <div class="fyxqupright_cont">
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">价格：</div>
                    <div class="fyxq_ptssright"><?php echo $house->total_price; ?>万加币<?php if (!empty($exchangeRate)) { ?>&nbsp;<span>(约<i><?php echo number_format($house->total_price * floatval($exchangeRate), 2); ?></i>万人民币）</span><?php } ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">地址：</div>
                    <div class="fyxq_ptssright"><?php echo $house->location; ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft"><?php if ($house->investType_id == 1) {
    echo '学区';
} else {
    echo '社区';
} ?>：</div>
                    <div class="fyxq_ptssright"><?php echo $house->community; ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">户型：</div>
                    <div class="fyxq_ptssright"><?php echo $house->bedroom_num; ?>卧&nbsp;&nbsp;<?php echo $house->toilet_num; ?>卫&nbsp;&nbsp;<?php echo $house->kitchen_num; ?>厨</span></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">配套：</div>
                    <div class="fyxq_ptssright fyxq_ptpd">
                        <?php
                        $house_match = explode(',', $house->match);
                        foreach ($matches as $match) {
                            if (in_array($match['id'], $house_match)) {
                                ?>
                                <span class="fyxq_ptss_you"><?php echo $match['name']; ?></span>
    <?php } else { ?>
                                <span><?php echo $match['name']; ?></span>
    <?php }
} ?>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
            <div class="fyxq_up_right_pic"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/pic34.jpg" /></div>
        </div>
        <div class="cl"></div>
    </div>
    <div class="fyxqdown">
        <div class="fyxqdown_left">
            <div class="xxlb_box">
                <div class="fyxqdown_left_title">
                    <a class="fyxqdown_left_cur" href="javascript:void(0);">详情列表</a>
                    <a href="#fwbj">房屋布局</a>
                    <a href="#fyms">房源描述</a>
                    <a href="#fytp">房源图片</a>
                    <a href="#fjfy">附近房源</a>
                    <a href="#rdfy">热点房源</a>
                    <a href="#fydt">房源地图</a>
                    <span class="dlh_btn">英尺 > 米</span>
                    <div class="cl"></div>
                </div>
                
<script language="javascript" type="text/javascript">
$(function(){

		var a1 = $(".s1").html();
		var a2 = $(".s2").html();
		var a3 = $(".s3").html();
	$(".dlh_btn").click(function(){
	
		function decimal(num,v){
		var vv = Math.pow(10,v);
		return Math.round(num*vv)/vv;
		}

        if($(this).hasClass("dlh_active"))
		{
			$(".s1").text(a1);
			$(".s2").text(a2);
			$(".s3").text(a3);
			$(".c1").html("平方英尺")
			$(".c2").html("平方英尺")
			$(".c3").html("英尺")
		   $(this).text("英尺 > 米");
           $(this).removeClass("dlh_active");
	   } 
	   else{
			var b1=decimal(a1*0.09290304,2);
			var b2=decimal(a2*0.09290304,2);
			var b3=decimal(a3*0.3048,2);
			$(".s1").text(b1);
			$(".s2").text(b2);
			$(".s3").text(b3);
			$(".c1").html("平方米")
			$(".c2").html("平方米")
			$(".c3").html("米")
		   $(this).addClass("dlh_active");
		   $(this).text("米 > 英制");
      }
	})
})
</script>
                
                <div class="fyxqdown_left_cont">
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">物业类型：<?php echo $house->propertyType->name; ?></div>
                        <div class="xqlb_list_right">投资类型：<?php echo $house->investType->name; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">房屋层数：<?php echo $house->floor_num; ?></div>
                        <div class="xqlb_list_right">房屋面积：<span class="s1"><?php echo $house->house_area; ?></span><span class="c1">平方英尺</span></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">土地面积：<span class="s2"><?php echo $house->land_area; ?></span><span class="c2">平方英尺</span></div>
                        <div class="xqlb_list_right">房屋规格：<span class="s3"><?php echo $house->house_size; ?></span><span class="c3">英尺</span></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">卧室数量：<?php echo $house->bedroom_num; ?></div>
                        <div class="xqlb_list_right">卫生间数量：<?php echo $house->toilet_num; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">厨房数量：<?php echo $house->kitchen_num; ?></div>
                        <div class="xqlb_list_right">停车位数量：<?php echo $house->park_num; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">土地所有权：<?php echo $house->land_ownership; ?></div>
                        <div class="xqlb_list_right">认证房源：<?php echo $house->certificate == 1 ? '是' : '否'; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">大门朝向：<?php echo $house->door_direction; ?></div>
                        <div class="xqlb_list_right">建造年份：<?php echo $house->construction_year; ?>&nbsp;年</div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">邮&nbsp;&nbsp;&nbsp;&nbsp;编：<?php echo $house->zipcode; ?></div>
                        <div class="xqlb_list_right">会&nbsp;客&nbsp;厅：<?php echo $house->embassy; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
                        <div class="xqlb_list_left">MLS编号：<?php echo $house->mls_code; ?></div>
                        <div class="xqlb_list_right">停车库：<?php echo $house->carport; ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="xqlb_list">
<?php if ($house->investType_id == 1) { ?>
                            <div class="xqlb_list_left">学&nbsp;&nbsp;&nbsp;&nbsp;区：<?php echo $house->community; ?></div>
                            <div class="xqlb_list_right">项目时间：<?php echo date('Y年m月d日', $house->subject->date); ?></div>
<?php } else { ?>
                            <div class="xqlb_list_left" style="width: 696px;">附近设施：<?php echo $house->facilities; ?></div>
<?php } ?>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
 <a href="javascript:;" name="fwbj" style="text-indent:-99999em; display:block;margin-bottom: -5px;zoom: 1;">1</a>
            <div class="fwbj_box">
            
<script language="javascript" type="text/javascript">
$(function(){

		var p1 = $(".f1_1").html();
		var p2 = $(".f1_2").html();
		var p3 = $(".f1_3").html();
		var p4 = $(".f2_1").html();
		var p5 = $(".f2_2").html();
		var p6 = $(".f2_3").html();
		function decimal(num,v){
		var vv = Math.pow(10,v);
		return Math.round(num*vv)/vv;
		}
	$(".fyxqdown_left_title").on("click",".ss",function(){


        if($(this).hasClass("dlh_active"))
		{
			$(this).removeClass("dlh_active");
			$(".f1_1").text(p1);
			$(".f1_2").text(p2);
			$(".f1_3").text(p3);
			$(".f2_1").text(p4);
			$(".f2_2").text(p5);
			$(".f2_3").text(p6);
			$(".t1").html("长(M)")
			$(".t2").html("宽(M)")
			$(".t3").html("面积(㎡)")
		    $(this).text("米 > 英制");


	   } 
	   else{
		    $(".t1").html("长（英尺）")
			$(".t2").html("宽（英尺）")
			$(".t3").html("面积（平方英尺）")
		    $(this).text("英制 > 米");
		    $(this).addClass("dlh_active");
			

			
			var h1=decimal(p1/0.3048,2);
			var h2=decimal(p2/0.3048,2);
			var h3=decimal(p3/0.09290304,2);
			var h4=decimal(p4/0.3048,2);
			var h5=decimal(p5/0.3048,2);
			var h6=decimal(p6/0.09290304,2);
			$(".f1_1").text(h1);
			$(".f1_2").text(h2);
			$(".f1_3").text(h3);
			$(".f2_1").text(h4);
			$(".f2_2").text(h5);
			$(".f2_3").text(h6);
	



      }
	})
})
</script>             
                <div class="fyxqdown_left_title">
                    <a class="fyxqdown_left_cur" href="javascript:;">房屋布局</a><span class="dlh_btn_2 ss">米 &gt; 英制</span>
                </div>
                <div class="fwbj_cont">
                    <div class="fwbj_contlist">
                        <div class="fwbj_contlist_one">楼层</div>
                        <div class="fwbj_contlist_two">房间</div>
                        <div class="fwbj_contlist_three"><span class="t1">长(M)</span></div>
                        <div class="fwbj_contlist_four"><span class="t2">宽(M)</span></div>
                        <div class="fwbj_contlist_five"><span class="t3">面积(㎡)</span></div>
                        <div class="fwbj_contlist_six">说明</div>
                        <div class="cl"></div>
                    </div>
                    <?php foreach ($layouts as $layout) { ?>
                        <div class="fwbj_contlist">
                            <div class="fwbj_contlist_one"><?php echo $layout->floor; ?></div>
                            <div class="fwbj_contlist_two"><?php echo $layout->room; ?></div>
                            <div class="fwbj_contlist_three"><span class="f1_1"><?php echo $layout->length; ?></span></div>
                            <div class="fwbj_contlist_four"><span class="f1_2"><?php echo $layout->width; ?></span></div>
                            <div class="fwbj_contlist_five"><span class="f1_3"><?php echo $layout->area; ?></span></div>
                            <div class="fwbj_contlist_six"><?php echo $layout->describe; ?></div>
                            <div class="cl"></div>
                        </div>
<?php } ?>
                </div>
            </div>
            <a href="javascript:;" name="fyms" style="text-indent:-99999em; display:block;margin-bottom: -5px;zoom: 1;">1</a>
            <div class="fwbj_box">
                <div class="fyxqdown_left_title">
                    <a class="fyxqdown_left_cur" href="javascript:;">房屋描述</a><div class="cl"></div>
                </div>
                <div class="fwms_cont">
                    <?php echo $house->introduction; ?>
                    <div class="dl_jm_left">
                        <div class="dl_jm_left_info">
                            <div class="dl_jm_left_info_one">如需帮助，请致电</div>
                            <div class="dl_jm_left_info_two">400-870-1029</div>
                            
                        </div>
                        
                        <div class="dl_jm_left_info_right">
                            <div style="margin-top:10px;float: left">&nbsp;&nbsp;或&nbsp;&nbsp;</div>
                            <div class="dl_jm_left_info_three" style="float:right">
														
                                <?php $result = Bagecms::getList('Consult','index_consult'); ?>
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $result[0]['QQ']; ?>&amp;site=qq&amp;menu=yes">在线咨询</a>
                                
                            </div>
                        </div>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
            <a href="javascript:;" name="fytp" style="text-indent:-99999em; display:block;margin-bottom: -5px;zoom: 1;">1</a>
            <div class="fwbj_box">
                <div class="fyxqdown_left_title">
                    <a class="fyxqdown_left_cur" href="javascript:;">房屋图片</a><div class="cl"></div>
                </div>
                <div class="fwms_cont">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $house->house_image; ?>" width="697" height="425"/>
                    <br/><br/>
                     <?php
                        $image_list = unserialize($house->image_list);
												if (!empty($image_list))
												{
                        foreach($image_list as $key => $k){
                     ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $k['file']; ?>" width="697" height="425"/>
                            <br/><br/>
                        <?php 
												}
												}?>

                </div>
            </div>
        </div>
        <div class="fyxqdown_right">
<?php $this->widget('application.widget.bagecms.EvaluateWidget'); ?>
            <div class="ajjsq">
                <div class="ajjsq_title">按揭计算器</div>
                <div class="ajjsq_cont">
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">房屋价格：</div>
                        <div class="ajjsq_left_two"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh.jpg" /></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh2.jpg" /></div>
                        <div class="ajjsq_left_five">$</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">首&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;付：</div>
                        <div class="ajjsq_left_two"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh.jpg" /></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh2.jpg" /></div>
                        <div class="ajjsq_left_five">%</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">首付金额：</div>
                        <div class="ajjsq_left_two"></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"></div>
                        <div class="ajjsq_left_five">$</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">还款年限：</div>
                        <div class="ajjsq_left_two"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh.jpg" /></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh2.jpg" /></div>
                        <div class="ajjsq_left_five">年</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">利&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;率：</div>
                        <div class="ajjsq_left_two"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh.jpg" /></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh2.jpg" /></div>
                        <div class="ajjsq_left_five">%</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">还款周期：</div>
                        <div class="ajjsq_left_two"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh.jpg" /></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/jh2.jpg" /></div>
                        <div class="ajjsq_left_five">$</div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">安省交易税：</div>
                        <div class="ajjsq_left_two"></div>
                        <div class="ajjsq_left_three">
                            <select class="ajjsq_select" name=""></select><br />
                            <input name="" type="text" />
                        </div>
                        <div class="ajjsq_left_four"></div>
                        <div class="ajjsq_left_five"></div>
                        <div class="cl"></div>
                    </div>
                    <div class="ajjsq_list">
                        <div class="ajjsq_left_one">多伦多交易税：</div>
                        <div class="ajjsq_left_two"></div>
                        <div class="ajjsq_left_three"><input name="" type="text" /></div>
                        <div class="ajjsq_left_four"></div>
                        <div class="ajjsq_left_five"></div>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cl"></div>
        <a href="javascript:;" name="fjfy" style="text-indent:-99999em; display:block;margin-bottom:25px;zoom: 1;">1</a>
        <div class="fjfy_box">
            <div class="fyxqdown_left_title">
                <a class="fyxqdown_left_cur" href="javascript:;" >附近房源</a><div class="cl"></div>
            </div>
            <div class="fjfy_box_cont">
                <div class="lm_three_jdt">
                    <div class="lm_jdt_left scroll_btnl fjfy_gd_body_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/left_jt.jpg" /></div>
                    <div class="lm_jdt_center scroll_img" style="width:790px; overflow:hidden; ">
                        <div class="scroll_img_body fjfy_gd_body">
<?php
if (!empty($nearby_houses)) {
    foreach ($nearby_houses as $nearby) {
        ?>
                                    <div class="fjfy_list">
                                        <a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $nearby->id)); ?>" target="_blank" title="<?php echo $nearby->name; ?>">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $nearby->house_image; ?>" width="192" height="250"/>
                                            <span class="fjfy_list_spanone"><?php echo $nearby->name; ?></span>
                                            <span class="fjfy_list_spantwo"><?php echo $nearby->total_price; ?>万加元</span>
                                        </a>
                                    </div>
    <?php }
} ?>
                        </div>
                    </div>
                    <div class="lm_jdt_right scroll_btnr fjfy_gd_body_right" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/right_jt.jpg" /></div>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
        <a href="javascript:;" name="rdfy" style="text-indent:-99999em; display:block;margin-bottom:25px;zoom: 1;">1</a>
        <div class="fjfy_box">
            <div class="fyxqdown_left_title">
                <a class="fyxqdown_left_cur" href="javascript:;">最近浏览</a><div class="cl"></div>
            </div>
            <div class="fjfy_box_cont">
                <div class="lm_three_jdt">
                    <div class="lm_jdt_left scroll_btnl fjfy_rd_body_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/left_jt.jpg" /></div>
                    <div class="lm_jdt_center scroll_img" style="width:790px; overflow:hidden; ">
                        <div class="scroll_img_body fjfy_rd_body">
                            <?php
                            if (!empty($view_history)) {
                                foreach ($view_history as $obj) {
                                    ?>
                                    <div class="fjfy_list">
                                        <a href="<?php echo Yii::app()->createUrl('house/view', array('id' => $obj->id)); ?>" target="_blank" title="<?php echo $obj->name; ?>">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->house_image; ?>" width="192" height="250"/>
                                            <span class="fjfy_list_spanone"><?php echo $obj->name; ?></span>
                                            <span class="fjfy_list_spantwo"><?php echo $obj->total_price; ?>万加元</span>
                                        </a>
                                    </div>
                            <?php }} ?>
                        </div>
                    </div>
                    <div class="lm_jdt_right scroll_btnr fjfy_rd_body_right" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/right_jt.jpg" /></div>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
        <a href="javascript:;" name="fydt" style="text-indent:-99999em; display:block;margin-bottom:25px;zoom: 1;">1</a>
        <div class="dtck_box hsdts_box5">
            <div class="fyxqdown_left_title">
                <a class="fyxqdown_left_cur" href="javascript:daolumap()">地图</a>
                <a href="javascript:streetmap(1)">街景</a>
                <div class="cl"></div>
            </div>
            <div class="dtck_box_two" style="background-color: #eee;width: 100%;">
                <div id="map1" class="dataWrap" style="display: block;height:430px"></div>
                <div id="map2" class="dataWrap" style="height:430px"></div>
            </div>
            <div class="dtck_box_three">
                <div class="map_cp">
                    <div class="map_cpone">周边设施</div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m1.jpg" /></div>
                            <div class="map_cplist_right">学校</div>
                        </a>
                    </div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m2.jpg" /></div>
                            <div class="map_cplist_right">餐饮</div>
                        </a>
                    </div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m3.jpg" /></div>
                            <div class="map_cplist_right">交通</div>
                        </a>
                    </div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m4.jpg" /></div>
                            <div class="map_cplist_right">购物</div>
                        </a>
                    </div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m5.jpg" /></div>
                            <div class="map_cplist_right">医院</div>
                        </a>
                    </div>
                    <div class="map_cplist">
                        <a href="javascript:;">
                            <div class="map_cplist_left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/m6.jpg" /></div>
                            <div class="map_cplist_right">银行</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 房源详情页面结束 -->
<script>
    $(document).ready(function() {
        //搜索条件下拉
        $(document).ready(function() {
            $(".syss_xltj").mouseover(function() {
                $(this).find(".syss_xltjdown").show();
            });
            $(".syss_xltj").mouseout(function() {
                $(this).find(".syss_xltjdown").hide();
            });
            //搜索条件删除
            $(".fyss_tjsc a").click(function() {
                $(".fyss_tjqr").empty();
            });

            $(".fyss_qrtj_list").click(function() {
                $(this).remove();
            });

        });

        //加入收藏
        $(".collection").click(function() {
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

        //图片视频tab切换
        $(".fyxq_tab_tp").click(function() {
            $(this).addClass("fyxq_tab_cur");
            $(".fyxq_tab_sp").removeClass("fyxq_tab_cur");
            $(".diflash").show();
            $(".fyxq_tab_cont_sp").hide();
        });

        $(".fyxq_tab_sp").click(function() {
            $(this).addClass("fyxq_tab_cur");
            $(".fyxq_tab_tp").removeClass("fyxq_tab_cur");
            $(".diflash").hide();
            $(".fyxq_tab_cont_sp").show();
        });

    });
    //附近房源左右滚动效果
    $(function() {
        var i = 4
        var cont = $(".fjfy_gd_body img").size();
        var kd = (cont * 198) + "px";
        var last = (cont - i) * 198 + "px";
        var page = 1;
        var o = cont - 3;
        var page_cont = cont;
        $(".fjfy_gd_body_left").click(function() {
            if (page == 1) {
                $(".fjfy_gd_body").animate({"margin-left": '-=' + last}, 1000);
                page = o;
            }
            else {
                $(".fjfy_gd_body").animate({"margin-left": "+=198px"}, 1000);
                page--;
            }
            $("i").text(page);
        });

        $(".fjfy_gd_body_right").click(function() {
            if (page == o) {
                $(".fjfy_gd_body").animate({"margin-left": "0"}, 1000);
                page = 1;
            }
            else {
                $(".fjfy_gd_body").animate({"margin-left": "-=198px"}, 1000);
                page++;
            }
            $("i").text(page);
        });

    });
    //热点推荐左右滚动效果
    $(function() {
        var i = 4
        var cont = $(".fjfy_rd_body img").size();
        var kd = (cont * 198) + "px";
        var last = (cont - i) * 198 + "px";
        var page = 1;
        var o = cont - 3;
        var page_cont = cont;
        $(".fjfy_rd_body_left").click(function() {
            if (page == 1) {
                $(".fjfy_rd_body").animate({"margin-left": '-=' + last}, 1000);
                page = o;
            }
            else {
                $(".fjfy_rd_body").animate({"margin-left": "+=198px"}, 1000);
                page--;
            }
            $("i").text(page);
        });

        $(".fjfy_rd_body_right").click(function() {
            if (page == o) {
                $(".fjfy_rd_body").animate({"margin-left": "0"}, 1000);
                page = 1;
            }
            else {
                $(".fjfy_rd_body").animate({"margin-left": "-=198px"}, 1000);
                page++;
            }
            $("i").text(page);
        });

    });
</script>

<script type="text/javascript">
    flowplayer("video_wrap", "<?php echo Yii::app()->theme->baseUrl; ?>/js/flowplayer-3.2.12.swf", {
        clip: {
            url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/" + "<?php echo $house->video_url; ?>",
            autoPlay: false,
            autoBuffering: true
        },
        plugins: {
            controls: {
                play: true, //开端按钮
                volume: true, //音量按钮
                mute: true, //静音按钮
                fullscreen: true, //全屏按钮
                scrubber: true, //进度条
                time: true, //是否显示时候信息
                autoHide: true    //功能条是否主动隐蔽
            }
        }
    });

    //图片焦点图切换
    var sj = 5000;
    $(function() {
        i = 0
        n = $(".diflashup span").length;
        time = setInterval("autoone()", sj);
    });

    function autoone() {
        i = i + 1;
        dq = i - 1;
        $(".diflashdown span:eq('" + dq + "')").addClass("span_cur").siblings().removeClass("span_cur");
        $(".diflashup span:eq('" + dq + "')").fadeIn(500).siblings().hide();
        if (i == n) {
            i = 0;
        }
    }

    $(document).ready(function() {
        $(".diflashdown span").mouseover(function() {
            var zs = $(this).index();
            $(this).addClass("span_cur").siblings().removeClass("span_cur");
            $(".diflashup span:eq('" + zs + "')").fadeIn(500).siblings().hide();
            clearTimeout(time);
        })
    });

    $(document).ready(function() {
        $(".diflashdown span").mouseout(function() {
            var zs = $(this).index();
            autotwo(zs);
            time = setInterval("autoone()", sj);
        })
    });

    function autotwo(k) {
        i = k;
        i = i + 1;
        dq = i - 1;
        $(".diflashdown span:eq('" + dq + "')").addClass("span_cur").siblings().removeClass("span_cur");
        $(".diflashup span:eq('" + dq + "')").fadeIn(500).siblings().hide();

        if (i == n) {
            i = 0;
        }
    }

    //小图片左右滚动
    $(function() {
        var page = 1;
        var t = 4; //每版放4个图片
        //向后 按钮
        $(".next-btn").click(function() {    //绑定click事件
            var content = $(".diflashdown");
            var content_list = $(".diflashdown_gd");
            var v_width = content.width();
            var len = content.find("span").length;
            var page_count = Math.ceil(len / t);   //只要不是整数，就往大的方向取最小的整数
            if (!content_list.is(":animated")) {    //判断“内容展示区域”是否正在处于动画
                if (page == page_count) {  //已经到最后一个版面了,如果再向后，必须跳转到第一个版面。
                    content_list.animate({left: '0px'}, "slow"); //通过改变left值，跳转到第一个版面
                    page = 1;
                } else {
                    content_list.animate({left: '-=' + v_width}, "slow");  //通过改变left值，达到每次换一个版面
                    page++;
                }
            }
        });
        //往前 按钮
        $(".prev-btn").click(function() {
            var content = $(".diflashdown");
            var content_list = $(".diflashdown_gd");
            var v_width = content.width();
            var len = content.find("span").length;
            var page_count = Math.ceil(len / t);   //只要不是整数，就往大的方向取最小的整数
            if (!content_list.is(":animated")) {    //判断“内容展示区域”是否正在处于动画
                if (page == 1) {  //已经到第一个版面了,如果再向前，必须跳转到最后一个版面。
                    content_list.animate({left: '-=' + v_width * (page_count - 1)}, "slow");
                    page = page_count;
                } else {
                    content_list.animate({left: '+=' + v_width}, "slow");
                    page--;
                }
            }
        });
    });

    //google地图开始
    $(function() {
        mapinit();
    });

    function mapinit() {
        ///地图
        var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $house->latitude; ?>), parseFloat(<?php echo $house->longitude; ?>));
        var myOptions = {
            zoom: 13,
            center: mapLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map1 = new google.maps.Map(document.getElementById('map1'), myOptions);
        var marker1 = new google.maps.Marker({
            position: mapLatLng,
            map: map1
        });
    }

    function daolumap() {
        $('.hsdts_box5 a').removeClass('fyxqdown_left_cur').eq(0).addClass('fyxqdown_left_cur');
        $('.hsdts_box5 .dataWrap').hide().eq(0).show();
        var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $house->latitude; ?>), parseFloat(<?php echo $house->longitude; ?>));
        var myOptions = {
            zoom: 13,
            center: mapLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map1 = new google.maps.Map(document.getElementById('map1'), myOptions);
        var marker1 = new google.maps.Marker({
            position: mapLatLng,
            map: map1
        });
    }

    function streetmap(loca) {
        if (true) {
            var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $house->latitude; ?>), parseFloat(<?php echo $house->longitude; ?>));
            var panoramaOptions = {pov: {heading: 0, pitch: 0, zoom: 0}, position: mapLatLng};
            if (loca == 0) {
                var panorama = new google.maps.StreetViewPanorama(document.getElementById("streetMap"), panoramaOptions);
            } else if (loca == 1) {
                $('.hsdts_box5 a').removeClass('fyxqdown_left_cur').eq(1).addClass('fyxqdown_left_cur');
                $('.hsdts_box5 .dataWrap').hide().eq(1).show();
                var Streetmap2 = new google.maps.StreetViewPanorama(document.getElementById("map2"), panoramaOptions);
            } else {
                $('.hsdts_box5 a').removeClass('fyxqdown_left_cur').eq(1).addClass('fyxqdown_left_cur');
                $('.hsdts_box5 .dataWrap').hide().eq(1).show();
                var Streetmap2 = new google.maps.StreetViewPanorama(document.getElementById("map2"), panoramaOptions);
                var panorama = new google.maps.StreetViewPanorama(document.getElementById("streetMap"), panoramaOptions);
            }
        }
    }
</script>