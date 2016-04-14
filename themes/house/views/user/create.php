<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>用户注册-加拿大房产置业平台</title>
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
		.f_linkdown ul{ padding:0px; margin:0px; }
		f_linkdown ul li{ list-style-type:none;}
        </style>
        <link type="text/css" rel="stylesheet" href="/themes/house/css/layout.css" />

</head>

<body>
<div class="main">
    <?php
     $db = Yii::app()->db;
	?>
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
    <!-- 登陆开始 -->
    <div class="zc_jm">
        <div class="zc_jm_left">
               <div class="zc_jm_left_up"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/zc_tp.jpg" /></div>
               <div class="zc_jm_left_down">
                    <div class="zc_jm_left_down_left">
                          <span><em>1、</em>热点推荐项目详细资料下载；  </span>
                          <span><em>2、</em>最新加拿大投资指南下载； </span>
                          <span><em>3、</em>学区房选房专属顾问；  </span>
                          <span><em>4、</em>投资收益报告下载；</span>
                          <span><em>5、</em>枫之都俱乐部会员海外服务跟踪；</span>
                          <span><em>6、</em>加拿大移民攻略下载；</span>
                          <span><em>7、</em>其他资料下载。</span>
                          <div class="cl"></div>
                    </div>
                    <div class="zc_jm_left_down_right">
                          <div class="dl_jm_left_info">
                               <div class="dl_jm_left_info_one">如需帮助，请致电</div>
                               <div class="dl_jm_left_info_two">400-870-1029</div>
                               <div class="dl_jm_left_info_three"><?php $result = Bagecms::getList('Consult','index_consult'); ?>
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $result[0]['QQ']; ?>&amp;site=qq&amp;menu=yes">在线咨询</a></div>
                          </div>
                    </div>
                    <div class="cl"></div>
               </div>
         </div>
        <div class="dl_jmbg dl_zc">
            <div class="dl_jm_label">注 册</div>
            <div class="dl_jm_cont">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-wrap',
                    'enableAjaxValidation'=>true,
                )); ?>
                <div class="dl_jm_one"><?php echo $form->textField($model, 'username'); ?><label>用户名</label></div>
                <?php echo $form->error($model,'username'); ?>
                <div class="dl_jm_one"><?php echo $form->textField($model, 'email'); ?><label>邮 箱</label></div>
                <?php echo $form->error($model,'email'); ?>
                <div class="dl_jm_one"><?php echo $form->textField($model, 'phone'); ?><label>手 机</label></div>
                <?php echo $form->error($model,'phone'); ?>
                <div class="dl_jm_one"><?php echo $form->passwordField($model, 'password'); ?><label>密 码</label></div>
                <?php echo $form->error($model,'password'); ?>
                <div class="dl_jm_one"><?php echo $form->passwordField($model, 'password_repeat'); ?><label>确认密码</label></div>
                <?php echo $form->error($model,'password_repeat'); ?>
                <div class="dl_jm_one dl_jm_yzm"><?php echo $form->textField($model, 'sms_code'); ?><label>手机验证码</label><a href="javascript:;" class="sjyzm" id="get_code">获取验证码&nbsp;<span id="time">180</span>秒</a></div>
                <?php echo $form->error($model,'sms_code'); ?>
                <input type="hidden" id="sms_uid" value="<?php echo $sms_data->uid; ?>"/>
                <input type="hidden" id="sms_psw" value="<?php echo $sms_data->password; ?>"/>
                <input type="hidden" id="sms_cid" value="<?php echo $sms_data->cid; ?>"/>
                <div class="dl_jm_two dl_zhmmdown zc_a">
                    <input type="submit" name="login" class="input-register" value="注 册"/>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <!-- 登陆结束 -->
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
<script type="text/javascript">
    //input判断
    $(document).ready(function(){
        var ele = $("#get_code");
        var time_ele = $("#time");
        var second = 180;

        if($('#User_username').val() != ""){
            $('#User_username').next().hide();
        }
        if($('#User_email').val() != ""){
            $('#User_email').next().hide();
        }
        if($('#User_phone').val() != ""){
            $('#User_phone').next().hide();
        }
        if($('#User_password').val() != ""){
            $('#User_password').next().hide();
        }
        if($('#User_password_repeat').val() != ""){
            $('#User_password_repeat').next().hide();
        }
        if($('#User_sms_code').val() != ""){
            $('#User_sms_code').next().hide();
        }

        $(".dl_jm_one input").click(function(){
            $(this).next().hide();
        });
        $(".dl_jm_one input").blur(function(){
            if($(this).val()==""){
                $(this).next().show();
            }
        });
        $("label").click(function(){
            $(this).hide();
            $(this).prev().focus();
        });

        var counter = function(){
            time_ele.text(second);
            second -= 1;
        }

        ele.click(function(){
            var sms_phone = $("#User_phone").val();
            var sms_uid = $("#sms_uid").val();
            var sms_psw = $("#sms_psw").val();
            var sms_cid = $("#sms_cid").val();

            $.post('<?php echo Yii::app()->createUrl('user/ajaxCheck'); ?>', {"sms_phone": sms_phone}, function(check){
                if(check.success){
                    var data = {
                        'sms_phone': sms_phone,
                        'sms_uid': sms_uid,
                        'sms_psw': sms_psw,
                        'sms_cid': sms_cid
                    }
                    $.post('<?php echo Yii::app()->createUrl('user/ajaxGetCode'); ?>', data, function(json){
                        if(json.success){
                            var time = setInterval(counter, 1000);
                            ele.attr('disabled', true);
                            ele.css('cursor', 'not-allowed');
                            setTimeout(function(){
                                clearInterval(time);
                                second = 180;
                                ele.css('cursor', 'pointer');
                                ele.attr('disabled', false);
                            },181000);
                        }else{
                            alert(json.msg);
                        }
                    }, 'json');
                }else{
                    alert(check.msg);
                    return false;
                }
            }, 'json');
        });
    });
</script>
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
            <a href="tencent://message/?uin=1969378190&Site=edojia.com&Menu=yes">
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
