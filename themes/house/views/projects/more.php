<link href="/themes/house/redian/images_redian/redian.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://www.idangero.us/swiper/dist/css/swiper.min.css" media="all" />
<script src="http://www.idangero.us/swiper/dist/js/swiper.min.js"></script>



<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?libraries=places&language=zh-cn"></script>
<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<style>

.swiper-container { background-color:#888787;}
.swiper-slide img { 
	width: 330px; height: 330px;  
	padding:4px;
    border:1px solid #888787;
    background-color:#fff;}
.swiper-pagination-bullet { opacity: 1; background: #fff; }
.swiper-pagination-bullet-active { opacity: 1; background: #ff4103; }


</style>
<div align="center"><img src="/themes/house/images/tuijian121.jpg" /></div>

<div class="nytb_dz" style="width: 1022px;"> <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a> &gt; <span style="font-size:14px;">项目推荐</span> </div>

<div class="wrap">

	<div class="nav_wrap" style="width: 1022px;">
		<div class="nav_fl">
			<ul>
				<li style="width:96px;"><img src="/themes/house/redian/images_redian/shouye.gif" align="absmiddle"/><a href="/">首页</a><span>|</span></li>
				<li><a href="#000">项目介绍</a><span>|</span></li>
				<li><a href="#002">设施介绍</a><span>|</span></li>
				<li><a href="#003">户型介绍</a><span>|</span></li>
				<li><a href="#001">价格</a><span>|</span></li>
				<li style="width:112px;"><a href="#004">开发商介绍</a><span>|</span></li>
				<li style="width:56px;"><a href="#005">地图</a><span>|</span></li>
				<li style="width:140px;"><a href="#006">为何选择枫之都</a></li>
			</ul>
		</div>
		<div class="nav_fr">
		  <p> <img src="/themes/house/redian/images_redian/zixun.gif" align="absmiddle"/><a href="#">在线咨询</a></p>
		</div>
	</div>
     
     
	<div class="liucheng">
		<img src="/themes/house/redian/images_redian/liucheng.jpg"/>
	</div>
	<!-- Swiper Start -->
	<div class="project_images" >
			<div class="swiper-container s1" >
					<div class="swiper-wrapper">
				<?php 
			$imageList = unserialize($subject['image_list']);
			foreach((array)$imageList as $key=>$row):
						if($row):?>
							<div class="swiper-slide" >
							 <img data-src="<?php 
							 $s = str_replace("uploads","tn_uploads",$row['file']);
							 echo $this->_baseUrl;?>/<?php echo $s; ?>" class="swiper-lazy">
							  <div class="swiper-lazy-preloader "></div>
							 </div>

						<?php endif?>
				<?php endforeach?>

					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next swiper-button-white"></div>
					<div class="swiper-button-prev swiper-button-white"></div>

			</div>
	<script>
		var s1 = new Swiper('.s1', {
			pagination: '.swiper-pagination',
			slidesPerView: 3,
			preloadImages: false,
			lazyLoading: true,
			paginationClickable: true,
			spaceBetween: 22,
			loop: true,
			autoplay: 5000,
			speed: 2000,
			//scrollbar: '.swiper-scrollbar',
			//scrollbarHide: true,
			//grabCursor: true,
			autoplayDisableOnInteraction: true

		});
	</script>
	</div>
	<!-- Swiper End -->
	 
	 <!-- Project Summary Start -->
	 <a id="000" name="000"></a>
	<div class="project">
		<div class="intro_title"> <img src="/themes/house/redian/images_redian/intro.jpg"/>	
		</div>
		<div class="intro_top">
			<?php echo $subject['summary'];?>
		</div>
		<div class="intro_top">
			<?php echo $subject['point'];?>
		</div>
		
     </div>
	<!-- Project Summary End -->
	
	<!-- Project Point Start -->
	<a id="002" name="002"></a>
	<div class="surrounding">
		<div class="sur_title">
			<img src="/themes/house/redian/images_redian/surround.jpg"/>
		</div>
		<div class="surrounding_top">
			<?php echo $subject['amenities'];?>
		</div>
	</div>
     <!-- Project Point End -->
	 <!-- Project layout Start -->
	 <a id="003" name="003"></a>
    <div class="apartment">
		<div class="apart_title">
			<img src="/themes/house/redian/images_redian/apart.jpg"/>
		</div>
                
		<div class="layout_images" >
		<div class="swiper-container s2" >
			<div class="swiper-wrapper">
			<?php
			$layoutList = unserialize($subject['layout_list']);
			foreach((array)$layoutList as $key=>$row):
				if($row):?>
					<div class="swiper-slide" >
						<img data-src="<?php 
						$s = str_replace("uploads","tn_uploads",$row['file']);
						echo $this->_baseUrl?>/<?php echo $s;?>" class="swiper-lazy">
						<div class="swiper-lazy-preloader "></div>
					 </div>

				<?php endif?>
			<?php endforeach?>

			</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-next swiper-button-white"></div>
		<div class="swiper-button-prev swiper-button-white"></div>


		</div>
		<script>
			var s2 = new Swiper('.s2', {
			pagination: '.swiper-pagination',
			slidesPerView: 3,
			preloadImages: false,
			lazyLoading: true,
			paginationClickable: true,
			spaceBetween: 22,
			loop: true,
			autoplay: 5000,
			speed: 2000,
			//scrollbar: '.swiper-scrollbar',
			//scrollbarHide: true,
			grabCursor: true,
			autoplayDisableOnInteraction: true
			});
		</script>

	</div>

		<a id="001" name="001"></a>
		<div class="intro_top">
			<?php echo $subject['price'];?>
		</div>
	
     </div>
     <!-- Project Point End -->
	 <!-- Project Developer  Start -->
    <a id="004" name="004"></a>
     
	<div class="developer">
		<div class="dev_title">
			<img src="/themes/house/redian/images_redian/developers.jpg" width="1072" height="66"/>
		</div>
		<div class="developer_intro">
			<?php echo $subject['developer_intro'];?>
		</div>
	</div>
  <!-- Project Developer  End -->
      <!-- Project Map  Start -->
	<a id="005" name="005"></a>

	<div class="maps">
		<div class="map_title">
			<img src="/themes/house/redian/images_redian/maps.jpg"/>
		</div>

		<div class="liyou_con" style="margin-top:-20px;">
			<script>
			window.onload=function()//用window的onload事件，窗体加载完毕的时候
			{
				daolumap();
			}
			</script>		
		</div>
    
	</div>
      <!-- Project Map  End -->
     
       <!-- Project Advantage  Start -->
    <a id="006" name="006"></a>
    <div class="liyou">
		<div class="liyou_title">
			<img src="/themes/house/redian/images_redian/liyou.jpg"/>
		</div>
		<div class="liyou_con">
			<img src="/themes/house/redian/images_redian/reason.jpg"/>
		</div>
    </div>
  <!-- Project A  End -->

</div>
