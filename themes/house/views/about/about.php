<link href="/themes/house/css/xinjia.css" type="text/css" rel="stylesheet" />
<link href="/themes/house/news/images_index/index.css" rel="stylesheet" type="text/css" />
<?php
$db = Yii::app()->db;
?>
<!-- nybanner开始-->
     <div class="nybanner_about"></div>
<!-- nybanner结束-->


<div class="about-navi-bar" data-role="navbar" data-grid="c">
    <ul>
	<li><a id='about_us' href="index.php?r=about/about1&id=27" data-ajax="false">关于</a></li>
	<li><a id='about_advantage' href="index.php?r=about/about1&id=28" data-ajax="false">优势</a></li>
	<li><a id='about_contact' href="index.php?r=about/about1&id=30" data-ajax="false">联系</a></li>
	<li><a id='about_hire' href="index.php?r=about/about1&id=31" data-ajax="false">招募</a></li>

    </ul>
</div><!-- /navbar -->



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
              
<script>

$(document).on("pageshow","#page_main",function(){
	
	var id = '<?php echo $_GET['id'];?>';
	
  	if ( id == "31"){
		$("#about_hire").addClass('ui-btn-active'); //make Sales Menu active
	}
  	if ( id == "27"){
		$("#about_us").addClass('ui-btn-active'); //make Sales Menu active
	}
  	if ( id == "28"){
		$("#about_advantage").addClass('ui-btn-active'); //make Sales Menu active
	}
  	if ( id == "30"){
		$("#about_contact").addClass('ui-btn-active'); //make Sales Menu active
	}	
	
});
</script>   
              
 
