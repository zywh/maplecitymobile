<link href="/themes/house/css/xinjia.css?<?php echo rand();?>" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/themes/house/js/jquery-1.9.1.js"></script>
<script>
$(document).ready(function(){
       //回到头部
      $(".fh").click(function(){
         $("html,body").animate({scrollTop:0}, 250)
         ;//100为滚动条的位置，1000为滚动的时延
       });
	   
       //回到头部浮动效果
		$(document).ready(function() {
				var fd=$(".topbox").offset().top;
				$(window).scroll(function(){
					var jtb=$(this).scrollTop();
					if(jtb>=fd){
						$(".topbox").addClass("fhone")
					}
					else{
						$(".topbox").removeClass("fhone")			
					}	
				 });
		   });
		   
	  //top右侧弹出
	  $(".topone").mouseover(function(){
	      $(this).find(".back").show();
	  });
	  $(".topone").mouseout(function(){
	      $(this).find(".back").hide();
	  });
		   
       //浮动导航效果
		$(document).ready(function() {
				var jl=$(".nav").offset().top;
				$(window).scroll(function(){
					var djl=$(this).scrollTop();
					if(djl>=jl){
						$(".nav").addClass("navfd");
					}
					else{
						$(".nav").removeClass("navfd")			
					}	
				 });
		   });		   
		   
//导航下拉弹出
$(document).ready(function(){
   $(".navlist").mouseover(function(){
        $(this).find(".nav_up").addClass("on_a")
        $(this).find(".navtcbox").show();
   })
   $(".navlist").mouseout(function(){
        $(this).find(".nav_up").removeClass("on_a")
        $(this).find(".navtcbox").hide();
   })
   
})	

//搜索条件下拉
$(document).ready(function(){

   $(".syss_xltj").mouseover(function(){
        $(this).find(".syss_xltjdown").show();
   })
   $(".syss_xltj").mouseout(function(){
        $(this).find(".syss_xltjdown").hide();
   })
 //搜索条件删除  
   $(".fyss_tjsc a").click(function(){
       $(".fyss_tjqr").empty();
   })
   
   $(".fyss_qrtj_list").click(function(){
       $(this).remove();
   })
   
//评估报告
   $(".grtzone").mouseover(function(){
         $(this).find(".grtzonedown").show()
   })
   $(".grtzone").mouseout(function(){
         $(this).find(".grtzonedown").hide()
   })

   $(".grtzonedown a").click(function(){
          var cs=$(this).text();
         $(this).parent().parent().prev().val(cs);
   })
   $(".grtzone").mouseout(function(){
         $(this).find(".grtzonedown").hide()
   })

  })
  
  
//弹出内容

var winHeight=$(window).height();
var winWidth=$(window).width();

$(".tcbox").css({
	width:winWidth,
	height:winHeight,
	opacity:0.8
	});
	
var boxwidth=$(".tcboxnr").width();
var boxheight=$(".tcboxnr").height();
var boxLeft=(winWidth-boxwidth)/2
var boxTop=(winHeight-boxheight)/2

$(".tcboxnr").css({
	left:boxLeft,
	top:boxTop
	})
 
$(".tclabel").click(function() {
    $(this).parent().hide();
	$(this).parent().prev().hide();
}); 


$(".lja").click(function() {
    $(this).next().show();
	$(this).next().next().show();
});
  
	   	  
})


</script>
<link href="/themes/house/news/images_index/index.css" rel="stylesheet" type="text/css" />
<div>
     <img src="/themes/house/news/images_index/ban.jpg"/>
</div>
<div style="height:10px; clear:both"></div>
<?php
$db = Yii::app()->db;
?>
<!-- 地址开始 -->
<div class="cl"></div>
<div class="nytb_dz" style="width:980px;">
    <a href="<?php Yii::app()->createUrl('site/index'); ?>">首页</a> > <a href="<?php echo Yii::app()->createUrl('news/canadaNews'); ?>"><?php echo $this->getCatalogName(1); ?></a> > <span style="font-size:14px;"><?php echo $this->getCatalogName($catalog_id); ?></span>
</div>
<!-- 地址结束 -->
<!-- 房产资讯开始 -->
<div class="fyxq"  style="margin-top:0px;">
    <div class="fyxqdown zx_zwy">
        <div class="fyxqdown_left" style="width: 693px;">
            <div class="jgzx_down">
                <div class="jgzx_down_left" style="margin-top:-15px;">
                    <div class="lm_four_right">
                    
                    
<?php //if($_GET[catalog_id]!=21){?>
                        <div class="lm_four_right_newslist">
                            <div class="lm_five_left_label">
                                <div class="jgzx_label_left"><?php echo $this->getCatalogName(21); ?></div>
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>21)); ?>" class="moretwo">更多>></a>
                                <div class="cl"></div>
                            </div>
                            <div class="lm_four_news_down">
                                <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>21)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(21); ?>" width="94" height="94"/></a></div>
                                <div class="lm_four_news_down_right">
                                    <div class="lm_four_news_down_info">
                                        <?php foreach($summary as $obj){ ?>
                                            <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                        <?php } ?>
                                        <div class="cl"></div>
                                    </div>
                                    <div class="cl"></div>
                                </div>
                                <div class="cl"></div>
                            </div>
                        </div>
<?php //}?>

<?php //if($_GET[catalog_id]!=22){?>
                        <div class="lm_four_right_newslist lm_four_right_newslist_two">
                            <div class="lm_five_left_label">
                                <div class="jgzx_label_left"><?php echo $this->getCatalogName(22); ?></div>
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>" class="moretwo">更多>></a>
                                <div class="cl"></div>
                            </div>
                            <div class="lm_four_news_down">
                                <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>22)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(22); ?>" width="94" height="94"/></a></div>
                                <div class="lm_four_news_down_right">
                                    <div class="lm_four_news_down_info">
                                        <?php foreach($life as $obj){ ?>
                                            <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                        <?php } ?>
                                        <div class="cl"></div>
                                    </div>
                                    <div class="cl"></div>
                                </div>
                                <div class="cl"></div>
                            </div>
                        </div>
<?php //}?>

<?php //if($_GET[catalog_id]!=25){?>
                        <div class="lm_four_right_newslist">
                            <div class="lm_five_left_label">
                                <div class="jgzx_label_left"><?php echo $this->getCatalogName(25); ?></div>
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>25)); ?>" class="moretwo">更多>></a>
                                <div class="cl"></div>
                            </div>
                            <div class="lm_four_news_down">
                                <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>25)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(25); ?>" width="94" height="94"/></a></div>
                                <div class="lm_four_news_down_right">
                                    <div class="lm_four_news_down_info">
                                        <?php foreach($travel as $obj){ ?>
                                            <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                        <?php } ?>
                                        <div class="cl"></div>
                                    </div>
                                    <div class="cl"></div>
                                </div>
                                <div class="cl"></div>
                            </div>
                        </div>
<?php //}?>

                        <?php //if($_GET[catalog_id]!=46){?>
                        <div class="lm_four_right_newslist">
                            <div class="lm_five_left_label">
                                <div class="jgzx_label_left">旅游签证</div>
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>46)); ?>" class="moretwo">更多>></a>
                                <div class="cl"></div>
                            </div>
                            <div class="lm_four_news_down">
                                <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>46)); ?>"><img src="/themes/house/images/qianzheng.jpg" width="94" height="94"/></a></div>
                                <div class="lm_four_news_down_right">
                                    <div class="lm_four_news_down_info">

                                        <?php 
$db = Yii::app()->db;
$sqlhaozi = "select * from h_post where catalog_id=46 limit 0,5";
$resultshazai = $db->createCommand($sqlhaozi)->query();
foreach($resultshazai as $househaizai){
?>
                                            <div class="news_a"><a href="index.php?r=news/canadaNewsView&id=<?php echo $househaizai["id"]; ?>" title="<?php echo $househaizai["title"]; ?>" target="_blank"><?php echo $househaizai["title"]; ?></a></div>
                                        <?php } ?>
                             
                                        <div class="cl"></div>
                                    </div>
                                    <div class="cl"></div>
                                </div>
                                <div class="cl"></div>
                            </div>
                        </div>
                        <?php //}?>
                        
                    </div>
                </div>
                <div class="jgzx_down_right">
                    <div class="lm_five_left_label">
                        <div class="jgzx_label_left"><?php echo $this->getCatalogName($catalog_id); ?></div>
                        <div class="cl"></div>
                    </div>
                    <div class="jgzx_rdxw">
                        <div class="jgzx_rdxw_up">
                            <div class="jgzx_rdxw_up_left">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage($catalog_id); ?>" width="160" height="160"/>
                            </div>
                            <div class="jgzx_rdxw_up_right">
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$special_news->id)); ?>" class="jgzx_title" title="<?php echo $special_news->title; ?>" target="_blank"><?php echo $special_news->title; ?></a>
                                <span><?php echo $special_news->summary; ?>...<a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$special_news->id)); ?>" class="jgzx_ljxx" target="_blank" style="font-size:12px;">查看详细</a></span>
                                
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="jgzx_rdxw_down">
                            <?php foreach($more_news as $obj){ ?>
                            <div class="lm_five_center_list">
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank">· <?php echo $obj->title; ?></a>&nbsp;<span>					
								<?php 
					if($obj->last_update_time==0){
					echo "[".date('Y-m-d', $obj->create_time)."]"; 
					}else{
					echo "[".date('Y-m-d', $obj->last_update_time)."]"; 
					}
					?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
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
        <div class="fyxqdown_right">
<style>
.zczltwo span a{ color:#666666; text-decoration:none; font-size:12px;}
.zczltwo span a:hover{ color:#FF6600;font-size:12px;}
</style>


<div class="zczl">
    <div class="zczlone">立即注册获得以下资料</div>
    <div class="zczltwo">
                <?php if (empty($this->_account['userId'])) { ?>
                    <span><a href="index.php?r=site/login">1.加国房产投资报告</a></span>
                    <span><a href="index.php?r=site/login">2.海外移民指南</a></span>
                    <span><a href="index.php?r=site/login">3.加国留学指南</a></span> 
                <?php 
				}else{
				
				
$sqljiaguo = "select image from h_post where id=137";
$resultjiaguo = $db->createCommand($sqljiaguo)->query();
foreach($resultjiaguo as $househaizai){
$jiaguo=$househaizai["image"];

}


$sqlhaiwai = "select image from h_post where id=138";
$resulthaiwai = $db->createCommand($sqlhaiwai)->query();
foreach($resulthaiwai as $househaiwai){
$haiwai=$househaiwai["image"];

}


$sqlzhinan = "select image from h_post where id=139";
$resultzhinan = $db->createCommand($sqlzhinan)->query();
foreach($resultzhinan as $housezhinan){
$zhinan=$housezhinan["image"];

}

				?>
                    <span><a href="/<?php echo $jiaguo;?>">1.加国房产投资报告</a></span>
                    <span><a href="/<?php echo $haiwai;?>">2.海外移民指南</a></span>
                    <span><a href="/<?php echo $zhinan;?>">3.加国留学指南</a></span> 
                <?php }?>
    </div>
    <form action="http://www.maplecity.com.cn/index.php?r=user/register" method="get">
<input type="hidden" value="user/register" name="r">    <div class="zczlthree">
        <div class="zczlthree_one"><input name="username" type="text" class="textbox" value="您的姓名" onblur="if(this.value=='') {this.style.color='#333';this.value='您的姓名';}" onfocus="if(this.value=='您的姓名'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
        <div class="zczlthree_one"><input name="phone" type="text" class="textbox" value="您的电话" onblur="if(this.value=='') {this.style.color='#333';this.value='您的电话';}" onfocus="if(this.value=='您的电话'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
        <div class="zczlthree_one"><input name="email" type="text" class="textbox" value="您的邮箱" onblur="if(this.value=='') {this.style.color='#333';this.value='您的邮箱';}" onfocus="if(this.value=='您的邮箱'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
    </div>
    <div style="height:10px;"></div>
    <div class="zczlfour"><input name="" type="submit" value="立即注册"></div>
    </form></div>
    
    <div class="sylj">
			         <div class="syljtitle">实用链接</div>
			         <div class="syljcont">
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s1.png" /><span>外汇牌价</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj1.png" /><span>枫之都-外汇牌价</span><div class="cl"></div></div>
               <div class="tccont_two">
                    <a href="#">中国银行牌价</a>
                    <a href="#">银率网</a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 --> 
                           
				 <a href="http://www.ratehub.ca/best-mortgage-rates" target="_blank"><img src="/themes/house/images/s2.png" /><span>贷款利率</span></a>

					<a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s3.png" /><span>贷款计算</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr" style="height:580px;">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj3.png" /><span>枫之都-贷款计算</span><div class="cl"></div></div>
               <div class="jisuan">
                      <div class="ajjsq_cont">
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">房屋价格：</div>
					       <div class="ajjsq_left_two"><img src="new/images/jh.png" /></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;"/></div>
						   <div class="ajjsq_left_four"><img src="new/images/jh2.png" /></div>
						   <div class="ajjsq_left_five">$</div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">首    付：</div>
					       <div class="ajjsq_left_two"><img src="new/images/jh.png" /></div>
						   <div class="ajjsq_left_three"><input name="" type="text"  style="width:75px;"/></div>
						   <div class="ajjsq_left_four"><img src="/themes/house/images/jh2.png" /></div>
						   <div class="ajjsq_left_five">%</div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">首付金额：</div>
					       <div class="ajjsq_left_two"></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four"></div>
						   <div class="ajjsq_left_five">$</div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">还款年限：</div>
					       <div class="ajjsq_left_two"><img src="new/images/jh.png" /></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four"><img src="/themes/house/images/jh2.png" /></div>
						   <div class="ajjsq_left_five">年</div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">利   率：</div>
					       <div class="ajjsq_left_two"><img src="new/images/jh.png" /></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four"><img src="/themes/house/images/jh2.png" /></div>
						   <div class="ajjsq_left_five">%</div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">还款周期：</div>
					       <div class="ajjsq_left_two"><img src="new/images/jh.png" /></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four"><img src="/themes/house/images/jh2.png" /></div>
						   <div class="cl"></div>
					  </div>
                      
                      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">还款：</div>
					       <div class="ajjsq_left_two"></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four xjmy2">$ / 每月</div>
						   <div class="cl"></div>
					  </div>
                      
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">省份：</div>
					       <div class="ajjsq_left_two"></div>
						   <div class="ajjsq_left_three">
							   <select class="ajjsq_select" name="" style="width:75px;">
							     <option>安大略省</option>
							   </select>
						   </div>
						   <div class="ajjsq_left_four"></div>
						   <div class="ajjsq_left_five"></div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">交易税：</div>
					       <div class="ajjsq_left_two"></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four">$</div>
						   <div class="ajjsq_left_five"></div>
						   <div class="cl"></div>
					  </div>
				      <div class="ajjsq_list">
					       <div class="ajjsq_left_one">多伦多交易税：</div>
					       <div class="ajjsq_left_two"></div>
						   <div class="ajjsq_left_three"><input name="" type="text" style="width:75px;" /></div>
						   <div class="ajjsq_left_four">$</div>
						   <div class="ajjsq_left_five"></div>
						   <div class="cl"></div>
					  </div>
				   </div>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->  
                           
					 <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s4.png" /><span>加拿大地图</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj4.png" /><span>枫之都-加拿大地图</span><div class="cl"></div></div>
               <div class="tccont_two">
                    <a href="http://www.meet99.com/emap-Canada.html">全国地图</a>
                    <a href="http://www.meet99.com/map-TORONTO.html">多伦多地图</a>
                    <a href="http://www.meet99.com/map-Ottawa.html">渥太华地图</a>
                    <a href="http://www.meet99.com/map-VANCOUVER.html">温哥华地图</a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->   
                           
                           
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s5.png" /><span>加拿大天气</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj5.png" /><span>枫之都-加拿大天气</span><div class="cl"></div></div>
               <div class="tccont_two">
                    <a href="http://php.weather.sina.com.cn/search_nation.php?nation=%BC%D3%C4%C3%B4%F3&dpc=1#g_3">全国天气</a>
                    <a href="http://php.weather.sina.com.cn/search.php?c=1&city=%B6%E0%C2%D7%B6%E0&dpc=1">多伦多天气</a>
                    <a href="http://php.weather.sina.com.cn/search.php?c=1&city=%CE%C2%B8%E7%BB%AA&dpc=1">渥太华天气</a>
                    <a href="http://php.weather.sina.com.cn/search.php?c=1&city=%E4%D7%CC%AB%BB%AA&dpc=1">温哥华天气</a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->  
  
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s6.png" /><span>加拿大交通</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj6.png" /><span>枫之都-加拿大交通</span><div class="cl"></div></div>
               <div class="tccont_two">
                    <a href="http://flight.qunar.com/schedule/international/fsearch_list.jsp?departure=%E5%8C%97%E4%BA%AC&arrival=%E5%A4%9A%E4%BC%A6%E5%A4%9A">航班查询</a>
                    <a href="http://www.octranspo1.com/">首都渥太华公交系统查询</a>
                    <a href="https://www.ttc.ca/">多伦多公交系统查询</a>
                    <a href="http://www.translink.ca/">温哥华公交系统查询</a>
                    <a href="http://tripplanning.translink.ca/hiwire?.a=iScheduleLookupSearch&LineName=999&LineAbbr=999">温哥华轻轨Skytrain时刻查询</a>
                    <a href="http://www.calgarytransit.com/">卡尔加里公交系统查询</a>
                    <a href="http://www.gotransit.com/timetables/en/schedules/full_schedules.aspx">多伦多火车系统（Go Train）查询</a>
                    <a href="http://www.viarail.ca/">加拿大VIA火车查询</a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->   
                           
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s7.png" /><span>加拿大学校</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj7.png" /><span>枫之都-加拿大学校排名</span><div class="cl"></div></div>
               <div class="tccont_two">
                    <a href="http://www.e-canada.cn/paiming">加拿大大学排名</a>
                    <a href="http://www.compareschoolrankings.org/">加拿大中小学排名</a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->  
                           
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s8.png" /><span>加拿大旅游</span></a>
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj8.png" /><span>枫之都-加拿大旅游</span><div class="cl"></div></div>
               <div class="tccontimg">
                    <a href="http://www.ontariotravel.cn/"><img src="/new/images/lj1.png" /><span>安大略省旅游局</span></a>
                    <a href="http://www.hellobc.com.cn/?CC=CN&SI=1"><img src="/new/images/lj2.png" /><span>英属哥伦比亚省旅游局</span></a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->  
                           
					       <a class="lja" href="javascript:void(0);"><img src="/themes/house/images/s9.png" /><span>航空票务</span></a>		
                           
<!-- 弹出内容 --> 
<div class="tcbox"></div>
    <div class="tcboxnr">
         <div class="tclabel"><span>X</span></div>
         <div class="tccont">
               <div class="tccont_one"><img src="/themes/house/images/sylj9.png" /><span>枫之都-航空票务</span><div class="cl"></div></div>
               <div class="tccontimg">
                    <a href="http://www.ctrip.com/#ctm_ref=nb_cn_top/"><img src="/new/images/pw1.png" /><span>携程网</span></a>
                    <a href="http://www.aircanada.com/en/home.html"><img src="/new/images/pw2.png" /><span>加拿大航空公司</span></a>
                    <a href="http://www.airchina.com.cn/index.shtml"><img src="/new/images/pw3.png" /><span>中国国际航空公司</span></a>
                    <a href="http://www.hainanairlines.com/CN/CN/Home"><img src="/new/images/pw4.png" /><span>海南航空公司</span></a>
                    <a href="http://www.cathaypacific.com/cx/sc_CN.html"><img src="/new/images/pw5.png" /><span>国泰航空公司</span></a>
               </div>
         </div>
         <div class="tcbottom"><img src="/themes/house/images/tclabel_down.png" /></div>
    </div>

<!-- 弹出内容 -->  
                           
                     </div>
			   </div>
                                             <div class="hot_rec">
        <?php

$sqlhaozi = "select * from h_house where lp_dol<3000000 and recommend=1 limit 0,5";
$resultshazai = $db->createCommand($sqlhaozi)->query();
foreach($resultshazai as $househaizai){
?>
                                                 <div class="hot_list">
                                                         <div class="hot_fl">
 <?php if($househaizai["house_image"]==""){?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src='/static/images/zanwu.jpg' width="120" height="72"/></a>
                      <?php }else{?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $househaizai["house_image"]; ?>"  width="120" height="72"/></a>
                      <?php }?>
                                                         </div>
                                                         <div class="hot_fr">
                                                               <p><?php echo $househaizai["addr"]; ?><br />
                                                             
                                                                 <font color="#CC6600"><font color="#CC6600"><?php echo $househaizai["lp_dol"]/10000;?></font>万加元
                                                               </p>
                                                         </div>
                                                       
                                                 </div>
        <?php }?> 
                                 </div>
        </div>
        <div class="cl"></div>
    </div>
</div>
<!-- 房产资讯结束 -->
<script type="text/javascript">
    //加国资讯/房产资讯左侧焦点图
    Qfast.add('widgets', { path: "<?php echo Yii::app()->theme->baseUrl;?>/js/terminator2.2.min.js", type: "js", requires: ['fx'] });
    Qfast(false, 'widgets', function () {
        K.tabs({
            id: 'fsD1',   //焦点图包裹id
            conId: "D1pic1",  //** 大图域包裹id
            tabId:"D1fBt",
            tabTn:"a",
            conCn: '.fcon', //** 大图域配置class
            auto: 1,   //自动播放 1或0
            effect: 'fade',   //效果配置
            eType: 'click', //** 鼠标事件
            pageBt:true,//是否有按钮切换页码
            bns: ['.prev', '.next'],//** 前后按钮配置class
            interval: 4000  //** 停顿时间
        });
    });

    $(function(){
        //评估报告
        $(".grtzone").mouseover(function(){
            $(this).find(".grtzonedown").show()
        });
        $(".grtzone").mouseout(function(){
            $(this).find(".grtzonedown").hide()
        });
        $(".grtzonedown a").click(function(){
            var cs=$(this).text();
            $(this).parent().parent().prev().val(cs);
        });
        $(".grtzone").mouseout(function(){
            $(this).find(".grtzonedown").hide()
        });
    });
</script>