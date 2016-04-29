
<?php
header("Content-type: text/html; charset=utf-8"); 
$tagname=trim($_GET["tname"]);
$connection = Yii::app()->db;
$sql = "select count(*) as shuliang from h_post where title like '%" .$tagname. "%' or content like '%" .$tagname. "%'";
$command = $connection->createCommand($sql);
$result = $command->queryAll();
$shuliang=$result[0]["shuliang"];
?>

<link href="/themes/house/news/images_tagname/index.css" rel="stylesheet" type="text/css" />
<div>
     <img src="/themes/house/news/images_tagname/ban.jpg"/>
</div>
<div class="news">
      <div class="news_wrap">
              <div class="news_con">
                     <div class="news_posotion">
                     <P><a href="/">首页 &nbsp;&nbsp;>&nbsp;&nbsp;</a><a href="index.php?r=news/canadaNews">加拿大资讯&nbsp;&nbsp;>&nbsp;&nbsp;</a><a ><span>资讯搜索</span></a></P>
                     </div>
                     <div class="news_fl">
                                 <div class="news_title">
                                       <p>共有<span><?php echo $shuliang;?></span>个关键字与<span>"<?php echo $tagname;?>"</span>相关的内容</p>
                                 </div>
                                 <div class="news_result">
                                             <div class="news_list">
                                                   <ul>
<li <?php if($_GET['catalog_id']==""){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>">全部</a></li>
<li <?php if($_GET['catalog_id']==1){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>&catalog_id=1">资讯</a></li>
<li <?php if($_GET['catalog_id']==2){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>&catalog_id=2">房产</a></li>
<li <?php if($_GET['catalog_id']==3){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>&catalog_id=3">移民</a></li>
<li <?php if($_GET['catalog_id']==4){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>&catalog_id=4">留学</a></li>
<li <?php if($_GET['catalog_id']==5){?>style="background-color:#FFCC00"<?php }?>> <a href="index.php?r=news/tagNews&tname=<?php echo $tagname;?>&catalog_id=5">旅游</a></li>
                                                   </ul>
                                             </div>
                                             
    
<?php
if($_GET['catalog_id']==1){
$sqlhaozi = "select * from h_post where (title like '%" .$tagname. "%' or content like '%" .$tagname. "%') and (catalog_id=41  or catalog_id=7 or catalog_id=8 or catalog_id=6)";
}
elseif($_GET['catalog_id']==2){
$sqlhaozi = "select * from h_post where (title like '%" .$tagname. "%' or content like '%" .$tagname. "%') and (catalog_id=10  or catalog_id=11 or catalog_id=12 or catalog_id=13)";
}
elseif($_GET['catalog_id']==3){
$sqlhaozi = "select * from h_post where (title like '%" .$tagname. "%' or content like '%" .$tagname. "%') and (catalog_id=19  or catalog_id=20 or catalog_id=24 or catalog_id=45)";
}
elseif($_GET['catalog_id']==4){
$sqlhaozi = "select * from h_post where (title like '%" .$tagname. "%' or content like '%" .$tagname. "%') and (catalog_id=17  or catalog_id=18 or catalog_id=43 or catalog_id=23 or catalog_id=17)";
}
elseif($_GET['catalog_id']==5){
$sqlhaozi = "select * from h_post where (title like '%" .$tagname. "%' or content like '%" .$tagname. "%') and (catalog_id=21  or catalog_id=22 or catalog_id=25 or catalog_id=46)";
}
else{
$sqlhaozi = "select * from h_post where title like '%" .$tagname. "%' or content like '%" .$tagname. "%'";
}
$resultshazai = $connection->createCommand($sqlhaozi)->query();

foreach($resultshazai as $househaizai){
$househaizai['title']=preg_replace("/($tagname)/i","<b style=\"color:red\">\\1</b>",$househaizai['title']);
?>
                                            <div class="news_info">
                                                     <div class="news_biao">
                                                            <a href="index.php?r=news/canadaNewsView&id=<?php echo $househaizai["id"];?>"><?php echo $househaizai["title"];?></a>
                                                       </div>
                                                        <div  class="news_xq">
                                        <p><span><?php echo date('Y-m-d', $househaizai["last_update_time"]);?></span><br />
                                                                <?php echo $househaizai["summary"];?>
                                                                  </p>
                                                         </div>
                                                     
                                                      
                                             </div>
<?php }?>
                                             
                                             
       
                                 </div>
                     </div>
                     <div class="news_fr">
                               <div class="fr_zx">
                               
                                                 <div class="fr_top">
                                                       <ul>
<?php

$sqlhaozi = "select * from h_post where catalog_id=4 or catalog_id=6 or catalog_id=9 or catalog_id=41 order by id desc limit 0,8";

$resultshazai = $connection->createCommand($sqlhaozi)->query();

foreach($resultshazai as $househaizai){

?>
<li><a href="index.php?r=news/canadaNewsView&id=<?php echo $househaizai["id"];?>"><img src="/themes/house/news/images_tagname/point.gif"/><?php echo mb_substr($househaizai["title"],0,14,"utf-8");?></a></li>
<?php }?>
                                                       </ul>
                                                 </div>
                                 </div>
                                 <div class="hot_rec">
        <?php

$sqlhaozi = "select * from h_house where lp_dol<3000000 and recommend=1 limit 0,5";
$resultshazai = $connection->createCommand($sqlhaozi)->query();
foreach($resultshazai as $househaizai){
?>
                                                 <div class="hot_list">
                                                         <div class="hot_fl">
 <?php if($househaizai["house_image"]==""){?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src='/static/images/zanwu.jpg' width="120" height="72"/></a>
                      <?php }else{?>
                                 <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$househaizai["id"])); ?>"  target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $househaizai["house_image"]; ?>"  width="120" height="72"/></a>
                      <?php }?>
                                                         </div>
                                                         <div class="hot_fr">
 <p><?php echo $househaizai["addr"]; ?><br />
                                                             
                                                                 <font color="#CC6600"><font color="#CC6600"><?php echo $househaizai["lp_dol"]/10000;?></font>万加元
                                                               </p>
                                                         </div>
                                                       
                                                 </div>
 <?php }?> 
                                 </div>
                             
                     </div>
              </div>
      </div>
</div>