(function(){
	var announcementListDom = $("#announcementListContainer");
console.log(announcementListDom);
console.log(announcementListDom.find("ul"));
	var announcementListtimer = null;
	function autoScroll(){
		announcementListtimer = setInterval(function(){
			announcementListDom.find("ul").animate({
				marginTop : "-45px"
			},500,function(){
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
			});
		},2000);
	};
	$("announcementList .fr ul li a").hover(function(){
		clearTimeout(announcementListtimer);
	},function(){
		autoScroll();
	});
	autoScroll();
})();

(function(){
	var sliderContainer = $("#img-list");
	var sliderIndex = 0;
	
	var $pre = $("#banner  .pre");
	var $next = $("#banner .next");


	$next.click(function(){
		play(1);
	});
	$pre.click(function(){
		play(1);
	});
	
	function play(direction = 1){
		imgs = $(sliderContainer).children();
		next = sliderIndex + direction;
		if(next >= imgs.length)
			next = 0;
		if(next < 0)
			next = imgs.length;
		
		fromPosition = 100 * direction + "%";
		toPosition = 100 * direction * -1 + "%";
		
		$(imgs[sliderIndex]).animate({left : toPosition}, 300);
		$(imgs[next]).css({left : fromPosition}).animate({left : 0}, 300);
		sliderIndex = next;
	}
	
	
	/*
	var $listDom = $("#banner  .list ul li");
	var $listShow = $("#banner  .list");
	var $listBox = $("#banner  .list ul");
	var $imgDom = $("#banner  .img-list ul");
	var $pre = $("#banner  .pre");
	var $next = $("#banner .next");
	var $list = $("#banner ");
	var len = $listDom.length;
	var _index = 0;
	var timer = null;
	$listDom.click(function(){
		_index = $(this).index();
		$(this).addClass("click").siblings().removeClass("click");
		play();
	});
	$pre.click(function(){
// console.log(_index);
		 _index--;
		if( _index < 0 ){
			_index = (len-1);
		   $imgDom.marginLeft = -1226*(len-1)+"px";
		}
		$listDom.eq(_index).addClass("click").siblings().removeClass("click");
		play();
	});
	$next.click(function(){
		 _index++;
		if( _index > (len-1)){
			_index = 0;
		   $imgDom.marginLeft = 0+"px";
		}
		$listDom.eq(_index).addClass("click").siblings().removeClass("click");
		play();
	});
	$listDom.click(function(){
		_index = $(this).index();
		play();
	});
	function play(){
		$imgDom.stop(true).animate({
			marginLeft:"-100%"
		},500);
		 $listBox.stop(true).animate({
			marginLeft:-198*_index+ "px"
		},500);
	};
	$list.hover(function(){
		clearTimeout(timer);
		// $listShow.show();
	},function(){
		autoPlay();
		// $listShow.hide();
	});
	function autoPlay(){
		timer = setInterval(function(){
			_index++;
			if(_index == len){
				_index = 0;
			}
			$listDom.eq(_index).addClass("click").siblings().removeClass("click");
				play();
		},200000);
	};
	autoPlay();*/
})();