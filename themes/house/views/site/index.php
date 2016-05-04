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
				
				 <?php foreach($subject_list as $project){ ?>
					<div class="swiper-slide" >
					<a data-ajax="false" href="<?php echo Yii::app()->createUrl('projects/more',array('id'=>$project->id)); ?>"><img style="width: 100%;height: 250px;"	src="<?php 
					echo Yii::app()->request->baseUrl;?>/<?php echo $project->room_type_image; ?>"></a>
					
				
					</div>
				<?php }?> 
		</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-next swiper-button-white"></div>
		<div class="swiper-button-prev swiper-button-white"></div>

	
	</div>
<script>
	var swiper = new Swiper(".swiper-container", {
		pagination: ".swiper-pagination",
		paginationClickable: true,
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		autoplay: 3000,
		speed: 2000,
coverflow: {
  rotate: 50,
  stretch: 0,
  depth: 100,
  modifier: 1,
  slideShadows : true
},
		autoplayDisableOnInteraction: true
	});
</script>
</div>

<!-- banner结束 -->


<!-- /navbar -->
<div class="home-navi-bar" data-role="navbar" >
    <ul>
	<li><a id='about_us' href="index.php?r=about/about1&id=27" data-ajax="false" >关于我们</a></li>
	<li><a id='projects' href="index.php?r=projects" data-ajax="false">项目推荐</a></li>
	<li><a id='mapsearch' href="index.php?r=map" data-ajax="false">地图搜索</a></li>
	<li><a id='housesearch' href="index.php?r=mhouse" data-ajax="false">房源搜索</a></li>
	

    </ul>
</div>
<!-- /navbar -->

<!-- MLS START -->
<div class="nycont_mls">

	<div class="ui-grid-c">
		<div class="ui-block-a">
			<a data-ajax="false"  href="index.php?r=about2/about2&id=32"><IMg class="mlsimg" src="/themes/house/images/index/btn1.jpg" ></a>
		 </div>
		<div class="ui-block-b">
			<a  data-ajax="false" href="index.php?r=about2/about2&id=33"><IMg class="mlsimg" src="/themes/house/images/index/btn2.jpg" ></a>
		   </div>
		<div class="ui-block-c">
			<a  data-ajax="false" href="index.php?r=about2/about2&id=34"><IMg class="mlsimg" src="/themes/house/images/index/btn3.jpg" ></a>
		</div>
		<div class="ui-block-d">
		<a data-ajax="false"  href="index.php?r=about2/about2&id=36"><IMg class="mlsimg" src="/themes/house/images/index/btn4.jpg" ></a>
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
