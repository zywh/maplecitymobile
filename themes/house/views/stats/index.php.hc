<div class="cl"></div>

<div class="chartbox">
	<div id="statsmonth">
	</div>
	<div id="statsyear" >
	
	</div>

</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="/static/js/Highcharts-4.2.1/js/highcharts.js"></script>
<script src="/static/js/Highstock-4.2.1/js/highstock.js"></script>



<script type="text/javascript">


 $.ajax({
        url: '<?php echo Yii::app()->createUrl('stats/getData'); ?>',
        dataType: "json",
        success: function(result) {
		//Start Success	
		//$.getJSON('<?php echo Yii::app()->createUrl('stats/getData?callback=?'); ?>', function(result) {
		
				
			var s1 = [];
			var s2 = [];
			$(result.YearData).each(function(index) {
				
				//mydate=this.Date.split("-");
				
				
				//JS month is 0-based. So -1 get right month in Highchart
				//array = [  Date.UTC(mydate[0],mydate[1]-1,mydate[2]) ,Number(this.AvgPrice)];
				array1 = [ Number(this.Date) ,Number(this.AvgPrice)];
				array2 = [ Number(this.Date) ,Number(this.Sale)];
				//console.log(this.Date);
				s1.push(array1);
				s2.push(array2);
			
			});
			
			var options = {
			  chart: {
                zoomType: 'x'
				},
			
				title: {
					text: '大多地区房价年度历史图'
				},
				subtitle: {
					text: document.ontouchstart === undefined ?
                        '用鼠标选择区域放大' : '用鼠标选择区域放大'
				},
				            xAxis: {
                type: 'datetime'
            },
			yAxis: [{ // left y axis
			title: {
				text: "平均价格"
			},
			labels: {
				align: 'left',
				x: 3,
				y: 16,
				format: '{value:.,0f}'
			},
                showFirstLabel: false
            }, { // right y axis
                //linkedTo: 0,
                gridLineWidth: 0,
                opposite: true,
                title: {
                    text: "房源数"
                },
                labels: {
                    align: 'right',
                    x: -3,
                    y: 16,
                    format: '{value:.,0f}'
                },
                showFirstLabel: false
            }],

            legend: {
                enabled: true
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 3
                    },
                    lineWidth: 2,
                    states: {
                        hover: {
                            lineWidth: 3
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                //type: 'area',
                name: '价格',
				yAxis: 0,
                data: s1
				
            },{
				name: '成交房源',
				yAxis: 1,
				data: s2
				
            }
			]
			};
			
			
		    $('#statsyear').highcharts(options);
    	

		}
		//END Success
	});

  
  
	
</script>