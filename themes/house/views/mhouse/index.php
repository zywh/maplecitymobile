

<script>

function update_houselist(options) {
	
	loading = true; //prevent further ajax loading
	//Ajax Start
	$.ajax({
		url: '/index.php?r=mhouse/SearchHouse',
		type: 'POST', 
		dataType: 'json', 
		data: { 
			sr : 	options['sr'],
			pageindex: options['pageindex'],
			housetype: options['type'],
			//houseprice: options['price'],
			houseroom: options['bedroom'],
			housebaths: options['washroom']
			//househousearea: options['housearea'],
			//houselandarea: options['landarea'],
			//orderby: options['orderby'],
			//city: options['city'],
			
			
		},

		//Success Start
		success: function(result) {
			forIndex++;
			//Result Loop Start
			var houseCount = result.Data.Total;
			var tableHtml = "";
			$(result.Data.MapHouseList).each(function(index) {
				//console.log("Build House list HTML");
					
				var hprice = ( sr == 'Lease' )? Math.round(this.Price*10000) +'  加元/月' : Math.round(this.Price) +'  万加元';
				
				var li = "<li data-icon='false'> " 
				+ " <a data-ajax='false' href='<?php echo Yii::app()->createUrl('mhouse/view'); ?>&id=" + this.Id + "'>" 
				+ "<img src=' " + this.CoverImg + "'>" 
				+ "<h3>" + this.HouseType + ":" + this.Beds + "卧" + this.Baths + "卫" + this.Kitchen + "厨" + "</h3>" 
				+ "<p>" + this.Address + "," + this.MunicipalityName + "</p>" 
				+ "<p>价钱:"  + hprice + "</p> " 
				+ "</a>"
				//+ "<a href='mailto:info@maplecity.com.cn?subject=查询房源-" + this.MlsNumber + "'>"
				//+ "</a>"
				
				+ "</li>";
				
				tableHtml = tableHtml + li;	
	
				//HouseArray[Arrayindex] = li;
				//Arrayindex++;
			});
			//Result Loop End
			
			
			//Display HouseList Start

			$("#house_count").text(houseCount + ":" + page);
			/*
            var tableHtml = "";
			$.each(HouseArray, function(index) {
				
				tableHtml = tableHtml + HouseArray[index];
			
			});
			
			*/
			if ( page == "0" ){
				//console.log("Refresh Page index:" + page);
				//console.log(tableHtml);
				$("#house_list").html(tableHtml).promise().done(function () {
				  $("#house_list").listview().listview('refresh');
				});
				

			} else {
				console.log("Append Page index:" + page);
				$("#house_list").append(tableHtml).listview('refresh');
				$('.animation_image').hide(); //show loading image
				loading = false; //prevent further ajax loading
			}
			
			
		}
		//Success End
	});
	//Ajax End
			
}

function getFieldValues() {
   
    $('select').each(function() {
        options[this.id] = this.value; //push value into options object
    });
    
}

var options = {};
var pageSize = 10;
var forIndex = 0;
var Arrayindex = 0;
var HouseArray = [];
var lenght = 1;
var sr = '<?php echo $_GET['sr'];?>';
var page = 0; //total loaded page zero for first page
var loading  = false; //to prevents multipal ajax loads
var total_groups = 1 ;

options['sr'] = sr;
options['pageindex'] = page;

$(document).on("pageshow","#page_main",function(){
	
	
  	if ( sr == "Sale"){
		$("#header_sale").addClass('ui-btn-active'); //make Sales Header active
	} else if ( sr == "Lease") {
		$("#header_lease").addClass('ui-btn-active'); //make Lease Header active
	}
		
	getFieldValues();
	//$("#pricetext").text(options["sr"] + ":" +  options['type']);  
	update_houselist(options);
	//$('ul').listview('refresh');
	
	//Start Select Change Event  
	$("select").change(function () {
		getFieldValues(); //Get updated Select
		//$("#pricetext").text(options["sr"] + ":" +  options['type']); 
		$('#search_clear').show(); 
		update_houselist(options);
		
		
	  
	});
	//Search Clear
	$('#search_clear').click(function()	{ 
		$("select").val([]);
		$("select").selectedIndex = -1;
		$("select").selectmenu('refresh');
		console.log("Clear Select");
		$('#search_clear').hide(); 
		//return false; 
	});	

	//Detect scroll to bottom
	$(window).scroll(function(){
		if($(document).height() > $(window).height()) {
			if($(window).scrollTop() == $(document).height() - $(window).heigh