<?php
/**
 * 首页控制器
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class SiteController extends XFrontBase
{
    /**
     * 首页
     */
    public function actionIndex ()
    {
		$db = Yii::app()->db;
		$criteria = new CDbCriteria();
		$criteria->order = 'date DESC';
		$criteria->select = 'subdate(date, 1) as date,t_house as t_resi,u_house as u_resi ,round(avg_house/10000,2) as avg_price ';
		$stats = Stats::model()->find($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->select = 'count(*) as lp_dol';
		$criteria->AddCondition('s_r="Lease"');
		$leaseCount = House::model()->count($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->select = 'count(*) as lp_dol';
		$criteria->AddCondition('s_r="Sale"');
		$saleCount = House::model()->count($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->select = 'count(*) as lp_dol';
		$criteria->AddCondition('latitude !=""');
		$mapCount = House::model()->count($criteria);
		
	   $data = array(
            'totalHouse'      => $saleCount,
            'avgPrice'         => $stats["avg_price"],
			'leaseTotal'   => $leaseCount,
			'mapTotal'   => $mapCount,
         
        );
        $this->render('index', $data);
		
   
    }

 

}
