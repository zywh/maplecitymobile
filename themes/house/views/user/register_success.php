<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>加拿大房产置业平台</title>
</head>

<body>
<div class="main">

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
    <!-- 跳转开始 -->
    <div class="tzym">
        <div class="tzymup">
            <span>注册成功</span><br />
            感谢您对枫之都的支持！<br />
            我们会继续努力为您提供更优质的服务，<br />
            愿您开心每一天！<br/>
            <span>页面将在&nbsp;<span id="counter">3</span>&nbsp;秒后自动跳转</span>
        </div>
        <div class="tzymdown"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/layout/thank.jpg" /></div>
    </div>
    <!-- 跳转结束 -->
    <script type="text/javascript">
        var counter = document.getElementById("counter");
        setTimeout(function(){
            counter.innerText = '2';
        }, 1000);
        setTimeout(function(){
            counter.innerText = '1';
        }, 2000);
        setTimeout(function(){
            counter.innerText = '0';
            window.location.href = '<?php echo Yii::app()->createUrl('site/login'); ?>';
        }, 3000);
    </script>
    <!-- foot开始 -->
    <div class="foot">
        <div class="footup">
            <div class="f_linkup">
                友情链接
            </div>
            <div class="f_linkdown">
                <?php foreach($link_list as $obj){ ?>
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
                枫之都   版权所有    苏ICP备10045531号-4</div>
        </div>
    </div>
</div>
<!-- foot结束 -->
</body>
</html>
