$(function(){
    /*我要贷款与申请贷款之间的切换*/
    (function(){
        var $divDoms = $("#container .application .a-fl .loan-title>div");
        var $formDoms = $("#container .application .a-fl .loantype .l-content .fl form");
        var $sj = $("#container .application .a-fl .loan-title p");
        $divDoms.on("click",function(){
            var _index = $(this).index();
             $(this).addClass("click").siblings().removeClass("click");
             $formDoms.eq(_index).css("display","block").siblings().css("display","none");
             if(_index){
                $sj.css("left","560px");
             }else{
                $sj.css("left","180px");
             }
        });
    })();
    (function(){
        var $listDom = $("#banner .b-content .list ul li");
        var $listShow = $("#banner .b-content .list");
        var $listBox = $("#banner .b-content .list ul");
        var $imgDom = $("#banner .b-content .img-list ul");
        var $pre = $("#banner .b-content .pre");
        var $next = $("#banner .b-content .next");
        var $list = $("#banner .b-content");
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
                marginLeft:-1226*_index+ "px"
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
            },2000);
        };
        autoPlay();
    })();
    (function(){
        var $aDoms =$("#container .login .login-bar .login-register a");
        $aDoms.hover(function(){
            $(this).addClass("hover").siblings().removeClass("hover");
        });
    })();
    (function(){
        var $pos = $("#header .h-nav .nav .fr ul li.pos");
        var $hide = $("#header .h-nav .nav .fr ul li .hide");
        $pos.hover(function(){
            $(this).find(".hide").stop().fadeIn().css("box-shaw","0px 2px 4px #bbb");
        },function(){
            $(this).find(".hide").stop().fadeOut();
        });
    })();
    // (function(){
    //     var $sliderLi = $("#banner .b-content .slider ul li");
    //     var $subMenu = $("#banner .b-content .slider ul li .sub-menu");
    //     var _index = 0;
    //     $sliderLi.hover(function(){
    //         _index = $(this).index();
    //         $subMenu.eq(_index).show();
    //     },function(){
    //         _index = $(this).index();
    //         $subMenu.eq(_index).hide();
    //     });

    // })();
    /*公告的文字滚动*/
    // (function(){
    //     var $inforDom = $(".search .s-content .s-input .fr");
    //     var $li = $(".search .s-content .s-input .fr ul li a");
    //     var len = $(".search .s-content .s-input .fr ul li").length;
    //     var _index = 0;
    //     var timer = null;
    //     function play(){
    //         timer = setInterval(function(){
    //             _index++;
    //             if(_index==len){
    //                 _index = 0;
    //                 console.log(_index);
    //                 $inforDom.find('ul').offset().top = "0";
    //             }
    //             $inforDom.find('ul').animate({
    //                 marginTop:-45*_index+ "px"
    //             });
    //             // if(_index >len){
    //             //     len = 0;
    //             // }
    //         },3000);
    //     };
    //     play();
    //     $li.hover(function(){
    //         clearTimeout(timer);
    //     },function(){
    //         play();
    //     });
    // })();
    /*-------------------------修改的文字滚动--------------------------------*/
    (function(){
        var $inforDom = $(".search .s-content .s-input .fr");
        var timer = null;
        function autoScroll(){
            timer = setInterval(function(){
                $inforDom.find("ul").animate({
                    marginTop : "-45px"
                },500,function(){
                    $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
                });
            },2000);
        };
        $(".search .s-content .s-input .fr ul li a").hover(function(){
            clearTimeout(timer);
        },function(){
            autoScroll();
        });
        autoScroll();
    })();
    /*热门房贷产品*/
    (function(){
        var $spanDom = $("#container .content .hot-loan .title .selecter span");
        var $ulDom = $("#container .content .hot-loan .h-banner ul");
        $spanDom.on("click",function(){
			if(!$(this).index()){//点击右边的
				if(parseInt($ulDom.css("margin-left"))<0){
					$ulDom.animate({
						marginLeft: (parseInt($ulDom.css("margin-left"))+1226)+"px",
					});
				}
            }else{
				if($ulDom.width()>Math.abs(parseInt($ulDom.css("margin-left"))-1226)){
					$ulDom.animate({
						marginLeft: (parseInt($ulDom.css("margin-left"))-1226)+"px",
					});
				}
            }
        });
    })();
    /*最新需求信息*/
    (function(){
        var $spanDom = $("#container .content .new-infor .title .selecter span");
        var $ulDom = $("#container .content .new-infor .news ul");
        var $stop = $("#container .content .new-infor .news");
        var timer = null;
        var flag = false;
        $stop.hover(function(){
            clearTimeout(timer);
        },function(){
            autoPlay();
        });
        function autoPlay(){
            timer = setInterval(function(){
                if(!flag){
                    $ulDom.animate({
                        marginLeft:-1226+"px"
                    });
                    flag = true;
                }else{
                    $ulDom.animate({
                        marginLeft:0+"px"
                    });
                    flag = false;
                }
            },5000);
        }
        autoPlay();
    })();
    /*热门房贷产品*/
    (function(){
        var $spanDom = $("#container .content .counsel .title .selecter span");
        var $ulDom = $("#container .content .counsel .specialist ul");
        $spanDom.on("click",function(){
            if(!$(this).index()){//点击右边的
				if(parseInt($ulDom.css("margin-left"))<0){
					$ulDom.animate({
						marginLeft: (parseInt($ulDom.css("margin-left"))+1226)+"px",
					});
				}
            }else{
				if($ulDom.width()>Math.abs(parseInt($ulDom.css("margin-left"))-1226)){
					$ulDom.animate({
						marginLeft: (parseInt($ulDom.css("margin-left"))-1226)+"px",
					});
				}
            }
        });
    })();
});