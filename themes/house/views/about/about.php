<link href="/themes/house/css/xinjia.css" type="text/css" rel="stylesheet" />
<link href="/themes/house/news/images_index/index.css" rel="stylesheet" type="text/css" />
<?php
$db = Yii::app()->db;
?>
<!-- nybanner开始-->
     <div class="nybanner_about"></div>
<!-- nybanner结束-->

<!-- 内容页面开始 -->	

 
           <div class="zcwz_label">
                 <div class="zcwz_label_left" style="padding-left:0px;"><?php echo $prev_post->title; ?></div>
                 <div class="zcwz_label_right"><?php echo $cat_name_en; ?></div>
                 <div class="cl"></div>
           </div>
		   
		   
	       <div class="fyxqdown">
			   <?php 
			   if($_GET["id"]==38){
				   ?><link href="/themes/house/jianjie/images_index/index.css" rel="stylesheet" type="text/css" /><?php 
			   echo $prev_post->content; 
			   }else{ ?>
				   <div class="fyxqdown_left">
						  <div class="zcwz about_js">
								<?php echo $prev_post->content; ?>
						  </div>			
					</div>

		   </div>
                                             

              
		 <?php }?>
              
   
              

	

<!-- 内容页面结束 -->

