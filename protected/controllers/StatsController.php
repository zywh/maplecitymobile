<?php

class StatsController extends XFrontBase
{
    public function actionIndex(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/stats.css');
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.roundabout.js');
	//$year_stats = StatsYear:model()->findAll();
        //$statsyear = StatsYear::model()->findAll(array(
         //   'order'     => 'date DESC',
       // ));

        //$data = array( 'statsyear' => $statsyear);

        $this->render('index');
    }
	
	public function actionCurrent(){
	Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/stats.css');
	
	$this->render('current');
    }

    public function actionGetData(){

	$result = array();
	$criteria = new CDbCriteria();
        $criteria->select = 'unix_timestamp(date)*1000 as date,avg_price,sale';


        $statsyear = StatsYear::model()->findAll($criteria);
	foreach ($statsyear as $val) {	
		$yeardata = array();
		$yeardata['Date'] = $val->date;	
		$yeardata['AvgPrice'] = $val->avg_price;	
		$yeardata['Sale'] = $val->sale;	
		$result['YearData'][] = $yeardata;	
	}
	//Wrap callback argument and () for JSONP
	//	Yii doesn't handle callback
	//echo $_GET["callback"];	
	//echo "(";
	
	echo json_encode($result);
	
	//echo ");";

    }

    public function actionGetMlsData(){

        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = 'unix_timestamp(date)*1000 as date,
				sales,dollar/1000000 as dallor,avg_price,
				new_list,snlr*100 as snlr,active_list,
				moi,avg_dom,avg_splp*100 as avg_splp,type';
	

        $data = MlsHist::model()->findAll($criteria);
        foreach ($data as $val) {


                $result['mlsdata'][$val->type]['avgprice'][] = array($val->date,$val->avg_price); //good
                $result['mlsdata'][$val->type]['avgdom'][] = array($val->date,$val->avg_dom); //good
                $result['mlsdata'][$val->type]['avgsplp'][] = array($val->date,$val->avg_splp); //good
				$result['mlsdata'][$val->type]['sales'][] = array($val->date,$val->sales); //good
                $result['mlsdata'][$val->type]['newlist'][] = array($val->date,$val->new_list); //good
                $result['mlsdata'][$val->type]['moi'][] = array($val->date,$val->moi); //good
				$result['mlsdata'][$val->type]['active'][] = array($val->date,$val->active_list); //good
				$result['mlsdata'][$val->type]['snlr'][] = array($val->date,$val->snlr); //bad
        }


        echo json_encode($result);

        //echo ");";

    }

	public function actionGetHouseStats(){
		$db = Yii::app()->db;
		$result = array();
		//
		
		$sql = " select * from h_stats_chart order by i1 desc;";
		$resultsql = $db->createCommand($sql)->query();
		
		foreach($resultsql as $row){
			if ( $row["chartname"] == 'city')	{
				//City
				//$result["city"][] = array($row["n1"],$row["n3"],$row["n2"],$row["n4"],$row["i1"],$row["i2"]); 
				$result["city"][] = array($row["n1"],$row["i1"],$row["i2"]); 
			}
		   if ( $row["chartname"] == 'province')       {
					//City
					$result["province"][] = array($row["n2"],$row["n4"],$row["i1"],$row["i2"]);
			}

		  
			if ( $row["chartname"] == 'price')	{
				//房价分布图
				$result["price"][] = array($row["n1"],$row["i1"]); //n1 is bin and i1 is count
			}
			
			if ( $row["chartname"] == 'house')	{
				//房屋面积分布图
				$result["housearea"][] = array($row["i1"],$row["n1"]); //n1 is bin and i1 is count
			}
			
			if ( $row["chartname"] == 'land')	{
				//土地面积分布图
				$result["landarea"][] = array($row["i1"],$row["n1"]); //n1 is bin and i1 is count
			}
			if ( $row["chartname"] == 'type')	{
				//土地面积分布图
				$result["property_type"][] = array($row["i1"],$row["n1"]); //n1 is bin and i1 is count
			}
						
		}
		

       	//End of count
		
       echo json_encode($result);

      
    }

	
	public function actionGetCityList(){
		$db = Yii::app()->db;
		$result = array();
		$term = trim($_GET['query']);
		//	
		//Generate Count by municipality
		$sql = "
			SELECT municipality,municipality_cname 
			FROM h_mname 
			WHERE municipality like '%".$term."%' 
			OR municipality_cname like '%".$term."%'
			";
		$resultsql = $db->createCommand($sql)->query();
		//
		foreach($resultsql as $row){
		  $result['suggestions']['value'] = $row["municipality"]; 
		  $result['suggestions']['data'] = $row["municipality"]; 
		  
		  //$result["value"] = $row["municipality_cname"]; 
		  //$result["id"] = $row["municipality"]; 
		  $results[] = $result;
		  
		  //If CNAME is different
		  if ( $row["municipality"] != $row["municipality_cname"]) {
 	                $result["suggestions"]['value'] = $row["municipality"];
	                  $result["suggestions"]['data'] = $row["municipality_cname"];
			  $results[] = $result;
		  }
		}
		

		 echo json_encode($results);
      
    }

}
