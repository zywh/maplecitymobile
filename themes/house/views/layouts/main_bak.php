<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fczx.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.jslides.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/koala.min.1.5.js"></script>
        <title>加拿大房产置业平台</title>
        <?php if( Yii::app()->controller->id == 'map' || Yii::app()->controller->id == 'house'){?>
        <!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB0Nd3Cbj-HPwggqQPpbGEMlPXe91muGMw&sensor=false"></script>-->
        <script type="text/javascript" src="http://ditu.google.cn/maps/api/js?libraries=places&sensor=false&language=zh-cn"></script>
        <script type="text/javascript" src="<?php echo $this->_baseUrl ?>/static/map/js/richmarker-compiled.js"></script>
        <?php }?>
    </head>
    <body>
        <div class="main">
            <!-- topdl开始 -->
            <div class="topdl">
                <div class="topdlbox">
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
                        <div class="navlist"><a class="nav_up <?php if (Yii::app()->controller->id == 'hotrecommend') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('hotrecommend/index'); ?>">热点推荐</a></div>
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'house' || Yii::app()->controller->id == 'map') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('house/index'); ?>">房源搜索</a>
                            <div class="navtc">
                                <div class="navtcbox" style="display:none;">
                                    <?php foreach($city_list as $obj){ ?>
                                    <a href="<?php echo Yii::app()->createUrl('house/index', array('cd1' => $obj->id, 'cd2' => 0, 'cd3' => 0, 'cd4' => 0, 'cd5' => 0, 'cd6' => 0, 'cd7' => 0, 'cd8' => 0, 'cd9' => 0, 'cd10' => 0)); ?>"><?php echo $obj->name; ?></a>
                                    <?php } ?>
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
                        <div class="navlist nav-wrap"><a class="nav_up <?php if (Yii::app()->controller->id == 'news') echo 'nav_active'; ?>" href="<?php echo Yii::app()->createUrl('news/canadaNews'); ?>">新闻&nbsp;•&nbsp;资讯</a>
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
                        <div class="searchleft"><input name="key" type="text" id="global_search" class="inputone" value="MLS号" onblur="if (this.value == '') {
                                    this.style.color = '#999';
                                    this.value = 'MLS号';
                                }" onfocus="if (this.value == 'MLS号') {
                                            this.value = '';
                                        } else {
                                            this.style.color = '#000';
                                        }" style="color: rgb(153, 153, 153);"></div>
                        <div class="searchright"><input name="" type="button" class="btnone" value="" id="global_search_btn"/>
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
            <div class="ewm">
                <div class="ewmleft">
                    <div class="ewmpic"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/ewm.jpg" /></div>
                    <div class="ewm_wz">
                        <div class="ewm_wz_title">枫之都能为您做些什么？</div>
                        <div class="ewm_wz_info">
                            枫之都投资置业顾问有限公司，是中国领先的加拿大房产置业及投资管理的专业服务机构。凭借公司核心团队对加拿大地产领域丰富的投资经验，枫之都为中国客户搭建了强大的加拿大房产置业销售平台，并为中国客户提供加拿大不动产置业、管理，投资贷款，留学自住，移民安家等一站式服务！
                        </div>
						<div class="ewm_wz_info">
							目前枫之都已与10多家加拿大知名房产开发商建立了合作关系，同时，与加拿大各大银行、知名律师行，投资公司以留学移民公司构建了长期的战略合作关系。
                        </div>
						<div class="ewm_wz_info">
							枫之都投资置业顾问有限公司，不仅仅是加拿大房产置业的平台，同时还是一个公益事业的平台。枫之都将每年的部分销售利润注入枫之都俱乐部，搭建一个海外学子职业规划，就业指导，及紧急资助的平台！
                        </div>
                        <div class="ewm_wz_last">枫之都------加拿大房产置业平台</div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="ewmright">
                    <div class="tel">400-870-1029</div>
                    <div class="telwz">枫之都能为您做些什么？</div>
                    <div class="telwz_time">周一至周日9:00-21:00<br />法定节假日除外</div>
                </div>
                <div class="cl"></div>
            </div>
            <!-- 二维码结束 -->
            <!-- foot开始 -->
            <div class="foot">
                <div class="footup">
                    <div class="f_linkup">
                        友情链接
                    </div>
                    <div class="f_linkdown">
                        <?php $link_list = Link::model()->findAll();
                        foreach($link_list as $obj){
                        ?>
                        <a href="<?php echo $obj->url; ?>"><?php echo $obj->title; ?></a>
                        <?php } ?>
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="footdown">
                    <div class="footdownone">
                        <a href="#">关于我们</a>
                        <a href="#">加入我们</a>
                        <a href="#">媒体报道</a>
                        <a href="#">海外房展</a>
                        <a href="#">公司动态</a>
                        <a href="#">联系我们</a>
                        <a href="#">投资须知</a>
                    </div>
                    <div class="footdowntwo">邮箱:info@ausingroup.com    Copyright@2002-2014 AUSIN GROUP Inc.All Rights Reserved <br />
                        枫之都   版权所有    <a href="#">苏ICP备10045531号-4</a></div>
                </div>
            </div>
            <!-- foot结束 -->
            <?php } ?>
        </div>
        <!-- 返回头部开 -->
        <div class="topbox">
            <div class="topone fh"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/top.png" /></div>
            <div class="topone">
                <a href="javascript:void(0);" title="咨询客服"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/top_2.png" border="0" /></a>
                <div class="back back_lxfs" style="display:none;">
                    <p>
                        <span>24小时服务热线：</span>
                        400-870-1029
                    </p>
                    <p>
                        <span>工作时间：</span>
                        周一到周日&nbsp;&nbsp;全天24小时
                    </p>
                    <!--<p style="border-bottom: none;">
                        <span>广告热线：</span>
                        021-3160 8595
                    </p>-->
                </div>
            </div>
            <div class="topone">
                <a href="javascript:void(0);" title="QQ咨询"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/top_1.png" border="0" /></a>
                <div class="back back_qq" style="display:none;">
                    <?php foreach((array)Bagecms::getList('Consult','index_consult') as $key=>$row){?>
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $row['QQ']; ?>&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $row['QQ']; ?>:52" alt="点击这里给我发消息">QQ咨询</a>
                    <?php } ?>
                </div>
            </div>
            <div class="topone">
                <a href="javascript:void(0);" title="分享到微博"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/top_3.png" border="0" /></a>
                <div class="back back_wb" style="display:none;">
                    <div>
                        <a href="javascript:void(0);" target="_blank" looyu_bound="1">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/back_wb.jpg" alt="" width="100" height="100">
                        </a>
                    </div>
                    <div class="weixin_iconbg">
                        <p>官方微博</p>
                    </div>
                </div>
            </div>
            <div class="topone">
                <a href="javascript:void(0);" title="分享到微信"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/top_4.png" border="0" /></a>
                <div class="back back_wb" style="display:none;">
                    <div>
                        <a href="javascript:void(0);" target="_blank" looyu_bound="1">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/back_wx.jpg" alt="" width="100" height="100">
                        </a>
                    </div>
                    <div class="weixin_iconbg">
                        <p>官方微信</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 返回头部结束 -->

        <script type="text/javascript">
            $(document).ready(function() {
                //回到头部
                $(".fh").click(function() {
                    $("html,body").animate({scrollTop: 0}, 250);//100为滚动条的位置，1000为滚动的时延
                });

                //回到头部浮动效果
                $(document).ready(function() {
                    var fd = $(".topbox").offset().top;
                    $(window).scroll(function() {
                        var jtb = $(this).scrollTop();
                        if (jtb >= fd) {
                            $(".topbox").addClass("fhone")
                        }
                        else {
                            $(".topbox").removeClass("fhone")
                        }
                    });
                });

                //浮动导航效果
                $(document).ready(function() {
                    var jl = $(".nav").offset().top;
                    $(window).scroll(function() {
                        var djl = $(this).scrollTop();
                        if (djl >= jl) {
                            $(".nav").addClass("navfd");
                        }
                        else {
                            $(".nav").removeClass("navfd")
                        }
                    });
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
                });

                //top右侧弹出
                $(".topone").mouseover(function(){
                    $(this).find(".back").show();
                });
                $(".topone").mouseout(function(){
                    $(this).find(".back").hide();
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