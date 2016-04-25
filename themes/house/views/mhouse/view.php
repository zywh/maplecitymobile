<link type="text/css" rel="stylesheet" href="http://www.idangero.us/swiper/dist/css/swiper.min.css" media="all" />
<script src="http://www.idangero.us/swiper/dist/js/swiper.min.js"></script>
<style>
.mydiv {
*background-image:url(/themes/house/images/yuyuebf.png);
text-align: center;
line-height: 40px;
font-size: 12px;
font-weight: bold;
z-index:99;
width: 495px;
height: 400px;
left:40%;/*FF IE7*/
top: 20%;/*FF IE7*/
margin-left:-150px!important;/*FF IE7 该值为本身宽的一半 */
margin-top:-60px!important;/*FF IE7 该值为本身高的一半*/
margin-top:0px;
position:fixed!important;/*FF IE7*/
position:absolute;/*IE6*/
_top:       expression(eval(document.compatMode &&
            document.compatMode=='CSS1Compat') ?
            documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
            document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);/*IE5 IE5.5*/

}
.mydiv .guanbi{ width:475px; height:20px; padding-right:20px;text-align:right;}
.mydiv .guanbi a{ color:#FFFFFF; font-size:14px; text-decoration:none}
.bgbgbg {
width: 100%;
height: 100%;
left:0;
top:0;/*FF IE7*/
filter:alpha(opacity=50);/*IE*/
opacity:0.5;/*FF*/
z-index:1;
position:fixed!important;/*FF IE7*/
position:absolute;/*IE6*/
_top:       expression(eval(document.compatMode &&
            document.compatMode=='CSS1Compat') ?
            documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
            document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);/*IE5 IE5.5*/

}
.zczltwo span a{ color:#666666; text-decoration:none;}
.zczltwo span a:hover{ color:#FF6600}
.syljcont a:hover{ color:#FF6600}
.kf{ line-height:30px; width:81px; height:31px; text-align:center}
.kf a{ color:#FFFFFF}
.kf a:hover{ color:#000000}
.dlh_btn a{ color:#FF6600}
.dlh_btn:hover{ text-decoration:underline}
.nytb_dz a:hover{ color:#FF6600}
</style>

<?php
$db = Yii::app()->db;
$jingdu=$house->latitude;
$weidu=$house->longitude;
$sid=$_GET["sid"];
$slat=$_GET["lat"];
$slng=$_GET["lng"];

	function get_firstimage($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		$dir="mlspic/crea/creamid/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			return $dir.$picfiles[2];

		}else { return 'static/images/zanwu.jpg';}
	}
	
	function get_tn_image($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		$dir="mlspic/crea/creatn/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			
			$s = implode(",",array_slice($picfiles,2,3)); //return 3 comma seperated list with offset 2 which is subdir . and ..
			$s = str_replace("Photo",$dir."Photo",$s); // Insert DIR in front
			return $s;
		} else { return 'static/images/zanwu.jpg';}
	}

?>    
<!-- 房源详情页面开始 -->

<div class="fyxq">
<!--效果开始-->
<div class="ink_phoBok">
<?php
//打开 images 目录
$county = $house->county;
$county = preg_replace('/\s+/', '', $county);
$county = str_replace("&","",$county);
$dir="mlspic/crea/creamid/".$county."/Photo".$house->ml_num."/";
$num_files = 0;

if(is_dir($dir)){
	$picfiles = scandir($dir);
	$num_files = count(scandir($dir))-2;
}
if ( $num_files > 0) {
?> 
<div class="swiper-container" style="margin-bottom: 10px;">
<div class="swiper-wrapper">
<?php
	for ($x = 2; $x <= $num_files + 1; $x++) {
	  $filePath = $dir.$picfiles[$x];
	  ?>
<div class="swiper-slide" style="width: 100%;">
  <div style="padding-top: 65%;"></div>
  <img style="width: 100%; height: auto; position: absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: silver;" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $filePath; ?>">
</div>
	 <?php
	}
?> 
<div class="swiper-pagination"></div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
<script>
var swiper = new Swiper(".swiper-container", {
  pagination: ".swiper-pagination",
  nextButton: '.swiper-button-next',
  prevButton: '.swiper-button-prev',
  paginationClickable: true,
  autoplay: 3500,
  speed: 1000,
  autoplayDisableOnInteraction: true,
});
</script>
</div>
<?php
}
?>
<!--End-->
</div>
          
          
        </div>
        <div class="fyxqupright">
            <div class="fyxqupright_title">MLS：<?php echo $house->ml_num; ?></div>
		</div>
        <div class="cl"></div>
		<div class="fyxqupright_cont">
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">价格：</div>
                    <div class="fyxq_ptssright">
					<?php 
					if ( $house->s_r == "Sale") {
					$str= $house->lp_dol/10000 . "&nbsp&nbsp万加币";
						echo $str;
					} 
					else {
						$str = $house->lp_dol . "&nbsp&nbsp加元/月";
					echo $str;  
					}
					?>
					<?php if (!empty($exchangeRate)) { ?>&nbsp;<span>(约<i>
					<?php echo number_format($house->lp_dol * floatval($exchangeRate)/10000, 2); ?></i>万人民币）</span><?php } ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">地址：</div>
                    <div class="fyxq_ptssright"><?php echo $house->addr.",&nbsp".$house->municipality.", &nbsp".$house->county."&nbsp"; ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft"><?php if ($house->investType_id == 1) {
    echo '学区';
} else {
    echo '城市';
} ?>：</div>
                    <div class="fyxq_ptssright"><?php echo $house->mname->municipality_cname."&nbsp&nbsp".$house->city->name; ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">户型：</div>
                    <div class="fyxq_ptssright"><img src="new/images/1s.jpg"  />&nbsp;&nbsp;<?php echo $house->br; ?>&nbsp;&nbsp;<img src="new/images/1t.jpg" />&nbsp;&nbsp;<?php echo $house->bath_tot; ?></div>
                    <div class="cl"></div>
                </div>
                <div class="fyxq_ptss">
                    <div class="fyxq_ptssleft">配套：</div>
                    <div class="fyxq_ptssright fyxq_ptpd">
                    
                               <?php 
							   if(strpos($house->a_c, 'Air') !== false || strpos($house->a_c, 'air') !== false){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">中央空调</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>中央空调</span>
                               <?php }?>
                    
                    
                               <?php if($house->central_vac=="Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">中央吸尘</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>中央吸尘</span>
                               <?php }?>

                               <?php if($house->furnished==1){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">配套家具</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>配套家具</span>
                               <?php }?>

                               <?php if($house->elevator=="Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">电梯</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>电梯</span>
                               <?php }?>
                               
                               <?php if($house->bsmt1_out !="None" or $house->bsmt2_out !=""){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">地下室</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>地下室</span>
                               <?php }?>

                               <?php 
							   if(strpos($house->pool, 'pool') !== false){
									?><!--有 --> <span><b></b><font color="#FF3300">游泳池</font></span><?php 
								}else{
									?><!--无 --><span><s></s>游泳池</span> <?php 
								}?>  
                               
                               <?php if($house->fpl_num == "Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">壁炉</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>壁炉</span>
                               <?php }?> 
                        </div>
                    <div class="cl"></div>
                </div>
                
                <div class="fyxq_phone"><img src="new/images/phone.jpg" width="78" height="78" /></div>
                <div class="fyxq_rx">服务热线：<br/>
                  <img src="new/images/plat.jpg" width="23" height="15" /><span>400-870-1029</span>
                </div>
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
			//$(".s2").text(a2);
			//$(".s3").text(a3);
			$(".c1").html("平方英尺")
			//$(".c2").html("平方英尺")
			//$(".c3").html("英尺")
		   $(this).text("英尺 > 米");
           $(this).removeClass("dlh_active");
	   } 
	   else{
			var b1=decimal(a1*0.09290304,2);
			var b2=decimal(a2*0.09290304,2);
			var b3=decimal(a3*0.3048,2);
			$(".s1").text(b1);
			//$(".s2").text(b2);
			//$(".s3").text(b3);
			$(".c1").html("平方米")
			//$(".c2").html("平方米")
			//$(".c3").html("米")
		   $(this).addClass("dlh_active");
		   $(this).text("米 > 英制");
      }
	})
})
</script>
                
      <div class="fyxqdown_left_cont">
				<ul data-role="listview">
				<li data-role="list-divider">详情列表</li>
                        <li class="xqlb_list"><span class="xqlb_label">MLS编号：</span><?php echo $house->ml_num; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">交叉路口：</span><?php echo $house->cross_st; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">物业类别：</span><?php echo $house->propertyType->name; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">挂牌时间：</span><?php echo $house->pix_updt; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">房屋层数：</span><?php echo $house->style; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">土地面积：</span><span class="s1"><?php echo $house->land_area; ?></span><span class="c1">平方英尺</span></li>
                        <li class="xqlb_list"><span class="xqlb_label">房屋面积：</span><span class="s2"><?php echo $house->sqft; ?></span><span class="c2">平方英尺</span></li>
                        <li class="xqlb_list"><span class="xqlb_label">土地描述：</span><span class="s3"></span><span class="c3"><?php echo $house->acres; ?></span></li>
                        <li class="xqlb_list"><span class="xqlb_label">房屋数量：</span><?php echo (int)$house->rms+(int)$house->rooms_plus; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">地税/年份：</span><?php echo '$ '.$house->taxes; ?>/<?php echo $house->yr." 年"; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">卧房数量：</span><?php echo (int)$house->br+(int)$house->br_plus; ?></li>
                      <li class="xqlb_list"><span class="xqlb_label">物业管理费：无</span></li>
                        <li class="xqlb_list"><span class="xqlb_label">厨房数量：</span><?php echo (int)$house->num_kit+(int)$house->kit_plus; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">建造年份：</span><?php echo $house->yr_built; ?>年</li>
                       <li class="xqlb_list"><span class="xqlb_label">卫生间数量：</span><?php echo $house->bath_tot; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">地下室：</span><?php echo $house->bsmt1_out; ?>　<?php echo $house->bsmt2_out; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">车库数量：</span><?php echo $house->gar_spaces; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">暖气：</span><?php echo $house->heating; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">大门朝向：</span>
						<?php 
						if($house->comp_pts=="N"){
						echo "北";
						}
						elseif($house->comp_pts=="S"){
						echo "南";
						}
						elseif($house->comp_pts=="W"){
						echo "西";
						}
						elseif($house->comp_pts=="E"){
						echo "东";
						} ?>
                        </li>
                        <li class="xqlb_list"><span class="xqlb_label">空调：</span><?php echo $house->a_c; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">邮编：</span><?php echo $house->zip; ?></li>
                        <li class="xqlb_list"><span class="xqlb_label">中央吸尘：</span><?php if($house->central_vac=="Y"){echo "是";}else{echo "否";} ?></li>
						<li class="xqlb_list"><span class="xqlb_label">游泳池：</span><?php echo $house->pool; ?></li>
					    <li class="xqlb_list"><span class="xqlb_label">出售/出租：</span>
						<?php 
						if($house->s_r=="Sale"){
						echo "出售";
						}
						elseif($house->s_r=="Lease"){
						echo "出租";
						}
						?></li>
                        <li class="xqlb_list"><span class="xqlb_label">周边和配套：</span><?php echo $house->prop_feat1_out; ?><?php if($house->prop_feat2_out!=""){echo " , ";}?><?php echo $house->prop_feat2_out; ?><?php if($house->prop_feat3_out!=""){echo " , ";}?><?php echo $house->prop_feat3_out; ?><?php if($house->prop_feat4_out!=""){echo " , ";}?><?php echo $house->prop_feat4_out; ?><?php if($house->prop_feat5_out!=""){echo " , ";}?><?php echo $house->prop_feat5_out; ?><?php if($house->prop_feat6_out!=""){echo " , ";}?><?php echo $house->prop_feat6_out; ?></li>
<!--                    <div class="xqlb_list">
                            <div class="xqlb_list_left">是否壁炉：<?php if($house->fpl_num=="N"){echo "没有";}else{echo "有";}?></div>
                            <div class="xqlb_list_right">是否游泳池：<?php if($house->pool=="None"){echo "没有";}else{echo "有";} ?></div>
                        <div class="cl"></div>
                    </div> -->
				<li data-role="list-divider">房屋布局</li>
<li>
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
<table data-role="table" id="xqlb_fwbj" class="ui-responsive" data-mode="columntoggle" >
  <thead><tr>
    <td width="12%" style="border-bottom: 1px solid #CCCCCC;">楼层</td>
    <td width="12%" style="border-bottom: 1px solid #CCCCCC;">房间</td>
    <td width="10%" style="border-bottom: 1px solid #CCCCCC;">长(M)</td>
    <td width="12%" style="border-bottom: 1px solid #CCCCCC;">宽(M)</td>
    <td width="17%" style="border-bottom: 1px solid #CCCCCC;">面积(M2)</td>
    <td width="37%" style="border-bottom: 1px solid #CCCCCC;">说明</td>
  </tr></thead>
  </body>
  <?php if($house->level1!="" || $house->rm1_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level1;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm1_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm1_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm1_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm1_len*$house->rm1_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm1_dc1_out; ?><?php if($house->rm1_dc2_out!=""){echo ",";}?><?php echo $house->rm1_dc2_out; ?><?php if($house->rm1_dc3_out!=""){echo ",";}?><?php echo $house->rm1_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level2!="" || $house->rm2_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level2;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm2_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm2_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm2_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm12_len*$house->rm2_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm2_dc1_out; ?><?php if($house->rm2_dc2_out!=""){echo ",";}?><?php echo $house->rm2_dc2_out; ?><?php if($house->rm2_dc3_out!=""){echo ",";}?><?php echo $house->rm2_dc3_out; ?></td>
  </tr>
   <?php }?>
  <?php if($house->level3!="" || $house->rm3_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level3;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm3_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm3_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm3_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm3_len*$house->rm3_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm3_dc1_out; ?><?php if($house->rm3_dc2_out!=""){echo ",";}?><?php echo $house->rm3_dc2_out; ?><?php if($house->rm3_dc3_out!=""){echo ",";}?><?php echo $house->rm3_dc3_out; ?></td>
  </tr>
   <?php }?>
  <?php if($house->level4!="" || $house->rm4_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level4;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm4_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm4_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm4_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm4_len*$house->rm4_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm4_dc1_out; ?><?php if($house->rm4_dc2_out!=""){echo ",";}?><?php echo $house->rm4_dc2_out; ?><?php if($house->rm4_dc3_out!=""){echo ",";}?><?php echo $house->rm4_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level5!="" || $house->rm5_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level5;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm5_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm5_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm5_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm5_len*$house->rm5_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm5_dc1_out; ?><?php if($house->rm5_dc2_out!=""){echo ",";}?><?php echo $house->rm5_dc2_out; ?><?php if($house->rm5_dc3_out!=""){echo ",";}?><?php echo $house->rm5_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level6!="" || $house->rm6_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level6;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm6_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm6_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm6_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm6_len*$house->rm6_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm6_dc1_out; ?><?php if($house->rm6_dc2_out!=""){echo ",";}?><?php echo $house->rm6_dc2_out; ?><?php if($house->rm6_dc3_out!=""){echo ",";}?><?php echo $house->rm6_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level7!=""|| $house->rm7_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level7;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm7_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm7_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm7_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm7_len*$house->rm7_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm7_dc1_out; ?><?php if($house->rm7_dc2_out!=""){echo ",";}?><?php echo $house->rm7_dc2_out; ?><?php if($house->rm7_dc3_out!=""){echo ",";}?><?php echo $house->rm7_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level8!="" || $house->rm8_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level8;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm8_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm8_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm8_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm8_len*$house->rm8_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm8_dc1_out; ?><?php if($house->rm8_dc2_out!=""){echo ",";}?><?php echo $house->rm8_dc2_out; ?><?php if($house->rm8_dc3_out!=""){echo ",";}?><?php echo $house->rm8_dc3_out; ?></td>
  </tr>
  <?php }?>
   <?php if($house->level9!="" || $house->rm9_out!=""){?>
  <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level9;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm9_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm9_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm9_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm9_len*$house->rm9_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm9_dc1_out; ?><?php if($house->rm9_dc2_out!=""){echo ",";}?><?php echo $house->rm9_dc2_out; ?><?php if($house->rm9_dc3_out!=""){echo ",";}?><?php echo $house->rm9_dc3_out; ?></td>
  </tr>
  <?php }?>
  <?php if($house->level10!="" || $house->rm10_out!=""){?>
    <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level10;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm10_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm10_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm10_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm10_len*$house->rm10_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm10_dc1_out; ?><?php if($house->rm10_dc2_out!=""){echo ",";}?><?php echo $house->rm10_dc2_out; ?><?php if($house->rm10_dc3_out!=""){echo ",";}?><?php echo $house->rm10_dc3_out; ?></td>
  </tr>
  <?php }?>
  
  <?php if($house->level11!=""){?>
    <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level11;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm11_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm11_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm11_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm11_len*$house->rm11_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm11_dc1_out; ?><?php if($house->rm11_dc2_out!=""){echo ",";}?><?php echo $house->rm11_dc2_out; ?><?php if($house->rm11_dc3_out!=""){echo ",";}?><?php echo $house->rm11_dc3_out; ?></td>
  </tr>
  <?php }?>
  
  
    <?php if($house->level12!=""){?>
    <tr>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->level12;?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm12_out; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm12_len; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm12_wth; ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo round($house->rm12_len*$house->rm12_wth,1); ?></td>
    <td style="border-bottom: 1px solid #CCCCCC;"><?php echo $house->rm12_dc1_out; ?><?php if($house->rm12_dc2_out!=""){echo ",";}?><?php echo $house->rm12_dc2_out; ?><?php if($house->rm12_dc3_out!=""){echo ",";}?><?php echo $house->rm12_dc3_out; ?></td>
  </tr>
  <?php }?>
</tbody></table>
</li>
<li data-role="list-divider"><a class="fyxqdown_left_cur" href="javascript:daolumap()">地图</a><a href="javascript:streetmap(1)">街景</a></li>
               </ul>
            </div>
 
            
<
     </div>
                           
<script>

//用window的onload事件，窗体加载完毕的时候
window.onload=function(){
daolumap();
}
</script>
</div>
<!-- 房源详情页面结束 -->

<script type="text/javascript">
    //google地图开始
    $(function() {
        mapinit();
    });

    function mapinit() {
        ///地图
        var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $jingdu; ?>), parseFloat(<?php echo $weidu; ?>));
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
        var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $jingdu; ?>), parseFloat(<?php echo $weidu; ?>));
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
		
		var sid = "<?php echo $sid?>";
		if ( sid != null) {
			console.log(sid);
			var schoolLatLng = new google.maps.LatLng(parseFloat(<?php echo $slat; ?>), parseFloat(<?php echo $slng; ?>));
        
			//Add school marker if sid exist
			var surl = 	"<?php echo Yii::app()->createUrl('column/map'); ?>&id=" + sid ;
		    //console.log(url);
		    var smarker = new google.maps.Marker({
            position: schoolLatLng,
            map: map1,
			icon: {
				url: '/themes/house/images/house/m1.jpg',
				size: new google.maps.Size(40,40)
				},
			url: surl
			});
			google.maps.event.addListener(smarker, 'click', function() {
				window.open(this.url);
            });
		
			//Add Direction Service
			//var directionsService = new google.maps.DirectionsService;
			//var directionsDisplay = new google.maps.DirectionsRenderer;
			//directionsDisplay.setMap(map1);
			//directionsService.route({
			//	origin: mapLatLng,
			//	destination: schoolLatLng,
			//	travelMode: google.maps.TravelMode.DRIVING
			//	}, function(response, status) {
			//		if (status === google.maps.DirectionsStatus.OK) {
			//				directionsDisplay.setDirections(response);
			//		} else {
			//		window.alert('Directions request failed due to ' + status);
			//		}
			//});
		}
    }

    function streetmap(loca) {
        if (true) {
            var mapLatLng = new google.maps.LatLng(parseFloat(<?php echo $jingdu; ?>), parseFloat(<?php echo $weidu; ?>));
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
