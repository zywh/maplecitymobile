<link type="text/css" rel="stylesheet" href="http://www.idangero.us/swiper/dist/css/swiper.min.css" media="all" />
<script src="http://www.idangero.us/swiper/dist/js/swiper.min.js"></script>
<style>
.swiper-pagination-bullet { opacity: 1; background: #fff; }
.swiper-pagination-bullet-active { opacity: 1; background: #ff4103; }

</style>

<!-- banner开始 -->
<div class="ink_phoBok" >

	<div class="swiper-container" >
		<div class="swiper-wrapper">
				<?php 
				foreach($banner as $k => $obj){ 
					
					?><div class="swiper-slide" >
					
					<img style=" 	width: 100%;height: auto;"		src="<?php 
					echo Yii::app()->request->baseUrl;?>/<?php echo $obj->image; ?>">
					
				</div>
				<?php }?> 
		</div>
		<div class="swiper-pagination"></div>
	
	</div>
<script>
	var swiper = new Swiper(".swiper-container", {
		pagination: ".swiper-pagination",
		paginationClickable: true,
		autoplay: 3000,
		speed: 1000,
		autoplayDisableOnInteraction: true
	});
</script>
</div>

<!-- banner结束 -->


<!-- /navbar -->
<div class="home-navi-bar" data-role="navbar" >
    <ul>
	<li><a id='about_us' href="index.php?r=about/about1&id=27" data-ajax="false" >关于我们</a></li>
	<li><a id='mapsearch' href="index.php?r=map" data-ajax="false">地图搜索</a></li>
	<li><a id='housesearch' href="index.php?r=mhouse" data-ajax="false">房源搜索</a></li>
	<li><a id='about_hire' href="index.php?r=about/partner" data-ajax="false">合作伙伴</a></li>

    </ul>
</div>
<!-- /navbar -->

<!-- MLS START -->
<div class="nycont_mls">
<div class="nycont_sgkjj"><p id="socialicons3">
	 <a style="margin-left:0px;" data-ajax="false" class="sgkjj1" href="index.php?r=about2/about2&id=32"><IMg src="/themes/house/images/index/btn1.jpg" border="0"/></a>
	 <a class="sgkjj2" data-ajax="false" href="index.php?r=about2/about2&id=33"><IMg src="/themes/house/images/index/btn2.jpg" border="0"/></a>
	 <a class="sgkjj3" data-ajax="false" href="index.php?r=about2/about2&id=34"><IMg src="/themes/house/images/index/btn3.jpg" border="0"/></a>
	 <a style="margin-right:0px;" data-ajax="false" class="sgkjj4"  href="index.php?r=about2/about2&id=36"><IMg src="/themes/house/images/index/btn4.jpg" border="0"/></a>
	 </p>
	 
</div>
</div>

<!-- MLS END -->

<div class="lm_four">
     <div class="lm_four_banner"><a href="index.php?r=about2/about2&id=33"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/tl_3.jpg" /></a></div>
 
</div>

<!-- 加国资讯结束 -->


<!-- 合作伙伴开始 -->
<div class="lm_eight">
    <div class="lm_eight_up"></div>
    <div class="lm_eight_down">
        <span><a href="http://www.maplecity.com.cn/index.php?r=about/tridel" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></a></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><a href="http://www.maplecity.com.cn/index.php?r=about/westbank" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></a></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_4.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_5.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_6.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_7.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_8.jpg" /></span>

        <div class="cl"></div>
    </div>
</div>

<!-- 合作伙伴结束 -->
