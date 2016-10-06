

var start=new Date();
window.onload=function(){
//轮番图
	var Box=document.getElementById('box');
	var Ul=Box.getElementsByTagName('ul')[0];
	var Li1=Ul.getElementsByTagName('li');
	var Ol=Box.getElementsByTagName('ol')[0];
	var Li2=Ol.getElementsByTagName('li');

	var now1=0;
	var now2=0;
	var timer=null;
//依靠可视窗口
	window.onresize = function(){
		Ul.style.width=Li2.length*getInner().width+'px';

		for (var i = 0; i < Li2.length; i++) {
			Li1[i].style.width=getInner().width+'px';
				Li2[i].index=i;
				Li2[i].onmouseover=function (){
				for (var i = 0; i < Li2.length; i++) {
					Li2[i].className='';
				}
				this.className='active';
				now2=this.index;
				now1=this.index;
				startMove(Ul,'left',-(this.index)*parseInt(Li1[0].style.width));
			};
		}
	}

	Ul.style.width=Li2.length*getInner().width+'px';

	for (var i = 0; i < Li2.length; i++) {
		Li1[i].style.width=getInner().width+'px';
			Li2[i].index=i;
			Li2[i].onmouseover=function (){
			for (var i = 0; i < Li2.length; i++) {
				Li2[i].className='';
			}
			this.className='active';
			now2=this.index;
			now1=this.index;
			startMove(Ul,'left',-(this.index)*parseInt(Li1[0].style.width));
		};
	}
		timer=setInterval(run,3000);
		Box.onmouseover=function(){
			clearInterval(timer);
		};
		Box.onmouseout=function(){
			timer=setInterval(run,3000);
		};
function run(){
	if (now2==0) {
		Li1[0].style.position='static';
		Ul.style.left=0;
		now1=0;
	}
	if (now2==Li2.length-1) {
		now2=0;
		Li1[0].style.position='relative';
		Li1[0].style.left=parseInt(Li2.length*parseInt(Li1[0].style.width))+'px';
	}else{
		now2++;
	}
	now1++;
	for (var i = 0; i < Li2.length; i++) {
		Li2[i].className=''
	}
	Li2[now2].className='active';
	startMove(Ul,'left',-(now1)*parseInt(Li1[0].style.width));
  }


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

	//透明层的显示与隐藏
	var t1=document.getElementsByClassName('t1');
	var t=document.getElementsByClassName('t');
	for (var i = 0; i < t.length; i++) {
		t[i].index=i;
		t[i].onmouseover=function(){
			t1[this.index].style.display='block';
		}
		t[i].onmouseout=function(){
			t1[this.index].style.display='none';
		}
	}

	//影片的显示与隐藏
	var three=$().getClass('three');
	var three1=$().getClass('three1');
	$().getId('button1').click(function(){
		four1.css('display','none');
		three.css('display','block');
		three1.css('display','none');
	});
	$().getId('button2').click(function(){
		four.css('display','none');
		three1.css('display','block');
		three.css('display','none');
	});
	var button1=$().getId('button1');
		button1.mousemove(function(){
		button2.css('textDecoration','none');
			button1.css('textDecoration','underline');
		});
	var button2=$().getId('button2');
		button2.mousemove(function(){
		button1.css('textDecoration','none');
		button2.css('textDecoration','underline');
	});


	var four=$().getId('four');
	var four1=$().getId('four1');
	$().getClass('show').click(function(){
		if (three.css('display')=='block') {
				if (four.css('display')=='none') 
			{
				four.css('display','block');
			}else{
				four.css('display','none');
			}
		}else{
			if (four1.css('display')=='none') 
			{
				four1.css('display','block');
			}else{
				four1.css('display','none');
			}
		}
		
	});
	// center_wrap
	var div44=document.getElementById('div44');
	var current=div44.getElementsByTagName('li');
	for( var i=0;i<5;i++){
		current[i].onmouseover=function(){
			for( var i=0;i<5;i++){
				current[i].className='';
			}
		this.className='current';
		}
	}
	for( var j=5;j<current.length;j++){
		current[j].onmouseover=function(){
			for( var j=5;j<current.length;j++){
				current[j].className='';
			}
		this.className='current';
		}
	}
	//显示聊天窗口
		var send_info=document.getElementById('send_info');
		var chat=document.getElementById('chat');
		var close=document.getElementsByName('close')[0];
		var show_chat=document.getElementById('show_chat');

		chat.onmouseover=function(){
			show_chat.style.display='block';
		}
		chat.onmouseout=function(){
			show_chat.style.display='none';
		}
		chat.onclick=function(){
			send_info.style.display='block';
		};
		close.onclick=function(){
			send_info.style.display='none';
		};

		drag();
		
var end=new Date();
var p1=document.getElementsByClassName('p1')[0];
	p1.innerHTML+=((end.getTime()-start.getTime())/1000+'秒');
};