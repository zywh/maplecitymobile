var getByClass = function(oP, oC){	
	typeof oP=='object'?oP:byId(oP);	
	var arrs=oP.getElementsByTagName('*');var i=0;var garrs=[];	
	for(i=0;i<arrs.length;i++){if(arrs[i].className==oC){garrs.push(arrs[i]);}}	
	return garrs;
};
var byId = function (id) {
	return "string" == typeof id ? document.getElementById(id) : id;
};
var byTag = function(tag,obj){
	return (typeof obj=='object'?obj:byId(obj)).getElementsByTagName(tag);
};
var getStyle = function(obj,attr){
	if(obj.currentStyle){
		return obj.currentStyle[attr];
	}else{
		return getComputedStyle(obj, false)[attr];
	}
};
var Class = {
	create: function() {
		return function() {this.initialize.apply(this, arguments); }
	}
};
var tFocus = Class.create();
tFocus.prototype = {
	initialize: function(tag,json) {		
	    var _this = this;
		this.iNow = 0;	
		this.style = json.changeStyle;
		this.aTimer = null;		
		this.tFocus = byId(tag);
		this.oPics = getByClass(this.tFocus,'pics')[0];		
		this.oPicLis = 	byTag('li',byTag('ul',this.tFocus)[0]);			
		this.oBtns = getByClass(this.tFocus,'btns')[0];	
		this.oBtnLis = byTag('li',getByClass(this.tFocus,'btns')[0]);
		this.oText = getByClass(this.tFocus,'tFocusText')[0];		
		this.oTextLis = byTag('li',this.oText);			
		this.prevBtn = getByClass(this.tFocus,'tFocus-prevBtn')[0];	
		this.nextBtn = getByClass(this.tFocus,'tFocus-nextBtn')[0];					
		if(this.style=='opac'){
			for(var i=0;i<this.oPicLis.length;i++){
		     this.oPicLis[i].style.position = 'absolute';
			 this.oPicLis[i].style.filter = 'alpha(opacity=0)';
			 this.oPicLis[i].style.opacity = 0;
	      }
		  this.oPicLis[0].style.filter = 'alpha(opacity=100)';
		  this.oPicLis[0].style.opacity = 1;		 
		};		
		this.doMove();			
		if(json.timer&&json.timer!=='undefind'){					
			this.timer = json.timer;
			this.autoPlay();
			
		}
		this.tFocus.onmouseover = function(){					  	  
			  clearInterval(_this.aTimer);		  
		}
		this.tFocus.onmouseout = function(){			
		  if(json.timer){_this.autoPlay();}
		}				
	},
	doMove: function(){
	  var _this = this;
	  clearInterval(_this.aTimer);	
	  this.oTextLis[0].className = 'current';  
	  for(var i=0;i<this.oBtnLis.length;i++)
	   {
		  this.oBtnLis[i].sIndex = i;
		  this.oBtnLis[i].onclick = function(){			 
			_this.setPic(this.sIndex);	
			_this.setText(this.sIndex);		 
			_this.setBtn(this.sIndex); 
		  }
	   };
	   this.prevBtn.onclick = function(){
		  if(_this.iNow<_this.oBtnLis.length-1){		  
		   _this.iNow++;		   
		  }else{
			 _this.iNow = 0;
		  }			  	 
		   _this.setPic(_this.iNow);
		   _this.setText(_this.iNow);
		   _this.setBtn(_this.iNow); 		  
	   };
	    this.nextBtn.onclick = function(){
		 if(_this.iNow<=0){		  
		   _this.iNow=_this.oBtnLis.length-1;			  
		  }else{
			 _this.iNow--;
		  }			  	 
		   _this.setPic(_this.iNow);
		   _this.setText(_this.iNow);
		   _this.setBtn(_this.iNow); 
	   };	
	},
	setBtn: function(iNum){		
	  for(var i=0;i<this.oBtnLis.length;i++){
		this.oBtnLis[i].className = '';  
	  }
	    this.oBtnLis[iNum].className = 'current';			
		if(iNum==0){					
	      this.startMove(this.oBtns,{top:0});
	    }else if(iNum>=this.oBtnLis.length-2){		  		
		  this.startMove(this.oBtns,{top:-(this.oBtnLis.length-4)*(parseInt(getStyle(this.oBtnLis[0],'height')))});
	    }else{			 	
		  this.startMove(this.oBtns,{top:-(iNum-1)*(parseInt(getStyle(this.oBtnLis[0],'height')))}); 		 
	    }
		
	},
	setText:function(iNum){
		//alert(this.oTextLis.length);		
	  for(var i=0;i<this.oTextLis.length;i++){
		  this.oTextLis[i].className = 'normal';  
	  }
	  this.oTextLis[iNum].className = 'current'; 
	},
	setPic:function(iNum){	
	  if(this.style=='opac'){
		  for(var i=0;i<this.oPicLis.length;i++){
		    this.startMove(this.oPicLis[i],{opacity:0});  
	      }		 
		  this.startMove(this.oPicLis[iNum],{opacity:100}); 
	  }else if(this.style=='up'){
		 this.startMove(byTag('div',this.oPics)[0],{top:-iNum*parseInt(getStyle(byTag('li',this.oPics)[0],'height'))}); 
	  }else{
		 this.startMove(byTag('div',this.oPics)[0],{top:-iNum*parseInt(getStyle(byTag('li',this.oPics)[0],'height'))});  
	  } 
	  
	},
	autoPlay:function(){
		var _this = this;			
		if(this.aTimer){
		  clearInterval(this.aTimer);	
		}
	    this.aTimer = setInterval(function(){		  						   
			  if(_this.iNow<_this.oPicLis.length-1){
				 _this.iNow++; 
			  }else{
				 _this.iNow=0; 
			  }
			  _this.setPic(_this.iNow);
			  _this.setText(_this.iNow);
			  _this.setBtn(_this.iNow); 			  
		},_this.timer);			
	},		
	startMove:function(obj, json, fn)
    {		
	clearInterval(obj.timer);
	obj.timer=setInterval(function (){		
		var bStop=true;		
		for(var attr in json)
		{			
			var iCur=0;			
			if(attr=='opacity')
			{
				iCur=parseInt(parseFloat(getStyle(obj, attr))*100);
			}
			else
			{
			  iCur=parseInt(getStyle(obj, attr));				
			}			
			var iSpeed=(json[attr]-iCur)/8;
			iSpeed=iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);			
			if(iCur!=json[attr])
			{
				bStop=false;
			}			
			if(attr=='opacity')
			{
				obj.style.filter='alpha(opacity:'+(iCur+iSpeed)+')';
				obj.style.opacity=(iCur+iSpeed)/100;
			}
			else
			{
				obj.style[attr]=iCur+iSpeed+'px';
			}
		}		
		if(bStop)
		{
			clearInterval(obj.timer);
			
			if(fn)
			{
				fn();
			}
		}
	}, 30)
}
};