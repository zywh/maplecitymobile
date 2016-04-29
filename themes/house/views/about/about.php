<link href="/themes/house/css/xinjia.css" type="text/css" rel="stylesheet" />

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
<style>
.nytb_dz a:hover{ color:#FF6600}
</style>
<link href="/themes/house/news/images_index/index.css" rel="stylesheet" type="text/css" />
<?php
$db = Yii::app()->db;
?>
<!-- nybanner开始-->
     <div class="nybanner_about"></div>
<!-- nybanner结束-->

<!-- 内容页面开始 -->	

   <div class="nycontnrbox nycont_kd">  
     <div class="nycontnr"> 
     <div class="nrym_cont">  
           <div class="zcwz_label">
                 <div class="zcwz_label_left" style="padding-left:0px;"><?php echo $prev_post->title; ?></div>
                 <div class="zcwz_label_right"><?php echo $cat_name_en; ?></div>
                 <div class="cl"></div>
           </div>
	       <div class="fyxqdown">
           <?php if($_GET["id"]==38){?>
           <link href="/themes/house/jianjie/images_index/index.css" rel="stylesheet" type="text/css" />
           <?php echo $prev_post->content; ?>
           <?php }else{?>
		          <div class="fyxqdown_left">
                      <div class="zcwz about_js">
                            <?php echo $prev_post->content; ?>
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
              
             <?php }?>
              
              
			  <div class="cl"></div>
			  		  
			 
              
			  	   
		   </div>
	 </div>

   </div>
 </div>
</div>
	

<!-- 内容页面结束 -->

