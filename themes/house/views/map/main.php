<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fczx.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.jslides.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/koala.min.1.5.js"></script>
        <title><?php 
		if(Yii::app()->controller->id=="site"){echo "加拿大房产置业平台";}
		elseif(Yii::app()->controller->id=="hotrecommend"){echo "热点推荐 - 加拿大房产置业平台";}
		elseif(Yii::app()->controller->id=="house"){echo "房源搜索 - 加拿大房产置业平台";}
		elseif(Yii::app()->controller->id=="enjoy"){echo "豪宅鉴赏 - 加拿大房产置业平台";}
		elseif(Yii::app()->controller->id=="column"){echo "学区专栏 - 加拿大房产置业平台";}
		elseif(Yii::app()->controller->id=="news"){echo "新闻资讯 - 加拿大房产置业平台";}
		else{
		echo "加拿大房产置业平台";
		}
		?></title>
        <?php if( Yii::app()->controller->id == 'map' || Yii::app()->controller->id == 'house'){?>
        <script type="text/javascript" src="http://ditu.google.cn/maps/api/js?libraries=places&language=zh-cn"></script>
        <script type="text/javascript" src="<?php echo $this->_baseUrl ?>/static/map/js/richmarker-compiled.js"></script>
        <script type="text/javascript" src="<?php echo $this->_baseUrl ?>/static/map/js/markercluster.js"></script>
        <?php }?>
        <style>
#leftsead{width:131px;height:143px;position:fixed;bottom:250px;right:20px; z-index:999;}
*html #leftsead{margin-top:258px;position:absolute;top:expression(eval(document.documentElement.scrollTop));}
#leftsead li{width:131px;height:60px; list-style-type:none;}
#leftsead ul{ padding:0px; margin:0px;}
#leftsead li img{float:left;}
#leftsead li a{height:49px;float:right;display:block;min-width:47px;max-width:131px;}
#leftsead li a .shows{display:block;}
#leftsead li a .hides{margin-left:-80px;cursor:pointer;cursor:hand;}
#leftsead li a.u-sildeFade .hides{display:none;position:absolute;right:45px;top:-10px;}
#leftsead li a.u-sildeFade #weibo{display:none;position:absolute;right:45px;top:35px;}
		.footdownone { margin-bottom:13px;}
        .footdownone a{ font-size:14px; font-weight:bold}
		.footdownone a:hover{ color:#FFFF00; font-size:14px; font-weight:bold;text-decoration:none;}
		.f_linkdown a{ text-decoration:none;}
		.f_linkdown a:hover{ color:#FFFF00;text-decoration:none;}
        </style>
    </head>
    <body>
    <?php
     $db = Yii::app()->db;
	?>
        <div class="main">
            <!-- topdl开始 -->
            <div class="topdl">
            <div style="width:980px; margin:0 auto;">
                <div class="topdlbox" style="float:left;width:360px;">
                    <?php if (empty($this->_account['userId'])) { ?>
                        <div class="topdl_before">
                            <div class="loginbox">
                                <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" id="login">登录</a>
                                <a href="<?php echo Yii::app()->createUrl('user/register'); ?>" id="register">注册</a>
                                <a href="<?php echo Yii::app()->createUrl('site/forgetPassword'); ?>" id="forget" target="_blank">忘记密码</a>
							</div>
                            <div class="cl"></div>
                        </div>
                    <?php } else { ?>
                        <div class="topdl_after">
                            <a class="wd" href="<?php echo Yii::app()->createUrl('club/uCenter'); ?>"><?php if(!empty($this->_account['nickname'])){ echo $this->_account['nickname']; }else{ echo $this->_account['userName']; } ?></a>
                            <a class="out" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">退出</a>
                        </div>
                    <?php } ?>
					
                </div>
				<div class="topnumber" style="float:right; width:auto; ">
					<div class="nav-adv"  style=" margin-top:6px;">
					<?php
            				       $criteria = new CDbCriteria();
					        $criteria->order = 'date DESC';
						$criteria->select = 'subdate(date, 1) as date,(t_resi + t_condo) as t_resi,(u_resi + u_condo) as u_resi ,round(avg_price/10000,2) as avg_price ';
						$stats = Stats::model()->find($criteria);
 
 
					 ?>
                    <span class="glyphicon glyphicon-home">
					目前有住宅房源<font color="#FF0000"><a href="<?php echo Yii::app()->createUrl('stats/current'); ?>"><?php echo $stats["t_resi"]; ?></a></font>套，
					平均房价<font color="#FF0000"><a href="<?php echo Yii::app()->createUrl('stats'); ?>"><?php echo $stats["avg_price"]; ?></a></font>万加币,<?php echo $stats["date"]; ?>
					更新房源<font color="#FF0000"><?php echo $stats["u_resi"]; ?></font>套</span>
					</div>
				</div>
                </div>
			</div>
            <!-- topdl结束 -->
			
			
            <!-- head开始 -->
            <div class="head">
                <div class="headleft"><a href="<?php echo Yii::app()->createUrl('site/index'); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/logo.jpg" border="0" /></a></div>
                <div class="headright">
                    <span class="headrightone">加拿大房产置业平台</span>
                    <span class="headrighttwo">400-870-1029</span>
                </div>
                <div class="cl"></div>
            </div>
            <!-- head结束 -->
            <?php
            $city_list = City::model()->findAll();
            $subject_list = Subject::model()->findAll(array(
                'condition' => 'recommend=1',
                'order'     => 'id DESC',
            ));
            ?>
            
            <!-- nav开始 -->
            <div class="nav">
                <div class="navbox">
                    <div class="navleft">
                        <div class="navlist"><a class="nav_up <?php if (Yii::app()->controller->id == 'site') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a></div>
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'hotrecommend') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('hotrecommend/index'); ?>">热点推荐</a>
                        
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                          <?php
             
				  $sqlredian = "select * from h_subject where recommend=1 limit 0,5";
				  $resultrd = $db->createCommand($sqlredian)->query();
				  foreach($resultrd as $houserd){
				  ?>
                                    <a href=""><?php echo $houserd["name"]; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'house' || Yii::app()->controller->id == 'map') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('house/index'); ?>">房源搜索</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                                    <!--<?php foreach($city_list as $obj){ ?>
                                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $obj->id, 'cd2' => 0, 'cd3' => 0, 'cd4' => 0, 'cd5' => 0, 'cd6' => 0, 'cd7' => 0, 'cd8' => 0, 'cd9' => 0, 'cd10' => 0)); ?>"><?php echo $obj->name; ?></a>
                                    <?php } ?>
									-->
									<a class="menuconditionsearch" href="<?php echo Yii::app()->createUrl('house/index') ?>">条件搜索</a>
									<a class="menuconditionsearch" href="<?php echo Yii::app()->createUrl('map/index'); ?>">地图搜索</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'housecz' || Yii::app()->controller->id == 'mapcz') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('housecz/index'); ?>">房屋出租</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
         
									<a class="menuconditionsearch" href="<?php echo Yii::app()->createUrl('housecz/index') ?>">条件搜索</a>
									<a class="menuconditionsearch" href="<?php echo Yii::app()->createUrl('mapcz/index'); ?>">地图搜索</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'enjoy') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('enjoy/index'); ?>">豪宅鉴赏</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                                    <?php foreach($subject_list as $obj){ ?>
                                        <a href="<?php echo Yii::app()->createUrl('enjoy/more', array('city' => $obj->city_id)); ?>"><?php echo $obj->city->name; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="navlist"><a class="nav_up <?php if (Yii::app()->controller->id == 'column') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('column/index'); ?>">学区专栏</a></div>
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'news') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('news/canadaNews'); ?>">新闻&nbsp;资讯</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews'); ?>">加拿大资讯</a>
                                    <a href="<?php echo Yii::app()->createUrl('news/houseNews'); ?>">加拿大房产</a>
																		<a href="<?php echo Yii::app()->createUrl('news/canadaNews2'); ?>">加拿大留学</a>
																		<a href="<?php echo Yii::app()->createUrl('news/canadaNews3'); ?>">加拿大移民</a>
																		<a href="<?php echo Yii::app()->createUrl('news/canadaNews4'); ?>">加拿大旅游</a>
                                </div>
                            </div>
                        </div>
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'studyabroad') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('about/about1&id=27'); ?>">关于枫之都</a>
														<div class="navtc">
                                <div class="navtcbox" style="display:none;">
                                    <a href="<?php echo Yii::app()->createUrl('about/about1&id=27'); ?>">枫之都简介</a>
                                    <a href="<?php echo Yii::app()->createUrl('about/about1&id=28');  ?>">我们的优势</a>
<!--																		<a href="<?php // echo Yii::app()->createUrl('about/about1&id=29'); ?>">合作伙伴</a>-->
																		<a href="<?php echo Yii::app()->createUrl('about/partner'); ?>">合作伙伴</a>
																		<a href="<?php echo Yii::app()->createUrl('about/about1&id=30'); ?>">联系我们</a>
																		<a href="<?php echo Yii::app()->createUrl('about/about1&id=31'); ?>">人才招募</a>
                                </div>
                            </div>
												</div>
                        <div class="navlist nav-wrap" style="width:118px;"><a class="nav_up <?php if (Yii::app()->controller->id == 'club') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('about/about1&id=38'); ?>" style="width: 120px;">枫之都俱乐部</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                               
                                    <a href="<?php echo Yii::app()->createUrl('club/service'); ?>">海外服务</a>
                                    <a href="<?php echo Yii::app()->createUrl('club/files'); ?>">资料下载</a>
																		 <?php if (!empty($this->_account['userId'])) { ?>
                                    <a href="<?php echo Yii::app()->createUrl('club/uCenter', array('userId'=>$this->_account['userId'])); ?>">会员中心</a>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <span class="nav_span">1</span>
                    </div>
                    <div class="search">
                        <div class="searchleft">
                          <input name="key" type="text" id="global_search" class="inputone" value="MLS号" onblur="if (this.value == '') {
                                    this.style.color = '#999';
                                    this.value = 'MLS号';
                                }" onfocus="if (this.value == 'MLS号') {
                                            this.value = '';
                                        } else {
                                            this.style.color = '#000';
                                        }" style="color: rgb(153, 153, 153);" />
                        </div>
                      <div class="searchright"><input name="" type="submit" class="btnone" value="" id="global_search_btn"/>
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="cl"></div>
                </div>
            </div>
            <!-- nav结束 -->
            <!-- body开始 -->
            <?php echo $content; ?>
            <!-- body结束 -->
            <?php if( Yii::app()->controller->id != 'map'){?>
            <!-- 二维码开始 -->
<!-- 二维码开始 -->
<div class="ewm">
  <div class="ewmleft">
    <div class="ewmpic"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ewm.jpg"></div>
    <div class="ewm_wz">
      <div class="ewm_wz_title">枫之都能为您做些什么？</div>
      <div class="ewm_wz_info"> 枫之都投资置业顾问有限公司，是中国领先的加拿大房产置业及投资管理的专业服务机构。凭借公司核心团队对加拿大地产领域丰富的投资经验，枫之都为中国客户搭建了强大的加拿大房产置业销售平台，并为中国客户提供加拿大不动产置业、管理，投资贷款，留学自住，移民安家等一站式服务！ </div>
      <div class="ewm_wz_info"> 目前枫之都已与10多家加拿大知名房产开发商建立了合作关系，同时，与加拿大各大银行、知名律师行，投资公司以留学移民公司构建了长期的战略合作关系。 </div>
      <div class="ewm_wz_info"> 枫之都投资置业顾问有限公司，不仅仅是加拿大房产置业的平台，同时还是一个公益事业的平台。枫之都将每年的部分销售利润注入枫之都俱乐部，搭建一个海外学子职业规划，就业指导，及紧急资助的平台！ </div>
      <div class="ewm_wz_last">枫之都------加拿大房产置业平台</div>
    </div>
    <div class="cl"></div>
  </div>
  <div class="ewmright">
  <div class="telwz">枫之都全国服务热线</div>
    <div class="tel"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/house/tel.gif" align="top"/>400-870-1029</div>
    
    <div class="telwz_time">周一至周日9:00-21:00<br>
      法定节假日除外</div>
  </div>
  <div class="cl"></div>
</div>
<!-- 二维码结束 --> 
<!-- foot开始 -->
<div class="foot">
  <div class="footup">
    <div class="f_linkup"> 友情链接 </div>
    <div class="f_linkdown">
                  <ul>
                  <?php
             
				  $sqljiaguo = "select * from h_link";
				  $resultjiaguo = $db->createCommand($sqljiaguo)->query();
				  foreach($resultjiaguo as $househaizai){
				  ?>
                       <li><a href="<?php echo $househaizai["url"];?>" target="_blank"><img src="<?php echo $househaizai["pic"];?>" width="80" height="40"/><BR /><?php echo $househaizai["title"];?></a></li>
                  <?php }?>
       
                       
                  </ul>
      <div class="cl"></div>
    </div>
  </div>
  <div class="footdown" style=" padding-top:30px;">
    <div class="footdownone"> <a href="index.php?r=about/about1&id=27">关于我们</a> <a href="index.php?r=about/about1&id=31">加入我们</a> <a href="index.php?r=about/about1&id=28">媒体报道</a> <a href="index.php?r=hotrecommend/index">海外房展</a> <a href="index.php?r=about/partner">公司动态</a> <a href="index.php?r=about/about1&id=30">联系我们</a> <a href="index.php?r=about/about1&id=40">投资须知</a> </div>
    <div class="footdowntwo">邮箱:info-china@maplecity.com.cn Copyright©2015 MAPLECITY Inc. &nbsp;All Rights Reserved    <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">苏ICP备10045531号-4</a></div>
  </div>
</div>
<!-- foot结束 -->
<?php } ?>
</div>
<!-- 返回头部开 -->
 <div id="leftsead">
    <ul class="list-unstyled">
        <li>
            <a class="u-sildeFade">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top_2.png" width="47" height="49" class="shows" />
                <img src="/themes/house/images/lianxi1.png"  class="hides" usemap="#taklhtml"/>
            </a>
        </li>
        <li>
            <a class="u-sildeFade">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top_4.png" width="47" height="49" class="shows" />
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/weixin2.png" width="200" height="240" class="hides" usemap="#taklhtml"/>
            </a>
        </li>
        <li>
            <a class="u-sildeFade" href="http://weibo.com/p/1006065704804217/home">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top_3.png" width="47" height="49" class="shows" />
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/weibo2.png" width="200" height="240" id="weibo" class="hides" usemap="#taklhtml"/>
            </a>
        </li>
        <li>
            <a href="tencent://message/?uin=1969378190&Site=maplecity.com.cn&Menu=yes">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ll04.png" width="131" height="49" class="hides"/>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top_1.png" width="47" height="49" class="shows" />
            </a>
        </li>
        <li>
            <a href="http://j.map.baidu.com/tp727" target="_blank" title="地图">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ll05.png" width="131" height="49" class="hides"/>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top_5.png" width="47" height="49" class="shows" />
            </a>
        </li>
        <li>
            <a id="top_btn">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ll06.png" width="131" height="49" class="hides"/>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/top.png" width="47" height="49" class="shows" />
            </a>
        </li>
    </ul>
</div><!--leftsead end-->
<script type="text/javascript">
$(document).ready(function(){
	$(".hides").hide();
	$("#leftsead a").hover(function(){
		if($(this).prop("className")=="u-sildeFade"){
			$(this).children("img.hides").show();
		}else{
			$(this).children("img.hides").show();
			$(this).children("img.shows").hide();
			$(this).children("img.hides").animate({marginLeft:'0px'},'slow');
		}
	},function(){
		if($(this).prop("className")=="u-sildeFade"){
			$(this).children("img.hides").hide('slow');
		}else{
			$(this).children("img.hides").animate({marginLeft:'-80px'},'slow',function(){$(this).hide();$(this).next("img.shows").show();});
		}
	});
	$("#top_btn").click(function(){if(scroll=="off") return;$("html,body").animate({scrollTop: 0}, 300);});

});


				//导航下拉弹出
$(document).ready(function() {
	$(".nav-wrap").mouseover(function() {
		$(this).find(".nav_up").addClass("on_a");
		var navwidth=$(this).find(".nav_up").width();
		$(this).find(".navtcbox").width(navwidth)
		$(this).find(".navtcbox").stop(true).delay(400).slideDown();
	});
	$(".nav-wrap").mouseout(function() {
		$(this).find(".navtcbox").stop(true).slideUp();
		$(this).find(".nav_up").removeClass("on_a");
	});
	
	
	$("#global_search").bind("enterKey",function(e){
	//do stuff here
   
	var msl = $("#global_search").val();
	$.post('<?php echo Yii::app()->createUrl('site/globalSearch'); ?>', {'msl': msl}, function(json){
		if(json.success){
			window.open(json.msg);
		}else{
			alert(json.msg);
		}
	}, 'json');
	
	});
	$("#global_search").keyup(function(e){
		if(e.keyCode == 13)	{
        $(this).trigger("enterKey");
		}
	});
	

	$("#global_search_btn").click(function(){
		var msl = $("#global_search").val();
		$.post('<?php echo Yii::app()->createUrl('site/globalSearch'); ?>', {'msl': msl}, function(json){
			if(json.success){
				window.open(json.msg);
			}else{
				alert(json.msg);
			}
		}, 'json');
	});
	
});
</script>   

    </body>
</html>
