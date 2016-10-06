
window.onload=function(){

  //个人中心——下拉菜单
	$().getClass('member').hover(function(){
		$(this).css('background',' url(./images/3.png) no-repeat right center');
		$().getClass('member_ul').show();
	},function(){
		$(this).css('background',' url(./images/4.png) no-repeat right center');
		$().getClass('member_ul').hide();
	});
	//地址下拉菜单
	$().getClass('add').hover(function(){
		$().getClass('a_ul').show();
	},function(){
		$().getClass('a_ul').hide();
	});

	//登录框
	var login=$().getId('login');
	var screen=$().getId('screen');
		login.center(350,250).resize(function(){
		if (login.css('display')=='block') {
			screen.lock();
		}
	});
	$().getClass('login').click(function(){
		login.center(350,250);
		login.css('display','block');
		screen.lock();
	});
	$().getClass('close').click(function(){
		login.css('display','none');
		screen.unlock();
	});
	//拖拽
	login.drag();


	//影院li背景切换
	var ul=document.getElementById('ul');
	var li=ul.getElementsByTagName('li');
	var span=ul.getElementsByClassName('span');
	for (var i = 0; i < li.length; i++) {
		span[i].style.display='none';
		span[0].style.display='block';

		li[i].index=i;
		if (i%2!=0) {
			li[i].style.background='#FBFBFB';
		}
		li[i].onmouseover=function(){
			for (var i = 0; i < li.length; i++) {
				span[i].style.display='none';
			}
		span[this.index].style.display='block';
		}
	}
//搜索的背景切换
	var search=document.getElementById('search');
	var search_li=search.getElementsByTagName('li');
	for (var i = 1; i < search_li.length; i++) {	
		search_li[i].onmouseover=function(){
			this.style.background='red';
		}
		search_li[i].onmouseout=function(){
			this.style.background='none';
		}
	}
//显示更多影院li
	var disp=document.getElementById('disp');
		disp.onclick=function(){
			if(ul.style.overflow=='auto'){
				ul.style.overflow='hidden';
			}else{
				ul.style.overflow='auto';
			}
		}

	//页面的切换
	// var a1=document.getElementsByClassName('a1');
	// var a2=document.getElementsByClassName('a2');
	// var a3=document.getElementsByClassName('a3');
	// 	a=a1[0].style.color;
	// 	a1[0].onmouseover=function(){
	// 		a1[0].style.color='red';
	// 	};
	// 	a1[0].onmouseout=function(){
	// 		a1[0].style.color=a;
	// 	};
	// 	a2[0].onmouseover=function(){
	// 		a2[0].style.color='red';
	// 	};
	// 	a2[0].onmouseout=function(){
	// 		a2[0].style.color='black';
	// 	};
	// 	a3[0].onmouseover=function(){
	// 		a3[0].style.color='red';
	// 	};
	// 	a3[0].onmouseout=function(){
	// 		a3[0].style.color='black';
	// 	};

//html页面切换
		// a1[0].onclick=function(){
			
		// };
		// a1[0].onmouseout=function(){
		// 	a1[0].style.color=a;
		// };
		// a2[0].onmouseover=function(){
		// 	a2[0].style.color='red';
		// };
		// a2[0].onmouseout=function(){
		// 	a2[0].style.color='black';
		// };
		// a3[0].onmouseover=function(){
		// 	a3[0].style.color='red';
		// };
		// a3[0].onmouseout=function(){
		// 	a3[0].style.color='black';
		// };

		

};