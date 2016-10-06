//跨浏览器获取视口大小
function getInner(){
	if(typeof window.innerWidth!='undefined'){
		return{
			width:window.innerWidth,
			height:window.innerHeight
		}
	}else{
		return{
			width:document.documentElement.clientWidth,
			height:document.documentElement.clientHeight
		}
	}
}
		// 拖拽
		function drag(){
			var h2=document.getElementsByTagName('h2');
			var disX = 0;
			var disY = 0;

			h2[0].onmousedown = function(ev) {
				var oEvent = ev || event;
				disX = oEvent.clientX - send_info.offsetLeft;
				disY = oEvent.clientY - send_info.offsetTop;

				document.onmousemove = function(ev) {

					var oEvent = ev || event;
                        // 存储div当前的位置
                        var left = oEvent.clientX - disX;
                        var top = oEvent.clientY - disY;

                        if (left < 0) {
                        	left = 0;
                        } else if (left > getInner().width - send_info.offsetWidth) {
                        	left = getInner().width - send_info.offsetWidth;
                        }

                        if (top < 0) {
                        	top = 0;
                        } else if (top > getInner().height - send_info.offsetHeight) {
                        	top = getInner().height - send_info.offsetHeight;
                        }

                        send_info.style.left = left + 'px';
                        send_info.style.top = top + 'px';
                    };

                    document.onmouseup = function() {
                    	document.onmousemove = null;
                    	document.onmouseup = null;
                    };
                    return false; // 阻止默认事件,解决火狐的bug
                };

        }
