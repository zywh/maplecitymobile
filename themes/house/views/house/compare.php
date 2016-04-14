
<div class="main">
    <!-- head开始 -->

    <!-- 登陆开始 -->
    <div class="duibi_box">
        <div class="main fix" style="text-align: center;">
            <table class="houseCompare ft" width="1000" border="1" align="center" style="border-collapse: collapse; border: 1px #c0c0c0 solid;">
                <tbody>
                <tr><td colspan="5" class="title">基础信息</td></tr>
                <tr class="photo">
                    <td width="150">照&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;片：</td>
                    <?php foreach($house_list as $house){ ?>
                    <td style="padding: 10px 0;">
     <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php 
	 //start here
	 //echo $house->house_image; 
	 $county = $house->county;
	$county = preg_replace('/\s+/', '', $county);
	$county = str_replace("&","",$county);
	$dir="mlspic/crea/".$county."/Photo".$house->ml_num."/";
	$num_files = 0;
	if(is_dir($dir)){
		$picfiles = scandir($dir);
		$num_files = count(scandir($dir))-2;
	}
	if ( $num_files > 0)	{
		  echo $dir.$picfiles[2];
	}else {
		echo "/static/images/zanwu.jpg";
	}
	 //end here
	 ?>" width="158" height="116" alt="房源对比">
                    </td>
                    <?php } ?>
                </tr>
                <tr>

                    <td class="compareType">房源名称：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('house/view',array('id'=>$house->id)); ?>" target="_blank">
                                <?php echo $house->addr; ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">城&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->mname->municipality_cname; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->district->name; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">社&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->community; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->addr; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->lp_dol; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->br; ?>卧&nbsp;<?php echo $house->bath_tot; ?>卫&nbsp;<?php echo $house->num_kit; ?>厨</td>
                    <?php } ?>
                </tr>
                
				
				<tr>
                    <td class="compareType">配&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;套：</td>
                    <?php foreach($house_list as $house){ ?>
                    <td class="fyxq_ptpd">
                                       
                               <?php if(strpos($house->a_c, 'Air') !== false || strpos($house->a_c, 'air') !== false){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">中央空调</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>中央空调</span>
                               <?php }?>
                    
                    
                               <?php if($house->central_vac=="Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">中央吸尘</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>中央吸尘</span>
                               <?php }?>

                               <?php if($house->furnished==1){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">配套家具</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>配套家具</span>
                               <?php }?>

                               <?php if($house->elevator=="Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">电梯</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>电梯</span>
                               <?php }?>
                               
                               <?php if($house->bsmt1_out !="None" or $house->bsmt2_out !=""){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">地下室</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>地下室</span>
                               <?php }?>

                               <?php if(strpos($house->pool, 'pool') !== false){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">游泳池</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>游泳池</span>
                               <?php }?>  
                               
                               <?php if($house->fpl_num == "Y"){?>
                                <!--有 -->            
                                <span><b></b><font color="#FF3300">壁炉</font></span>
                                <?php }else{?>
                                <!--无 -->
                               <span><s></s>壁炉</span>
                               <?php }?> 
                        
					
					
					</td>
                    <?php } ?>
                </tr>
				
				

                <tr><td colspan="5" class="title">房屋信息：</td></tr>
                <tr>
                    <td class="compareType">物业类型：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->propertyType->name; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">房屋层数：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->style; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">房屋面积：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->sqft; ?> 平方英尺</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">土地面积：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->land_area; ?>平方英尺</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">卧室数量：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->br; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">卫生间数量：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->bath_tot; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">厨房数量：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->num_kit; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">停车位数量：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->gar_spaces; ?></td>
                    <?php } ?>
                </tr>
                <td class="compareType">大门朝向：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->comp_pts; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">建造年份：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->yr_built; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="compareType">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->zip; ?></td>
                    <?php } ?>
                </tr>
                
                <tr>
                    <td class="compareType">MLS编号：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->ml_num; ?></td>
                    <?php } ?>
                </tr>
 
                <tr>
                    <td class="compareType">附近设施：</td>
                    <?php foreach($house_list as $house){ ?>
                        <td><?php echo $house->prop_feat1_out; ?></td>
                    <?php } ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
