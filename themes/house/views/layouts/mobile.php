<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mobile.css" />
        <title> 加拿大房产_枫之都
		</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
 
    </head>
    <body>
		<?php
		$db = Yii::app()->db;
		?>
        <div class="main">
            <!-- topdl开始 -->
            <div class="topdl">
 			
					<?php
            			$criteria = new CDbCriteria();
					    $criteria->order = 'date DESC';
						$criteria->select = 'subdate(date, 1) as date,t_house as t_resi,u_house as u_resi ,round(avg_house/10000,2) as avg_price ';
						$stats = Stats::model()->find($criteria);
 
 
					 ?>
                    <span class="glyphicon glyphicon-home">
					住宅房源<font color="#FF0000"><a href="<?php echo Yii::app()->createUrl('stats/current'); ?>"><?php echo $stats["t_resi"]; ?></a></font>套，
					平均房价<font color="#FF0000"><a href="<?php echo Yii::app()->createUrl('stats'); ?>"><?php echo $stats["avg_price"]; ?></a></font>万加币,<?php echo $stats["date"]; ?>
					更新房源<font color="#FF0000"><?php echo $stats["u_resi"]; ?></font>套</span>
			</div>
			
			
			<!-- topdl结束 -->
			
			
            <!-- head开始 -->

            <!-- head结束 -->

         
            
            <!-- nav开始 -->
 
			<!-- nav结束 -->
            <!-- body开始 -->
            <?php echo $content; ?>
            <!-- body结束 -->
            
 
	<!-- foot开始 -->
	<div class="foot"></div>
	<!-- foot结束 -->

    </body>
</html>
