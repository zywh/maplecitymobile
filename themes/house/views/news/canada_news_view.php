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
<!-- 房源详情页面开始 -->
<div class="fyxq">

    <div class="fyxqdown zx_zwy">
        <div class="fyxqdown_left">
        <!-- 地址开始 -->
<div class="cl"></div>
<div class="nytb_dz">
    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a> > <a href="<?php echo Yii::app()->createUrl('news/canadaNews'); ?>"><?php echo $this->getCatalogName(4); ?></a> > <a href="<?php echo Yii::app()->createUrl('news/canadaNews',array('catalog_id'=>$post->catalog_id)); ?>"><?php echo $post->catalog->catalog_name; ?></a> > <span>正文</span>
</div>
<!-- 地址结束 -->
            <div class="zx_zwycont" style="overflow:hidden">
                <div class="zx_zwytitle" style="color:#FF9900; font-size:20px;"><?php echo $post->title; ?></div>
                <div class="zx_zwyinfo" style="width:560px;">
                    <span class="zx_span_time">更新时间：
										<?php 
					if($post->last_update_time==0){
					echo date('Y-m-d', $post->create_time);
					}
					else{
					echo date('Y-m-d', $post->last_update_time);
					}
					?></span>
                    <span class="zx_span_zz" style="width: 220px; text-align:center">作者：<?php echo $post->author; ?></span>
                    <span class="zx_span_fx">分享到：<div class="bdsharebuttonbox"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["weixin","sqq"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    </span>
                    <div class="cl"></div>
                </div>
                <div style="height:8px; border-bottom:#CCCCCC dotted 1px; margin-bottom:10px;"></div>
                <div class="zx_zwy_wz"><?php echo $post->content; ?></div>
                
                
                 <div class="zx_zwy_qhy">
                 标签：
                 <?php
$sql = "select taaag from h_post where id=".$post->id."";
$command = $db->createCommand($sql);
$result = $command->queryAll();

$tag_name=$result[0]["taaag"];

$keywords=array_filter(explode(",",$tag_name));
foreach($keywords as $v){
				 ?>
                 <a href="index.php?r=news/tagNews&tname=<?php echo trim($v);?>" style="color:#f14b00; text-decoration:underline"><?php echo $v;?></a>
                 <?php }?>
                 </div>
                
                <div class="zx_zwy_qhy">
                    <?php if(!empty($prev_post)){ ?><span class="zx_zwy_prev align-left">上一篇：<a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$prev_post->id)); ?>" style="color:#f14b00" title="<?php echo $prev_post->title; ?>"><?php echo $prev_post->title; ?></a></span><?php } ?>
                    <?php if(!empty($next_post)){ ?><span class="zx_zwy_next align-right">下一篇：<a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$next_post->id)); ?>" style="color:#f14b00" title="<?php echo $next_post->title; ?>"><?php echo $next_post->title; ?></a></span><?php } ?>
                    <div class="cl"></div>
                </div>
             <!--开始 -->
             <style>
             .hotxxk{width:715px; height: 265px; margin:0 auto; }
.hot_title_xxk{ width:115x; height: 55px; line-height:55px; }
.hot_title_xxk p{font-size:16px; color:#222222;}
.hot_con_xxk{overflow:hidden;width:953px; height: 178px;}
.hot_img_xxk{float:left;width:264px; height: 178px; }
.hot_fr_xxk{float:left;width:400px; margin-left:10px; height: 178px;}
.hot_price_xxk{width:400px; height: 48px; background-color:#f2f2f2; padding-left:5px;}
.hot_price_xxk{ font-size:16px;}
.hot_price_xxk span{color:#f64500;}
.hot_des_xxk{margin-top:5px;}
.hot_des_xxk p{color:#898989; font-size:14px; line-height:22px;}
.hot_info_xxk{width:66px; height: 21px; line-height:21px;margin-top:5px;}
.hot_info_xxk a{color:#FFFFFF;}
.zx_zwy_qhy a{ margin-left:12px;}
             </style>
<div class="hotxxk" style="height:auto">
                            <div class="hot_title_xxk">
                                     <p>热点房源推荐</p>
                            </div>
                            
        <?php 

$sqlhaozi = "select * from h_house where lp_dol<3000000 and recommend=1 limit 0,3";
$resultshazai = $db->createCommand($sqlhaozi)->query();
foreach($resultshazai as $househaizai){
?>

               
                            <div class="hot_con_xxk">
                                   <div class="hot_img_xxk">
                                       <?php if($househaizai["house_image"]==""){?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src='/static/images/zanwu.jpg' width="250" height="212"/></a>
                      <?php }else{?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $househaizai["house_image"]; ?>"  width="250" height="212"/></a>
                      <?php }?>
                                   </div>
                                   <div class="hot_fr_xxk" style="margin-top:0px;"> 
                                               <div class="hot_price_xxk">
                                                     <p><span>地址：</span><?php echo $househaizai["addr"]; ?><br />
                                                       <span>价格：</span><?php echo $househaizai["lp_dol"]/10000; ?>万加币
                                                     </p>
                                               </div>
                                               <div class="hot_des_xxk">
                                                     <p><?php echo $househaizai["extras"]; ?>
                                                        </p>
                                               </div>
                                               <div class="hot_info_xxk">
                                                    <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"><img src="/themes/house/services/images_index/info.jpg"/></a>
                                               </div>
                                   </div>
                            </div>
                            
                            <div style="height:15px; clear:both"></div>
<?php }?>       
                    
                </div>
             <div style="font-size:14px; line-height:24px; background-color:#fafafa; border:#f3f2f2 1px solid; padding:12px; ">注：枫之都的所有原创和编译整理作品，版权均属于枫之都，经过网站授权可转载，转载请注明‘来源：枫之都’,转载目的在于传递更多信息，并不代表本网站赞同其观点和对其真实性负责。违反上述声明者，本网站将追究其相关法律责任。</div>
             <!--结束 -->
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
                                 
                                 <!--结束 -->
        </div>
        <div class="cl"></div>
    </div>
</div>
<!-- 房源详情页面结束 -->