
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
<div class="nycont_sgkjj">
                     <a class="sgkjj1" target="_blank" href="index.php?r=about2/about2&id=32"></a>
                     <a class="sgkjj2" target="_blank" href="index.php?r=about2/about2&id=33"></a>
                     <a class="sgkjj3" target="_blank" href="index.php?r=about2/about2&id=34"></a>
                     <a class="sgkjj4" target="_blank" href="index.php?r=about2/about2&id=36"></a>
                     <div class="cl"></div>
</div>
</div>


<!-- 热点推荐开始 -->
<div class="lm_one">
    <div class="lm_oneup"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_1.jpg" /></div>
    <div class="lm_onedown">
        <div class="lm_oneleft">
            <div class="video">
                <div class="lm_label">枫之都精选视频</div>
                <div class="videocont" id="video_wrap" style="width:249px; height:171px"></div>
                <div class="lmlistbox">
                    <?php foreach($video as $obj){ ?>
                    <div class="lmlist"><a href="<?php echo Yii::app()->createUrl('site/viewVideo', array('id' => $obj->id)); ?>" target="_blank"><?php echo $obj->title; ?></a><span><?php echo date('Y-m-d', $obj->date); ?></span></div>
                    <?php } ?>
                </div>
            </div>
            <div class="zczl" style=" margin-top:60px;">
                <div class="zczlone">立即注册获得以下资料</div>
                <div class="zczltwo">
                    <span>1.加国房产投资报告</span>
                    <span>2.海外移民指南</span>
                    <span>3.加国留学指南</span>
                </div>
                <?php echo CHtml::beginForm(array('user/register'),'get'); ?>
                <div class="zczlthree">
                    <div class="zczlthree_one"><input name="username" type="text" class="textbox" value="您的姓名" onblur="if(this.value=='') {this.style.color='#333';this.value='您的姓名';}" onfocus="if(this.value=='您的姓名'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
                    <div class="zczlthree_one"><input name="phone" type="text" class="textbox" value="您的电话" onblur="if(this.value=='') {this.style.color='#333';this.value='您的电话';}" onfocus="if(this.value=='您的电话'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
                    <div class="zczlthree_one"><input name="email" type="text" class="textbox" value="您的邮箱" onblur="if(this.value=='') {this.style.color='#333';this.value='您的邮箱';}" onfocus="if(this.value=='您的邮箱'){this.value='';}else{this.style.color='#000';}" style="color: #333;"></div>
                </div>
                <div class="zczlfour"><input name="" type="submit" value="立即注册" /></div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
        <div class="lm_oneright">
            <?php foreach($hot as $obj){
                if(!empty($obj)){?>
            <div class="lm_jd">
                <div class="lm_jdup">
                    <div class="lm_label"><span class="highlight"><?php echo $obj->city->name; ?></span>/<?php echo strtoupper($obj->city->englishName); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('hotrecommend/more', array('city'=>$obj->city_id)); ?>" class="more" target="_blank">更多项目</a>
                    <div class="cl"></div>
                </div>
                <div class="lm_jddown" title="<?php echo $obj->name; ?>">
                    <a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl;?>/<?php echo $obj->house_image; ?>" width="338" height="266" /></a>
                    <div class="lm_jd_tc">
                        <div class="lm_jd_tcbox">
                            <div class="lm_jd_wzup">
                                <span>名称：<?php echo $obj->name; ?></span>
                                <span>简介：首付<?php echo $obj->prepay; ?>万加币起</span>
                            </div>
                            <a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank">[详细]</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
    <div class="cl"></div>
</div>
<!-- 热点推荐结束 -->

<!-- 豪宅鉴赏开始 -->
<div class="lm_two">
    <div class="lm_twoup"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_hzjs.png" /></div>
    <div class="lm_twodown" style="margin-top:-40px;">
        <div class="lm_twobanner"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/b_2.jpg" /></div>
        <div class="lm_twojs">
            <?php foreach($enjoy as $k => $obj){
                if($k == 1){
            ?>
            <div class="lm_twojs_one lm_twojs_two">
                <div class="lm_twojs_one_right">
                    <div class="lm_twojs_title">名称：<?php echo $obj->name; ?></div>
                    <div class="lm_twojs_info"><span>简介：</span>首付<?php echo $obj->prepay; ?>万加币起<br /><?php echo strip_tags($obj->introduction); ?></div>
                    <a class="more" href="<?php echo Yii::app()->createUrl('enjoy/view', array('id'=>$obj->id)); ?>" target="_blank">[详细]</a>
                </div>
                <div class="lm_twojs_one_left"><a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl;?>/<?php echo $obj->house_image; ?>" width="320" height="195"/></a></div>
                <div class="cl"></div>
            </div>
            <?php }else{ ?>
            <div class="lm_twojs_one">
                <div class="lm_twojs_one_left"><a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl;?>/<?php echo $obj->house_image; ?>" width="320" height="195"/></a></div>
                <div class="lm_twojs_one_right">
                    <div class="lm_twojs_title">名称：<?php echo $obj->name; ?></div>
                    <div class="lm_twojs_info"><span>简介：</span>首付<?php echo $obj->prepay; ?>万加币起<br /><?php echo strip_tags($obj->introduction); ?></div>
                    <a class="more" href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank">[详细]</a>
                </div>
                <div class="cl"></div>
            </div>
            <?php }} ?>
        </div>
    </div>
</div>
<!-- 豪宅鉴赏结束 -->

<!-- 学区专栏开始 -->
<div class="lm_three">
    <div class="lm_threeup"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_3.jpg" width="980" height="39" /></div>
    <div class="lm_threedown">
        <div class="lm_three_jdt">
            <div class="lm_jdt_left scroll_btnl"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/left_jt.jpg" /></div>
            <div class="lm_jdt_center scroll_img" style="width:630px; overflow:hidden; ">
                <div class="scroll_img_body">
                    <?php foreach($column as $obj){ ?>
                        <div class="lm_jdtlist">
                            <a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->house_image; ?>" width="156" height="335"/></a>
                            <div class="lm_jdt_title">学区房推荐</div>
                            <div class="lm_jdt_info" style="overflow:hidden; white-space: nowrap; text-overflow: ellipsis; width: 100%;" title="<?php echo $obj->name; ?>"><?php echo $obj->name; ?></div>
                            <div class="lm_jdt_info">首付<?php echo $obj->prepay; ?>万加币起</div>
                            <a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" class="moretwo" target="_blank">了解更多</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_jdt_right scroll_btnr" ><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/right_jt.jpg" /></div>
            <div class="cl"></div>
        </div>
    </div>
</div>
<!-- 学区专栏结束 -->

<!-- 加国资讯开始 -->
<div class="lm_four">
    <div class="lm_fourup"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_4.jpg" /></div>
    <div class="lm_fourdown">
        <div class="lm_four_banner"><a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>6)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/b_3.jpg" /></a></div>
        <div class="lm_four_news">
            <div class="lm_four_left">
                <div class="lm_four_flash">
                    <div id="fsD1" class="focus">
                        <div id="D1pic1" class="fPic">
                            <div class="xwdt">
                                <div class="xwdt_title">加国即时新闻动态</div>
                            </div>
                            <?php foreach($instant as $obj){ ?>
                            <div class="fcon">
                                <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->image; ?>" width="290" height="396" /></a>
                                <span class="shadow"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="fbg">
                            <div class="D1fBt" id="D1fBt">
                                <a href="javascript:void(0);" class="current"><i>1</i></a>
                                <a href="javascript:void(0);"><i>2</i></a>
                                <a href="javascript:void(0);"><i>3</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lm_four_center">
                <div class="lm_four_center_title"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/index/xlm_1.jpg" /></div>
                <div class="lm_four_center_one">
                    <div class="lm_four_cneter_newsinfo">
                        <?php foreach($canada_news as $obj){ ?>
                            <div class="news_a canada-news"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                        <?php } ?>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
            <div class="lm_four_right">
                <div class="lm_four_right_newslist lm_four_right_newslist_two">
                    <div class="lm_four_news_up">
                        <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(7); ?></div>
                        <a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>7)); ?>" class="moretwo" target="_blank">更多>></a>
                        <div class="cl"></div>
                    </div>
                    <div class="lm_four_news_down">
                        <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>7)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(7); ?>" width="94" height="94"/></a></div>
                        <div class="lm_four_news_down_right">
                            <div class="lm_four_news_down_info">
                                <?php foreach($summary as $obj){ ?>
                                    <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                <?php } ?>
                                <div class="cl"></div>
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="lm_four_right_newslist lm_four_right_newslist_two">
                    <div class="lm_four_news_up">
                        <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(8); ?></div>
                        <a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>8)); ?>" class="moretwo" target="_blank">更多>></a>
                        <div class="cl"></div>
                    </div>
                    <div class="lm_four_news_down">
                        <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>8)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(8); ?>" width="94" height="94"/></a></div>
                        <div class="lm_four_news_down_right">
                            <div class="lm_four_news_down_info">
                                <?php foreach($life as $obj){ ?>
                                    <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                <?php } ?>
                                <div class="cl"></div>
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="lm_four_right_newslist">
                    <div class="lm_four_news_up">
                        <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(9); ?></div>
                        <a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>9)); ?>" class="moretwo" target="_blank">更多>></a>
                        <div class="cl"></div>
                    </div>
                    <div class="lm_four_news_down">
                        <div class="lm_four_news_down_left"><a href="<?php echo Yii::app()->createUrl('news/canadaNews', array('catalog_id'=>9)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(9); ?>" width="94" height="94"/></a></div>
                        <div class="lm_four_news_down_right">
                            <div class="lm_four_news_down_info">
                                <?php foreach($travel as $obj){ ?>
                                    <div class="news_a"><a href="<?php echo Yii::app()->createUrl('news/canadaNewsView',array('id'=>$obj->id)); ?>" title="<?php echo $obj->title; ?>" target="_blank"><?php echo $obj->title; ?></a></div>
                                <?php } ?>
                                <div class="cl"></div>
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
            <div class="cl"></div>
        </div>

    </div>
</div>
<!-- 加国资讯结束 -->

<!-- 房产资讯开始 -->
<div class="lm_five">
    <div class="lm_five_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_5.jpg" /></div>
    <div class="lm_five_down">
        <div class="lm_five_down_pic">
            <?php foreach($exhibition as $obj){ ?>
                <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->image; ?>" width="192" height="250"/>
                    <span class="exhibition_title" title="<?php echo $obj->title; ?>"><?php echo $obj->title; ?></span>
                </a>
            <?php } ?>
            <div class="cl"></div>
        </div>
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(11); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/houseNews', array('catalog_id'=>11)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_left_pic">
                    <div id="hdp">
                        <div class="slides">
                            <ul class="slide-pic">
                                <?php foreach($school_distrcit_house as $k => $obj){
                                    if($k == 0){
                                        ?>
                                        <li class="cur"><a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->name; ?>"><img width="290" height="218" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->house_image; ?>" /></a></li>
                                    <?php }else{ ?>
                                        <li><a href="<?php echo Yii::app()->createUrl('house/view', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->name; ?>"><img width="290" height="218"  src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $obj->house_image; ?>" /></a></li>
                                    <?php }} ?>
                            </ul>
                            <ul class="slide-li op">
                                <li class="cur"></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <ul class="slide-li slide-txt">
                                <li class="cur"><a href="javascript:void(0);"></a></li>
                                <li><a href="javascript:void(0);"></a></li>
                                <li><a href="javascript:void(0);"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="lm_five_left_news">
                    <div class="lm_five_left_news_up">
                        <div class="lm_five_left_news_title"><a href="<?php echo Yii::app()->createUrl('house/index',array('cd1'=>0,'cd2'=>0,'cd3'=>1,'cd4'=>0,'cd5'=>0,'cd6'=>0,'cd7'=>0,'cd8'=>0,'cd9'=>0,'cd10'=>0)); ?>" target="_blank">最新学区房介绍</a></div>
                    </div>
                    <div class="lm_five_left_news_down">
                        <?php foreach($school_distrcit_house_news as $obj){ ?>
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>">· <?php echo $obj->title; ?></a>
                        <?php } ?>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(12); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/houseNews', array('catalog_id'=>12)); ?>" class="moretwo">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($house_hotspots as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/houseNews', array('catalog_id'=>12)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(12); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(13); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/houseNews', array('catalog_id'=>13)); ?>" class="moretwo">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_up">
                    <div class="lm_five_right_up_left"><a href="<?php echo Yii::app()->createUrl('news/houseNews', array('catalog_id'=>13)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(13); ?>" border="0" width="108" height="108"/></a></div>
                    <div class="lm_five_right_up_right">
                        <div class="lm_five_right_title"><a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$house_property_special_news->id)); ?>" title="<?php echo $house_property_special_news->title; ?>" target="_blank"><?php echo $house_property_special_news->title; ?></a></div>
                        <div class="lm_five_right_info">
                            <div class="house_property_special_news_summary"><?php echo $house_property_special_news->summary; ?></div>
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView',array('id'=>$house_property_special_news->id)); ?>" target="_blank">[详情]</a>
                        </div>
                    </div>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_right_down">
                    <?php foreach($house_property as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</div>
<!-- 房产资讯结束-->


<!-- 加拿大留学开始 -->
<div class="lm_five">
    <div class="lm_five_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_lx.png" /></div>
    <div class="lm_five_down" style="margin-top:-50px;">
			<div class="lm_four_banner"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>17)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/b_3.jpg" /></a></div>
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(17); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(18); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>18)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_lx[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews2', array('catalog_id'=>18)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(18); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(23); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</div>
<!-- 加拿大留学结束-->


<!-- 加拿大移民开始 -->
<div class="lm_five">
    <div class="lm_five_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_ym.png" /></div>
    <div class="lm_five_down" style="margin-top:-50px;">
			<div class="lm_four_banner"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>19)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/b_3.jpg" /></a></div>
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(19); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(20); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>20)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_ym[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews3', array('catalog_id'=>20)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(20); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(24); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</div>
<!-- 加拿大移民结束-->


<!-- 加拿大旅游开始 -->
<div class="lm_five">
    <div class="lm_five_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_ly.png" /></div>
    <div class="lm_five_down" style="margin-top:-50px;">
			<div class="lm_four_banner"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>21)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/b_3.jpg" /></a></div>
        <div class="lm_five_down_news">
            <div class="lm_five_left">
                 <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(21); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="lm_five_center">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(22); ?></div>
                    <a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>" class="moretwo" target="_blank">更多>></a>
                    <div class="cl"></div>
                </div>
                <div class="lm_five_center_info">
                    <?php foreach($news_ly[1] as $obj){ ?>
                        <div class="lm_five_center_list house_hotspots_line">
                            <a href="<?php echo Yii::app()->createUrl('news/canadaNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="lm_five_center_pic"><a href="<?php echo Yii::app()->createUrl('news/canadaNews4', array('catalog_id'=>22)); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $this->getCatalogImage(22); ?>" width="317" height="151" border="0" /></a></div>
            </div>
            <div class="lm_five_right">
                <div class="lm_five_left_label">
                    <div class="lm_four_news_up_left"><?php echo $this->getCatalogName(25); ?></div>
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
                            <a href="<?php echo Yii::app()->createUrl('news/houseNewsView', array('id'=>$obj->id)); ?>" target="_blank" title="<?php echo $obj->title; ?>" class="house_hotspots">· <?php echo $obj->title; ?></a> <span>[<?php echo date('Y-m-d', $obj->create_time); ?>]</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</div>
<!-- 加拿大旅游结束-->


<!-- 资质证明开始 -->
<div class="lm_seven">
    <div class="lm_seven_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_7.jpg" /></div>
    <div class="lm_seven_down">
        <div class="lm_seven_list"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/z_1.jpg" border="0" />加拿大房产局成员证</a></div>
        <div class="lm_seven_list"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/z_2.jpg" border="0" />加国注册证明</a></div>
        <div class="lm_seven_list"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/z_3.jpg" border="0" />枫之都房产许可证</a></div>
        <div class="lm_seven_list"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/z_4.jpg" border="0" />最佳服务商</a></div>
        <div class="lm_seven_list"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/z_5.jpg" border="0" />最佳服务商</a></div>
        <div class="cl"></div>
    </div>
</div>
<!-- 资质证明结束 -->

<!-- 合作伙伴开始 -->
<div class="lm_eight">
    <div class="lm_eight_up"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/lm_8.jpg" /></div>
    <div class="lm_eight_down">
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_4.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_5.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_6.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_7.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_8.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_9.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_10.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_4.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_5.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_6.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_7.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_8.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_9.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_10.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_4.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_5.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_6.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_7.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_8.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_9.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_10.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_4.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_5.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_6.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_7.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_8.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_9.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_10.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_1.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_2.jpg" /></span>
        <span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/index/h_3.jpg" /></span>
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
