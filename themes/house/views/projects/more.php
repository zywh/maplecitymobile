<link rel="stylesheet" href="static/js/Swiper/css/swiper.min.css" >
<script src="static/js/Swiper/js/swiper.min.js"></script>


<script type="text/javascript" src="http://ditu.google.cn/maps/api/js?libraries=places&language=zh-cn"></script>
<script type="text/javascript" src="/static/map/js/richmarker-compiled.js"></script>
<style>


.swiper-slide img { width: 100%; height: 270px;  }
.project_title { color:#ff4103;text-align:center;}
	
.swiper-pagination-bullet { opacity: 1; background: #fff; }
.swiper-pagination-bullet-active { opacity: 1; background: #ff4103; }


</style>

<div class="wrap">

 
 
	<div class="project_title"><h3><?php echo $subject['name'];?></h3>
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
							 <img src="<?php 
							 $s = str_replace("uploads","tn_uploads",$row['file']);
							 echo $this->_baseUrl;?>/<?php echo $s; ?>" >
							
							 </div>

						<?php endif?>
				<?php endforeach?>

					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next swiper-button-white"></div>
					<div class="swiper-button-prev swiper-button-white"></div>

			</div>

	</div>
	<!-- Swiper End -->


	<div data-role="collapsibleset" data-corners="false" data-theme="a" data-content-theme="a">
	<div data-role="collapsible">
		<h3>项目介绍</h3>
		<p><?php echo $subject['summary'];?></p>
	</div>
	<div data-role="collapsible">
		<h3>配套设施</h3>
		<p><?php echo $subject['amenities'];?></p>
	</div>
	<div data-role="collapsible">
		<h3>项目详情</h3>
		<p><?php echo $subject['point'];?></p>
	</div>
	<div data-role="collapsible">
		<h3>户型介绍</h3>
		              
		<div class="layout_images" >
		<div class="swiper-container s2" >
			<div class="swiper-wrapper">
			<?php
			$layoutList = unserialize($subject['layout_list']);
			foreach((array)$layoutList as $key=>$row):
				if($row):?>
					<div class="swiper-slide" >
						<img src="<?php 
						$s = str_replace("uploads","tn_uploads",$row['file']);
						echo $this->_baseUrl?>/<?php echo $s;?>" >
						
					 </div>

				<?php endif?>
			<?php endforeach?>

			</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-next swiper-button-white"></div>
		<div class="swiper-button-prev swiper-button-white"></div>


		</div>


	</div>

	</div>
	<div data-role="collapsible">
		<h3>开发商介绍</h3>
		<p><?php echo $subject['developer_intro'];?></p>
	</div>	
	
	
	</div>
	

</div>

<script>
$(document).on("pageshow","#page_main",function(){
	var s1 = new Swiper('.s1', {
		pagination: '.swiper-pagination',
		 nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		//preloadImages: false,
		//lazyLoading: true,
		paginationClickable: true,
		loop: true,
		autoplay: 5000,
		speed: 2000,
		autoplayDisableOnInteraction: false

	});
	
	
	var s2 = new Swiper('.s2', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		loop: true,
		autoplay: 5000,
		speed: 2000,
		//scrollbar:
		autoplayDisableOnInteraction: false
	});
	

	
});	
</script>

	

