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
    <!-- 登陆开始 -->
    <div class="dl_jm">
        <div class="dl_jm_left">
            <div class="dl_jm_left_info">
                <div class="dl_jm_left_info_one">如需帮助，请致电</div>
                <div class="dl_jm_left_info_two">400-870-1029</div>
                <div class="dl_jm_left_info_three"><a href="#">立即咨询</a></div>
            </div>
        </div>
        <div class="dl_jmbg zhmm_jmbg">
            <div class="dl_jm_label">修改密码</div>
            <div class="dl_jm_cont">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-wrap',
                    'enableAjaxValidation'=>true,
                )); ?>
                <div class="dl_jm_one"><?php echo $form->textField($model, 'password'); ?><label>新密码</label></div>
                <?php echo $form->error($model,'password'); ?>
                <div class="dl_jm_one"><?php echo $form->passwordField($model, 'password_repeat'); ?><label>确认密码</label></div>
                <?php echo $form->error($model,'password_repeat'); ?>
                <div class="zhmm_jm_two">
                    <?php echo $form->hiddenField($model, 'email', array('value'=>$email)); ?>
                    <input type="submit" name="login" value="提 交"/>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <!-- 登陆结束 -->
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
                枫之都   版权所有    苏ICP备10045531号-4</div>
        </div>
    </div>
</div>
<!-- foot结束 -->
<script type="text/javascript">
    //input判断
    $(document).ready(function(){
        if($('#User_username').val() != ""){
            $('#User_username').next().hide();
        }
        if($('#User_password').val() != ""){
            $('#User_password').next().hide();
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
    });
</script>
</body>
</html>
