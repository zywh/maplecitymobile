<style>
.fl_title{ font-family:"宋体";}
.hot_loca{font-family:"宋体";}
.hot_des a{ font-family:"宋体";}
.zczltwo span a{ color:#666666; text-decoration:none;}
.zczltwo span a:hover{ color:#FF6600}
.lm_five_right_title a{ color:#666666}
.lm_five_right_title a:hover{ color:#FF6600}
.lmlist a:hover{ color:#FF6600}
.zczltwo span a:hover{ text-decoration:underline}
</style>
<?php
	$db = Yii::app()->db;
	function get_firstimage($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		#$dir="mlspic/crea/".$county."/Photo".$ml_num."/";
		$dir="mlspic/crea/creamid/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			return $dir.$picfiles[2];

		}else { return 'static/images/zanwu.jpg';}
	}

	function get_tn_image($county,$ml_num){
		
		$county = preg_replace('/\s+/', '', $county);
		$county = str_replace("&","",$county);
		$dir="mlspic/crea/creatn/".$county."/Photo".$ml_num."/";
		$num_files = 0;
		if(is_dir($dir)){
			$picfiles = scandir($dir);
			$num_files = count(scandir($dir))-2;
		}
		if ( $num_files >= 1)    {
			
			$s = implode(",",array_slice($picfiles,2,3)); //return 3 comma seperated list with offset 2 which is subdir . and ..
			$s = str_replace("Photo",$dir."Photo",$s); // Insert DIR in front
			return $s;
		} else { return 'static/images/zanwu.jpg';}
	}	
?> 
<!-- banner开始 -->
<div class="banner">
    <div id="full-screen-slider">
        <ul id="slides">
            <?php foreach($banner as $k => $obj){ ?>
            <li style="background:<?php switch($k){
                case 0: echo '#560762';break;
                case 1: echo '#467809';break;
                default: echo '#34F';break;
            } ?> url('<?php echo Yii::app()->request->baseUrl;?>/<?php echo $obj->image; ?>') no-repeat center top"><a href="<?php echo $obj->url; ?>"></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- banner结束 -->

<div class="nycont_mls">
<div class="nycont_sgkjj"><p id="socialicons3">
	 <a style="margin-left:0px;" data-ajax="false" class="sgkjj1" href="index.php?r=about2/about2&id=32"><IMg src="/themes/house/images/index/btn1.jpg" border="0"/></a>
	 <a class="sgkjj2" data-ajax="false" href="index.php?r=about2/about2&id=33"><IMg src="/themes/house/images/index/btn2.jpg" border="0"/></a>
	 <a class="sgkjj3" data-ajax="false" href="index.php?r=about2/about2&id=34"><IMg src="/themes/house/images/index/btn3.jpg" border="0"/></a>
	 <a style="margin-right:0px;" data-ajax="false" class="sgkjj4"  href="index.php?r=about2/about2&id=36"><IMg src="/themes/house/images/index/btn4.jpg" border="0"/></a>
	 </p>
	 
</div>
</div>





<!-- 加国资讯开始 -->
<div class="lm_four">
     <div class="lm_four_banner"><a href="index.php?r=about2/about2&id=33"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/tl_3.jpg" /></a></div>
 
</div>
<!-- 加国资讯结束 -->



<!-- 加拿大留学开始 -->
<div class="lm_five" >
 
			
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>17)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(17); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>17)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>17)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(17); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right" style="width:170px;">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_lx_special_news[0][0]->id)); ?>" title="<?php echo $news_lx_special_news[0][0]->title; ?>" target="_blank"><?php echo $news_lx_special_news[0][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_lx_special_news[0][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_lx_special_news[0][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_lx[0] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>18)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(18); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>18)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_lx[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>18)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(18); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>23)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(23); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>23)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>23)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(23); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_lx_special_news[1][0]->id)); ?>" title="<?php echo $news_lx_special_news[1][0]->title; ?>" target="_blank"><?php echo $news_lx_special_news[1][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_lx_special_news[1][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_lx_special_news[1][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_lx[2] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
   
</div>
<!-- 加拿大留学结束-->


<!-- 加拿大移民开始 -->
<div class="lm_five">
   
			
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"> <a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>19)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(19); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>19)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>19)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(19); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right" style="width:170px;">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_ym_special_news[0][0]->id)); ?>" title="<?php echo $news_ym_special_news[0][0]->title; ?>" target="_blank"><?php echo $news_ym_special_news[0][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_ym_special_news[0][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_ym_special_news[0][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_ym[0] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>20)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(20); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>20)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_ym[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>20)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(20); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>24)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(24); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>24)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>24)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(24); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_ym_special_news[1][0]->id)); ?>" title="<?php echo $news_ym_special_news[1][0]->title; ?>" target="_blank"><?php echo $news_ym_special_news[1][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_ym_special_news[1][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_ym_special_news[1][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_ym[2] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
            <div class="lm_four_banner" style="margin-top:40px;"><a href="index.php?r=about/about1&id=50"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/tl_2.jpg" /></a></div>
        </div>
   
</div>
<!-- 加拿大移民结束-->


<!-- 加拿大旅游开始 -->
<div class="lm_five">
   
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>21)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(21); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>21)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>21)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(21); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right" style="width:170px;">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_ly_special_news[0][0]->id)); ?>" title="<?php echo $news_ly_special_news[0][0]->title; ?>" target="_blank"><?php echo $news_ly_special_news[0][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_ly_special_news[0][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$news_ly_special_news[0][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_ly[0] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(22); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_ly[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(22); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"> <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>25)); ?>" class="moretwo" target="_blank"><?php echo $this->getCatalogName(25); ?></a></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>25)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>25)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(25); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_ly_special_news[1][0]->id)); ?>" title="<?php echo $news_ly_special_news[1][0]->title; ?>" target="_blank"><?php echo $news_ly_special_news[1][0]->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $news_ly_special_news[1][0]->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$news_ly_special_news[1][0]->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($news_ly[2] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php 
					if($obj->last_update_time==0){
					echo date('Y-m-d', $obj->create_time); 
					}else{
					echo date('Y-m-d', $obj->last_update_time); 
					}
					?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
   
</div>
<!-- 加拿大旅游结束-->


<!-- 资质证明开始 -->

<!-- 资质证明结束 -->

<!-- 合作伙伴开始 -->
<div class="lm_eight">
    <div class="lm_eight_up"><a href="index.php?r=about/partner"><img src="/static/images/partner.jpg" /></a></div>
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

<script type="text/javascript">
    flowplayer("video_wrap", "<?php echo Yii::app()->theme->baseUrl; ?>/js/flowplayer-3.2.12.swf", {
        clip: {
            url: "<?php echo Yii::app()->request->baseUrl; ?>"+"/"+"<?php echo $home_video->url; ?>",
            autoPlay: false,
            autoBuffering: false
        },
        plugins: {
            controls: {
                play:true,        //开端按钮
                volume: true,     //音量按钮
                mute: true,       //静音按钮
                fullscreen: true, //全屏按钮
                scrubber: true,   //进度条
                time: false,      //是否显示时候信息
                autoHide: true    //功能条是否主动隐蔽
            }
        }
    });

    $(document).ready(function(){
        //热点推荐
        $(".lm_jddown").mouseover(function(){
            $(this).find(".lm_jd_tcbox").addClass("lm_jd_tcbox_on")
        });
        $(".lm_jddown").mouseout(function(){
            $(this).find(".lm_jd_tcbox").removeClass("lm_jd_tcbox_on")
        });
    });

    //学区专栏左右滚动效果
    $(function(){
        var i=4
        var cont=$(".scroll_img_body img").size();
        var kd=(cont*158)+"px";
        var last=(cont-i)*158+"px";
        var page=1;
        var o=cont-3;
        var page_cont=cont;
        $(".scroll_btnl").click(function(){
            if(page==1){
                $(".scroll_img_body").animate({"margin-left":'-='+last},1000);
                page=o;
            }
            else{
                $(".scroll_img_body").animate({"margin-left":"+=158px"},1000);
                page--;
            }
            $("i").text(page);
        });

        $(".scroll_btnr").click(function(){
            if(page==o){
                $(".scroll_img_body").animate({"margin-left":"0"},1000);
                page=1;
            }
            else{
                $(".scroll_img_body").animate({"margin-left":"-=158px"},1000);
                page++;
            }
            $("i").text(page);
        });

    });

    //加国资讯/房产资讯左侧焦点图
    Qfast.add('widgets', { path: "<?php echo Yii::app()->theme->baseUrl;?>/js/terminator2.2.min.js", type: "js", requires: ['fx'] });
    Qfast(false, 'widgets', function () {
        K.tabs({
            id: 'fsD1',   //焦点图包裹id
            conId: "D1pic1",  //** 大图域包裹id
            tabId:"D1fBt",
            tabTn:"a",
            conCn: '.fcon', //** 大图域配置class
            auto: 1,   //自动播放 1或0
            effect: 'fade',   //效果配置
            eType: 'click', //** 鼠标事件
            pageBt:true,//是否有按钮切换页码
            bns: ['.prev', '.next'],//** 前后按钮配置class
            interval: 4000  //** 停顿时间
        });				
    });
</script>
