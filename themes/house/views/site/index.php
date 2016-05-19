<link rel="stylesheet" href="static/js/Swiper/css/swiper.min.css" >
<script src="static/js/Swiper/js/swiper.min.js"></script>
<style>
.swiper-pagination-bullet { opacity: 1; background: #fff; }
.swiper-pagination-bullet-active { opacity: 1; background: #ff4103; }
.swiper-slide img{
	width:100%;
	height:210px;
	
}

</style>


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

<!-- Swiper开始 -->
<div class="swiper-container" >
	<div class="swiper-wrapper">
			
			 <?php foreach($subject_list as $project){ ?>
				<div class="swiper-slide" >
				<a data-ajax="false" href="<?php echo Yii::app()->createUrl('projects/more',array('id'=>$project->id)); ?>"><img 	src="<?php 
				echo Yii::app()->request->baseUrl;?>/<?php echo $project->room_type_image; ?>"></a>
				
				</div>
			<?php }?> 
	</div>
	<div class="swiper-pagination"></div>
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>




<script>

$(document).on("pageshow","#page_main",function(){
	var swiper = new Swiper(".swiper-container", {
		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		
		effect: 'fade',
		fade: {
		  crossFade: true
		},
		//preloadImages: false,
		//lazyLoading: true,
		paginationClickable: true,
		loop: true,
		autoplay: 4000,
		speed: 2000,
		autoplayDisableOnInteraction: false

	});
	
});

</script>
</div>
<!-- Swiper结束 -->


<!-- MLS START -->

<div class="homepage-mls">



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
</div>

<!-- MLS END -->

<!-- 加国资讯开始-->
        
<script type="text/javascript" language="JavaScript" charset="utf-8"> 
<!--
// Set the max number of items to display (1-5):
	bmArtNumber = 5;

// Set to true to open links in a new window:
	bmArtNewWindow = false;

// Set to false to hide article descriptions (show headlines only):
	bmArtFull = true;

// Set the background color:
	bmArtBackgroundColor = '#ffffff';

// Set the padding (in pixels) to determine
// the amount of space to create around the link list:
	bmArtPadding = '5px';

// Set the font style for the words "华枫网--CHINASMILE::服务加拿大华人的综合性网站: TOP HEADLINES":
	bmArtHeadTag = '<span style="display:none;font-family:arial,helvetica,verdana,sans-serif; font-size:12px; color:#000000; font-weight:bold;">';
	
// Set the font style for the main text:
	bmArtFontTag = '<span style="font-family:arial,helvetica,verdana,sans-serif; font-size:16px; color:#000000; font-weight:normal;">';
	
// Set the font style for the 华枫网--ChinaSmile::服务加拿大华人的综合性网站 text at the bottom
	bmArtSmallTag = '<span style="display:none; font-family:arial,helvetica,verdana,sans-serif; font-size:10px; color:#000000; font-weight:normal;">';
	
// Make no changes below this line
// ===============================
	bmArtLoaded= false;
//-->
</script>
<script src="http://www.chinasmile.net/csnews/affiliate/Art.js" language="JavaScript" type="text/javascript" charset="utf-8"></script><script type="text/javascript" language="JavaScript" charset="utf-8">
<!-- 
	if (bmArtLoaded) {
		bmArtDeliver();
	}
	
//-->
</script> 
<noscript>
<div><a href="http://www.chinasmile.net/">Click here for top headlines from 华枫网--ChinaSmile::服务加拿大华人的综合性网站.</a></div>
</noscript>
<!-- End code for 华枫网--ChinaSmile::服务加拿大华人的综合性网站 content affiliates. -->

<!-- 加国资讯结束 -->




<!-- 合作伙伴结束 -->




